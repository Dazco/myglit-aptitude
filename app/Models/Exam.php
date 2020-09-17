<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public static $categories =  ['technical', 'aptitude', 'logical'];

    public function questions(){
        return $this->hasMany(Question::class, 'exam_id');
    }
}
