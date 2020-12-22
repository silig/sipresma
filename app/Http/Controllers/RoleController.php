<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Role;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
    	$role = Role::orderBy('created_at', 'desc')->paginate(10);
    	return view('role.index',compact('role'));
    }

    public function store(Request $request){
    	$this->validate($request, [
    		'name' => 'required|string|max:50']
    	);

    	$role = Role::firstorcreate(['name' =>$request->name]);
    	return redirect()->back()->with(['success' => 'Role: <strong>' .$role->name. '</strong> ditambahkan']);
    }

    public function destroy($id){

    	$role = Role::findorFail($id);
    	$role->delete();
    	return redirect()->back()->with(['success' => 'Role: <strong>' .$role->name. '</strong> dihapus']);
    }
}
