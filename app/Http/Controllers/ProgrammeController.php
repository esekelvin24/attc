<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Programme;


class ProgrammeController extends Controller
{
    //
    public function programme_list(Request $request)
    {
        $programme_collections = DB::table('tbl_programmes')->get();
        return view('programme.programmes',compact('programme_collections'));
    }

    public function programme_edit(Request $request)
    {
        $programme_collections = DB::table('tbl_programmes')->where('programme_id',decrypt($request->id))->get();
        return view('programme.edit_programme',compact('programme_collections'));
    }

    
    public function create_programme(Request $request)
    {
        
        return view('programme.new_programme');
    }

    public function save_programme(Request $request)
    {
        $rules = [
           
           "programme_name" => "required",
           "disp_img" => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ];

        $this->validate($request, $rules);
       
        $Programme = new Programme();

        $Programme->programme_name = $request->programme_name;
        $Programme->created_by = Auth::user()->id;

        if(isset($request->disp_img))
        {
            $rand_one = rand(1,9999999);
            $rand_two = rand(1,9999999);
            $rand = $rand_one.$rand_two;

            $img_ext =  $request->disp_img->getClientOriginalExtension();
            $Programme->disp_img = $rand.".".$img_ext;
            $Programme->created_at = NOW();
            $Programme->save();

            $request->disp_img->move("frontend/assets/img/programmes", $rand.".".$img_ext);
        }else
        {
            $Programme->save();
        }
       

        return redirect()->route('programme_list')->with("success", "programme was created successfully");

    }

    public function save_edited_programme(Request $request)
    {
        $rules = [
           "programme_id" => "required",
           "programme_name" => "required",
           "disp_img" => 'sometimes|mimes:jpeg,jpg,png,gif|max:10000',
        ];

        $this->validate($request, $rules);
       
        $Programme = Programme::find(decrypt($request->programme_id));

        $Programme->programme_name = $request->programme_name;

        if(isset($request->disp_img))
        {
            $img_ext =  $request->disp_img->getClientOriginalExtension();
            $Programme->disp_img = decrypt($request->programme_id).".".$img_ext;
            $request->disp_img->move("frontend/assets/img/programmes", decrypt($request->programme_id).".".$img_ext);
        }
        $Programme->save();

        return redirect()->route('programme_list')->with("success", "programme was updated successfully");

    }
}
