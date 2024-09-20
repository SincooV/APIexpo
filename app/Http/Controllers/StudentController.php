<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Sanctum;

class StudentController extends Controller
{
    
    public function index()
    {
        return User::all();
    }

  
    public function store(Request $request)
    {
        try {  $valid = $request -> validate([
            'name' => 'max:35|required',
            'email' => 'max:40|required',
            'password' => 'max:20|required',
            'period' => 'max:10|required',
            'ra' => 'required',
            'class_id'=> ''
            
    ]);}
   
    catch(ValidationException $e){
        return Response::json(['error' => $e]);
    }
    $register = User::create($valid);
  
    return Response::json(['register' => $register ]);

    }

   
    public function show($id)
    {
        $class = User::find($id);
        if (!$class) {
            return response()->json([
                'message' => 'class não encontrada.'
            ], 404);
        }

        $classs2 = DB::table('Students')
        ->join('class', 'Students.class_id', '=', 'class.id')
        ->where('Students.id', 'LIKE', '%' . $id . '%')
        ->select('studentclass.*')  
        ->get();

        return response()->json([
            'message' => 'Detalhes da class.',
            'data' => $class


        ]);  
         
    }
    

    
    public function update(Request $request, $id)
    {
       
        $class = Student::findOrFail($id);
         $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'class_id'=> 'required'
         
         ]);
         

        

    
        $class->fill($validatedData);
        $class->save();


        return Response::json([
            'message' => 'Student atualizado com sucesso.',
            'data' => $class
        ]);
    }


   
     
    public function patch(Request $request, $id)
    {
        $validatedData = $request->validate([
            'class_id' => 'sometimes|integer',
        ]);

      
        $class = Student::findOrFail($id);

       
        $class->update($validatedData);

        return response()->json([
            'message' => 'class atualizada com sucesso.',
            'data' => $class
        ]);
   }


     
    public function destroy(string $id)
    {
        $class = Student::find($id);

        if (!$class) {
            return response()->json([
                'message' => 'Student não encontrado.'
            ], 404);
        }

        $class->delete();

        return response()->json([
            'message' => 'Student deletado com sucesso.'
        ]);

    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.'],
            ]);
        }

        $Student = Auth::User();
        $token = $Student->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'message' => 'Login bem-sucedido.',
            'token' => $token,
            'Student' => $Student
        ]);
    }
      public function logout(Request $request)
    {
        $request->User()->tokens()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }
}
