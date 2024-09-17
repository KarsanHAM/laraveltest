<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($orders as $order)
                        @if($order->bl_release_date === null && $order->freight_payer_self === 0)
                        <li> Order with ID: {{$order->id}},
                            <form name="addBillOfLading"
                                  action="{{route('orders.update', $order->id)}}"
                                  method="POST">
                                {{csrf_field()}}
                                @method('PATCH')
                                <button type="submit"> Add Bill of Lading</button>
                            </form>
                        </li>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
