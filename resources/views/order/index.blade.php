<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders that are awaiting Bill of Lading release') }}
        </h2>
    </x-slot>

    @if($errors->any())
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach($unreleasedSelfContractedOrders as $unreleasedSelfContractedOrder)
                        <li> Order with ID: {{$unreleasedSelfContractedOrder->id}},
                            <form name="addBillOfLading"
                                  action="{{route('orders.releaseBillOfLading', $unreleasedSelfContractedOrder->id)}}"
                                  method="POST">
                                {{csrf_field()}}
                                @method('PATCH')
                                <button type="submit"> Give go to release Bill of Lading</button>
                            </form>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
