<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4"> {{ $form->name }}</h1>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            {{ session('error') }}
        </div>
    @endif




    <!-- Code Selection or Create Form -->
    @if(empty($code_id))
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4">Code</h2>
            @if($codes->isEmpty())
                <p class="text-gray-500">No codes attached to this form.</p>
            @else
            <div class="overflow-x-auto rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200 bg-white">
                    <thead class="bg-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Code</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Quantity</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Available</th>
                            {{-- <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Sold</th> --}}
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Left</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($codes as $code)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3">
                                    <button wire:click="$set('code_id', {{ $code->id }})" class="text-blue-600 hover:underline font-medium">
                                        {{ $code->code_name }}
                                    </button>
                                </td>
                                <td class="px-4 py-3">{{ $code->quantity }}</td>
                                <td class="px-4 py-3">
                                    {{ $code->formData->sum('quantity') > $code->quantity ? 0 : $code->quantity - $code->formData->sum('quantity') }}
                                </td>
                                {{-- <td class="px-4 py-3">{{ $code->quantity - $code->formData->sum('quantity') }}</td> --}}
                                <td class="px-4 py-3">{{ $code->formData->sum('quantity') }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif
        </div>
    @else
        <!-- Create Form -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-semibold mb-4"> {{ $codes->firstWhere('id', $code_id)->code_name ?? 'Unknown' }}</h2>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Selected Code</label>
                <p class="mt-1 text-gray-900">{{ $codes->firstWhere('id', $code_id)->code_name ?? 'Unknown' }}</p>
                <input type="hidden" wire:model="code_id" value="{{ $code_id }}">
                @error('code_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                <input wire:model="customer_name" id="customer_name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('customer_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input wire:model="quantity" id="quantity" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="remark" class="block text-sm font-medium text-gray-700">Remark</label>
                <textarea wire:model="remark" id="remark" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                @error('remark') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            {{-- <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select wire:model="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="1">Order Confirmed</option>
                    <option value="0">Cancel</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div> --}}

            <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create</button>
            <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
        </div>
    @endif

    <!-- Form Data List -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Form Data List</h2>
        @if($formData->isEmpty())
            <p class="text-gray-500">No form data available.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remark</th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> --}}
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($formData as $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->code->code_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $data->remark }}</td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">{{ $data->status ? 'Order Confirmed' : 'Cancel' }}</td> --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('form-data.edit', $data->id) }}" class="text-green-500 hover:underline">Edit</a>
                                <button wire:click="delete({{ $data->id }})" class="text-red-500 hover:underline ml-2">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $formData->links() }}
        @endif
    </div>
</div>
