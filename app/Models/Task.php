<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'project', 'description', 'deadline', 'start', 'priority', 'status_id'];

    protected $appends = ['user_ids'];
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_assign_tasks',   'task_id', 'user_id');
    }

    public function getDeadlineAttribute($key)
    {
        return date('m/M/Y', strtotime($key));
    }
    public function getStartAttribute($key)
    {
        return date('m/M/Y', strtotime($key));
    }


    public function getUserIdsAttribute($key)
    {
        return array_column($this->user->toArray(), 'id');
    }


    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class, 'priority', 'id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}
