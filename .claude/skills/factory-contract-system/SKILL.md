# Factory Contract System

## Purpose

Ensure factories always represent valid domain state aligned with database constraints.

---

## Core Rule

A factory MUST never generate invalid database records.

If a column is NOT NULL:
- it MUST be present in the factory default state

---

## 1. Schema Awareness

Factories MUST be updated whenever:

- migrations add a NOT NULL column
- columns are renamed
- constraints are tightened

---

## 2. Minimum Valid Entity Rule

Each factory defines the smallest valid version of an entity.

It is not a “random data generator”.

It is a “valid domain constructor”.

---

## 3. Service Alignment

Factories MUST align with service-layer creation logic.

If service requires a field → factory must provide it.

Mismatch is a defect.

---

## 4. Seeder Dependency Rule

Seeders MUST ONLY use factories that already produce valid state.

Seeders are not responsible for fixing factory deficiencies.

---

## 5. Drift Detection

This skill activates when:

- SQLSTATE NOT NULL errors occur
- factories are modified
- migrations introduce constraints
- seeders fail in CI

---

## 6. Validation Principle

If a factory cannot generate a valid model without overrides:

- factory is incomplete
- not the test
- not the service
