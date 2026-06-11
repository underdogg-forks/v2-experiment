# Autonomous Coding Workflow

## Goal

Perform repository-wide modifications safely, incrementally, and with continuous validation.

---

## Preparation

Before modifying code:

1. Read the existing implementation.
2. Understand the current behavior.
3. Identify existing abstractions that can be reused.
4. Preserve existing architectural patterns.

Do not modify code that has not been understood.

---

## Incremental Development

Complete work in small logical steps.

After each change:

1. Verify compilation.
2. Execute targeted tests.
3. Resolve failures.
4. Run Laravel Pint.
5. Continue only when the repository is in a clean state.

---

## Validation

Never continue after introducing failing tests.

Never ignore:

- PHPUnit failures
- Static analysis failures
- Syntax errors
- Formatting violations

The repository must remain in a working state throughout the refactoring process.

---

## Module Completion

After completing a module:

1. Execute the targeted test suite.
2. Run Laravel Pint.
3. Verify that no unintended changes exist.
4. Create a commit describing the completed module.

Do not begin the next module until the current module is complete.

---

## Uncertainty

If the required behavior cannot be determined with high confidence:

- Stop immediately.
- Explain the ambiguity.
- Request clarification.
- Do not guess implementation details.

---

## Success Criteria

The task is complete only when:

- Existing behavior is preserved.
- No duplicate logic has been introduced.
- The transformation is idempotent.
- All targeted tests pass.
- The full test suite passes.
- Code formatting complies with project standards.
- No unnecessary architectural changes have been introduced.
