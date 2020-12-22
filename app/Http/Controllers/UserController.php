<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        //dd(auth()->user()->name);
        //$users = User::orderBy('created_at', 'DESC')->paginate(100);
        // $mahasiswa = DB::Select("SELECT a.id,a.NIM, a.username, a.status, c.name FROM users a
        //             join model_has_roles b on a.id = b.model_id
        //             join roles c on c.id = b.role_id
        //             where c.name = 'mahasiswa' ")->paginate(100);
        $mahasiswa = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles','roles.id', '=', 'model_has_roles.role_id')
                    ->select('users.id', 'users.NIM', 'users.username', 'users.status', 'roles.name')
                    ->where('roles.name', 'mahasiswa')
                    ->paginate(100);
        $admin = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles','roles.id', '=', 'model_has_roles.role_id')
                    ->select('users.id', 'users.NIM', 'users.username', 'users.status', 'roles.name')
                    ->where('roles.name', 'admin')
                    ->paginate(100);
        $dept = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles','roles.id', '=', 'model_has_roles.role_id')
                    ->select('users.id', 'users.NIM', 'users.username', 'users.status', 'roles.name')
                    ->whereIn('roles.name', ['departemen','fakultas','senat'])
                    ->paginate(100);
        // $mahasiswa = (object)$mahasiswa->paginate(100);
        return view('users.index', compact('mahasiswa', 'admin', 'dept'));
    }

    public function create()
    {
        $role = Role::orderBy('name', 'ASC')->get();
        return view('users.create', compact('role'));
    }

    public function store(Request $request)
    {
       //dd($request->all());
        $this->validate($request, [
            'NIM' => 'nullable|max:100',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name'
        ]);

        $user = User::Create([
            'username' => $request->username,
            'NIM' => $request->NIM,
            'password' => bcrypt($request->password),
            'status' => true
        ]);

        $user->assignRole($request->role);
        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->username . '</strong> Ditambahkan']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'NIM' => 'required|string|max:100',
            'username' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'NIM' => $request->name,
            'password' => $password
        ]);
        return redirect(route('users.index'))->with(['success' => 'User: <strong>' . $user->name . '</strong> Diperbaharui']);
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with(['success' => 'User: <strong>' . $user->name . '</strong> Dihapus']);
    }

    public function roles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all()->pluck('name');
        return view('users.roles', compact('user', 'roles'));
    }

    public function setRole(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->syncRoles($request->role);
        return redirect()->back()->with(['success' => 'Role Sudah Di Set']);
    }

    public function rolePermission(Request $request)
    {
        $role = $request->get('role');
        $permissions = null;
        $hasPermission = null;

        $roles = Role::all()->pluck('name');

        if (!empty($role)) {
            $getRole = Role::findByName($role);
            $hasPermission = DB::table('role_has_permissions')
                ->select('permissions.name')
                ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
            $permissions = Permission::all()->pluck('name');
        }
        return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
    }

    public function addPermission(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:permissions'
        ]);

        $permission = Permission::firstOrCreate([
            'name' => $request->name
        ]);
        return redirect()->back();
    }

    public function setRolePermission(Request $request, $role)
    {
        //select role berdasarkan namanya
        $role = Role::findByName($role);

        //fungsi syncPermission akan menghapus semua permission yg dimiliki role tersebut
        //kemudian di-assign kembali sehingga tidak terjadi duplicate data
        $role->syncPermissions($request->permission);
        return redirect()->back()->with(['success' => 'Permission to Role Saved!']);
    }

    public function setAktif($id){
    	$user = User::find($id);
        $user->update(['status' => 1]);
    	return redirect()->back()->with(['success' => '<strong>'.$user['username'].'</strong> telah diaktifkan']);
    }
    
    public function setNonAktif($id){


    	$user = User::find($id);
        $user->update(['status' => 0]);
    	 //dd($user);

    	return redirect()->back()->with(['success' => $user->username.' telah dinonaktifkan']);
    }

    public function gantipassword($id){
        $di = decrypt($id);
        return view('auth.passwords.gantipassword', compact('di'));
    }

    public function updatepassword(Request $request, $id){
        $di = decrypt($id);
        $user = User::find($di);
        if (password_verify($request->oldpassword, $user->password)){
            if ($request->newpassword == $request->newpassword1) {
                $user->update([
                    'password' => bcrypt($request->newpassword)
                ]);
                return redirect()->back()->with(['success' => 'berhasil ubah password']);
            } else {
                return redirect()->back()->with(['error' => 'password baru tidak sama']);
            }
        } else {
           return redirect()->back()->with(['error' => 'password lama salah']);
        }
    }

    public function searchmhs(Request $request)
   {
     
      if($request->ajax()){
   
        $output="";
        //$products = Product::where('title','LIKE','%'.$request->search."%")->get();
        $mahasiswa = DB::table('users')
                    ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                    ->join('roles','roles.id', '=', 'model_has_roles.role_id')
                    ->select('users.id', 'users.NIM', 'users.username', 'users.status', 'roles.name')
                    ->where('roles.name', 'mahasiswa')
                    ->where('username','LIKE','%'.$request->search."%")
                    ->paginate(100);
        
        if($mahasiswa){
            $a = 1;
           foreach ($mahasiswa as  $mahasiswa) {
           
            if($mahasiswa->status){
            $output.='<tr>'.
            '<td>'.$a++.'</td>'.
            '<td>'.$mahasiswa->id.'</td>'.
            
            '<td>'.$mahasiswa->NIM.'</td>'.
            
            '<td>'.$mahasiswa->name.'</td>'.
            
            '<td><label class="badge badge-success">Aktif</label></td>'.
            '<td><form action="'.route("users.destroy", $mahasiswa->id).' " method="POST">'.
            '<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">'.
            '<input type="hidden" name="_method" value="DELETE">'.
            '<a href="'.route('users.roles',$mahasiswa->id).'" class="btn btn-info btn-sm" atl="change role" title="change role"><i class="fa fa-user-secret"></i></a>'.
            '<a href="'.route("users.edit", $mahasiswa->id).'" class="btn btn-warning btn-sm" alt="ubah password" title="ubah password"><i class="fa fa-edit"></i></a>'.
            '<button class="btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>'.
            '<a href="'.route("users.nonaktif", $mahasiswa->id).'" class="btn btn-info btn-sm" title="Nonaktifkan user!"><i class="fa fa-toggle-off"></i></a>'.
            '</form>'.
            '</td>'.
            
            '</tr>';
            } else {
                $output.='<tr>'.
            '<td>'.$a++.'</td>'.
            '<td>'.$mahasiswa->id.'</td>'.
            
            '<td>'.$mahasiswa->NIM.'</td>'.
            
            '<td>'.$mahasiswa->name.'</td>'.
            
            '<td><label for="" class="badge badge-warning">Suspend</label></td>'.
            '<td><form action="'.route("users.destroy", $mahasiswa->id).'" method="POST">'.
            '<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">'.
            '<input type="hidden" name="_method" value="DELETE">'.
            '<a href="'.route('users.roles',$mahasiswa->id).'" class="btn btn-info btn-sm" atl="change role" title="change role"><i class="fa fa-user-secret"></i></a>'.
            '<a href="'.route("users.edit", $mahasiswa->id).'" class="btn btn-warning btn-sm" alt="ubah password" title="ubah password"><i class="fa fa-edit"></i></a>'.
            '<button class="btn btn-danger btn-sm" title="hapus"><i class="fa fa-trash"></i></button>'.
            '<a href="'.route("users.nonaktif", $mahasiswa->id).'" class="btn btn-info btn-sm" title="Aktifkan user!"><i class="fa fa-toggle-on"></i></a>'.
            '</form>'.
            '</td>'.
            
            '</tr>';   
            }
        
           }
           return $output;  
        }
  
      }
   }
}
