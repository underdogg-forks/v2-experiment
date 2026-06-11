# Safe Refactoring Rules

## Goal

Perform safe, deterministic refactoring while preserving existing behavior and architecture.

---

## Existing Methods

- Never overwrite an existing method if it already satisfies part of the requirement.
- Extend existing implementations instead of replacing them.
- Preserve existing business logic unless explicitly instructed otherwise.

---

## Constructor Injection

- Always preserve constructor injection.
- Never replace dependency injection with `app()`, `resolve()`, or facades unless explicitly requested.
- Do not introduce new dependencies when existing ones can be reused.

---

## Public API Stability

- Never modify public method signatures unless every call site is updated within the same change.
- Avoid introducing breaking changes.
- Prefer extending internal behavior instead of changing public contracts.

---

## Idempotent Refactoring

- Refactoring must be idempotent.
- Running the same transformation twice must produce no additional modifications.
- Never introduce duplicate methods, imports, traits, or logic.

---

## Behavior Preservation

- Do not change runtime behavior unless explicitly requested.
- Architectural improvements must preserve observable behavior.
- Moving logic between classes must not alter execution.

---

## Unknown Contracts

- If the intended behavior cannot be inferred from existing code, stop immediately.
- Never invent business rules.
- Never guess missing service contracts.
- Report ambiguities and request clarification instead.
