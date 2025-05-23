<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Code Manager</h1>

    <!-- Create/Edit Code -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Edit Code' : 'Create Code' }}</h2>
        <div class="mb-4">
            <label for="code_name" class="block text-sm font-medium text-gray-700">Code Name</label>
            <input wire:model="code_name" id="code_name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('code_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input wire:model="quantity" id="quantity" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button wire:click="{{ $isEditing ? 'update' : 'create' }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            {{ $isEditing ? 'Update' : 'Create' }}
        </button>
        @if($isEditing)
            <button wire:click="cancelEdit" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
        @endif
    </div>

    <!-- Code List -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Code List</h2>
        @if($codes->isEmpty())
            <p class="text-gray-500">No codes available.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($codes as $index =>  $code)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">

                                {{ ($codes->currentPage() - 1) * $codes->perPage() + $index + 1 }}

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $code->code_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $code->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="edit({{ $code->id }})" class="text-green-500 hover:underline">Edit</button>
                                <button wire:confirm='Are You Sure Want To Delete Code ?' wire:click="delete({{ $code->id }})" class="text-red-500 hover:underline ml-2">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $codes->links() }}
        @endif
    </div>
</div>
