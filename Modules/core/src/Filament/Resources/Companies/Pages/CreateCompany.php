<?php

namespace Modules\Core\Filament\Resources\Companies\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Core\Filament\Resources\Companies\CompanyResource;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;
}
