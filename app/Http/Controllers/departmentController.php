<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Employee;
use App\Department;

class departmentController extends Controller
{

    public function listDepartment()
    {
      $dep = Department::all();
      return response()->json(AppHelper::createResponseJson('200',true,'Department list',$dep));
    }

    public function adddDpartment(Request $request)
    {
    	$depName = $request->depName;
    	$depDescription = $request->depDescription;

    	$validator = Validator::make(
          array('depName'=>$depName,
          		'depDescription'=>$depDescription
          		),
          array('depName'=>'required',
          		'depDescription'=>'required'
          	));
		if($validator->fails())
	    {
	        return response()->json(AppHelper::createResponseJson('400',false,$validator->getMessageBag()->first()),400);
	    }else{

	    	$dep = Department::create([
	    		'dep_name'=>$depName,
	    		'dep_description'=>$depDescription
	    		]);
    		return response()->json(AppHelper::createResponseJson('200',true,'Department Added successfully',$dep));
	    }
    }

    public function editDepartment(Request $request,$id)
    {
    	$depId = $id; 
    	$depName = $request->depName;
    	$depDescription = $request->depDescription;

    	$validator = Validator::make(
          array('depName'=>$depName,
          		'depDescription'=>$depDescription
          		),
          array('depName'=>'required',
          		'depDescription'=>'required',
          	));
		if($validator->fails())
	  {
	        return response()->json(AppHelper::createResponseJson('400',false,$validator->getMessageBag()->first()),400);
	    }else{
          $check = Department::find($depId );
          if($check != Null && !empty($check)){
              $dep = Department::where('id',$depId)->update([
              'dep_name'=>$depName,
              'dep_description'=>$depDescription
              ]);
              return response()->json(AppHelper::createResponseJson('200',true,'Department updated successfully',$dep));
          }else{
            return response()->json(AppHelper::createResponseJson('404',false,'Department not found'),404);
          }  	
	    }
    }

    public function deleteDepartment($depId)
    {
      $check = Department::find($depId);
      if($check != Null && !empty($check))
      {
          $emp = Department::where('id',$depId)->delete();
          return response()->json(AppHelper::createResponseJson('200',true,'Department deleted successfully',$emp));
      }else{
          return response()->json(AppHelper::createResponseJson('404',false,'Department not found'),404);
      }  
    }
}
