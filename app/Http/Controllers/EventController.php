<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class EventController extends Controller
{
    //

    
    public function save_edit_event(Request $request)
    {
        
       
        $rules =
            [
                'event_title'=>'required',
                'event_date'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
                'venue'=>'required',
                'ckeditor1'=>'required',
                'att_chkbox' => 'sometimes',
                "attachment_file" => "sometimes|mimetypes:application/pdf|max:10000",
                'banner_image'  => 'mimes:jpeg,jpg,png,gif|sometimes|max:10000'
            ];
        //check validation options
        $this->validate($request,$rules);
        $file_ext ="";
        $img_ext = "";
        $file_name = "";
        $img_name = "";

        $event_id = $request->event_id;
        $event_obj = DB::table('tbl_event')->where('event_id', $event_id)->first();
        
       

       
        //$ext_arr = explode(".",$request->attachment_file);
        if($request->attachment_file != null)
        {
            $file_ext = $request->attachment_file->getClientOriginalExtension();
            $file_name = rand(1,9999999).rand(1,9999999).".".$file_ext;
            if (file_exists("file_upload/events/".$event_obj->file_path) && $event_obj->file_path !="")
                 unlink("file_upload/events/".$event_obj->file_path);
        }else
        {
            $file_name = $event_obj->file_path;
        }

        if($request->banner_image != null)
        {
            $img_ext =  $request->banner_image->getClientOriginalExtension();
            $img_name = rand(1,9999999).rand(1,9999999).".".$img_ext;
            if (file_exists("frontend/assets/img/event/".$event_obj->file_path)  && $event_obj->file_path !="")
                  unlink("frontend/assets/img/event/".$event_obj->img_path);
        }else
        {
            $img_name = $event_obj->img_path;
        }
  
        $update = [

            
            'event_title'   => $request->event_title,
            'event_content' => $request->ckeditor1,
            'event_start_time' => $request->start_time,
            'event_end_time' => $request->end_time,
            'event_venue' => $request->venue,
            'event_date' => $request->event_date,
            'created_at' => NOW(),
            'user_id'    => Auth::user()->id,
            'file'       => $request->att_chkbox,
            'file_path'   => $file_name,
            'img_path'   => $img_name
        ];
        
        if ($request->attachment_file == null)
        {
            unset($update['file_path']);
            
        }

        if ($request->banner_image == null)
        {
            unset($update['img_path']);
        }
        
        //if ($request->banner_image)

        $result = DB::table('tbl_event')->where('event_id', $event_id)->update($update);
       

        if($request->banner_image != null)
        {
            $request->banner_image->move("frontend/assets/img/event", $img_name);    
        }

        if ($result == true && $request->attachment_file != null)
        {
            $request->attachment_file->move("file_upload/events", $file_name);
        }

        $data=[
            'success'=>'Event updated successfully'
        ];
        return redirect()->route('event_list')->with($data);
       
    }
    
    public function save_event(Request $request)
    {
        
        $rules =
            [
                'event_title'=>'required',
                'event_date' =>'required',
                'ckeditor1'=>'required',
                'start_time' =>'required',
                'venue' =>'required',
                'end_time'=>'required',
                'att_chkbox' => 'sometimes',
                "attachment_file" => "sometimes|mimetypes:application/pdf|max:10000",
                'banner_image'  => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ];
        //check validation options
        $this->validate($request,$rules);
    
        
        //$event_id = Utilities::getnextid("event_id");
        //$ext_arr = explode(".",$request->attachment_file);
        $rand_one = rand(1,9999999);
        $rand_two = rand(1,9999999);
        $rand = $rand_one.$rand_two;

        $img_ext =  $request->banner_image->getClientOriginalExtension();
        $file_ext = "";
        if ($request->att_chkbox != 0)
        {
            $file_ext = $request->attachment_file->getClientOriginalExtension();
            
        }
        //dd($ext);
        $insert = [

            //'event_id'    => $event_id,
            'event_title'   => $request->event_title,
            'event_content' => $request->ckeditor1,
            'event_start_time' => $request->start_time,
            'event_end_time' => $request->end_time,
            'event_date'    => $request->event_date,
            'event_venue' => $request->venue,
            'created_at' => NOW(),
            'user_id'    => Auth::user()->id,
            'file'       => $request->att_chkbox,
            'file_path'   => ''.$rand.".".$file_ext,
            'img_path'   => ''.$rand.".".$img_ext
        ];

        if ($request->att_chkbox == 0)
        {
            unset($insert['file_path']);
        }

        $result = DB::table('tbl_event')->insert($insert);
        $request->banner_image->move("frontend/assets/img/event", $rand.".".$img_ext);

        if ($result == true && $request->att_chkbox == 1)
        {
            $request->attachment_file->move("file_upload/events", $rand.".".$file_ext);
        }

        $data=[
            'event_success'=>'yes'
        ];
        return redirect()->route('event_list')->with($data);
       
    }

    public function create_event(Request $request)
    {
        return view('events.new_event');
    }

    public function event_list(Request $request)
    {
        $event_collection = DB::table('tbl_event as nw')->OrderBy('event_date')->get();

        
        return view('events.event', compact('event_collection'));
    }


    public function edit_event (Request $request)
	{
	    //To know what the person logged in can change
	  

	    $event_collection = DB::table('tbl_event')->where('event_id',$request->id)->get();

	    
		$data=
		[
			'event_collection' => $event_collection,
			'event_id' => $request->id
		];
		
		return view('events.event_edit')->with($data);
	}



}
