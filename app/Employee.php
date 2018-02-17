<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
	protected $guarded = [];
    protected $table = "employee";

    public function departmentName(){
    	return $this->hasOne('App\Department','id','department');
    }
}
