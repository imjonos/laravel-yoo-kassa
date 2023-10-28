<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Nos\Yookassa\Facades\YookassaFacade;
use Tests\TestCase;

class YookassaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Index LanguageLine functionality
     *
     * @return void
     */
    public function testCreatePayment(): void
    {
        $model = YookassaFacade::createPayment(10, 'test');
        $this->assertNotEmpty($model);
    }
}
