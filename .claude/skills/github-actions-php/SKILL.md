---
name: github-actions-php
description: "Configures GitHub Actions workflows for PHP/Laravel projects. Activates when modifying the phpunit workflow, adding CI steps, configuring PHP matrix, MySQL services, artifact uploads, or when the user mentions GitHub Actions, CI, workflow, phpunit.yml, or the CI pipeline."
license: MIT
metadata:
  author: project
---

# GitHub Actions PHP Workflow

## Workflow File

`.github/workflows/phpunit.yml`

## Key Design Decisions

**PHP Matrix:** Runs on both 8.3 and 8.4 in parallel. Catches version-specific deprecations early.

**MySQL, not SQLite:** If prod is MySQL, CI must be MySQL. Never shortcut with SQLite.

**`.env.ci`:** A dedicated env file committed to the repo (`.gitignore` exception added).
The workflow copies it to both `.env` and `.env.testing`.

**Output parser:** `vendor/bin/phpunit ... | tee phpunit-output.log | php .github/scripts/parse-phpunit.php`
strips passing test lines, condenses stack traces, and surfaces only failures. Full log uploaded as artifact.

## MySQL Service

```yaml
services:
  mysql:
    image: mysql:8.0
    env:
      MYSQL_ROOT_PASSWORD: password
    ports:
      - 3306:3306
    options: >-
      --health-cmd="mysqladmin ping"
      --health-interval=10s
      --health-timeout=5s
      --health-retries=3
```

Wait for it explicitly — the health check passes before the service is reachable:

```bash
for i in {1..30}; do
  if mysqladmin ping -h127.0.0.1 -uroot -ppassword --silent; then break; fi
  sleep 2
done
```

## .env.ci

```ini
APP_ENV=testing          # makes app()->runningUnitTests() return true
APP_KEY=base64:...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=daybyday_test
DB_USERNAME=root
DB_PASSWORD=password
SESSION_DRIVER=array
QUEUE_CONNECTION=sync
CACHE_STORE=array
MAIL_MAILER=array
```

**Must be excepted in `.gitignore`:**
```
.env*
!.env.example
!.env.testing.example
!.env.ci
```

## Setup PHP Composer Action

`.github/actions/setup-php-composer/action.yml` — a composite action that:
1. Sets up PHP via `shivammathur/setup-php@v2`
2. Caches Composer packages by `composer.lock` hash
3. Runs `composer install` with either `composer-args` (full override) or `composer-flags`

## Exit Code Handling

PHPUnit exits non-zero for warnings too. The workflow distinguishes:

```bash
PHPUNIT_EXIT="${PIPE_EXIT_CODES[0]}"

if [ "$PHPUNIT_EXIT" -eq 0 ]; then exit 0; fi

# Only fail on actual failures/errors, not warnings or incomplete
if grep -Eq 'FAILURES!|ERRORS!|Failures:\s*[1-9]|Errors:\s*[1-9]' "$LOG_FILE"; then
  exit "$PHPUNIT_EXIT"
fi

exit 0  # warnings alone don't fail the build
```

## Workflow Dispatch Inputs

The workflow can be triggered manually with:
- `test_group`: full / crud / api / custom / flaky
- `output`: testdox / pao
- `test_runner`: phpunit / paratest
- `fail_fast`: true / false
- `custom_group_name`: PHPUnit group name (when group=custom)

## Flaky Tests

Tag unreliable tests with `#[Group('flaky')]`. The workflow excludes them by
default (`--exclude-group flaky`) so they never block a merge.
