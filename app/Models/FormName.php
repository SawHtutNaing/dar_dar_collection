<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormName extends Model
{
    protected $fillable = ['name'];

    public function codes(): BelongsToMany
    {
        return $this->belongsToMany(Code::class, 'code_form', 'form_id', 'code_id');
    }

    public function formData(): HasMany
    {
        return $this->hasMany(FormData::class, 'form_name_id');
    }
}
