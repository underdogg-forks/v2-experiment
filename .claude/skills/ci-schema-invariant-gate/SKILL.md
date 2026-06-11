# CI Schema Invariant Gate

## Purpose

Prevent schema-related failures before tests run.

---

## Step 1 — Fresh State Validation

CI MUST execute:

```bash
php artisan migrate:fresh --seed
```

This ensures:
- migrations are valid
- seeders are valid
- factories produce valid state

---

## Step 2 — Schema Integrity Check

After seeding:

- ensure no SQLSTATE errors occurred
- ensure all required fields were satisfied
- ensure no silent DB coercion issues exist

---

## Step 3 — Test Execution

Only after schema is clean:

```bash
php artisan test
```

---

## Step 4 — Failure Classification

If failure occurs:

### Migration failure
→ schema is invalid

### Seeder failure
→ factory or data contract is invalid

### Test failure
→ behavior or expectation is invalid

---

## Step 5 — Rule of Truth

- Database defines truth of structure
- Factories define truth of creation
- Tests define truth of behavior

All three MUST agree before merge.

---

## Result

This gate ensures:

- no hidden NOT NULL surprises
- no CI-only schema failures
- no factory drift
- no silent production divergence
