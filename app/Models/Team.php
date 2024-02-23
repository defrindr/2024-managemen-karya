<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'created_by'];

    public function scopeUserInvitations(Builder $builder, int $userId, bool $status)
    {
        $builder->whereIn(
            'id',
            TeamDetail::where('user_id', $userId)
                ->where('approve', $status)
                ->select('team_id')
        );
    }

    // public function scopeUserPendingInvitations(Builder $builder, int $userId)
    // {
    //     $builder->userInvitations($userId, false);
    // }

    // public function scopeUserApproveInvitations(Builder $builder, int $userId)
    // {
    //     $builder->userInvitations($userId, true);
    // }

    public function isCreator()
    {
        return $this->created_by == auth()->user()->id;
    }

    public function pendingMembers()
    {
        return $this->members()->where('approve', false);
    }

    public function approveMembers()
    {
        return $this->members()->where('approve', true);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_details')->withPivot(['approve']);
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getMemberTextAttribute()
    {
        $members = [];

        foreach ($this->approveMembers()->get() as $member) {
            $members[] = "{$member->name}";
        }

        return join(', ', $members);
    }
}
