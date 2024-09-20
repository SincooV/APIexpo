<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presence_model extends Model
{
    use HasFactory;

   
    protected $table = 'presence';

        public function user()
        {
            return $this->belongsTo(User::class);
        }

    protected $fillable = [
        'student_id',
        'class_id'
    ];

}
