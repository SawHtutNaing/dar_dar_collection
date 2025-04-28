<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Code extends Model
{
    protected $fillable = ['code_name'];

    public function forms(): BelongsToMany
    {
        return $this->belongsToMany(FormName::class, 'code_form', 'code_id', 'form_id');
    }
}
