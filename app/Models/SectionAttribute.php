<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionAttribute extends Model
{
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id', 'id');
    }
}
