<?php

namespace App\Eloquents\Line;

use App\Eloquents\Eloquent as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;
use stdClass;

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

    /**
     * @param string|null $message
     *
     * @return stdClass
     */
    public function getMessageAttribute(?string $message): stdClass
    {
        return json_decode($message);
    }

    /**
     * @param string|null $message
     *
     * @return stdClass
     */
    public function getOriginalDataAttribute(?string $original_data): stdClass
    {
        return json_decode($original_data);
    }

    /**
     * @param string|null $message
     *
     * @return stdClass
     */
    public function getSourceAttribute(?string $source): stdClass
    {
        return json_decode($source);
    }
}
