<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChannelSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telegram_channel_url',
        'is_active',
        'user_count',
        'comment'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * علاقة القناة مع المستخدمين
     */
    public function users()
    {
        return $this->hasMany(User::class, 'telegram_channel_url', 'telegram_channel_url');
    }

    /**
     * تفعيل القناة
     */
    public function activate()
    {
        $this->is_active = true;
        $this->save();
        return $this;
    }

    /**
     * تعطيل القناة
     */
    public function deactivate()
    {
        $this->is_active = false;
        $this->save();
        return $this;
    }

    /**
     * زيادة عدد المستخدمين
     */
    public function incrementUserCount()
    {
        $this->user_count++;
        $this->save();
        
        if ($this->user_count >= 50) {
            $this->deactivate();
        }
        
        return $this;
    }

    /**
     * تغيير رابط القناة
     */
    public function changeUrl($newUrl)
    {
        $this->telegram_channel_url = $newUrl;
        $this->user_count = 0;
        $this->is_active = true;
        $this->save();
        return $this;
    }
}