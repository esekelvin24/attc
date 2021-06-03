<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller
{
    //

    public function manage_role(Request $request)
    {
        $roles_collection = Role::get();
        return view('settings.manage_roles', compact('roles_collection'));
    }

    public function edit_role(Request $request)
	{
       $id = decrypt($request->id);

       $permission_collection = Permission::get();
       $role_collection = Role::where('id',$id)->get();
       
       $selected_permission = DB::table('roles_permissions')->where('role_id', $id)->pluck('role_id','permission_id');
	   return view('settings.edit_role', compact('role_collection','permission_collection','selected_permission'));
	   
	}

    public function add_new_role(Request $request)
    {
      $permission_collection = Permission::get();
      return view('settings.add_new_role',compact('permission_collection'));
    }

    public function save_edit_role(Request $request)
    {
        $rules = [
            "role_name" => "required",
            'description' => 'required',
            'id' => 'required'
        ];
         $this->validate($request, $rules);
        
          $id = decrypt($request->id);

          
          DB::beginTransaction();
          $role = Role::find($id);
          
          $role->name = $request->role_name;
          $role->description = $request->description;
          $role->save();
          $delete_existing_permiss = DB::table('roles_permissions')->where('role_id',$id)->delete();
             
 
          if(isset($request->permission))
          {
              
              $permissions = $request->permission;
              foreach($permissions as $val)
              {
                  $insert_role_permission[] = [
                     "role_id" => $role->id,
                     "permission_id" => $val
                  ];
              }
             
             
             $check_insert = DB::table('roles_permissions')->insert($insert_role_permission);
 
             if(!$check_insert && !$role && !$delete_existing_permiss) 
             {
                 DB::rollback();
                 return redirect('/manage_role')->with('error','An error occured when updating role');
             }else
             {
                 DB::commit(); 
                 return redirect('/manage_role')->with('success','role has been updated successfully'); 
             }
             
          }else{
 
             if(!$role && !$delete_existing_permiss) 
             {
                 DB::rollback();
                 return redirect('/manage_role')->with('error','An error occured when updating role');
             }else
             {
                 DB::commit();  
                 return redirect('/manage_role')->with('success','role has been updated successfully'); 
             }
 
          }
 
        
    }

    public function save_role(Request $request)
    {
       $rules = [
           "role_name" => "required",
           'role_slug'=>'required',
           'description' => 'required'
       ];
       $this->validate($request, $rules);

       //check if slug already exit
       $check = Role::where('slug', $request->role_slug)->get();

       if(count($check) < 1)
       {
         DB::beginTransaction();

         $role = new Role();
         
         $role->name = $request->role_name;
         $role->slug = $request->role_slug;
         $role->description = $request->description;
         $role->save();
        

         if(isset($request->permission))
         {
             
             $permissions = $request->permission;

             foreach($permissions as $val)
             {
                 $insert_role_permission[] = [
                    "role_id" => $role->id,
                    "permission_id" => $val
                 ];
                
             }
            
            $check_insert = DB::table('roles_permissions')->insert($insert_role_permission);

            if(!$check_insert && !$role) 
            {
                DB::rollback();
                return redirect('/manage_role')->with('error','An error occured when saving role');
            }else
            {
                DB::commit(); 
                return redirect('/manage_role')->with('success','role has been saved successfully'); 
            }
            
         }else{

            if(!$role) 
            {
                DB::rollback();
                return redirect('/manage_role')->with('error','An error occured when saving role');
            }else
            {
                DB::commit();  
                return redirect('/manage_role')->with('success','role has been saved successfully'); 
            }

         }

       }else{
           return redirect('/manage_role')->with('error','Slug Name already exist');
       }
    }

    public function get_role_info(Request $request)
    {
       $id = decrypt($request->id);
       $role_collection = Role::where('id',$id)->get();

       $role_permission_collection = DB::table('roles_permissions')->join('permissions','permissions.id','roles_permissions.permission_id')->where('role_id',$id)->get();


       return view('settings.role_info',compact('role_collection','role_permission_collection'));
    }


    public function get_user_role(Request $request)
    {
        
		$query= Role::where('id',$request->role_id)->get();
        $role_name= $query[0]->name;
        
        $role_permission_collection = DB::table('roles_permissions')->select('permissions.name','permissions.id')->join('permissions','permissions.id','roles_permissions.permission_id')->where('role_id',$request->role_id)->get();

		
		
?>

<p style="margin-top: -10px">Detailed Permissions breakdown for <strong><?php echo $role_name ?></strong></p>
        <ul id="basic">
            <?php
            foreach($role_permission_collection as $val) {
                ?>
                <li style="color:white" class="badge badge-info"  data-node-id="<?php echo $val->id ?>"  > <!--class="simple-tree-closed"-->
                    <span ><?php echo $val->name ?></span>
                        
                </li>
                <?php
            }
            ?>
        </ul>

        <ul>
                            

        <script type="text/javascript">

            $(document).ready(function() {
                $('#basic').simpleTree();
            });

        </script>


<?php


	}
}
