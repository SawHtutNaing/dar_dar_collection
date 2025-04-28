<?php

namespace App\Livewire;

use App\Models\Code;
use App\Models\FormName;
use Livewire\Component;
use Livewire\WithPagination;

class FormManager extends Component
{
    use WithPagination;

    public $name = '';
    public $formId = null;
    public $selectedCodes = [];
    public $isEditing = false;

    public function render()
    {
        $forms = FormName::with('codes')->paginate(10);
        $codes = Code::all();

        return view('livewire.form-manager', compact('forms', 'codes'));
    }

    public function create()
    {
        // Debug


        $this->validate(['name' => 'required|string|max:255']);

        $form = FormName::create(['name' => $this->name]);

        // Redirect to FormData create section
        return redirect()->route('form-data.create', ['formId' => $form->id]);
    }

    public function update()
    {
        // Debug


        $this->validate(['name' => 'required|string|max:255']);

        $form = FormName::findOrFail($this->formId);
        $form->update(['name' => $this->name]);
        $form->codes()->sync($this->selectedCodes);

        $this->resetForm();
    }

    public function edit($id)
    {
        $form = FormName::findOrFail($id);
        $this->formId = $id;
        $this->name = $form->name;
        $this->selectedCodes = $form->codes->pluck('id')->toArray();
        $this->isEditing = true;
    }

    public function delete($id)
    {
        FormName::findOrFail($id)->delete();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->formId = null;
        $this->selectedCodes = [];
        $this->isEditing = false;
    }
}
