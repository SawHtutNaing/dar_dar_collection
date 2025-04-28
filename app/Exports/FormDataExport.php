<?php

namespace App\Exports;

use App\Models\FormData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FormDataExport implements FromCollection, WithHeadings, WithMapping
{
    protected $formId;
    protected $startDate;
    protected $endDate;

    public function __construct($formId, $startDate = null, $endDate = null)
    {
        $this->formId = $formId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = FormData::where('form_name_id', $this->formId)->with('code');

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }
        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Code',
            'Customer Name',
            'Quantity',
            'Remark',
            'Status',
            'Created At',
        ];
    }

    public function map($formData): array
    {
        return [
            $formData->code->code_name,
            $formData->customer_name,
            $formData->quantity,
            $formData->remark,
            $formData->status ? 'Order Confirmed' : 'Cancel',
            $formData->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
