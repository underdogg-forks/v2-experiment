# Test Honesty

## Purpose

Ensure tests, factories, seeders, and database schema remain aligned with production reality.

This skill prevents:
- schema drift
- false-positive test suites
- invalid factory-generated state
- hidden MySQL vs SQLite inconsistencies

---

## 1. Schema Contract Enforcement

Every NOT NULL column MUST be represented in:

- factory default state
- service-layer creation path
- or explicit validation test

If none exist → system is invalid.

---

## 2. Factory Contract Rule

Factories MUST always produce valid database state.

- No missing NOT NULL fields
- No reliance on optional DB defaults
- No conditional omissions unless domain explicitly allows null

Factories represent the “minimum valid entity”.

---

## 3. Seeder Integrity Rule

Seeders MUST reflect production-valid data.

- No missing required fields
- No implicit DB coercion reliance
- Must pass on MySQL without SQLite differences

---

## 4. Database Engine Parity

Test environment MUST match production database behavior.

- SQLite divergence is not acceptable for schema-sensitive systems
- MySQL behavior is the reference

---

## 5. Drift Detection Triggers

This skill activates when:

- migrations change columns
- factories are added/modified
- seeders change
- SQLSTATE errors appear
- CI differs from local behavior

---

## 6. Required Smoke Validation (optional but recommended)

Before commit:

- migrate:fresh
- seed
- run full test suite

This is a safety net, not a replacement for proper tests.

---

## 7. Failure Interpretation

If a NOT NULL violation occurs:

- missing factory attribute OR
- missing service validation OR
- incomplete test coverage

Never assume database is wrong.

The code is always wrong first.

---

## 8. Enforcement Priority

1. application-architecture-standard
2. test-honesty
3. domain-specific skills
4. execution workflow
