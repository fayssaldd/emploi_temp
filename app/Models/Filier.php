<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function formateurs()
    {
        return $this->belongsToMany(Formateur::class, 'formateur_filier', 'filier_id', 'formateur_id');
    }
    public function groupes()
    {
        return $this->hasMany(Group::class, 'filier_id');
    }
}
