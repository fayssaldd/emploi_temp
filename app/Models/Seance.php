<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'formateur_id');
    }

}


