<?php

namespace Tests\Unit\Services\SyntaxGate\Actions;

use App\Eloquents\Line\Messages\LineText;
use App\Services\Line\ReplyService;
use App\Services\Segmentation\JieBa;
use App\Services\SyntaxGate\Actions\CutSegmentation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CutSegmentationTest extends TestCase
{
    use RefreshDatabase;

    public function testExecuteWillCutSegmentation()
    {
        $text = factory(LineText::class)->states('withMessageEvent')->create([
            'text' => '*紅茶10元',
        ]);
        $event = $text->messageEvent;
        $this->mock(JieBa::class)
            ->shouldReceive('possegCut')
            ->with('紅茶10元')
            ->once()
            ->andReturn([
                [
                    'word' => '紅茶',
                    'tag' => 'nr',
                ],
                [
                    'word' => '10',
                    'tag' => 'm',
                ],
                [
                    'word' => '元',
                    'tag' => 'm',
                ],
            ]);

        $this->mock(ReplyService::class)
            ->shouldReceive('setToken')
            ->with($text->messageEvent->getReplyToken())
            ->once()
            ->shouldReceive('sendText')
            ->with('紅茶nr, 10m, 元m')
            ->once();

        $action = app(CutSegmentation::class);
        $action->execute($event);
    }

    public function testExecuteWillNoActionWithoutKeySign()
    {
        $text = factory(LineText::class)->states('withMessageEvent')->create([
            'text' => '你知道我在說什麼嗎？',
        ]);
        $event = $text->messageEvent;

        $this->mock(JieBa::class);
        $this->mock(ReplyService::class)
            ->shouldNotReceive('setToken');

        $action = app(CutSegmentation::class);
        $action->execute($event);
    }
}
