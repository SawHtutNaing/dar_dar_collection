<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Code extends Model
{
    protected $fillable = ['code_name' , 'quantity' ,'d_at'];

    
    public function forms(): BelongsToMany

    {
        return $this->belongsToMany(FormName::class, 'code_form', 'code_id', 'form_id');
    }
    public function formData()
    {
        return $this->hasMany(FormData::class);
    }

}
