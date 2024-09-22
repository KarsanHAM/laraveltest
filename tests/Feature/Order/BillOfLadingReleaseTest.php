<?php

namespace Order;

use Tests\TestCase;

class BillOfLadingReleaseTest extends TestCase
{
    /**
     * A basic feature Test example.
     *
     * @return void
     */
    public function test_unreleased_orders_index_is_rendered()
    {
        $response = $this->get('/orders');

        $response->assertStatus(200);
    }
}
