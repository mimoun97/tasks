<?php

namespace App;

use App\Channel;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Session;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, Notifiable, HasApiTokens, Impersonate, HasPushSubscriptions;

    const DEFAULT_PHOTO = 'default.png';

    const DEFAULT_PHOTO_PATH = 'photos/' . self::DEFAULT_PHOTO;

    const USERS_CACHE_KEY = 'tasks.mimoun1997.users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->save($task);
    }

    public function addTasks($tasks)
    {
        $this->tasks()->saveMany($tasks);
    }

    public function isSuperAdmin()
    {
        return $this->admin;
    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gravatar' => $this->gravatar,
            'mobile' => $this->mobile,
            'admin' => (boolean)$this->admin,
            'roles' => $this->roles()->pluck('name')->unique()->toArray(),
            'permissions' => $this->getAllPermissions()->pluck('name')->unique()->toArray()
        ];
    }

    public function getGravatarAttribute()
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email);
    }

    public function canImpersonate()
    {
        return $this->isSuperAdmin();
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        // els admins no poden ser impersonats
        return !$this->isSuperAdmin();
    }

    public function impersonatedBy()
    {
        if ($this->isImpersonated()) return User::findOrFail(Session::get('impersonated_by'));
        return null;
    }

    public function scopeRegular($query)
    {
        return $query->where('admin', 0);
    }

    public function scopeAdmin($query)
    {
        return $query->where('admin', true);
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }

    public function assignPhoto(Photo $photo)
    {
        $photo->user_id = $this->id;
        $photo->save();
        return $this;
    }

    public function avatars()
    {
        return $this->hasMany(Avatar::class);
    }

    public function addAvatar(Avatar $avatar)
    {
        $this->avatars()->save($avatar);
        return $this;
    }

    /**
     * Hashed key.
     * @return string
     */
    protected function hashedKey()
    {
        $hashids = new \Hashids\Hashids(config('tasks.salt'));
        return $hashids->encode($this->getKey());
    }

    /**
     * Get the photo path prefix.
     *
     * @param  string  $value
     * @return string
     */
    public function getHashIdAttribute($value)
    {
        return $this->hashedKey();
    }

    public function mapSimple()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gravatar' => $this->gravatar,
            'admin' => (boolean)$this->admin,
            'hash_id' => $this->hash_id,
        ];
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class);
    }

    public function routeNotificationForNexmo()
    {
        return $this->mobile;
    }
}
