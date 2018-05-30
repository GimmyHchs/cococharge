<?php

namespace App\Eloquents\Line;

use App\Eloquents\Account\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LineUser extends Authenticatable
{
    protected $table = 'line_users';

    protected $fillable = [
        'user_id',
        'line_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param User $user
     */
    public function assignToUser(User $user): void
    {
        $this->user()->associate($user)->save();
    }
}
