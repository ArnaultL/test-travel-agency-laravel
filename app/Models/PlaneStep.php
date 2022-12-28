<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaneStep extends Model
{
    use HasFactory;
    protected $table = 'plane_step';
    public $timestamps = false;
    
    public function step() {
        return $this->belongsTo(Step::class);
    }
}
