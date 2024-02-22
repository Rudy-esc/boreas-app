<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudes extends Model
{
    use HasFactory;

    public function sitio ()
    {
        return $this->belongsTo(sitios::class, 'SitiosId', 'id');
    }

    public function objeto ()
    {
        return $this->belongsTo(objetos::class, 'ObjetosId', 'id');
    }
}
