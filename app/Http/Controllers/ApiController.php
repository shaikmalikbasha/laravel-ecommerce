<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
class ApiController extends Controller
{
    public function addStudent(Request $request) {

    	$student = new Student();

    	$student->name = $request->input("name");
    	$student->roll_number = $request->input("roll_number");
    	$student->email = $request->input("email");
    	$student->mobile = $request->input("mobile");
    	$student->save();
    	return response()->json($student);
    }

    public function showStudent() {

    	$student = Student::all();
    	// return view('user',["data"=>response()->json($student)]);
    	return response()->json($student);
    	// print_r($student);
    }
    public function showStudentById($id) {
    	
    	$student = Student::find($id);
    	return response()->json($student);
    }
}
