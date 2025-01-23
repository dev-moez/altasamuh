<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Actions\WhatsApp\SendWhatsAppMessageAction;
use App\Casts\ArabicDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Role;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PhoneNumberVerification;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'phone_verified_at',
        'country_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'phone_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => ArabicDateCast::class
        ];
    }

    public static function booted(): void
    {
        parent::booted();

        static::created(function (User $user) {
            if ($user->hasRole(Role::ROLE_USER)) {
                (new SendWhatsAppMessageAction($user->fullPhoneNumber()))->execute("Welcome to {{ config('app.name') }}");
            }
        });
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole([Role::ROLE_ADMIN, Role::ROLE_SUPER_ADMIN]);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function phoneNumberVerifications(): HasMany
    {
        return $this->hasMany(PhoneNumberVerification::class);
    }

    public function fullPhoneNumber()
    {
        return $this->country_code . $this->phone_number;
    }
}
