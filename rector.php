<?php

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withImportNames()
    ->withPaths([
        __DIR__ . '/Modules',
    ]);
