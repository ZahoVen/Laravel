<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['make', 'model', 'owner_id', 'mechanic_id'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
