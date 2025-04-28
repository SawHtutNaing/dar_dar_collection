<?php

namespace App\Livewire;

use App\Models\Code;
use Livewire\Component;
use Livewire\WithPagination;

class CodeManager extends Component
{
    use WithPagination;

    public $code_name = '';

    public function render()
    {
        $codes = Code::paginate(10);
        return view('livewire.code-manager', compact('codes'));
    }

    public function create()
    {
        $this->validate(['code_name' => 'required|string|max:255']);

        Code::create(['code_name' => $this->code_name]);
        $this->code_name = '';
    }

    public function delete($id)
    {
        Code::findOrFail($id)->delete();
    }
}
