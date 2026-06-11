<?php

namespace Modules\Core\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Models\Setting;

class SettingService
{
    public function createSetting(array $data): Setting
    {
        return Setting::query()->create($data);
    }

    public function updateSetting(Setting $setting, array $data): Setting
    {
        $setting->update($data);

        return $setting->fresh();
    }

    public function deleteSetting(Setting $setting): bool
    {
        return (bool) $setting->delete();
    }

    public function listForCompany(int $companyId): Collection
    {
        return Setting::query()
            ->where('company_id', $companyId)
            ->orderBy('setting_key')
            ->get();
    }

    public function getForCompany(int $companyId, string $key): ?Setting
    {
        return Setting::query()
            ->where('company_id', $companyId)
            ->where('setting_key', $key)
            ->first();
    }
}
