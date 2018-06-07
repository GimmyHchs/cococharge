<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IMessageEvent;
use App\Eloquents\Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineText extends Eloquent implements IMessageEvent
{
    protected $table = 'line_texts';

    protected $fillable = [
        'line_user_id',
        'hookevent_id',
        'line_id',
        'text',
    ];

    /**
     * @return BelongsTo
     */
    public function lineUser(): BelongsTo
    {
        return $this->belongsTo(LineUser::class);
    }

    /**
     * @return BelongsTo
     */
    public function hookevent(): BelongsTo
    {
        return $this->belongsTo(Hookevent::class);
    }
}
