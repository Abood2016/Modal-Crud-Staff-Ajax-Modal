<?php

namespace App\Http\Controllers;


use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::OrderBy('id','desc')->get();
        return view('admin.student',['students'=> $students]);
    }

    public function store(Request $request)
    {
        $std = new Student();
        $std->fname = $request->input('fname');
        $std->lname = $request->input('lname');
        $std->course = $request->input('course');
        $std->section = $request->input('section');

        $std->save();
        return redirect()->back()->with('success','add Successfully');

    }

    public function update(Request $request, $id)
    {
        $std  = Student::findOrFail($id);
        $std->fname = $request->input('fname');
        $std->lname = $request->input('lname');
        $std->course = $request->input('course');
        $std->section = $request->input('section');

        $std->update();

    }


    public function destroy($id)
    {
        $std  = Student::findOrFail($id);

        $std->delete();
        return redirect()->back();
    }

}
