<div class="max-w-7xl mx-auto p-6" wire:ignore>
    <h1 class="text-2xl font-bold mb-4">Form Manager</h1>

    <!-- Create/Edit Form -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">{{ $isEditing ? 'Edit Form' : 'Create Form' }}</h2>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Form Name</label>
            <input wire:model="name" id="name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if($isEditing)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Attach Codes</label>
                @foreach($codes as $code)
                    <div>
                        <input wire:model="selectedCodes" type="checkbox" value="{{ $code->id }}" id="code-{{ $code->id }}">
                        <label for="code-{{ $code->id }}">{{ $code->code_name }}</label>
                    </div>
                @endforeach
            </div>
        @endif

        <button wire:click="{{ $isEditing ? 'update' : 'create' }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            {{ $isEditing ? 'Update' : 'Create' }}
        </button>
        @if($isEditing)
            <button wire:click="resetForm" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</button>
        @endif
    </div>

    <!-- Form List -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Form List</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Codes</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($forms as $form)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $form->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $form->codes->pluck('code_name')->implode(', ') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('form-data.index', $form->id) }}" class="text-blue-500 hover:underline">View Data</a>
                            <a href="{{ route('form-data.report', $form->id) }}" class="text-purple-500 hover:underline ml-2">Report</a>
                            <button wire:click="edit({{ $form->id }})" class="text-green-500 hover:underline ml-2">Edit</button>
                            <button wire:click="delete({{ $form->id }})" class="text-red-500 hover:underline ml-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $forms->links() }}
    </div>
</div>
