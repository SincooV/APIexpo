<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\presence_model;
use Response;
use App\Models\Student;
use App\Models\Class_model;
use Illuminate\Support\Facades\DB;
use Log;
class Presenca extends Controller
{
   
    public function index()
    {
        return presence_model::all();
    }


     
    public function store(Request $request)
    {
 
        try {  $valid = $request -> validate([
            'student_id'=> '', 
            'class_id'=> ''
            
    ]);}
   
    catch(ValidationException $e){
        return Response::json(['error' => $e]);
    }
    $register = presence_model::create($valid);
  
    return Response::json(['register' => $register]);


    }


    public function show($id)
    {
   
  
        $results = DB::table('students')
        ->join('presence', 'students.id', '=', 'presence.student_id')
        ->join('studentclass', 'students.class_id', '=', 'studentclass.id') 
        ->where('studentclass.class', $id)
        ->select('presence.*' , 'students.name', 'students.created_at', 'students.updated_at', 'students.email')
        ->get();
    
       

      

        return Response::json(['alunos' => $results]);
 


    
      
        $posts = presence_model::with('student')->get();
        $posts2 = class_model::with('class')->get();

      
        return response()->json([
            'presence' => $posts->map(function ($post, $posts2) {
                return [
                    'id_class' => $post->student->class_id,
                    'student_name' => $post->student->name,
                 
                    'student_table' => (new \App\Models\student())->getTable()
                ];
            })]);



    }
    
    public function update(Request $request, string $id)
    {
     

     
        $class = class_model::findOrFail($id);

      
        $class->update($validatedData);

        return response()->json([
            'message' => 'class atualizada com sucesso.',
            'data' => $class
        ]);
    }


    
     
    public function destroy(string $id)
    {
        
    }


    

    
}