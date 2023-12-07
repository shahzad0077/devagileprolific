<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class OrganizationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    // public function Organization()
    // {
    //     $organization  = Organization::where('user_id',Auth::id())->where('trash',NULL)->Paginate(10);
    //     return view('organizations.index',compact('organization'));

    // }
    
    // public function getdata()
    // {
    //     $startDate = '2023-10-01';
    //     $endDate = '2023-12-31';   
    //      $objid = array();
    //       $keyid = array();
    //       $initid = array();

    //          $data = DB::table('objectives')->whereBetween('created_at', [$startDate, $endDate])->where('user_id',Auth::id())->where('trash',NULL)->get();
    //          foreach($data as $d)
    //          {
    //           $objid[] = $d->id;  
    //          }
    //         $key = DB::table('key_result')->where('user_id',Auth::id())->whereIn('obj_id',$objid)->get();
            
    //          foreach($key as $kk)
    //          {
    //           $keyid[] = $kk->id;  
    //          }
    //         $init = DB::table('initiative')->where('user_id',Auth::id())->whereIn('key_id',$keyid)->get();

    //         foreach($init as $ii)
    //          {
    //           $initid[] = $ii->id;  
    //          }
    //          $epic = DB::table('epics')->where('user_id',Auth::id())->whereIn('initiative_id',$initid)->get();

    //          foreach($data as $da)
    //          {
    //           echo $da->objective_name.'<br>';     
    //           foreach($key as $k)
    //          {
    //           if($k->obj_id == $da->id)
    //           {
    //               echo $k->key_name.'<br>';
    //           }
    //           foreach($init as $i)
    //           {
    //           if($i->key_id == $k->id)
    //           {
    //             echo $i->initiative_name.'<br>';   
    //           }
               
    //           foreach($epic as $e)
    //           {
    //           if($i->id == $e->initiative_id)
    //           {
    //             echo $e->epic_name.'<br>';   
    //           }      
                  
    //           }
                  
    //           } 
    //          } 
    //          }
    // }
    public function SaveOrganization(Request $request)
    {

        $email = Organization::where('email',$request->email)->where('trash',NULL)->where('user_id',Auth::id())->first();
        $phone = Organization::where('phone_no',$request->phone)->where('trash',NULL)->where('user_id',Auth::id())->first();

        if($email)
        {
        echo 1;
        }else if($phone)
        {
         echo 2;
        }else
        {

            $organization  = new Organization();
            if($request->add_logo)
            {
              $organization->logo = $this->sendimagetodirectory($request->add_logo);
            }
    
            $organization->organization_name = $request->organization_name;
            $organization->email = $request->email;
            $organization->phone_no = $request->phone;
            $organization->detail = $request->small_description;
            $organization->slug = Str::slug($request->organization_name.'-'.rand(10, 99));
            $organization->user_id = Auth::id();
            $organization->code =  '#OR' . rand(1000, 9999);
    
            $organization->save();
        }




    }

    public function UpdateOrganization(Request $request)
    {

            $organization  = Organization::find($request->org_edit_id);

            if($request->has('logo'))
            {
              $organization->logo = $this->sendimagetodirectory($request->logo);
            }else{

                $organization->logo = $request->old_image;
    
            }
           
    
            $organization->organization_name = $request->organization_name;
            $organization->email = $request->email;
            $organization->phone_no = $request->phone_no;
            $organization->detail = $request->detail;
            $organization->slug = Str::slug($request->organization_name.'-'.rand(10, 99));
            $organization->user_id = Auth::id();
            $organization->save();
        

            return redirect()->back()->with('message', 'Organization Updated Successfully');



    }


    public function DeleteOrganization(Request $request)
    {
        $Delete  = Organization::where('user_id',Auth::id())->where('id',$request->org_id)->update(['trash' => 1]);
        DB::table('objectives')->where('org_id',$request->org_id)->update(['trash' => 1]);

        return redirect()->back()->with('message', 'Organization Deleted Successfully');

    }

 

    public static function sendimagetodirectory($imagename)

    {

        $file = $imagename;

        $filename = rand() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets/images'), $filename);

        return $filename;

    }
    
      public function DeleteOrganizationAll(Request $request)
    {
        $Delete  = Organization::where('user_id',Auth::id())->whereIn('id',$request->selectedOptions)->update(['trash' => 1]);

        session()->flash('message', 'Organization Deleted Successfully');

        // return redirect()->back()->with('message', 'Organization Deleted Successfully');

    }
    
     public function saveQuarter(Request $request)
    {

      $counter = 1;
      $data = DB::table('sprint')->orderby('id','DESC')->where('value_unit_id',$request->unit_id)->first();
      if($data)
      {
      $counter = $data->IndexCount + 1; 
      }
        DB::table('sprint')
        ->insert([
          'title' => $request->title,
          'start_data' => $request->startdate,
          'end_date' => $request->enddate,
          'detail' => $request->detail,
          'user_id' => Auth::id(),
          'value_unit_id'  => $request->unit_id,
          'IndexCount' => $counter,
          'type'  => $request->type,

        
        ]);
        
        if($request->type == 'unit')
        {
         $organization  = DB::table('business_units')->where('slug',$request->slug)->first();
         $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','unit')->get();   
        }
        
        if($request->type == 'stream')
        {
         $organization  = DB::table('value_stream')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','stream')->get();          
            
        }


         return view('objective.objective-render',compact('organization','objective'));  



    }
    
    public function endQuarter(Request $request)
    {

     $s = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$request->unit_id)->where('type',$request->type)->first();
  
    // $data = DB::table('objectives')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('trash',NULL)->count();
    // $dataobj = DB::table('objectives')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('trash',NULL)->where('obj_prog','=',100)->count();
    // $datakey = DB::table('key_result')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->count();
    // $datakeycomp = DB::table('key_result')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('key_prog','=',100)->count();
    // $dataepic = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->count();
    // $dataepiccomp = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('trash',NULL)->where('epic_progress','=',100)->count();
    // $dataepicdelete = DB::table('epics')->whereBetween('trash', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->count();
    // $dataepicinprog = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('trash',NULL)->where('epic_progress','!=',100)
    // ->where('epic_status','In progress')->count();
    // $dataepictodo = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('trash',NULL)->where('epic_progress','!=',100)
    // ->where('epic_status','To Do')->count();

    //      DB::table('sprint_report')
    //     ->insert([
    //       'q_id' => $s->id,
    //       'obj_comp' =>  $dataobj,
    //       'obj_total' => $data,
    //       'key_total' => $datakey,
    //       'key_comp' => $datakeycomp,
    //       'epic_total' => $dataepic,
    //       'epic_comp' => $dataepiccomp,
    //       'epic_remove' => $dataepicdelete,
    //       'epic_done' => $dataepiccomp,
    //       'epic_inprog' => $dataepicinprog,
    //       'epic_todo' => $dataepictodo,
    //       'user_id' => Auth::id(),

        
    //     ]);
        
             $master = array();
             $temp = array();
             $objid = array();
             $objective = DB::table('objectives')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->where('unit_id',$s->value_unit_id)
             ->where('type',$request->type)->where('trash',NULL)->get();
             foreach($objective as $obj)
             {
             $objid[] = $obj->id;  
             }
             foreach($objective as $obj)
             {
              $temp['id'] = $obj->id;
              $temp['objective_name'] = $obj->objective_name;
              $temp['objective_date'] = Carbon::parse($obj->start_date)->format('M d,Y').' - '.Carbon::parse($obj->end_date)->format('M d,Y');
              $temp['objective_status'] = $obj->status;
              $temp['objective_prog'] = $obj->obj_prog;
              array_push($master,$temp);     
             }
             
              DB::table('sprint_report')
              ->insert([
                'objective' => json_encode($master),
                'q_id' => $s->id,
                'user_id' => Auth::id(),
         
              ]);
               
             $masterkey = array();
             $tempkey = array(); 
             $keyid = []; 
             $key = DB::table('key_result')->whereBetween('created_at', [$s->start_data, $s->end_date])->whereIn('obj_id',$objid)->get();
             foreach($key as $kk)
             {
             $keyid[] = $kk->id;  
             }
            //   $epicCount = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->whereIn('key_id',$keyid)->count();
            //   $epicComp =  DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->whereIn('key_id',$keyid)->where('epic_progress','=',100)->count();
            //   $epicincomp = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->whereIn('key_id',$keyid)->where('epic_progress','!=',100)->count();

             foreach($key as $k)
             {
                 
            $epicCount = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('key_id',$k->id)->where('trash',NULL)->count();
              $epicComp =  DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('key_id',$k->id)->where('trash',NULL)->where('epic_progress','=',100)->count();
              $epicincomp = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('key_id',$k->id)->where('trash',NULL)->where('epic_progress','!=',100)->count();
              
              $tempkey['id'] = $k->id;
              $tempkey['obj_id'] = $k->obj_id;
              $tempkey['key_name'] = $k->key_name;
              $tempkey['key_date'] = Carbon::parse($k->key_start_date)->format('M d,Y').' - '.Carbon::parse($k->key_end_date)->format('M d,Y');
              $tempkey['key_status'] = $k->key_status;
              $tempkey['key_prog'] = $k->key_prog;
              $tempkey['key_epic_count'] = $epicCount;
              $tempkey['key_epic_comp'] = $epicComp;
              $tempkey['key_epic_incopm'] = $epicincomp;
              array_push($masterkey,$tempkey);     
             }
             
             DB::table('sprint_report')
              ->where('q_id', $s->id)
              ->update([
                'key_result' => json_encode($masterkey),
         
               ]);
               
             $masterinit = array();
             $tempinit = array();  
             $init = DB::table('initiative')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->get();
             foreach($init as $i)
             {
            //   $tempinit['id'] = $i->id;
            //   $tempinit['key_id'] = $i->key_id;
            //   $tempinit['init_name'] = $i->initiative_name;
            //   $tempinit['init_date'] = Carbon::parse($i->initiative_start_date)->format('M d,Y').' - '.Carbon::parse($i->initiative_end_date)->format('M d,Y');
            //   $tempinit['init_status'] = $i->initiative_status;
            //   $tempinit['init_prog'] = $i->initiative_prog;
            //   array_push($masterinit,$tempinit); 
            
               DB::table('sprint_report')
              ->insert([
                'initiative_id' => $i->id,
                'initiative_key_id' => $i->key_id,
                'initiative_name' => $i->initiative_name,
                'q_id' => $s->id,
         
              ]);
             }
             
          
               
             $masterepic = array();
             $tempepic = array();  
             $epic = DB::table('epics')->whereBetween('created_at', [$s->start_data, $s->end_date])->where('user_id',Auth::id())->get();
             foreach($epic as $e)
             {
            //   $tempepic['id'] = $e->id;
            //   $tempepic['initiative_id'] = $e->initiative_id;
            //   $tempepic['epic_name'] = $e->epic_name;
            //   $tempepic['epic_date'] = Carbon::parse($e->epic_start_date)->format('M d,Y').' - '.Carbon::parse($e->epic_start_date)->format('M d,Y');
            //   $tempepic['epic_status'] = $e->epic_status;
            //   $tempepic['epic_prog'] = $e->epic_name;
            //   array_push($masterepic,$tempepic); 
              
               DB::table('sprint_report')
              ->insert([
                'epic_id' => $e->id,
                'epic_init_id' => $e->initiative_id,
                'epic_name' => $e->epic_name,
                'epic_prog' => $e->epic_progress,
                'epic_date' => Carbon::parse($e->epic_end_date)->format('M d,Y'),
                'epic_trash' => $e->trash,
                'q_id' =>  $s->id,
                'epic_done' => $e->updated_at,
                'epic_status' => $e->epic_status,
         
              ]);
             }
             
          
        
        DB::table('sprint')->where('user_id',Auth::id())->where('value_unit_id',$request->unit_id)->where('status',NULL)->update(['status'=> 1]);


    }
    
      public function AllBUReport($id,$type)
    {
          if($type == 'unit')
          {
          $organization = DB::table('business_units')->where('slug',$id)->first();        
          $report  =  DB::table('sprint')->where('value_unit_id',$organization->id)->where('type','unit')->get();
          }
          
          if($type == 'stream')
          {
          $organization = DB::table('value_stream')->where('slug',$id)->first();        
          $report  =  DB::table('sprint')->where('value_unit_id',$organization->id)->where('type','stream')->get();
          }

          if($type == 'BU')
          {
          $organization = DB::table('unit_team')->where('slug',$id)->first();        
          $report  =  DB::table('sprint')->where('value_unit_id',$organization->id)->where('type','BU')->get();
          }

          
          if($type == 'VS')
          {
          $organization = DB::table('value_team')->where('slug',$id)->first();        
          $report  =  DB::table('sprint')->where('value_unit_id',$organization->id)->where('type','VS')->get();
          }
          
          return view('Report.Bu-report',compact('report','organization','type'));

    }

    public function ThirdReport($id,$type)
    {
      
      $obj = array();
      $key  = array();
      $sprint = array();
      $report = DB::table('sprint')->where('user_id',Auth::id())->where('id',$id)->first();
      if($report)
      {
      $sprint = DB::table('sprint_report')->where('user_id',Auth::id())->where('q_id',$report->id)->first();
      if($type == 'unit')
      {
      $organization = DB::table('business_units')->where('id',$report->value_unit_id)->first();
      }
      if($type == 'stream')
      {
      $organization = DB::table('value_stream')->where('id',$report->value_unit_id)->first();
      }
      if($type == 'BU')
      {
      $organization = DB::table('unit_team')->where('id',$report->value_unit_id)->first();        
      }
      if($type == 'VS')
      {
      $organization = DB::table('value_team')->where('id',$report->value_unit_id)->first();        
      }
      if($sprint)
      {
      $obj =   json_decode($sprint->objective);
      $key =   json_decode($sprint->key_result);
      $count = count($key);   
      }
      }
      
    return view('Report.report3',compact('sprint','obj','key','report','organization','type','count'));

    }
    
     public function AllReport($id,$type)
    {
          $obj = array();
          $key  = array();
          $sprint = array();
          $report = DB::table('sprint')->where('user_id',Auth::id())->where('id',$id)->first();
          if($report)
          {
          $sprint = DB::table('sprint_report')->where('user_id',Auth::id())->where('q_id',$report->id)->first();
          if($type == 'unit')
          {
          $organization = DB::table('business_units')->where('id',$report->value_unit_id)->first();
          }
          if($type == 'stream')
          {
          $organization = DB::table('value_stream')->where('id',$report->value_unit_id)->first();
          }
          if($type == 'BU')
          {
          $organization = DB::table('unit_team')->where('id',$report->value_unit_id)->first();        
          }
          if($type == 'VS')
          {
          $organization = DB::table('value_team')->where('id',$report->value_unit_id)->first();        
          }
          if($sprint)
          {
          $obj =   json_decode($sprint->objective);
          $key =   json_decode($sprint->key_result);   
          }
          }
          
        return view('Report.report',compact('sprint','obj','key','report','organization','type'));

    }
    
    public function SecondReport($id,$sprint)
    {
        $report = DB::table('sprint')->where('id',$sprint)->first();
        $organization = DB::table('business_units')->where('id',$report->value_unit_id)->first();        
        $SprintInit = DB::table('sprint_report')->where('initiative_key_id',$id)->where('q_id',$sprint)->get();
        $SprintObj = DB::table('sprint_report')->where('q_id',$sprint)->first();
        $obj =   json_decode($SprintObj->objective);
        $key =   json_decode($SprintObj->key_result); 
        $type = $organization->type;

        return view('Report.report2',compact('SprintInit','SprintObj','id','obj','key','sprint','organization','type'));

    }

    public function AllEpicReport($sprint,$type)
    {
        $report = DB::table('sprint')->where('id',$sprint)->first();
        $organization = DB::table('business_units')->where('id',$report->value_unit_id)->first();        

        return view('Report.allreportepic',compact('report','sprint','type','organization'));

    
    }

    public function AllInitReport($init,$sprint)
    {
        $report = DB::table('sprint')->where('id',$sprint)->first();
        $organization = DB::table('business_units')->where('id',$report->value_unit_id)->first();
        $InitName = DB::table('sprint_report')->where('initiative_id',$init)->where('q_id',$sprint)->first();        
        $type = $organization->type;
        return view('Report.init-report',compact('report','sprint','type','organization','init','InitName'));

    
    }
    
    
       public function UpdateSprintQuarter(Request $request)
    {
        DB::table('sprint')
        ->where('id',$request->s_id)->update([
          'end_date' => $request->end_date,
        
        ]);
        
        return redirect()->back();
    }

    public function GetKeychart(Request $request)
    {
    $KEYChart = array();
    $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$request->unit_id)->first();
    if($report)
    {
      
    $KEYChart =  DB::table('key_chart')->where('key_id',$request->obj)->where('IndexCount',$report->IndexCount)->first();
    }
   
    $key = DB::table('key_result')->where('id',$request->obj)->first();
    $keyQAll = DB::table('key_chart')->where('key_id',$request->obj)->get();



    return view('objective.key-chart',compact('KEYChart','key','report','keyQAll'));

  
    }

    public function AddnewQvalue(Request $request)
    {
      
        DB::table('key_quarter_value')->insert([
          'key_chart_id' => $request->key_chart_id,
          'key_id' => $request->id,
          'sprint_id' => $request->sprint_id,
          'value' => $request->value,
        
        ]);

    $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$request->unit_id)->first();
    $KEYChart =  DB::table('key_chart')->where('key_id',$request->id)->where('IndexCount',$report->IndexCount)->first();
    $key = DB::table('key_result')->where('id',$request->id)->first();
    $keyQAll = DB::table('key_chart')->where('key_id',$request->id)->get();
    // $keyqvalue =  DB::table('key_quarter_value')->where('key_chart_id', $KEYChart->id)->get();

    return view('objective.key-chart',compact('KEYChart','key','report','keyQAll'));

    }

    public function UpdateQvalue(Request $request)
    {
        DB::table('key_quarter_value')->where('id',$request->id)->update([
          'value' => $request->title,
        
        ]);

        $key = DB::table('key_quarter_value')->where('id',$request->id)->first();
        $keychart = DB::table('key_quarter_value')->where('key_chart_id',$key->key_chart_id)->orderby('id','DESC')->first();

        return $keychart;

    }

    public function DeleteQvalue(Request $request)
    {
        DB::table('key_quarter_value')->where('id',$request->id)->delete();
      
    }

    public function UpdateQkeyVal(Request $request)
    {
        DB::table('key_chart')->where('id',$request->id)->update([
          'quarter_value' => $request->title,
        
        ]);

        $KEYChart = array();

        $key = DB::table('key_chart')->where('id',$request->id)->first();
        $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$request->unit_id)->first();
      
        if($report)
        {
          
        $KEYChart =  DB::table('key_chart')->where('key_id',$key->key_id)->where('IndexCount',$report->IndexCount)->first();
        
        }

        return $KEYChart;
       


       

    }

      
    public function DeleteSprintQuarter(Request $request)
    {
        DB::table('sprint')->where('id',$request->sprint_id)->delete();
        DB::table('sprint_report')->where('q_id',$request->sprint_id)->delete();
        return redirect()->back();
    }

    public function AddnewKeyQvalue(Request $request)
    {
      $kindex = DB::table('key_chart')->where('key_id',$request->id)->where('buisness_unit_id',$request->unit_id)->orderby('id','DESC')->first();
      $Index =  $kindex->IndexCount + 1;
      DB::table('key_chart')->insert([
          'key_id' => $request->id,
          'quarter_value' => $request->value,
          'buisness_unit_id' => $request->unit_id,
          'IndexCount' =>  $Index,
        
        ]);

    $KEYChart = array();
    $report = DB::table('sprint')->where('user_id',Auth::id())->where('status',NULL)->where('value_unit_id',$request->unit_id)->first();
    if($report)
    {
    $KEYChart =  DB::table('key_chart')->where('key_id',$request->id)->where('IndexCount',$report->IndexCount)->first();

    }
    $key = DB::table('key_result')->where('id',$request->id)->first();
    $keyQAll = DB::table('key_chart')->where('key_id',$request->id)->get();
   

    return view('objective.key-chart',compact('KEYChart','key','report','keyQAll'));

    }
    
    
    


}
