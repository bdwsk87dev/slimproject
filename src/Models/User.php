<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = "users";
    protected $fillable = ['u_email', 'u_password', 'u_first_name', 'u_last_name', 'u_middle_name'];

    /**
     * @return HasMany
     */
    public function roles(): HasMany
    {
        return $this->hasMany(Roles::class);
    }
}