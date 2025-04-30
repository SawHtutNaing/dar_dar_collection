<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Form Data for {{ $form->name }}</h1>

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

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold mb-4">Edit Form Data</h2>

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
        {{-- <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select wire:model="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="1">Order Confirmed</option>
                <option value="0">Cancel</option>
            </select>
            @error('status') <span class="text-redDave-500 text-sm">{{ $message }}</span> @enderror
        </div> --}}

        <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
        <a href="{{ route('form-data.create', ['formId' => $form->id]) }}" class="bg-gray-500 text-white px-4 py-2 rounded-md ml-2">Cancel</a>
    </div>
</div>
