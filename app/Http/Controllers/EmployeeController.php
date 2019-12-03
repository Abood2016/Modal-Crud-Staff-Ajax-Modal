<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    public function index()
    {
        $employess = DB::table('employees')->orderBy('id','desc')->get(); 
        
        return view('admin.employee',['employess' => $employess]);
    }


    public function store(Request $request)
    {
        $this->validate($request,
        [
            'fname'=>'required',
            'lname' => 'required',
            'address' => 'required',
            'mobile' => 'required',
        ]);

        $emp = new Employee();
        $emp->fname = $request->input('fname');
        $emp->lname = $request->input('lname');
        $emp->address = $request->input('address');
        $emp->mobile = $request->input('mobile');

        $emp->save();
        return redirect()->back()->with('success','add Successfully');

    }


    public function update(Request $request , $id)
    {
        $this->validate($request,
            [
                'fname' => 'required',
                'lname' => 'required',
                'address' => 'required',
                'mobile' => 'required',
            ]
        );
        $emp = Employee::findOrFail($id);
        $emp->fname = $request->input('fname');
        $emp->lname = $request->input('lname');
        $emp->address = $request->input('address');
        $emp->mobile = $request->input('mobile');

        $emp->update();
        return redirect()->back()->with('success', 'Updated Successfully');


    }

    public function destroy($id)
    {
        $emp = Employee::findOrFail($id);
        $emp->delete();

        return redirect()->back()->with('success', 'Deleted Successfully');

    }


}
