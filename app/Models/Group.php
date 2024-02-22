<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function filiere()
    {
        return $this->belongsTo(Filier::class, 'filier_id');
    }
}
