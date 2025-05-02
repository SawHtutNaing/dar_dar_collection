<?php

namespace App\Livewire;

use App\Models\FormData;
use App\Models\FormName;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormDataExport;
use App\Exports\SortedExport;

class FormDataReport extends Component
{
    use WithPagination;

    public $formId;
    public $start_date;
    public $end_date;

    public function mount($formId)
    {
        $this->formId = $formId;
        // Set default date range (e.g., last 30 days)
        // $this->start_date = now()->subDays(30)->format('Y-m-d');
        // $this->end_date = now()->format('Y-m-d');
    }

    public function render()
    {
        $form = FormName::findOrFail($this->formId);
        $query = FormData::where('form_name_id', $this->formId)->with('code');

        // Apply date filters if provided
        if ($this->start_date) {
            $query->whereDate('created_at', '>=', $this->start_date);
        }
        if ($this->end_date) {
            $query->whereDate('created_at', '<=', $this->end_date);
        }

        $formData = $query->paginate(40);

        return view('livewire.form-data-report', compact('form', 'formData'));
    }


    public function export()
    {
        return Excel::download(new FormDataExport($this->formId, $this->start_date, $this->end_date), 'form_data_' . $this->formId . '_' . now()->format('Ymd') . '.xlsx');
    }
    public function Sortedexport()
    {
        return Excel::download(new SortedExport($this->formId, $this->start_date, $this->end_date), 'form_data_' . $this->formId . '_' . now()->format('Ymd') . '.xlsx');
    }


}
