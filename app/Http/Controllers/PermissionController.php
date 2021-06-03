<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Maintab;
use App\Models\Subtab;
use App\Models\Subertab;

use DB;

class PermissionController extends Controller
{
	//

	public function manage_menu_permission()
	{
		$main_menu = Maintab::get();
		$sub_tab = Subtab::get();
		$suber_tab = Subertab::get();

		return view('settings.manage_menu_permission',compact('main_menu','sub_tab','suber_tab'));
	}

	public function save_menu_permission(Request $request)
	{
	
		$menu_string = decrypt($request->menu);
		$menu_arr = explode("~",$menu_string);
		$menu_table = $menu_arr[0];
		$menu_id = $menu_arr[1];
		$menu_id_name = $menu_arr[2];
       
		if(isset($request->permission))
		{
			$update_slug = DB::table($menu_table)->where($menu_id_name, $menu_id)->update(["permission_slug" => decrypt($request->permission)]);
			 
			if($update_slug)
			 {
				return redirect('/manage_menu_permission')->with('success','Permission has been added successfully');
			 }
		}
		
		return redirect('/manage_menu_permission');
	}

	public function get_role_menu_list(Request $request)
	{
		$menu_string = decrypt($request->menu);
		$menu_arr = explode("~",$menu_string);
		$menu_table = $menu_arr[0];
		$menu_id = $menu_arr[1];
		$menu_id_name = $menu_arr[2];

		$menu_permission_slug = DB::table($menu_table)->where($menu_id_name, $menu_id)->first();

		if(isset($menu_permission_slug->permission_slug))
		{
			$menu_permission_slug = $menu_permission_slug->permission_slug;
		}else{
			$menu_permission_slug ="";
		}
        
		$permission_collection = Permission::get();

		return view('settings.menu_permission_list',compact('permission_collection','menu_permission_slug'));

	}
	
	


	public function manage_special_permission()
	{
		$user_permission_collection = DB::table('users_permissions')->join('users','users.id','users_permissions.user_id')->groupBy('users.id')->get();

        return view('settings.manage_special_permission', compact('user_permission_collection'));
	}

	public function save_assign_special_perm(Request $request)
	{
		 
		 $rules = [
			"user_id" => "required",
			'permission' => 'sometimes',
			
		];
		$this->validate($request, $rules);

		$user_id = decrypt($request->user_id);
		

		DB::beginTransaction();
 
		$delete_user_perm = DB::table('users_permissions')->where('user_id',$user_id)->delete();
		
		if (isset($request->permission))
		{
			$permission = $request->permission;
			foreach($permission as $val)
			{
				$insert[] = [
					'user_id' => $user_id,
					'permission_id' => $val
				];
			}
			$check_insert_stat = DB::table('users_permissions')->insert($insert);
		}else
		{
			$check_insert_stat = true;
		}
		
	

		if( $check_insert_stat)
		{
			DB::commit(); 
			return redirect('/assign_permissions_to_user/'.encrypt($user_id))->with('success','Special permission was assigned successfully');
		}else
		{
			DB::rollback();
			return redirect('/assign_permissions_to_user/'.encrypt($user_id))->with('error','An error occured when assigning special permission');
		
		}

		 
	}

	public function assign_permissions_to_user(Request $request, $user_id)
	{
		$user_id = decrypt($user_id);
		
		
		
		$check_if_exist = User::where('id',$user_id)->get();

		if(count($check_if_exist) > 0)
		{
			
			$user_role_details = DB::table('users_roles')->join('roles','roles.id','users_roles.role_id')->where('user_id',$user_id)->get();
			$role_id = $user_role_details[0]->role_id;
			$permission_collection = Permission::get();
			$role_permission_collection = DB::table('roles_permissions')->join('permissions','permissions.id','roles_permissions.permission_id')->where('role_id',$role_id )->get();

            $selected_special_permission = DB::table('users_permissions')->join('permissions','permissions.id','users_permissions.permission_id')->where('user_id',$user_id)->pluck('slug','permission_id');
	  
		   
			return view('settings.assign_permissions_to_user',compact('permission_collection','selected_special_permission','role_permission_collection','user_role_details','check_if_exist'));

		}else//user does not exist on the system
		{

		}
	}

