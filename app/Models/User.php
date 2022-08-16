<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'avatar',
        'password',
        'random_key',
        'activation_code',
        'is_active',
        'gender',
        'date_of_birth',
        'joining_date',
        'address',
        'about',
        'facebook_id',
        'twitter_id',
        'google_id',
        'status'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['modules'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('users.status', '=', 1);
        });
    }

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('assets/images/default/default-user.jpg');
        }
        return asset('assets/images/user/' . $this->name . '-' . $this->id . '/' . $this->avatar);
    }

    public function hasGravatar($email)
    {
        // Craft a potential url and test its headers
        $hash = md5(strtolower(trim($email)));

        $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
        $headers = @get_headers($uri);

        $has_valid_avatar = true;

        try {
            if (!preg_match('|200|', $headers[0])) {
                $has_valid_avatar = false;
            }
        } catch (\Exception $e) {
            $has_valid_avatar = true;
        }

        return $has_valid_avatar;
    }

    public function getModulesAttribute()
    {
        return user_modules();
    }
}
