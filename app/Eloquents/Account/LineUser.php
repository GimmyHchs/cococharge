<?php

namespace App\Eloquents\Account;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LineUser extends Authenticatable
{
    protected $table = 'line_users';

    protected $fillable = [
        'user_id',              // for key
        'line_id',              // line的唯一識別碼
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignToUser($user)
    {
        return $this->user()->associate($user)->save();
    }
}
