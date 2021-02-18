<?php

namespace App\Models;

use App\Actions\Fortify\PasswordValidationRules;
use App\Traits\Actions;
use App\Traits\Frontend;
use App\Traits\Searchable;
use App\Traits\IsAdmin;
use App\Traits\PaginationData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use IsAdmin;
    use PasswordValidationRules;
    use Frontend;
    use PaginationData;
    use Searchable;
    use Actions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'admin'
    ];

    /**
     * Attributes hidden in frontend components
     *
     * @var array
     */
    protected $hidden_frontend = [
        'id',
        'profile_photo_url',
        'admin',
        'profile_photo_path'
    ];

    /**
     * Attributes sortable in frontend components
     *
     * @var array
     */
    protected $sortable_frontend = [];

    /**
     * Attribute images in frontend components
     *
     * @var array
     */
    protected $images_frontend = [
        'profile_photo_url'
    ];

    /**
     * Attribute dates in frontend components
     *
     * @var array
     */
    protected $dates_frontend = [];

    protected $searchable = [
        'id',
        'name',
        'email'
    ];

    protected $actions = [
        'edit'
    ];

    /**
     * @return HasMany
     */
    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
