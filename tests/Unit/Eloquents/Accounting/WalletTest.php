<?php

namespace Tests\Unit\Eloquents\Accounting;

use App\Eloquents\Accounting\Wallet;
use App\Eloquents\Line\LineAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function testFactory()
    {
        $wallets = factory(Wallet::class, 5)->create();

        $this->assertEquals($wallets->count(), 5);
    }

    public function testBelongsToLineAccount()
    {
        $wallet = factory(Wallet::class)->create();
        $lineAccount = factory(LineAccount::class)->create();
        $wallet->lineAccount()->associate($lineAccount)->save();

        $this->assertEquals($lineAccount->id, $wallet->lineAccount->id);
    }
}
