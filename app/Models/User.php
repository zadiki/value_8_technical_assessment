<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMINISTRATOR = 'administrator';

    const ROLE_BRANCH_MANAGER = 'branch_manager';

    const ROLE_STORE_MANAGER = 'store_manager';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdministrator()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isBranchManager()
    {
        return $this->role === self::ROLE_BRANCH_MGR;
    }

    public function isStoreManager()
    {
        return $this->role === self::ROLE_STORE_MGR;
    }

    /**
     * Get the shop associated with the user.
     */
    public function shop(): HasOne
    {
        return $this->hasOne(Shop::class);
    }

    /**
     * Get the branch associated with the user (as a manager).
     */
    public function branch(): HasOne
    {
        return $this->hasOne(Branch::class);
    }
}
