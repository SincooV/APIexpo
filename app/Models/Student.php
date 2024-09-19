<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory,HasApiTokens, Notifiable;
    


    protected $fillable = [
        'name',
        'email',
        'password',
        'class_id',
        'ra',
        'period',
        
    ];
    

    public function Users()
    {
        return $this->hasMany(Presentes_model::class);
       
    }
    public function Turmas(){
        return $this->belongsTo(Turma_model::class);
    }
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

 
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
