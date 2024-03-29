<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function sections()
    {
        return $this->hasMany('App\Models\PageSection', 'page_id', 'id');
    }
}
