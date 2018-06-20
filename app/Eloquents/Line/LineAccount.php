<?php

namespace App\Eloquents\Line;

use App\Eloquents\Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LineAccount extends Eloquent
{
    protected $table = 'line_accounts';

    protected $fillable = [
        'type',
        'line_id',
    ];

    /**
     * @return HasMany
     */
    public function followEvents(): HasMany
    {
        return $this->hasMany(FollowEvent::class);
    }

    /**
     * @return HasMany
     */
    public function unfollowEvents(): HasMany
    {
        return $this->hasMany(UnfollowEvent::class);
    }

    /**
     * @return HasMany
     */
    public function joinEvents(): HasMany
    {
        return $this->hasMany(JoinEvent::class);
    }

    /**
     * @return HasMany
     */
    public function leaveEvents(): HasMany
    {
        return $this->hasMany(LeaveEvent::class);
    }

    /**
     * @return HasMany
     */
    public function messageEvents(): HasMany
    {
        return $this->hasMany(MessageEvent::class);
    }
}
