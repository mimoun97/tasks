<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = [];
    
    public function addUser($user)
    {
        $this->users()->save($user);
    }

    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
