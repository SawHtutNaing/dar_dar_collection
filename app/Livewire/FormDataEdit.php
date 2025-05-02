<?php

namespace App\Livewire;

use App\Models\Code;
use App\Models\FormData;
use App\Models\FormName;
use Livewire\Component;

class FormDataEdit extends Component
{
    public $formDataId;
    public $formId;
    public $code_id;
    public $customer_name = '';
    public $quantity = '';
    public $remark = '';
    public $status = 1;

    public function mount($id)
    {
        $formData = FormData::findOrFail($id);
        $this->formDataId = $id;
        $this->formId = $formData->form_name_id;
        $this->code_id = $formData->code_id;
        $this->customer_name = $formData->customer_name;
        $this->quantity = $formData->quantity;
        $this->remark = $formData->remark;
        $this->status = $formData->status;
    }

    public function render()
    {
        $form = FormName::findOrFail($this->formId);
        $codes = $form->codes;
        return view('livewire.form-data-edit', compact('form', 'codes'));
    }

    public function update()
    {
        $this->validate([
            'code_id' => 'required|exists:codes,id',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'remark' => 'nullable|string',
            // 'status' => 'required|boolean',
        ]);

        $code = Code::findOrFail($this->code_id);
        $formData = FormData::where('id', $this->formDataId)->first();
        if ( ($code->quantity +  $formData->quantity -  $code->formData->sum('quantity') ) < $this->quantity) {
            session()->flash('error', 'Insufficient quantity available.');
            return;
        }

        $formData = FormData::findOrFail($this->formDataId);
        $formData->update([
            'code_id' => $this->code_id,
            'customer_name' => $this->customer_name,
            'quantity' => $this->quantity,
            'remark' => $this->remark,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Form data updated successfully.');
        // return redirect()->route('form-data.create', ['formId' => ]);
        return redirect()->route('form-data.create', ['formId' => $this->formId, 'codeId' => $this->code_id]);

    }
}
