<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Nos\YooKassa\Facades\YooKassaFacade;
use Tests\TestCase;

class YooKassaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Index LanguageLine functionality
     *
     * @return void
     */
    public function testCreatePayment(): void
    {
        $model = YooKassaFacade::createPayment(10, 'test');
        $this->assertNotEmpty($model);
    }
}
