<?php

namespace App\Livewire;

use App\Models\Code;
use App\Models\FormData;
use App\Models\FormName;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class FormDataManager extends Component
{
    use WithPagination;

    public $formId;
    public $code_id = '';
    public $customer_name = '';
    public $quantity = '';
    public $remark = '';
    public $status = 1;
    public $formDataId = null;
    public $isEditing = false;

    public function mount($formId)
    {
        $this->formId = $formId;
    }

    public function render()
    {
        $form = FormName::findOrFail($this->formId);
        $formData = FormData::where('form_name_id', $this->formId)->with('code')->paginate(10);
        $codes = $form->codes;

        return view('livewire.form-data-manager', compact('form', 'formData', 'codes'));
    }

    public function create()
    {
        $this->validate([
            'code_id' => 'required|exists:codes,id',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'remark' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        FormData::create([
            'form_name_id' => $this->formId,
            'code_id' => $this->code_id,
            'customer_name' => $this->customer_name,
            'quantity' => $this->quantity,
            'remark' => $this->remark,
            'user_id' => Auth::id(),
            'status' => $this->status,
        ]);

        $this->resetForm();
    }

    public function edit($id)
    {
        $formData = FormData::findOrFail($id);
        $this->formDataId = $id;
        $this->code_id = $formData->code_id;
        $this->customer_name = $formData->customer_name;
        $this->quantity = $formData->quantity;
        $this->remark = $formData->remark;
        $this->status = $formData->status;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate([
            'code_id' => 'required|exists:codes,id',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'remark' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $formData = FormData::findOrFail($this->formDataId);
        $formData->update([
            'code_id' => $this->code_id,
            'customer_name' => $this->customer_name,
            'quantity' => $this->quantity,
            'remark' => $this->remark,
            'status' => $this->status,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        FormData::findOrFail($id)->delete();
    }

    public function resetForm()
    {
        $this->code_id = '';
        $this->customer_name = '';
        $this->quantity = '';
        $this->remark = '';
        $this->status = 1;
        $this->formDataId = null;
        $this->isEditing = false;
    }
}
