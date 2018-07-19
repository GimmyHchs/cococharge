<?php

namespace Tests\Unit\Services\SyntaxGate\Actions;

use App\Eloquents\Line\Messages\LineText;
use App\Services\Line\ReplyService;
use App\Services\SyntaxGate\Actions\CutSegmentation;
use App\Services\SyntaxGate\JieBa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CutSegmentationTest extends TestCase
{
    use RefreshDatabase;

    public function testExecuteWillCutSegmentation()
    {
        $text = factory(LineText::class)->states('withMessageEvent')->create([
            'text' => '*你知道我在說什麼嗎？',
        ]);
        $event = $text->messageEvent;
        $this->mock(JieBa::class)
            ->shouldReceive('cut')
            ->with('你知道我在說什麼嗎？')
            ->once()
            ->andReturn([
                '你',
                '知道',
                '我',
                '在',
                '說',
                '什麼',
                '嗎',
                '？',
            ]);

        $this->mock(ReplyService::class)
            ->shouldReceive('setToken')
            ->with($text->messageEvent->getReplyToken())
            ->once()
            ->shouldReceive('sendText')
            ->with('你, 知道, 我, 在, 說, 什麼, 嗎, ？')
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
