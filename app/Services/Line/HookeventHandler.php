<?php

namespace App\Services\Line;

use App\Exceptions\Line\UndefinedEventTypeException;
use App\Services\Line\WebhookParsers\ParserFactory;
use Illuminate\Support\Collection;
use Log;

class HookeventHandler
{
    /**
     * @var Collection
     */
    private $hookevents;

    /**
     * @param array $events
     *
     * @return Collection
     */
    public function handle(array $events, bool $isAutoSave = false): Collection
    {
        $this->hookevents = collect([]);

        foreach ($events as $event) {
            try {
                $parser = ParserFactory::make(array_get($event, 'type'));
                $this->hookevents->push($parser->parse($event, $isAutoSave));
            } catch (UndefinedEventTypeException $e) {
                Log::error($e->getMessage());
            }
        }

        return $this->hookevents;
    }

    /**
     * @return string|null
     */
    public function getFirstReplyToken(): ?string
    {
        return optional($this->hookevents->first())->reply_token;
    }
}
