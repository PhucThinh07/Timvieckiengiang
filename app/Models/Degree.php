<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model{

    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function educations(){
        return $this->belongsToMany(Education::class, 'education_degrees', 'degree_id',
            'education_id');
    }
}
