<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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
}
