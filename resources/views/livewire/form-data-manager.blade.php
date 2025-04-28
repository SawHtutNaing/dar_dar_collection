
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Form Data for {{ $form->name }}</h1>

    <!-- Create/Edit Form Data -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Edit Form Data' : 'Create Form Data' }}</h2>
        <div class="mb-4">
            <label for="code_id" class="block text-sm font-medium text-gray-700">Code</label>
            <select wire:model="code_id" id="code_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">Select Code</option>
                @foreach($codes as $code)
                    <option value="{{ $code->id }}">{{ $code->code_name }}</option>
                @endforeach
            </select>
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
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select wire:model="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="1">Order Confirmed</option>
                <option value="0">Cancel</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click="{{ $isEditing ? 'update' : 'create' }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            {{ $isEditing ? 'Update' : 'Create' }}
        </button>
        @if($isEditing)
            <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
        @endif
    </div>

    <!-- Form Data List -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Form Data List</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remark</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
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
                        <td class="px-6 py-4 whitespace-nowrap">{{ $data->status ? 'Order Confirmed' : 'Cancel' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="edit({{ $data->id }})" class="text-green-500 hover:underline">Edit</button>
                            <button wire:click="delete({{ $data->id }})" class="text-red-500 hover:underline ml-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $formData->links() }}
    </div>
</div>

