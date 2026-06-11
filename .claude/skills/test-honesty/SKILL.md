---
name: test-honesty
description: Ensures test, factory, seeder, and schema consistency with production reality
---

# Purpose

Prevents schema drift and invalid test assumptions.

---

# 1. Schema Contract

Every NOT NULL column must be represented in:
- factory
- service create path
- or explicit validation test

---

# 2. Factory Rule

Factories must always produce valid database state.

No missing required fields.

---

# 3. Seeder Rule

Seeders must reflect production-valid data.

No reliance on implicit DB defaults.

---

# 4. Database Parity

Production DB = MySQL / MariaDB reference.

SQLite differences are invalid for schema logic.

---

# 5. Drift Triggers

- migration changes
- factory updates
- SQLSTATE errors
- CI vs local mismatch

---

# 6. Identity Drift Rule

Do not assume IDs are deterministic.

Never assert hardcoded primary keys.

---

# 7. Smoke Validation

migrate:fresh + seed is required before CI tests.
