<?php

namespace Tests\Unit;

use App\Events\BillOfLadingReleased;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\TestCase;
use Tests\CreatesApplication;

class OrderTest extends TestCase
{
    use CreatesApplication;
    /**
     * A basic unit Test example.
     *
     * @return void
     */
    public function test_dispatch_release_bill_of_lading_event()
    {
        // Mock the authenticated user
        $user = User::factory()->make();
        Auth::shouldReceive('user')->andReturn($user);

        // Mock event dispatching
        Event::fake();

        // Create an Order model instance
        $order = Order::factory()->make([
            'bl_release_date' => null,
            'freight_payer_self' => 0,  // self-contracted
        ]);

        // Call the function directly on the model
        $order->releaseBillOfLading($order);

        // Assert the Bill of Lading release date is set
        $this->assertNotNull($order->bl_release_date);
        $this->assertEquals($user->id, $order->bl_release_user_id);

        // Assert the event was dispatched
        Event::assertDispatched(BillOfLadingReleased::class, function ($event) use ($order) {
            return $event->order->id === $order->id;
        });
    }
}
