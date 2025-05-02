<div class="max-w-7xl mx-auto p-6" wire:ignore>
    <h1 class="text-2xl font-bold mb-4">{{ $form->name }}</h1>

    <!-- Date Filter Form -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        {{-- <h2 class="text-xl font-semibold mb-4">Filter by Date</h2> --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            {{-- <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input wire:model.debounce.500ms="start_date" id="start_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input wire:model.debounce.500ms="end_date" id="end_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div> --}}
            <div class="flex items-end">
                <button wire:click="export" class="bg-green-500 text-white px-4 py-2 rounded-md">Raw Excel </button>
            </div>
            <div class="flex items-end">
                <button wire:click="Sortedexport" class="bg-blue-500 text-white px-4 py-2 rounded-md">Final Excel</button>
            </div>



        </div>
    </div>

    <!-- Form Data Table -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Form Data</h2>
        @if($formData->isEmpty())
            <p class="text-gray-500">No data available for the selected date range.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remark</th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> --}}
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($formData as $index =>  $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ ($formData->currentPage() - 1) * $formData->perPage() + $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->code->code_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->remark }}</td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">{{ $data->status ? 'Order Confirmed' : 'Cancel' }}</td> --}}
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $formData->links() }}
        @endif
    </div>
</div>
