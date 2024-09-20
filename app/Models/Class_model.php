<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Class_model extends Model
{
    use HasFactory;
  
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'studentclass';
    public $turma = 'class_name  class_year';
    protected $fillable = [
        'class_name',
        'class_year',
        'class',
        'year'
    ];
  
}
