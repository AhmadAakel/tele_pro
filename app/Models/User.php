<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'verification_code',
        'is_verified',
        'is_admin',
        'email_verified_at',
        'telegram_channel_url',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /**
     * علاقة المستخدم مع القناة
     */
    public function channel()
    {
        return $this->belongsTo(ChannelSetting::class, 'telegram_channel_url', 'telegram_channel_url');
    }

    /**
     * إنشاء كود التحقق
     */
    public function generateVerificationCode()
    {
        $this->verification_code = substr(md5(uniqid(rand(), true)), 0, 6);
        $this->save();
        return $this->verification_code;
    }

    /**
     * التحقق من صحة كود التفعيل
     */
    public function verify($code)
    {
        if ($this->verification_code === $code) {
            $this->is_verified = true;
            $this->email_verified_at = now();
            $this->verification_code = null;
            $this->save();
            return true;
        }
        return false;
    }
}