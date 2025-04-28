<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormData extends Model
{
    protected $fillable = ['form_name_id', 'code_id', 'customer_name', 'quantity', 'remark', 'user_id', 'status'];

    public function formName(): BelongsTo
    {
        return $this->belongsTo(FormName::class, 'form_name_id');
    }

    public function code(): BelongsTo
    {
        return $this->belongsTo(Code::class, 'code_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