	public function edit_permission(Request $request)
	{
	   $id = decrypt($request->id);

	   $permission_collection = Permission::where('id',$id)->get();

	   return view('settings.edit_permission', compact('permission_collection'));
	   
	}

	public function save_edit_permission(Request $request)
	{
		$rules = [
			"permission_name" => "required",
			'description' => 'required',
			'id' => 'required'
		];
		$this->validate($request, $rules);

		$id = decrypt($request->id);
		$permission = Permission::find($id);
		$permission->name = $request->permission_name;
		$permission->description = $request->description;
		$permission->save();

		if(!$permission) 
	     {		 
		   return redirect('/manage_permission')->with('error','An error occured when updating permission');
		 }else
		 {
			DB::commit();  
			return redirect('/manage_permission')->with('success','Permission has been updated successfully'); 
		 }


	}


	public function save_permission(Request $request)
	{
		$rules = [
			"permission_name" => "required",
			'permission_slug'=>'required',
			'description' => 'required'
		];
		$this->validate($request, $rules);
 
		//check if slug already exit
		$check = Permission::where('slug', $request->permission_slug)->get();
 
		if(count($check) < 1)
		{
		  DB::beginTransaction();
 
		  $permission = new Permission();
		  
		  $permission->name = $request->permission_name;
		  $permission->slug = $request->permission_slug;
		  $permission->description = $request->description;
		  $permission->save();
 
			 if(!$permission) 
			 {
				 DB::rollback();
				 return redirect('/manage_permission')->with('error','An error occured when saving permission');
			 }else
			 {
				 DB::commit();  
				 return redirect('/manage_permission')->with('success','Permission has been saved successfully'); 
			 }
 
		
 
		}else{
			return redirect('/manage_permission')->with('error','Slug Name already exist');
		}
	}

	public function add_new_permission()
	{

		return view('settings.add_new_permission');
	}
	
	public function manage_permission(Request $request)
    {
        $permission_collection = Permission::get();
        return view('settings.manage_permission', compact('permission_collection'));
    }

    public function get_permission_info(Request $request)
    {
       $id = decrypt($request->id);
       $permission_collection = Permission::where('id',$id)->get();
       $role_permission_collection = DB::table('roles_permissions')->join('roles','roles.id','roles_permissions.role_id')->where('permission_id',$id)->get();

       return view('settings.permission_info',compact('permission_collection','role_permission_collection'));
    }

    /*
    public function Permission()
    {   
    	$dev_permission = Permission::where('slug','create-tasks')->first();
		$manager_permission = Permission::where('slug', 'edit-users')->first();

		//RoleTableSeeder.php
		$dev_role = new Role();
		$dev_role->slug = 'developer';
		$dev_role->name = 'Developer';
		$dev_role->save();
		$dev_role->permissions()->attach($dev_permission);

		$manager_role = new Role();
		$manager_role->slug = 'support';
		$manager_role->name = 'System Support';
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

		$dev_role = Role::where('slug','developer')->first();
		$manager_role = Role::where('slug', 'manager')->first();

		$createTasks = new Permission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($dev_role);

		$editUsers = new Permission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);

		$dev_role = Role::where('slug','support')->first();
		$manager_role = Role::where('slug', 'support')->first();
		$dev_perm = Permission::where('slug','create-tasks')->first();
		$manager_perm = Permission::where('slug','edit-users')->first();

		$developer = new User();
        $developer->firstname = 'Ese';
        $developer->middlename = 'Kelvin';
        $developer->lastname = 'Uvbiekpahor';
		$developer->email = 'esekelvin24@gmail.com';
		$developer->password = bcrypt('123456');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new User();
		$manager->firstname = 'System';
        $manager->lastname = 'Support';
     
		$manager->email = 'attc@gmail.com';
		$manager->password = bcrypt('123456');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);

		
		return redirect()->back();
	}
	*/
}
