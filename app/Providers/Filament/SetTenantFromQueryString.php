<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\Company;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SetTenantFromQueryString
{
    public function handle(Request $request, Closure $next): Response
    {
        $user    = Auth::user();
        $company = Company::query()->where('search_code', Str::lower(request('tenant')))->first();

        if ( ! $company) {
            return $next($request);
        }

        if (
            /* @var User $user */
            $user?->companies->contains('id', $company->id)
            || $user?->hasAnyRole(UserRole::elevated())
        ) {
            session(['current_company_id' => $company->id]);
            filament()->setTenant($company);

            $request->route()?->setParameter('tenant', Str::lower($company->search_code));
        }

        return $next($request);
    }
}
