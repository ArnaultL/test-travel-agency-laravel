<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;
    protected $table = 'steps';
    public $timestamps = false;
    protected $with = ['plane_step'];

    public function travel() {
        return $this->belongsTo(Travel::class);
    }

    public function plane_step() {
        return $this->hasMany(PlaneStep::class);
    }
}
