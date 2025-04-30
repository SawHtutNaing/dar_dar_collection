<?php

namespace App\Livewire;

use App\Models\Code;
use App\Models\FormData;
use App\Models\FormName;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class FormDataManager extends Component
{
    use WithPagination;

    #[Url]
    public $formId;

    #[Url]
    public $code_id = '';
    public $customer_name = '';
    public $quantity = '';
    public $remark = '';
    public $status = 1;

    public function mount(int $formId, ?int $codeId = null): void
    {
        $this->formId = $formId;
        if ($codeId) {
            $this->code_id = $codeId;
        }
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

        $code = Code::findOrFail($this->code_id);

        if (($code->quantity -  $code->formData->sum('quantity')) < $this->quantity) {
            session()->flash('error', 'Insufficient quantity available.');
            return;
        }
        $this->validate([
            'code_id' => 'required|exists:codes,id',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'remark' => 'nullable|string',
            // 'status' => 'required|boolean',
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

        // $this->resetForm();
        session()->flash('message', 'Form data created successfully.');
    }

    public function delete($id)
    {
        FormData::findOrFail($id)->delete();
        session()->flash('message', 'Form data deleted successfully.');
    }

    public function resetForm()
    {
        $this->code_id = '';
        $this->customer_name = '';
        $this->quantity = '';
        $this->remark = '';
        $this->status = 1;
    }
}
