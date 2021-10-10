<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use Validator;
use App\Models\Employee;
use Intervention\Image\Facades\Image;
use Redirect;
use Session;
use DB;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['designations'] = Designation::All();
        $query = Employee::leftjoin('designations', 'designations.id', '=', 'employees.designation')
       ->get(['employees.*', 'designations.name AS designation_name',  DB::raw("(CASE
       WHEN employees.status = '1' THEN 'Active'
       WHEN employees.status = '0' THEN 'Disabled'
       END) AS employee_status")]);
        $data['employee_data'] = $query;

        return view('index')->with($data);

        //return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|unique:employees',
            'myfile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'design_ation' => 'required',
            ]);
            // if ($validator->fails()) {
            //     return response()->json(['code' => 400, 'status' => 'error', 'message' => $validator->messages()->first(), 'data' => $validator->errors()], 400);
            // }
            $attributeNames = [
                'name' => 'Name',
                'email' => 'Phone',
                'myfile' => 'image',
                'design_ation' => 'designation',
            ];
            $validator->setAttributeNames($attributeNames);
            if ($validator->fails()) {
                return redirect()->back()->withErrors(['errors' => 'There is some error in the details.']);
            }
            $image_name='';

$details=[
         'title'=>'Mail from test',
                    'body'=>'Your account has
                        been created'
];
            if ($req->hasFile("myfile"))
{
               $date =date('Ymdhis');
                $img_extension = $req->file('myfile')->extension();
                $image_name_string = preg_replace("/[^a-zA-Z0-9]+/", "", $req->get('name'));
                $image_name = 'emp_img'.str_replace(" ","-",$image_name_string).'.'.$date.$img_extension;
                $path = $req->file('myfile')->storeAs('public/upload',$image_name);
            }

            try {
             $employee = new Employee;
             $employee->name =$req->get('name');
             $employee->email =$req->get('email');
             $employee->designation =$req->get('design_ation');
             $employee->image =$image_name;
             $employee->save();

             Mail::to($req->email)->send(new TestMail($details));

            }
            catch (Exception $ex) {
                return redirect('employees')->with('error', 'Error in employee creation.');
            }
            return redirect('employees')->with('success', 'Employee saved successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['designations'] = Designation::All();
        $data['employee_data'] = Employee::find($id);
        return view('edit')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       echo $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|unique:employees',
            'myfile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'design_ation' => 'required',
            ]);
            // if ($validator->fails()) {
            //     return response()->json(['code' => 400, 'status' => 'error', 'message' => $validator->messages()->first(), 'data' => $validator->errors()], 400);
            // }
            $attributeNames = [
                'name' => 'Name',
                'email' => 'Phone',
                'myfile' => 'image',
                'design_ation' => 'designation',
            ];
            $validator->setAttributeNames($attributeNames);
            if ($validator->fails()) {
                return redirect()->back()->withErrors(['errors' => 'There is some error in the details.']);
            }
                        $image_name='';
                        $result = Employee::find($id);
                        if ($req->hasFile("myfile"))
                        {
                           $date =date('Ymdhis');
                            $img_extension = $req->file('myfile')->extension();
                            $image_name_string = preg_replace("/[^a-zA-Z0-9]+/", "", $req->get('name'));
                            $image_name = 'emp_img'.str_replace(" ","-",$image_name_string).'.'.$date.$img_extension;
                            $path = $req->file('myfile')->storeAs('public/upload',$image_name);
                        }
                        else{

                            $image_name =$result->image;
                        }

                       try {
                        $result->name =$req->get('name');
                        $result->email =$req->get('email');
                        $result->designation =$req->get('design_ation');
                        $result->image =$image_name;
                        $result->save();

                       }
                       catch (Exception $ex) {
                           return redirect('employees')->with('error', 'Error in employee updation.');
                       }
                       return redirect('employees')->with('success', 'Employee updated successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function services($id)
    {

        try {
            $result = Employee::find($id);
            $result->status ='0';
            $result->created_at = date('Y-m-d h:i:s');
            $result->updated_at = date('Y-m-d h:i:s');
            $result->status ='0';
            $result->save();
           }
           catch (Exception $ex) {
               return redirect('employees')->with('error', 'Error in employee delete.');
           }
           return redirect('employees')->with('success', 'Employee Deleted successfully!');


    }
}
