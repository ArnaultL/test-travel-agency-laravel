<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'travels';
    protected $with = ['steps'];

    public function steps() {
        return $this->hasMany(Step::class);
    }
}
