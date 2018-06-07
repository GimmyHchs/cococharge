<?php

namespace App\Eloquents\Line;

use App\Eloquents\Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hookevent extends Eloquent
{
    protected $table = 'hookevents';

    protected $fillable = [
        'original_data',
        'reply_token',
        'type',
        'timestamp',
        'source',
        'message',
    ];

    protected $casts = [
        'message' => 'object',
        'original_data' => 'object',
        'source' => 'object',
    ];

    /**
     * @return HasMany
     */
    public function lineTexts(): HasMany
    {
        return $this->hasMany(LineText::class);
    }

    /**
     * @param LineText $line_text
     */
    public function addLineText(LineText $line_text): void
    {
        $this->lineTexts()->save($line_text);
    }
}
