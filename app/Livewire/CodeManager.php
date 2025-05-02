<?php

namespace App\Livewire;

use App\Models\Code;
use Livewire\Component;
use Livewire\WithPagination;

class CodeManager extends Component
{
    use WithPagination;

    public $code_name = '';
    public $quantity = 0;
    public $codeId = null;
    public $isEditing = false;

    public function render()
    {
        $codes = Code::paginate(20);
        return view('livewire.code-manager', compact('codes'));
    }

    public function create()
    {
        $this->validate(['code_name' => 'required|string|max:255' ,'quantity' => 'required|integer|min:1']);

        Code::create(['code_name' => $this->code_name , 'quantity' => $this->quantity]);
        $this->resetForm();
        $this->resetPage(); // Reset pagination to refresh the data
        session()->flash('message', 'Code created successfully.');
    }

    public function edit($id)
    {
        $code = Code::findOrFail($id);
        $this->codeId = $id;
        $this->code_name = $code->code_name;
        $this->quantity = $code->quantity;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate(['code_name' => 'required|string|max:255' ,'quantity' => 'required|integer|min:1']);

        $code = Code::findOrFail($this->codeId);
        $code->update(['code_name' => $this->code_name , 'quantity' => $this->quantity]);
        $this->resetForm();
        $this->resetPage(); // Reset pagination to refresh the data
        session()->flash('message', 'Code updated successfully.');
    }

    public function delete($id)
    {
        Code::findOrFail($id)->delete();
        $this->resetPage(); // Reset pagination to refresh the data
        session()->flash('message', 'Code deleted successfully.');
    }

    public function resetForm()
    {
        $this->code_name = '';
        $this->quantity = 0;

        $this->codeId = null;
        $this->isEditing = false;
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }
}

