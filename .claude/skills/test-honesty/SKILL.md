---
name: test-honesty
description: "Audits test infrastructure for environment mismatches and schema drift. Activates when tests pass locally but fail in CI, when switching database drivers, when adding factories or seeders, or when the user mentions SQLite vs MySQL, fragile tests, test confidence, column not found, or schema drift."
license: MIT
metadata:
  author: project
---

# Test Honesty

> Tests are for confidence. A test that passes on SQLite but fails on MySQL isn't a passing test — it's a deferred bug.

## Core Principle

**Never test with a database engine you don't run in production.** SQLite is lenient:
it ignores unknown columns in some contexts, skips foreign key checks by default,
and accepts type coercions that MySQL rejects. Every divergence is a hidden gap
between your test suite and reality.

## When Activated

Run this audit whenever:
- Tests pass locally but fail in CI
- Switching or considering SQLite → MySQL (or vice versa)
- A factory or seeder is created or modified
- A migration adds, renames, or drops a column
- A `Column not found` or `SQLSTATE` error surfaces only in CI

---

## Audit Checklist

### 1. Database Driver

Check `phpunit.xml` for SQLite overrides:

```xml
<!-- BAD — masks MySQL-specific schema issues -->
<env name="DB_CONNECTION" value="sqlite"/>
<env name="DB_DATABASE" value=":memory:"/>
```

If production uses MySQL, CI must also use MySQL. Remove the SQLite overrides and
ensure the workflow spins up a MySQL service and creates the test database.

### 2. Factory Column Audit

For every factory in `Modules/*/database/factories/` and `database/factories/`:

1. Collect all keys returned by `definition()` and any `state()` methods.
2. Find the corresponding migration(s) for the model's table.
3. Flag any key that does not match a column defined in the migration.

Common pitfalls:
- Default Laravel stub uses `name`/`email`; many apps rename these (e.g. `user_name`, `user_email`).
- Copy-pasted factories from another model that uses different column names.
- A migration renamed a column but the factory was not updated.

### 3. Seeder Column Audit

For every seeder in `database/seeders/` and `Modules/*/database/seeders/`:

1. Collect all keys passed to `Model::factory()->create([...])` or `Model::create([...])`.
2. Cross-reference against the model's migration.
3. Flag mismatches — SQLite silently discards unknown keys; MySQL throws `Column not found`.

Pay special attention to `DatabaseSeeder.php` — it is the entry point for
`migrate:fresh --seed` and often contains the default Laravel stub values.

### 4. Seeder in CI

The workflow must run `php artisan migrate:fresh --seed` (not just `migrate:fresh`)
so that seeder column errors are caught before deployment, not after.

### 5. `runningUnitTests()` Guards

Search for `app()->runningUnitTests()` or `App::runningUnitTests()` in the codebase:

```bash
grep -rn "runningUnitTests" app/ Modules/
```

Each hit is a place where production and test code paths diverge. Document why
each one exists. If it exists solely to work around a missing build artifact
(e.g. Vite manifest), fix the artifact problem instead.

---

## How to Run the Audit

```bash
# 1. Collect all factory definition keys
grep -rn "'" Modules/*/database/factories/ database/factories/ \
  | grep "=>" | grep -v "//"

# 2. Collect all migration column definitions
grep -rn "->string\|->integer\|->unsignedBigInteger\|->boolean\|->text\|->timestamp\|->date" \
  database/migrations/ Modules/*/database/migrations/

# 3. Check seeders for hardcoded column names
grep -rn "create(\[" database/seeders/ Modules/*/database/seeders/

# 4. Check for SQLite in phpunit.xml
grep -n "sqlite\|:memory:" phpunit.xml
```

Then manually cross-reference the factory/seeder keys against the migration columns.

---

## Fixing Drift

1. **Wrong column name in factory/seeder** → update to match the migration column name.
2. **SQLite in phpunit.xml** → remove overrides; add a MySQL service to the CI workflow.
3. **`runningUnitTests()` guard hiding a real issue** → fix the underlying problem
   (e.g. commit a real or stub Vite manifest; configure the asset pipeline for test environments).
4. **Migration renamed a column but factory not updated** → update the factory; consider
   adding a test that explicitly creates a model via the factory and asserts the record exists,
   which will catch this on any engine.
