<?php

namespace App\Services\Line;

use App\Services\Line\WebhookParsers\ParserFactory;
use Illuminate\Support\Collection;

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
    public function handle(array $events, bool $is_auto_save = false): Collection
    {
        $this->hookevents = collect([]);

        foreach ($events as $event) {
            $parser = ParserFactory::make(array_get($event, 'type'));
            $this->hookevents->push($parser->parse($event, $is_auto_save));
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
