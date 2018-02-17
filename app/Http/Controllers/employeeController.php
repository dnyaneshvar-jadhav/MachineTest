<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Employee;

class employeeController extends Controller
{

    public function listEmployee()
    {
      $emp = Employee::where('status',"active")->get();
      return response()->json(AppHelper::createResponseJson('200',true,'Employee list',$emp));
    }

    public function addEmployee(Request $request)
    {
    	$firstName = $request->firstName;
    	$lastName = $request->lastName;
    	$email = $request->email;
    	$department = $request->department;
    	$contactNumber = $request->contactNumber;
    	$status = strtolower($request->status);

    	$validator = Validator::make(
          array('firstName'=>$firstName,
          		'lastName'=>$lastName,
          		'email'=>$email,
          		'department'=>$department,
          		'contactNumber'=>$contactNumber,
          		'status'=>$status,
          		),
          array('firstName'=>'required',
          		'lastName'=>'required',
          		'email'=>'required|email|unique:employee,email',
          		'department'=>'required',
          		'contactNumber'=>'required|numeric|digits:10',
          		'status'=>'required'
          	));
  		if($validator->fails())
  	  {
	        return response()->json(AppHelper::createResponseJson('400',false,$validator->getMessageBag()->first()),400);
	    }else{

	    	$emp = Employee::create([
	    		'first_name'=>$firstName,
	    		'last_name'=>$lastName,
	    		'email'=>$email,
	    		'department'=>$department,
	    		'contact_number'=>$contactNumber,
	    		'status'=>$status,
	    		]);
    		return response()->json(AppHelper::createResponseJson('200',true,'Employee created successfully',$emp));
	    }
    }

    public function editEmployee(Request $request,$id)
    {
    	$employeeId = $id; 
    	$firstName = $request->firstName;
    	$lastName = $request->lastName;
    	$email = $request->email;
    	$department = $request->department;
    	$contactNumber = $request->contactNumber;
    	$status = strtolower($request->status);

    	$validator = Validator::make(
          array('firstName'=>$firstName,
          		'lastName'=>$lastName,
          		'email'=>$email,
          		'department'=>$department,
          		'contactNumber'=>$contactNumber,
          		'status'=>$status,
          		),
          array('firstName'=>'required',
          		'lastName'=>'required',
          		'email'=>'required|email|unique:employee,email,'.$employeeId,
          		'department'=>'required',
          		'contactNumber'=>'required|numeric|digits:10',
          		'status'=>'required'
          	));
  		if($validator->fails())
  	  {
	        return response()->json(AppHelper::createResponseJson('400',false,$validator->getMessageBag()->first()),400);
	    }else{
          $check = Employee::find($employeeId );
          if($check != Null && !empty($check)){
              $emp = Employee::where('id',$employeeId)->update([
              'first_name'=>$firstName,
              'last_name'=>$lastName,
              'email'=>$email,
              'department'=>$department,
              'contact_number'=>$contactNumber,
              'status'=>$status,
              ]);
              return response()->json(AppHelper::createResponseJson('200',true,'Employee updated successfully',$emp));
          }else{
            return response()->json(AppHelper::createResponseJson('404',false,'Employee not found'),404);
          }  	
	    }
    }

    public function deleteEmployee($employeeId){
      $check = Employee::find($employeeId);
      if($check != Null && !empty($check))
      {
          $emp = Employee::where('id',$employeeId)->delete();
          return response()->json(AppHelper::createResponseJson('200',true,'Employee deleted successfully',$emp));
      }else{
          return response()->json(AppHelper::createResponseJson('404',false,'Employee not found'),404);
      }  
    }

    public function empWithDep()
    {
      $emp = Employee::with('departmentName')->get();
      return response()->json(AppHelper::createResponseJson('200',true,'Employee list with department',$emp));  
    }

    public  function empOnStatus($status){
      if($status== "All"){
        $emp = Employee::with('departmentName')->get();
      }else{
        $emp = Employee::with('departmentName')->where('status',$status)->get();
      }
      return response()->json(AppHelper::createResponseJson('200',true,'Employee list with department',$emp));  
    }
}
