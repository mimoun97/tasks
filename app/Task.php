<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model

{
    //use FormattedDates;
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'completed'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->hasOne(File::class);
    }

    public function assignFile(File $file)
    {
        $file->task_id = $this->id;
        $file->save();
    }

        public function complete($completed = true)
    {
        $this->update(compact('completed'));
    }

    public function incomplete()
    {
        $this->complete(false);
    }

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'completed' => $this->completed,
            'user_id' => $this->user_id,
            'user_name' => optional($this->user)->name,
            'user_email' => optional($this->user)->email,
            'user' => $this->user
//            'tags' => $this->tags
//            'file' => $this->file
        ];

        //TODO timestamps
    }

    public function assignUser(User $user)
    {
        $this->user()->associate($user);
        $this->save();
    }
}
