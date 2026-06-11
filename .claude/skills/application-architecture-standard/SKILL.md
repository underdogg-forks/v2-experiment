---
name: application-architecture-standard
description: "Defines the structural rules for Laravel application architecture, layering, and code organization"
---

# Purpose

This skill defines the authoritative rules for how Laravel applications must be structured.

It is the single source of truth for:

- architecture boundaries
- layering rules
- code organization
- abstraction decisions
- service responsibilities

---

# 1. Layering Rules

The application MUST follow strict layering:

## Presentation Layer
- Controllers
- Filament Pages
- Form Requests (validation only)

Rules:
- No business logic allowed
- Only orchestration and input/output handling

---

## Application Layer
- Services
- DTOs
- Transformers
- Application workflows

Rules:
- Contains all business logic
- Must not depend on UI layer (Filament, Controllers)
- Must not contain framework-specific logic unless required for contracts

---

## Domain Layer
- Models
- Core business rules inside models (only if unavoidable)
- Value objects (if used)

Rules:
- Models represent state and invariants
- No HTTP, no Filament, no persistence logic outside ORM

---

## Infrastructure Layer
- API clients
- External services
- Repositories (if used)
- Queue integrations

Rules:
- Must be replaceable
- Must not contain business logic
- Must be hidden behind interfaces or adapters

---

# 2. Service Layer Rules

- Services are the ONLY place for business logic orchestration
- Services must not contain framework-specific code
- Services must use DTOs and Transformers for input/output
- Services must not be aware of HTTP, Filament, or request lifecycle

---

# 3. Abstraction Rules

## When to abstract
- Repeated logic appears in 2+ places
- A concept has a clear single responsibility
- A change would otherwise require multiple edits

## When NOT to abstract
- Single-use logic
- Premature optimization
- Unstable or unclear domain behavior

---

# 4. Duplication Control

- Never duplicate business logic across services
- Never copy validation logic into services (keep in Form Requests or Validators)
- Never duplicate transformation logic (use Transformers only)

---

# 5. Primary Key Integrity

- Never assume `id`
- Always use model-defined primary keys
- All services MUST respect domain-specific identifiers

---

# 6. Dependency Rules

- Use constructor injection only
- Never use `app()` or service locators inside business logic
- No facades inside services unless explicitly justified

---

# 7. Framework Boundaries

Laravel / Filament rules:

- Filament handles UI only
- Controllers handle HTTP only
- Services handle business logic only
- Models handle data representation only

No cross-layer leakage is allowed.

---

# 8. Refactoring Safety

All architectural changes must:

- preserve behavior
- avoid breaking public interfaces
- be idempotent
- not introduce duplicate logic

If behavior is unclear → stop immediately.

---

# 9. Enforcement Priority

If conflicts exist:

1. This skill (application architecture)
2. Domain-specific skills (filament, modules, auth)
3. Execution workflows
