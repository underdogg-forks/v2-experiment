# Laravel Architecture Standards

## Goal

Maintain a consistent, scalable Laravel architecture that emphasizes reuse, separation of concerns, and maintainability.

---

## Dependency Reuse

- Reuse existing DTOs, Transformers, Services, Repositories, and Adapters whenever possible.
- Never replace typed objects with arrays when a DTO already exists.
- Prefer extending existing abstractions over creating new ones.

---

## Duplicate Logic

- Avoid duplicated implementations.
- Extract shared behavior into reusable abstractions when appropriate.
- Prefer Traits or dedicated Services over copy-pasted logic.

---

## Control Flow

- Prefer early returns.
- Minimize nesting.
- Keep methods focused on a single responsibility.

---

## Service Layer

- Business logic belongs in Services.
- Framework lifecycle logic belongs in Controllers, Filament Pages, Commands, Jobs, or Listeners.
- Infrastructure concerns must not leak into business Services.

---

## SOLID Principles

- Maintain single responsibility.
- Reduce coupling between classes.
- Prefer composition over duplication.
- Introduce abstractions only when they provide meaningful value.

---

## Existing Architecture

- Follow the existing architectural patterns of the project.
- Extend existing components before introducing new ones.
- Keep naming conventions and project structure consistent with surrounding code.
