---
name: senior-laravel-developer-review
description: "Creates a code-review by senior Laravel developer, heavily focusing on amazing phpunit tests"
---

Follow these rules:

Analyze the pull-request to see if it adheres to proper standards:
- [ ] SOLID Programming
- [ ] Dynamic Programming
- [ ] DRY Programming
- [ ] Early return patterns

Analyze the tests to check if it follows these rules:

```
# Test Quality Rules

> Production-grade definitions for use in `.junie/test-quality.md`, `.github/copilot-instructions.md`, `AGENTS.md`, and Codex system prompts.

---

## What Makes a Test Weak

A **weak test** is one that passes even when the system is broken, or fails without clearly identifying the defect.

These are the patterns that create maintenance noise and future inbox load.

---

## Weak Test Properties

A test is **weak** if it contains any of the following.

### 1. No Meaningful Assertion

```php
$response = $this->get('/clients');
$this->assertTrue(true);
```

**Problem:** Always passes. Detects nothing.

---

### 2. Asserts Only Status Code

```php
$response = $this->get('/clients');
$this->assertEquals(200, $response->statusCode());
```

**Problem:** Page can be broken while still returning 200.

**Missing:** Content verification, expected behavior verification.

---

### 3. Tests Framework, Not Business Logic

```php
$this->assertInstanceOf(Clients::class, new Clients());
```

**Problem:** Verifies nothing about behavior.

---

### 4. Tests Happy Path Only

```php
$this->post('/clients/create', $validData);
$this->assertOk($response);
```

**Missing:** Invalid input test, edge cases, boundary conditions.

These generate bug reports later.

---

### 5. Hardcoded Fragile Values

```php
$this->assertEquals('Client 123', $response->body());
```

**Problem:** Breaks on harmless formatting changes.

---

### 6. No Failure Case Testing

Missing tests for: 404 handling, invalid ID, unauthorized access, invalid payload.

This is the **#1 source of production regressions**.

---

### 7. Multiple Behaviors Tested at Once

```php
public function test_clients_page()
{
    // tests listing
    // tests creation
    // tests deletion
}
```

**Problem:** When it fails, root cause is unclear.

---

### 8. No Deterministic Setup

```php
// depends on database state
$response = $this->get('/clients');
```

**Problem:** Tests pass locally but fail in CI.

---

### 9. Hidden Side Effects

```php
$this->get('/clients/delete/5');
```

Without verifying deletion actually happened.

---

### 10. No Coverage of Controller Entry Points

Missing tests for `index()`, `form()`, `save()`, `delete()`, `status()`.

These create untested production paths.

---

## What Makes a Test Sturdy

A **sturdy test** fails only when behavior changes, not when formatting changes.

It must:
- Detect bugs early
- Identify failures precisely
- Remain stable across refactors

---

## Properties of a Sturdy Test

### 1. Tests One Behavior

```php
public function it_displays_clients_index() { ... }
```

Not `test_clients_everything()`.

---

### 2. Has Meaningful Assertions

```php
$this->assertOk($response);
$this->assertStringContainsString('Clients', $response->body());
```

Not `assertTrue(true)`.

---

### 3. Verifies Business Outcome

```php
$this->assertRedirectTo($response, '/clients');
```

Verifies user flow correctness — not framework output.

---

### 4. Tests Failure Paths

Mandatory cases: invalid ID, missing data, unauthorized access, malformed payload.

```php
$response = $this->get('/clients/view/999999');
$this->assertEquals(404, $response->statusCode());
```

---

### 5. Uses Deterministic Data

Must seed known data and reset state per test. Never depend on existing database contents.

---

### 6. Uses Clear Naming

```php
it_redirects_after_client_creation()
```

Not `test1()`.

---

### 7. Verifies Side Effects

```php
$this->post('/clients/delete/5');
$this->assertDatabaseMissing('clients', ['client_id' => 5]);
```

---

### 8. Covers All Controller Entry Points

Every public method — `index()`, `view()`, `form()`, `save()`, `delete()`, `status()` — must have at least one test.

---

### 9. Avoids Brittle Output Matching

**Prefer:** `assertStringContainsString()`

**Avoid:** `assertEquals(full_html)`

---

### 10. Independent Tests

Each test must run alone and must not depend on execution order.

---

## Mandatory Coverage Rules

These must exist **before release**.

### Controller Coverage

Every controller must have:

| Test Type           | Required |
|---------------------|----------|
| Index               | ✅        |
| Create              | ✅        |
| Update              | ✅        |
| Delete              | ✅        |
| Invalid input       | ✅        |
| Unauthorized access | ✅        |
| Not-found           | ✅        |

**Minimum: 7 tests per controller.**

---

### Model Coverage

Every model must test:
- Valid save
- Invalid save
- Required fields
- Boundary values
- Data mutation logic

---

### Validation Coverage

Every form must test:
- Missing required field
- Invalid format
- Maximum length
- Minimum length

---

### Security Coverage

Must test:
- Unauthorized access
- Privilege escalation
- Direct URL access

These prevent security emails, bug reports, and incident alerts.

---

### Regression Coverage

Every bug fixed must add a regression test — without exception.

---

## Stability Rules

Tests must:
- Run headless
- Run deterministically
- Run without internet
- Run without manual setup

---

## Observability Rules

Every failure must show exact failing behavior, not ambiguous output.

---

## Required Coverage Targets

These correlate strongly with low support load.

| Layer       | Target                    |
|-------------|---------------------------|
| Controllers | 100% entry point coverage |
| Models      | 90% behavior coverage     |
| Services    | 90% behavior coverage     |

> **Behavior coverage matters** — not line coverage.

---

## Codex Test Generation Rules

Codex must follow these rules strictly.

**Every generated test MUST:**

1. Test exactly one behavior
2. Contain at least one meaningful assertion
3. Verify business behavior
4. Include at least one failure-path test
5. Use deterministic setup
6. Avoid asserting full HTML equality
7. Avoid placeholder assertions
8. Cover controller entry points
9. Validate both success and failure paths
10. Be independent of other tests

**Reject tests that:**
- Use `assertTrue(true)`
- Only check HTTP 200
- Contain no failure cases

---

## Minimum Survival Checklist

For every module, the following tests must exist:

```
GET  index
GET  view — valid ID
GET  view — invalid ID
POST create — valid data
POST create — invalid data
POST update — valid data
POST update — invalid data
POST delete — valid
POST delete — invalid
     unauthorized access
```

If these exist → inbox stays quiet.

If missing → you get emails.

---

## Final Reality Check

| If you enforce these rules           | If you do not                  |
|--------------------------------------|--------------------------------|
| Codex produces sturdy tests          | Weak tests accumulate          |
| Failures become actionable           | Confidence drops               |
| Regressions drop sharply             | Bug reports increase           |
| Support volume stays low             | Inbox fills                    |
```

Scrutinize all pieces and suggest code-improvements in easily copy/pastable format
Make an amazing code-review comment that is understandable by my 90-year old grandma