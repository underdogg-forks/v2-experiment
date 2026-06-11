---
name: application-architecture-standard
description: Defines structural rules for Laravel architecture, layering, and code organization
---

# Purpose

Single source of truth for application structure and architectural boundaries.

---

# 1. Layering Rules

## Presentation Layer
- Controllers
- Filament Pages
- Form Requests (validation only)

No business logic allowed.

## Application Layer
- Services
- DTOs
- Transformers

Holds all business logic orchestration.

## Domain Layer
- Models
Represents state and invariants only.

## Infrastructure Layer
- API clients
- External services

Must be replaceable and contain no business logic.

---

# 2. Service Rules

- Business logic lives in services
- No HTTP/Filament logic in services
- DTOs required for input/output
- No facades in services

---

# 3. Dependency Rules

- Constructor injection only
- No service locators
- No hidden dependencies

---

# 4. Architecture Integrity

- No cross-layer leakage
- Strict separation of concerns
- Refactoring must preserve behavior
