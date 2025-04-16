<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Str;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns() : array
    {
        return[
            'id',
            'name',
            'email',
            'password',
            'domain',
        ];
    }

    public function setPasswordAttribute($value)
    {
         return $this->attributes['password']=bcrypt($value);
    }
}
