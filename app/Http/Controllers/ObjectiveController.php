<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use App\Helpers\Quarters;
use App\Helpers\Jira;


class ObjectiveController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }


    public function Objectives($id,$type)
    {
        
        
    
         
        // $organization  = Organization::where('slug',$id)->where('trash',NULL)->first();
        // $objective =     DB::table('objectives')->where('user_id',Auth::id())->where('org_id',$organization->id)->where('trash',NULL)->get();

        if($type == 'unit')
        {
         $organization  = DB::table('business_units')->where('slug',$id)->first();
         $objective =     DB::table('objectives')->where('unit_id',$organization->id)->where('trash',NULL)->where('type','unit')->get();

        }
        
              

        
        if($type == 'stream')
        {
         $organization  = DB::table('value_stream')->where('slug',$id)->first();
         $objective =     DB::table('objectives')->where('unit_id',$organization->id)->where('trash',NULL)->where('type','stream')->get();

            
        }

        if($type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$id)->first();
          $objective =     DB::table('objectives')->where('unit_id',$organization->id)->where('trash',NULL)->where('type','BU')->get();

            
        }

        if($type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$id)->first();
          $objective =     DB::table('objectives')->where('unit_id',$organization->id)->where('trash',NULL)->where('type','VS')->get();

            
        }
        
         
         Jira::UpdateEpicjira();
        
        return view('objective.index',compact('organization','objective','type'));  


         
        
  

    }
    public function SaveObjective(Request $request)
    {

        $objective_name = DB::table('objectives')->where('objective_name',$request->objective_name)->first();

        // if($objective_name)
        // {
        // echo 1;
        // }else
        // {
         
        DB::table('objectives')->insert([

        'objective_name' => $request->objective_name,
        'org_id' => $request->org_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'detail' => $request->detail,
        'user_id' => Auth::id(),
        'unit_id' => $request->unit_id,
        'type' => $request->type,
        'status' => $request->objective_status

        ]);

        // $organization  = Organization::where('slug',$request->slug)->where('trash',NULL)->first();
        // $objective =  DB::table('objectives')->where('user_id',Auth::id())->where('org_id',$request->org_id)->where('trash',NULL)->get();
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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }

        

         return view('objective.objective-render',compact('organization','objective'));

           
        // }


    }

    public function UpdateObjective(Request $request)
    {


      
        DB::table('objectives')
         ->where('id',$request->edit_obj_id)
         ->update([
        'objective_name' => $request->edit_objective_name,
        'start_date' => $request->edit_start_date,
        'end_date' => $request->edit_end_date,
        'detail' => $request->edit_obj_small_description,
        'user_id' => Auth::id(),
        'status' => $request->status

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }
        
        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }


         return view('objective.objective-render',compact('organization','objective'));  






    }

    public function DeleteObjective(Request $request)
    {


      
        DB::table('objectives')->where('id',$request->delete_obj_id)->update(['trash' => 1]);
        DB::table('key_result')->where('obj_id',$request->delete_obj_id)->delete();
        DB::table('initiative')->where('obj_id',$request->delete_obj_id)->delete();


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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


        return view('objective.objective-render',compact('organization','objective'));





    }




  

    public function SaveKeyObjective(Request $request)
    {


      
        $key_name = DB::table('key_result')->where('key_name',$request->key_name)->first();

        // if($key_name)
        // {
        // echo 1;
        // }else
        // {
        
        if($request->has('Target'))
        {
          $team = implode(',',$request->Target);  
        }else
        {
         $team = NULL;   
        }
         
       $KEY =  DB::table('key_result')->insertGetId([

        'key_name' => $request->key_name,
        'obj_id' => $request->obj_id,
        'key_start_date' => $request->key_start_date,
        'key_end_date' => $request->key_end_date,
        'key_detail' => $request->key_detail,
        'user_id' => Auth::id(),
        'weight' => $request->weight,
        'key_status' => $request->k_status,
        'target_value' => $team,
        'key_result_type' => $request->key_result_type,
        'key_unit' => $request->key_result_unit,
        'init_value' => $request->init_value,
        'target_number' => $request->target_number,
     


        ]);

        $counter = 0;
        foreach($request->Target  as $key => $value)
        {
          $counter++;
          DB::table('key_chart')->insert([
            'quarter_value' => $request->Target[$key],
            'key_id' =>  $KEY,
            'buisness_unit_id' => $request->unit_id,
            'IndexCount' => $counter,
          ]);
        }

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective'));


           
        // }




    }

    public function UpdateKeyObjective(Request $request)
    {

       $key = DB::table('key_result')->where('obj_id',$request->obj_id)->sum('weight');
       
       $weight = null;
       
       if($key > 0)
       {
       $weight = $request->weightedit_1;       
           
       }else
       {
        $weight = $request->weightedit;       

       }

        DB::table('key_result')
        ->where('id',$request->key_id)
        ->update([

        'key_name' => $request->edit_key_name,
        'key_start_date' => $request->edit_key_start_date,
        'key_end_date' => $request->edit_key_end_date,
        'key_detail' => $request->edit_key_detail,
        'user_id' => Auth::id(),
        'weight' => $weight,
        'key_status' => $request->edit_key_status,
        'key_result_type' => $request->edit_key_result_type,
        'key_unit' => $request->edit_key_result_unit,
        'init_value' => $request->edit_init_value,
        'target_number' => $request->edit_target_number,
      

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
        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }


        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective'));
           
        
    }

    public function DeleteKeyObjective(Request $request)
    {


      
        DB::table('key_result')->where('id',$request->key_delete_id)->delete();
        DB::table('initiative')->where('key_id',$request->key_delete_id)->delete();

        DB::table('key_chart')->where('key_id',$request->key_delete_id)->delete();
        DB::table('key_quarter_value')->where('key_id',$request->key_delete_id)->delete();

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective')); 





    }

    public function SaveKeyinitiative(Request $request)
    {


      
        $initiative_name = DB::table('initiative')->where('initiative_name',$request->initiative_name)->first();

        // if($initiative_name)
        // {
        // echo 1;
        // }else
        // {
         
        DB::table('initiative')->insert([

        'initiative_name' => $request->initiative_name,
        'obj_id' => $request->obj_id_initiative,
        'key_id' => $request->key_id_initiative,
        'initiative_start_date' => $request->initiative_start_date,
        'initiative_end_date' => $request->initiative_end_date,
        'initiative_detail' => $request->initiative_detail,
        'user_id' => Auth::id(),
        'initiative_weight' => $request->slider,
         'initiative_status' => $request->init_status,

        

        ]);
        
      $month = DB::table('organization')->where('user_id',Auth::id())->first();
      $monthIndex = 1;
      if($month->month)
      {
       $monthIndex = $month->month + 1; 

      }
        $startDate = now()->startOfMonth()->setMonth($monthIndex);
        $startDateFormatted = $startDate->toDateString();     
        
      $data = DB::table('initiative')->where('user_id',Auth::id())->orderby('id','DESC')->first();
      $quarters  = Quarters::GetQuarterYear($startDateFormatted,$request->initiative_end_date,$data->id);

     
//      $endDate = Carbon::parse($request->initiative_start_date);
//      $startDate = Carbon::parse($startDateFormatted);
     
//     if($endDate > $startDate)
//     {
//       $quartersToRemove = [];
//       $monthsToRemove = [];
           
       
//   while ($startDate->lt($endDate)) {
//         $year = $startDate->year;
//         $quarter = ceil($startDate->month / 3);

//         $monthsToRemove[] = ['year' => $year, 'quarter' => $quarter, 'month' => $startDate->format('F')];

//         $startDate->addMonth();
//     }




//         foreach ($monthsToRemove as $monthToRemove) {
//             DB::table('quarter_month')
//                 ->where('initiative_id',$data->id)
//                 ->where('year', $monthToRemove['year'])
//                 // ->where('quarter_name', 'Q' . $monthToRemove['quarter'])
//                 ->where('month', $monthToRemove['month'])
//                 ->delete();
                
                
                
        
               
//         }
//     }
        
    
    
//      $quarter = [
//     'Q1 2023',
//     'Q2 2023',
//     'Q3 2023',
//     'Q4 2023',
//      ];

// foreach ($quarter as $quarterName) {
//     DB::table('quarter')->insert([
//         'quarter_name' => $quarterName,
//         'initiative_id' => $data->id,
//         'user_id' => Auth::id(),
       
//     ]);
// }

// $quarters = DB::table('quarter')->where('user_id', Auth::id())->where('initiative_id',$data->id)->get();

// $monthNamesSets = [
//     ['January', 'February', 'March' ],
//     ['April','May', 'June' ],
//     ['July','August','September'],
//     ['October', 'November', 'December']

// ];

// foreach ($quarters as $key => $quarter) {
//     $monthNames = $monthNamesSets[$key] ?? [];

//     foreach ($monthNames as $monthName) {
//         DB::table('quarter_month')->insert([
//             'quarter_id' => $quarter->id,
//             'month' => $monthName,
//             'user_id' => Auth::id(),
//             'initiative_id' => $data->id
//         ]);
//     }
// }
 
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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


        return view('objective.objective-render',compact('organization','objective'));

           
        // }




    }

    public function DeleteKeyInitiative(Request $request)
    {


      
        DB::table('initiative')->where('id',$request->initiative_delete_id)->delete();
        DB::table('quarter')->where('user_id', Auth::id())->where('initiative_id',$request->initiative_delete_id)->delete();
        DB::table('quarter_month')->where('user_id', Auth::id())->where('initiative_id',$request->initiative_delete_id)->delete();

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective')); 





    }


    public function UpdateKeyinitiative(Request $request)
    {

     $key = DB::table('initiative')->where('key_id',$request->key_edit)->sum('initiative_weight');
     $weight = null;
     if($key > 0)
     {
       $weight = $request->weightedit;   
     }else
     {
      $weight = $request->sliderValue; 
         
     }
     
     
     
      $date = DB::table('initiative')->where('id',$request->edit_id_initiative)->first();
      
      
      $startDate = Carbon::parse($date->initiative_end_date);
      $endDate =   Carbon::parse($request->edit_initiative_end_date);
 
      
      
      
      $previousEndDate = Carbon::parse($date->initiative_end_date);
      $newEndDate = Carbon::parse($request->edit_initiative_end_date); 
 
//  $months = [];

// while ($previousEndDate->lte($endDate)) {
//     // Add the current month to the array
//     // $months[] = $startDate->format('F Y'); // 'F' returns the full month name (e.g., 'September')
//     $months[] = ['startdate' => $startDate->format('F'), 'enddate' => $startDate->format('Y')];

//     $startDate->addMonth();
// }

     
     

     if($request->edit_initiative_end_date == $date->initiative_end_date)
     {
        DB::table('initiative')
        ->where('id',$request->edit_id_initiative)
        ->update([
        'initiative_name' => $request->edit_initiative_name,
        'initiative_start_date' => $request->edit_initiative_start_date,
        'initiative_end_date' => $request->edit_initiative_end_date,
        'initiative_detail' => $request->edit_initiative_detail,
        'user_id' => Auth::id(),
         'initiative_weight' => $weight,
         'initiative_status' => $request->edit_initiative_status,

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }

 
         return view('objective.objective-render',compact('organization','objective'));   
     }


                     if($endDate > $previousEndDate)
                      
                     {
        
                    $existingQuarters = DB::table('quarter')
                    ->where('initiative_id', $date->id)
                    ->select('year', 'quarter_name')
                    ->get()
                    ->groupBy('year')
                    ->map(function ($quarters) {
                        return $quarters->pluck('quarter_name')->toArray();
                    })
                    ->toArray();
        

                    
                    $month = DB::table('organization')->where('user_id',Auth::id())->first();
                      $monthIndex = 1;
                      if($month->month)
                      {
                       $monthIndex = $month->month + 1; 
                
                      }
                        $startD = now()->startOfMonth()->setMonth($monthIndex);
                        $startDateFormatted = $startD->toDateString();  
                        
                    $startDate = Carbon::parse($startDateFormatted);
                    $endDate = Carbon::parse($date->initiative_end_date);
                    $newEndDate = Carbon::parse($request->edit_initiative_end_date);



                    $currentDate = $startDate->copy();
                    
                    $quarters = [];
                    
                    $year = $currentDate->year;
                    
                    $monthCount = 0;
                    
                    while ($currentDate->lte($newEndDate)) {
                        $monthCount++;
                        $currentDate->addMonth();
                    }
                    
                    $currentDate = $startDate;
                    
                    for ($i = 1; $i <= $monthCount; $i++) {
                        $quarter = ceil($i / 3);
                    
                        if ($quarter > 4) {
                            $quarter -= 4;
                        }
                    
                        if (!isset($quarters[$year][$quarter])) {
                            $quarters[$year][$quarter] = [];
                        }
                    
                        $quarters[$year][$quarter][] = $currentDate->format('F');
                    
                        $currentDate->addMonth();
                    
                        if ($currentDate->month == 1) {
                            $year++;
                        }
                    }
                    
                    
                    $counter = -1;
                    
                    
                    foreach ($quarters as $year => $yearQuarters) {
                        foreach ($yearQuarters as $quarterNum => $months) {
                            $quarterName = 'Q' . $quarterNum;
                            $counter++;

        if (!isset($existingQuarters[$year]) || !in_array($quarterName, $existingQuarters[$year])) {
            $quarterId = DB::table('quarter')->insertGetId([
                'quarter_name' => $quarterName,
                'year' => $year,
                'initiative_id' => $date->id,
                'user_id' => Auth::id(),
                'loop_index' => $counter,
            ]);
        } else {
            $existingQuarter = DB::table('quarter')
                ->where('initiative_id', $date->id)
                ->where('year', $year)
                ->where('quarter_name', $quarterName)
                ->first();

            if ($existingQuarter) {
                $quarterId = $existingQuarter->id;
            }
        }

        foreach ($months as $monthName) {
            $existingMonth = DB::table('quarter_month')
                ->where('quarter_id', $quarterId)
                ->where('month', $monthName)
                ->first();

            if (!$existingMonth) {
                DB::table('quarter_month')->insert([
                    'quarter_id' => $quarterId,
                    'month' => $monthName,
                    'user_id' => Auth::id(),
                    'initiative_id' => $date->id,
                    'quarter_name' => $quarterName,
                    'year' => $year,
                ]);
            }
        }
    }
}

         DB::table('initiative')
        ->where('id',$request->edit_id_initiative)
        ->update([
        'initiative_name' => $request->edit_initiative_name,
        'initiative_start_date' => $request->edit_initiative_start_date,
        'initiative_end_date' => $request->edit_initiative_end_date,
        'initiative_detail' => $request->edit_initiative_detail,
        'user_id' => Auth::id(),
         'initiative_weight' => $weight,
         'initiative_status' => $request->edit_initiative_status,

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective')); 

       
      }
      
   

    //     $monthName = Carbon::parse($date->initiative_end_date)->format('F');
    //     $YearName = Carbon::parse($date->initiative_end_date)->format('Y');
        
    //   $QDate = DB::table('quarter_month')->where('initiative_id',$date->id)->where('month',$monthName)->where('year',$YearName)->first();
    $epicId = DB::table('epics')
    ->where('initiative_id', $date->id)
    ->where(function ($query) use ($date, $request) {
        $query->where('epic_end_date', '<', $date->initiative_end_date)
              ->orWhere('epic_end_date', '>', $request->edit_initiative_end_date);
    })
    ->count(); 
 
    

      if($endDate < $previousEndDate && $epicId == 0)
      {
    
     
           $quartersToRemove = [];
           $monthsToRemove = [];
      
      
            
            while ($previousEndDate->gt($newEndDate)) {
            
                $year = $previousEndDate->year;
                $quarter = ceil($previousEndDate->month / 3);
                 
               
                $quartersToRemove[] = ['year' => $year, 'quarter' => $quarter];
                $monthsToRemove[] = ['year' => $year, 'quarter' => $quarter, 'month' => $previousEndDate->format('F')];
            
                
                $previousEndDate->subMonth();
              
            
            }
            

        foreach ($monthsToRemove as $monthToRemove) {
            DB::table('quarter_month')
                ->where('initiative_id',$date->id)
                ->where('year', $monthToRemove['year'])
                // ->where('quarter_name', 'Q' . $monthToRemove['quarter'])
                ->where('month', $monthToRemove['month'])
                ->delete();
                
                
                
        
               
        }
        
        DB::table('initiative')
        ->where('id',$request->edit_id_initiative)
        ->update([
        'initiative_name' => $request->edit_initiative_name,
        'initiative_start_date' => $request->edit_initiative_start_date,
        'initiative_end_date' => $request->edit_initiative_end_date,
        'initiative_detail' => $request->edit_initiative_detail,
        'user_id' => Auth::id(),
         'initiative_weight' => $weight,
         'initiative_status' => $request->edit_initiative_status,

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective')); 
      
      }else
      {
          echo 1;
      }


      
        

           
        

    }
    
      public function SaveEpic(Request $request)
    {


  
        $monthName = Carbon::parse($request->epic_end_date)->format('F');
  
        $month = DB::table('quarter_month')->where('initiative_id',$request->ini_epic_id)->where('month',$monthName)->first();

         
        $epicId = DB::table('epics')->insertGetId([

        'epic_status' => $request->epic_status,
        'epic_name' => $request->epic_name,
        'epic_detail' => $request->epic_description,
        'epic_start_date' => $request->epic_start_date,
        'epic_end_date' => $request->epic_end_date,
        'initiative_id' => $request->ini_epic_id,
        'user_id' => Auth::id(),
        'month_id' => $month->id,
        'quarter_id' => $month->quarter_id, 
        

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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$id)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective'));

        
    }
    
    public function UpdateEpic(Request $request)
    {
        $date = DB::table('epics')->where('id',$request->edit_epic_id)->first();
        $monthName = Carbon::parse($request->edit_epic_end_date)->format('F');
        $month = DB::table('quarter_month')->where('initiative_id',$request->edit_ini_epic_id)->where('month',$monthName)->first();
        if($request->has('selectedOptions'))
        {
            $team = $request->selectedOptions;  
        }else
        {
            $team = NULL;   
        }
        DB::table('epics')->where('id',$request->edit_epic_id)->update([
            'epic_status' => $request->edit_epic_status,
            'epic_name' => $request->edit_epic_name,
            'epic_detail' => $request->edit_epic_description,
            'epic_start_date' => $request->edit_epic_start_date,
            'epic_end_date' => $request->edit_epic_end_date,
            'user_id' => Auth::id(),
            'month_id' => $month->id, 
            'team_id' => $team,
            'buisness_unit_id'=>$request->edit_buisness_unit_id,
        ]);
        if($request->edit_epic_status == 'Done')
        {
            DB::table('epics')->where('id',$request->edit_epic_id)->update([
                'epic_progress' => 100,
                'updated_at' => Carbon::now(),
            ]);
        }
        DB::table('epics_stroy')->where('epic_id',$request->edit_epic_id)->update(['progress' => 100]);
        $epicid = DB::table('epics')->where('id',$request->edit_epic_id)->first();
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $yearMonthString = $currentDate->format('Y');
        $yearMonth = $currentDate->format('F');
        $CurrentQuarter = '';
        $QuarterCount = '';
        $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$request->edit_ini_epic_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
        $Quarter = DB::table('epics')->where('id',$request->edit_epic_id)->first();
        if($CurrentQuarter)
        {
        $QuarterCount = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('trash',NULL)->count();
        $Quarterprogress  = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
        }
        if($QuarterCount > 0)
        {
        $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
            DB::table('quarter')->where('id',$CurrentQuarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
            DB::table('initiative')->where('id',$CurrentQuarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);
        }
        $initcount = DB::table('initiative')->where('key_id',$request->edit_epic_key)->sum('initiative_weight');
        if($initcount == 100)
        {
            $epic = DB::table('epics')->where('id',$epicid->id)->where('trash',NULL)->first();
            $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
            $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
            $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
            $finaltotal =  ($totalinitiative * 100);
            $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
            $resultinit = ($intw->initiative_weight / 100);
            $newresultinit = round(($resultinit * $finaltotal),2);
            DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);
        }
        else
        {   
            $epic = DB::table('epics')->where('id',$request->edit_epic_id)->first();
            $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
            $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
            $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
            $finaltotal =  ($totalinitiative * 100);
            DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]); 
        }
        $objwcount = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->edit_epic_key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->edit_epic_key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->edit_epic_key)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->edit_epic_key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->edit_epic_key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->edit_epic_key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->edit_epic_key)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->edit_epic_key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->edit_epic_key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->edit_epic_obj)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->edit_epic_obj)->update(['q_obj_prog' => $QuartertotalObj]);
      

 
     
     
    $backlog = DB::table('epics')->where('id',$request->edit_epic_id)->first();
     
 
    if($backlog->backlog_id != '' && $backlog->type == 'stream')
    {
        
    DB::table('backlog')->where('id',$backlog->backlog_id)->update(['epic_status' => $request->edit_epic_status,'epic_title' => $request->edit_epic_name,'epic_start_date' => $request->edit_epic_start_date,'epic_end_date' => $request->edit_epic_end_date]);

    }
     
     if($backlog->backlog_id != '' && $backlog->type == 'unit')
     {
     DB::table('backlog_unit')->where('id',$backlog->backlog_id)->update(['epic_status' => $request->edit_epic_status,'epic_title' => $request->edit_epic_name,'epic_start_date' => $request->edit_epic_start_date,'epic_end_date' => $request->edit_epic_end_date]);

     }
     
    if($backlog->backlog_id != '' && $backlog->type == 'unit')
    { 
     $jiraa = DB::table('backlog_unit')->where('id',$backlog->backlog_id)->first();
    } 
    
     if($backlog->backlog_id != '' && $backlog->type == 'stream')
    { 
     $jiraa = DB::table('backlog')->where('id',$backlog->backlog_id)->first();
    }     
    
    if($backlog->backlog_id != '')
    { 
    if($backlog->jira_id != '')
    {
    $Account = DB::table('jira_setting')->where('user_id',Auth::id())->first();
    $username = $Account->user_name;
    $apiToken = $Account->token;
    $issueKeyOrId = $backlog->jira_id;
    $apiEndpoint = "{$Account->jira_url}/rest/api/3/issue/{$issueKeyOrId}";

    $auth = base64_encode("$username:$apiToken");

     
    $updateData = [
    "fields" => [
        "description" => [
            "type" => "doc",
            "version" => 1,
            "content" => [
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "type" => "text",
                            "text" => $request->edit_epic_description
                        ]
                    ]
                ]
            ]
        ],
        
       "summary" => $request->edit_epic_name, 
    ],
    
     
];
        
        $ch = curl_init($apiEndpoint);
        
        if ($ch === false) {
            die("cURL initialization failed");
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updateData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic {$auth}",
            "Content-Type: application/json",
        ]);
        
        $response = curl_exec($ch);
        
        curl_close($ch);

     }
    }
    

        
      
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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective')); 

        
    }
    
        public function EditEpic(Request $request)
    {
        
    
      $epicstory = DB::table('epics_stroy')->where('epic_id',$request->edit_epic_id)->get();
      $epic = DB::table('epics')->where('id',$request->edit_epic_id)->first();

      return view('objective.edit-epic-story',compact('epicstory','epic'));

      // return view('objective.epic-story-render',compact('epicstory','epic'));
      

    }
    
      public function DeleteEpic(Request $request)
    {


  
    DB::table('epics')->where('id',$request->epicid)->update(['trash' => Carbon::now()]);
    DB::table('epics_stroy')->where('epic_id',$request->epicid)->delete(); 
      
 
    $Quartertotal = 0;
    $totalinitiative = 0;
    $finaltotal  = 0;
    
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $yearMonthString = $currentDate->format('Y');
        $yearMonth = $currentDate->format('F');
        $CurrentQuarter = '';
        $QuarterCount = '';
        $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$request->ini_epic)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
    
    $Quarter = DB::table('epics')->where('id',$request->epicid)->first();
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$CurrentQuarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$CurrentQuarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }

     
   $initcount = DB::table('initiative')->where('key_id',$request->edit_epic_key)->sum('initiative_weight');

    if($initcount == 100)
    {
    $epic = DB::table('epics')->where('id',$request->epicid)->first();

    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100); 
    
     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

    }else
    {
        
    $epic = DB::table('epics')->where('id',$request->epicid)->first();
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->where('epic_progress','=',100)->count();
    if($epicinitiativecount > 0)
    {
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100);
    }
    
    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    


        
    }

      
  
    
      $objwcount = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->edit_epic_key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->edit_epic_key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->edit_epic_key)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->edit_epic_key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->edit_epic_key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->edit_epic_key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->edit_epic_key)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->edit_epic_key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->edit_epic_key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->edit_epic_obj)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->edit_epic_obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->edit_epic_obj)->update(['q_obj_prog' => $QuartertotalObj]);


        
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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective'));





    }
    
    public function AddStoryProgress(Request $request)
    {
        
    
      $epicid = DB::table('epics_stroy')->where('id',$request->id)->first();
      
          DB::table('epics_stroy')->where('id',$request->id)->update([
            'progress' => '100',

                  ]);
                  
    $epicstory = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->get();
    $epicprogress  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->sum('progress');
    $count  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->count();
    
    $total = round(($epicprogress / $count),2);

     DB::table('epics')->where('id',$epicid->epic_id)->update(['epic_progress' => $total,'updated_at' => Carbon::now()]);
     
     $backlog = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
     
     if($backlog->backlog_id != '' && $backlog->type == 'stream')
     {
      DB::table('backlog')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
     if($backlog->backlog_id != '' && $backlog->type == 'unit')
     {
      DB::table('backlog_unit')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
        
    
        $Quarter = DB::table('epics')->where('id',$epicid->epic_id)->first();
        
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $yearMonthString = $currentDate->format('Y');
        $yearMonth = $currentDate->format('F');
        $CurrentQuarter = '';
        $QuarterCount = '';
        $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$Quarter->initiative_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();

    
    
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }
     
    $initcount = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');
 
    if($initcount == 100)
    {
        
    $epic = DB::table('epics')->where('id',$epicid->epic_id)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 

     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

        
    }else
    {
        
    $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 


    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    
 
    // $QuarterprogressInit  = DB::table('quarter')->where('initiative_id',$epic->initiative_id)->where('quarter_progress','=',100)->count();
    // $QuartertotalInit = round(($QuarterprogressInit / 4 * 100),2);
    // DB::table('initiative')->where('id',$epic->initiative_id)->update(['q_initiative_prog' => $QuartertotalInit]);


        
    }


 

     $objwcount = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      

     $keyw = DB::table('key_result')->where('id',$request->key)->first();
     $result = ($keyw->weight / 100);
     $newresult = round(($result * $finaltotalkey),2);
      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  round(($totalkey * 100),2);      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     

    
         
     
     
     
     $objcount = DB::table('key_result')->where('obj_id',$request->obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100);
     DB::table('objectives')->where('id',$request->obj)->update(['obj_prog' => $finaltotalobj]);
     
    $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->obj)->update(['q_obj_prog' => $QuartertotalObj]);

    return view('objective.edit-epic-story',compact('epicstory','epic'));

      
    // return view('objective.epic-story-render',compact('epicstory','epic'));
      

    }
    
        public function UpdateStoryProgress(Request $request)
    {
        
    
      $epicid = DB::table('epics_stroy')->where('id',$request->id)->first();
      
          DB::table('epics_stroy')->where('id',$request->id)->update([
            'progress' => '0',

                  ]);
                  
    $epicstory = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->get();
    $epicprogress  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->sum('progress');
    $count  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->count();
    
    $total = round(($epicprogress / $count),2);

     DB::table('epics')->where('id',$epicid->epic_id)->update(['epic_progress' => $total,'updated_at' => Carbon::now()]);
     
      $backlog = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
     
     if($backlog->backlog_id != '' && $backlog->type == 'stream')
     {
      DB::table('backlog')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
     if($backlog->backlog_id != '' && $backlog->type == 'unit')
     {
      DB::table('backlog_unit')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
    $Quarter = DB::table('epics')->where('id',$epicid->epic_id)->first();

     $currentDate = Carbon::now();
     $currentYear = $currentDate->year;
     $currentMonth = $currentDate->month;
     $yearMonthString = $currentDate->format('Y');
     $yearMonth = $currentDate->format('F');
     $CurrentQuarter = '';
     $QuarterCount = '';
     $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$Quarter->initiative_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();

    
    
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }
    
     
    $initcount = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');
 
    if($initcount == 100)
    {
        
     $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 

     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

        
    }else
    {
        
     $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 


    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    
    // $QuarterprogressInit  = DB::table('quarter')->where('initiative_id',$epic->initiative_id)->where('quarter_progress','=',100)->count();
    // $QuartertotalInit = round(($QuarterprogressInit / 4 * 100),2);
    // DB::table('initiative')->where('id',$epic->initiative_id)->update(['q_initiative_prog' => $QuartertotalInit]);

        
    }
    
      $objwcount = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->key)->first();
     $result = ($keyw->weight / 100);
     $newresult = round(($result * $finaltotalkey),2);
      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  round(($totalkey * 100),2);      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $finaltotalkey]);
     
     $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  round(($totalobj * 100),2); 
     
     DB::table('objectives')->where('id',$request->obj)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->obj)->update(['q_obj_prog' => $QuartertotalObj]);

    return view('objective.edit-epic-story',compact('epicstory','epic'));

    //  return view('objective.epic-story-render',compact('epicstory','epic'));
      

    }
    
        public function AddNewStory(Request $request)
    {
        
    
      $epicid = DB::table('epics')->where('id',$request->id)->first();
      
          DB::table('epics_stroy')->insert([
            'epic_story_name' => $request->title,
            'story_assign' => $request->story_assign,
            'story_status' => $request->story_status,
            'StoryID' => Str::slug('SSP-'.rand(100,999)),
            'epic_id' => $request->id,
            'user_id' => Auth::id(),

              ]);
                  
    $epicstory = DB::table('epics_stroy')->where('epic_id',$epicid->id)->get();
    $epicprogress  = DB::table('epics_stroy')->where('epic_id',$epicid->id)->sum('progress');
    $count  = DB::table('epics_stroy')->where('epic_id',$epicid->id)->count();
    
    $total = round(($epicprogress / $count),2);

     DB::table('epics')->where('id',$epicid->id)->update(['epic_progress' => $total,'updated_at' => Carbon::now()]);
     
     $backlog = DB::table('epics')->where('id',$epicid->id)->where('trash',NULL)->first();
     
     if($backlog->backlog_id != '' && $backlog->type == 'stream')
     {
      DB::table('backlog')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
     if($backlog->backlog_id != '' && $backlog->type == 'unit')
     {
      DB::table('backlog_unit')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
    $Quarter = DB::table('epics')->where('id',$epicid->id)->first();
    
    $currentDate = Carbon::now();
     $currentYear = $currentDate->year;
     $currentMonth = $currentDate->month;
     $yearMonthString = $currentDate->format('Y');
     $yearMonth = $currentDate->format('F');
     $CurrentQuarter = '';
     $QuarterCount = '';
     $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$Quarter->initiative_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
     
    
   
    
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }
     
    $initcount  = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');

    if($initcount == 100)
    {
    $epic = DB::table('epics')->where('id',$epicid->id)->where('trash',NULL)->first();

    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100); 
    
     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

    }else
    {
        
    $epic = DB::table('epics')->where('id',$epicid->id)->where('trash',NULL)->first();
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100);
    
    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    
    // $QuarterprogressInit  = DB::table('quarter')->where('initiative_id',$epic->initiative_id)->where('quarter_progress','=',100)->count();
    // $QuartertotalInit = round(($QuarterprogressInit / 4 * 100),2);
    // DB::table('initiative')->where('id',$epic->initiative_id)->update(['q_initiative_prog' => $QuartertotalInit]);

        
    }

      
  
    
      $objwcount = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->key)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->obj)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->obj)->update(['q_obj_prog' => $QuartertotalObj]);

      
    // return view('objective.epic-story-render',compact('epicstory','epic'));
    return view('objective.edit-epic-story',compact('epicstory','epic'));
  

    }
    
    public function UpdateStoryTitle(Request $request)
    {
        
    
    
      
      DB::table('epics_stroy')->where('id',$request->s_id)->update([
            'epic_story_name' => $request->title,
            'story_status' => $request->story_status,
            'story_assign' => $request->story_assign,
          ]);

    if($request->story_status == 'Done')
    {
    DB::table('epics_stroy')->where('id',$request->s_id)->update(['progress' => 100]);
    }else
    {
      DB::table('epics_stroy')->where('id',$request->s_id)->update(['progress' => 0]);
  
    }
    
    $epicid = DB::table('epics_stroy')->where('id',$request->s_id)->first();
                  
    $epicstory = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->get();
    $epicprogress  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->sum('progress');
    $count  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->count();
    
    $total = round(($epicprogress / $count),2);

     DB::table('epics')->where('id',$epicid->epic_id)->update(['epic_progress' => $total,'updated_at' => Carbon::now()]);
     
     $backlog = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
     
    if($backlog->backlog_id != '' && $backlog->type == 'stream')
     {
      DB::table('backlog')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
     if($backlog->backlog_id != '' && $backlog->type == 'unit')
     {
      DB::table('backlog_unit')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
    $Quarter = DB::table('epics')->where('id',$epicid->epic_id)->first();
    // $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    // $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    // $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    // DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    // DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);
    
    $currentDate = Carbon::now();
     $currentYear = $currentDate->year;
     $currentMonth = $currentDate->month;
     $yearMonthString = $currentDate->format('Y');
     $yearMonth = $currentDate->format('F');
     $CurrentQuarter = '';
     $QuarterCount = '';
     $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$Quarter->initiative_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
     
    
   
    
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }
      
    $initcount = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');
 
    if($initcount == 100)
    {
        
     $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 

     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

        
    }else
    {
        
     $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 


    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    
    // $QuarterprogressInit  = DB::table('quarter')->where('initiative_id',$epic->initiative_id)->where('quarter_progress','=',100)->count();
    // $QuartertotalInit = round(($QuarterprogressInit / 4 * 100),2);
    // DB::table('initiative')->where('id',$epic->initiative_id)->update(['q_initiative_prog' => $QuartertotalInit]);

        
    }
    
    $objwcount = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->key)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $finaltotalkey]);
     
       $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->obj)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->obj)->update(['q_obj_prog' => $QuartertotalObj]);

    return view('objective.edit-epic-story',compact('epicstory','epic'));
    // return view('objective.epic-story-render',compact('epicstory','epic'));
      

    }
    
    public function DeleteStory(Request $request)
    {
        
      $total = 0;
      $epicid = DB::table('epics_stroy')->where('id',$request->id)->first();
      
      DB::table('epics_stroy')->where('id',$request->id)->delete();

                
                  
    $epicstory = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->get();
    $epicprogress  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->sum('progress');
    $count  = DB::table('epics_stroy')->where('epic_id',$epicid->epic_id)->count();
    if($count > 0)
    {
        
    $total = round(($epicprogress / $count),2);
    }
    

     DB::table('epics')->where('id',$epicid->epic_id)->update(['epic_progress' => $total,'updated_at' => Carbon::now()]);
     
     $backlog = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
     
     if($backlog->backlog_id != '' && $backlog->type == 'stream')
     {
      DB::table('backlog')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
     if($backlog->backlog_id != '' && $backlog->type == 'unit')
     {
      DB::table('backlog_unit')->where('id',$backlog->backlog_id)->update(['progress' => $total]);

     }
     
    $Quarter = DB::table('epics')->where('id',$epicid->epic_id)->first();
    
    // $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    // $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    // $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    // DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    // DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);
    
     $currentDate = Carbon::now();
     $currentYear = $currentDate->year;
     $currentMonth = $currentDate->month;
     $yearMonthString = $currentDate->format('Y');
     $yearMonth = $currentDate->format('F');
     $CurrentQuarter = '';
     $QuarterCount = '';
     $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$Quarter->initiative_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
     
    
   
    
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$Quarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$Quarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$Quarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }
  
    
    $initcount = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');
 
    if($initcount == 100)
    {
        
     $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 

     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

        
    }else
    {
        
     $epic = DB::table('epics')->where('id',$epicid->epic_id)->where('trash',NULL)->first();
    
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress / $epicinitiativecount); 
    $finaltotal =  round(($totalinitiative * 100),2); 


    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    
    // $QuarterprogressInit  = DB::table('quarter')->where('initiative_id',$epic->initiative_id)->where('quarter_progress','=',100)->count();
    // $QuartertotalInit = round(($QuarterprogressInit / 4 * 100),2);
    // DB::table('initiative')->where('id',$epic->initiative_id)->update(['q_initiative_prog' => $QuartertotalInit]);

        
    }
    
    $objwcount = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     
     $keyw = DB::table('key_result')->where('id',$request->key)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->key)->update(['key_prog' => $finaltotalkey]);
     
     $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->obj)->update(['obj_prog' => $finaltotalobj]);
     
    $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->obj)->update(['q_obj_prog' => $QuartertotalObj]);

    return view('objective.edit-epic-story',compact('epicstory','epic'));

    // return view('objective.epic-story-render',compact('epicstory','epic'));
      

    }
    
    public function GetAllData(Request $request)
    {
        
    

    $epic = DB::table('epics')->where('id',$request->id)->first();
    $initiative = DB::table('initiative')->where('id',$epic->initiative_id)->first(); 
    $key = DB::table('key_result')->where('id',$initiative->key_id)->first();
    $obj = DB::table('objectives')->where('id',$key->obj_id)->first();
    return response()->json(['epic' => $epic, 'initiative' => $initiative,'key' => $key,'obj' => $obj]);


    }
    
     public function checkkeyweight(Request $request)
    {
        
    

  
    $key = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
    
    $value = $key + $request->slider;

    return response()->json(['key' => $value]);


    }
    
      public function checkkeyweightedit(Request $request)
    {
        
     $key = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
     $keyid = DB::table('key_result')->where('id',$request->key)->first();
     
     $oldsum = ($key - $keyid->weight);
     $newvalue = ($oldsum + $request->value);
    
    return response()->json(['key' => $newvalue,'keyid' => $keyid]);

    }
    
       public function checkkeyweighteditfirst(Request $request)
    {
        
     $key = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
     $keyid = DB::table('key_result')->where('id',$request->key)->first();
     
     $oldsum = ($key - $keyid->weight);
     $newvalue = ($oldsum + $request->weightedit);
    
    return response()->json(['key' => $newvalue,'keyid' => $keyid]);

    }
    
        
      public function WeightCheckEdit(Request $request)
    {
        
     $key = DB::table('key_result')->where('obj_id',$request->obj)->sum('weight');
     $keyid = DB::table('key_result')->where('id',$request->id)->first();
     
     return view('objective.key-weight-render',compact('key','keyid'));

    
     
    }
    
    public function ChangeEpic(Request $request)
    {
        
   
    


        
    $quarterMonth  = DB::table('epics')->where('id',$request->droppedElId)->update(['month_id' => $request->parentElId]);
    
     $epic = DB::table('epics')->where('id',$request->droppedElId)->first();
     $keycount = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $obj = DB::table('objectives')->where('id',$keycount->obj_id)->first();
     $org = DB::table('organization')->where('id',$obj->org_id)->first();

        // $organization  = Organization::where('slug',$org->slug)->where('trash',NULL)->first();
        // $objective =  DB::table('objectives')->where('user_id',Auth::id())->where('org_id',$organization->id)->where('trash',NULL)->get();
        // return view('objective.objective-render',compact('organization','objective'));
        
        


    }
    
       public function checkinitiativeweight(Request $request)
    {
        
    

  
    $key = DB::table('initiative')->where('key_id',$request->obj)->sum('initiative_weight');
    
    $value = $key + $request->slider;

    return response()->json(['key' => $value]);


    }
    
    public function WeightCheckinitiativeEdit(Request $request)
    {
        
     $key = DB::table('initiative')->where('key_id',$request->obj)->sum('initiative_weight');
     $keyid = DB::table('initiative')->where('id',$request->id)->first();
     
     return view('objective.initiative-weight-render',compact('key','keyid'));

    
     
    }
    
       public function checkinitiativeweightedit(Request $request)
    {
        
     $key = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');
     $keyid = DB::table('initiative')->where('id',$request->keyId)->first();
     
     $oldsum = ($key - $keyid->initiative_weight);
     $newvalue = ($oldsum + $request->value);
    
    return response()->json(['key' => $newvalue,'keyid' => $keyid]);

    }
    
       public function checkinitiativeweighteditfirst(Request $request)
    {
        
     $key = DB::table('initiative')->where('key_id',$request->key)->sum('initiative_weight');
     $keyid = DB::table('initiative')->where('id',$request->init)->first();
     
     $oldsum = ($key - $keyid->initiative_weight);
     $newvalue = ($oldsum + $request->sliderValue);
    
    return response()->json(['key' => $newvalue,'keyid' => $keyid]);

    }
    
      public function SaveEpicMonth(Request $request)
    {


  
        

        if($request->has('selectedOptions'))
        {
         $team = $request->selectedOptions;  
        }else
        {
         $team = NULL;   
        }
       
       $EpicId =  DB::table('epics')->insertGetId([

        'epic_status' => $request->epic_status,
        'epic_name' => $request->epic_name,
        'epic_detail' => $request->epic_description,
        'epic_start_date' => $request->epic_start_date,
        'epic_end_date' => $request->epic_end_date,
        'initiative_id' => $request->ini_epic_id,
        'user_id' => Auth::id(),
        'month_id' => $request->epic_month,
        'quarter_id' => $request->epic_quartar,
        'obj_id' => $request->epic_obj,
        'team_id' => $team,
        'key_id' => $request->epic_key,
        'buisness_unit_id' => $request->buisness_unit_id,
        'epic_type' => $request->epic_type,

        ]);
        
    if($request->epic_status == 'Done')
    {
      DB::table('epics')->where('id',$EpicId)->update([
          'epic_progress' => 100,
          'updated_at' => Carbon::now(),
          
          ]);
    } 
    if($request->has('epicStory'))
    foreach($request->epicStory  as $key => $value)
    {
      DB::table('epics_stroy')
      ->where('id',$request->epicStory[$key])
      ->update([
        'epic_id' => $EpicId,
      ]);
    }

    if($request->has('epicComment'))
    foreach($request->epicComment  as $key => $value)
    {
      DB::table('epic_comment')
      ->where('id',$request->epicComment[$key])
      ->update([
        'epic_id' => $EpicId,
      ]);
    }
    
        $currentDate = Carbon::now();
        $currentYear = $currentDate->year;
        $currentMonth = $currentDate->month;
        $yearMonthString = $currentDate->format('Y');
        $yearMonth = $currentDate->format('F');
        $CurrentQuarter = '';
        $QuarterCount = '';
        $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$request->ini_epic_id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();


    $Quartertotal = 0;
    $totalinitiative = 0;
    $finaltotal  = 0;
    
    $Quarter = DB::table('epics')->where('id',$EpicId)->first();
    if($CurrentQuarter)
    {
    $QuarterCount = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('trash',NULL)->count();
    $Quarterprogress  = DB::table('epics')->where('quarter_id',$CurrentQuarter->quarter_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    }
    if($QuarterCount > 0)
    {
    $Quartertotal = round(($Quarterprogress / $QuarterCount * 100),2);
    DB::table('quarter')->where('id',$CurrentQuarter->quarter_id)->update(['quarter_progress' => $Quartertotal]);
    DB::table('initiative')->where('id',$CurrentQuarter->initiative_id)->update(['q_initiative_prog' => $Quartertotal]);

    
    }
    

     
    $initcount = DB::table('initiative')->where('key_id',$request->epic_key)->sum('initiative_weight');

    if($initcount == 100)
    {
    $epic = DB::table('epics')->where('id',$EpicId)->first();

    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('epic_progress','=',100)->where('trash',NULL)->count();
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100); 
    
     $intw = DB::table('initiative')->where('id',$epic->initiative_id)->first();
     $resultinit = ($intw->initiative_weight / 100);
     $newresultinit = round(($resultinit * $finaltotal),2);
     DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $newresultinit]);

    }else
    {
        
    $epic = DB::table('epics')->where('id',$EpicId)->first();
    $epicinitiativecount = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->count();
    $initiativeprogress  = DB::table('epics')->where('initiative_id',$epic->initiative_id)->where('trash',NULL)->where('epic_progress','=',100)->count();
    if($epicinitiativecount > 0)
    {
    $totalinitiative =  ($initiativeprogress/$epicinitiativecount); 
    $finaltotal =  ($totalinitiative * 100);
    }
    
    DB::table('initiative')->where('id',$epic->initiative_id)->update(['initiative_prog' => $finaltotal]);
    


        
    }

      
  
    
      $objwcount = DB::table('key_result')->where('obj_id',$request->epic_obj)->sum('weight');
  
     
     if($objwcount == 100)
     {
   
     
     $keycount = DB::table('initiative')->where('key_id',$request->epic_key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->epic_key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
    
     $keyw = DB::table('key_result')->where('id',$request->epic_key)->first();
     $result = ($keyw->weight / 100);
     $newresult = intval($result * $finaltotalkey);
      
     DB::table('key_result')->where('id',$request->epic_key)->update(['key_prog' => $newresult]);

    
     }else{
     
     
         
     $keycount = DB::table('initiative')->where('key_id',$request->epic_key)->count();
     $keyprogress  = DB::table('initiative')->where('key_id',$request->epic_key)->where('initiative_prog','=',100)->count();
     $totalkey =  ($keyprogress / $keycount); 
     $finaltotalkey =  ($totalkey * 100);      
     DB::table('key_result')->where('id',$request->epic_key)->update(['key_prog' => $finaltotalkey]);
     
    $QuarterprogressKey  = DB::table('initiative')->where('key_id',$request->epic_key)->where('q_initiative_prog','=',100)->count();
    $QuartertotalKey = round(($QuarterprogressKey / $keycount * 100),2);
     DB::table('key_result')->where('id',$request->epic_key)->update(['q_key_prog' => $QuartertotalKey]);
     }
     
     $objcount = DB::table('key_result')->where('obj_id',$request->epic_obj)->count();
     $objprogress  = DB::table('key_result')->where('obj_id',$request->epic_obj)->where('key_prog','=',100)->count();
     $totalobj =  ($objprogress / $objcount); 
     $finaltotalobj =  ($totalobj * 100); 
     
     DB::table('objectives')->where('id',$request->epic_obj)->update(['obj_prog' => $finaltotalobj]);
     
      $QuarterprogressObj  = DB::table('key_result')->where('obj_id',$request->epic_obj)->where('q_key_prog','=',100)->count();
    $QuartertotalObj = round(($QuarterprogressObj / $objcount * 100),2);
    DB::table('objectives')->where('id',$request->epic_obj)->update(['q_obj_prog' => $QuartertotalObj]);

 
        
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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        

        
       return view('objective.objective-render',compact('organization','objective'));
        
    }
    
     public function UpdateEpicFlag(Request $request)
    {


        DB::table('epics')->where('id',$request->flag_epic_id)->update([

            'flag_type' => $request->flag_type,
            'flag_assign' => $request->flag_assign,
            'flag_title' => $request->flag_title,
            'flag_description' => $request->flag_description,
            'user_id' => Auth::id(),

        ]);
        
    
        if(!DB::table('epics')->where('id',$request->flag_epic_id)->first()->flag_status)
        {
            DB::table('epics')->where('id',$request->flag_epic_id)->update([
            'flag_status' => 'todoflag',
            'flag_order' => 1,
            ]);
        }
        
      
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

        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   

            
        }
        


         return view('objective.objective-render',compact('organization','objective')); 

        
    }
    
     public function EpicTeam(Request $request)
    {

     $type = $request->type;
     $id = $request->unit_id;

     $data = DB::table('epics')->where('id',$request->epic_id)->first();
     return view('objective.epic-team',compact('data','type','id')); 


        
    }
    
      public function GetEpicFlag(Request $request)
    {
        
        
        $FladId = $request->input('chartId');
        
        if($FladId[0] == 'All')
        {
        if($request->type == 'unit')
        {
         $organization  = DB::table('business_units')->where('slug',$request->slug)->first();
         $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','unit')->get();
        return view('objective.objective-render',compact('organization','objective')); 

        }
        
        if($request->type == 'stream')
        {
         $organization  = DB::table('value_stream')->where('slug',$request->slug)->first();
         $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','stream')->get();   
        return view('objective.objective-render',compact('organization','objective')); 

            
        }    
        }
        
        if($request->type == 'unit')
        {
         $organization  = DB::table('business_units')->where('slug',$request->slug)->first();
         $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','unit')->get(); 
         return view('objective.epicFlag',compact('organization','objective','FladId')); 
        }
        
        if($request->type == 'stream')
        {
         $organization  = DB::table('value_stream')->where('slug',$request->slug)->first();
         $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','stream')->get();          
          return view('objective.epicFlag',compact('organization','objective','FladId'));   
        }

        
        if($request->type == 'BU')
        {
          $organization  = DB::table('unit_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','BU')->get();   
          return view('objective.epicFlag',compact('organization','objective','FladId'));   

            
        }

        if($request->type == 'VS')
        {
          $organization  = DB::table('value_team')->where('slug',$request->slug)->first();
          $objective =     DB::table('objectives')->where('org_id',$request->org_id)->where('unit_id',$request->unit_id)->where('trash',NULL)->where('type','VS')->get();   
          return view('objective.epicFlag',compact('organization','objective','FladId'));   

            
        }
        
    }

    public function SaveNewStory(Request $request)
    {
        

         $StoryId =  DB::table('epics_stroy')->insertGetId([
            'epic_story_name' => $request->title,
            'story_assign' => $request->story_assign,
            'story_type' => $request->story_type,
            'story_status' => $request->story_status,
            'StoryID' => Str::slug('SSP-'.rand(100,999)),
            'VS_BU_ID' => $request->unit_id,
            'R_id' => $request->RID,
            'user_id' => Auth::id(),  
            ]);
      
    if($request->story_status == 'Done')
    {
    DB::table('epics_stroy')->where('id',$StoryId)->update(['progress' => 100]);
    }  

    $story = DB::table('epics_stroy')->where('user_id',Auth::id())->where('epic_id',NULL)
    ->where('VS_BU_ID',$request->unit_id)
    ->where('R_id',$request->RID)->get();          


    return view('objective.story-render',compact('story'));   

    } 
    
    public function UpdateNewStory(Request $request)
    {
        

            DB::table('epics_stroy')
            ->where('id',$request->id)
            ->update([
            'epic_story_name' => $request->title,
            'story_assign' => $request->story_assign,
            'story_type' => $request->story_type,
            'story_status' => $request->story_status,
            ]);


      if($request->story_status == 'Done')
        {
        DB::table('epics_stroy')->where('id',$request->id)->update(['progress' => 100]);
        }        

    $story = DB::table('epics_stroy')->where('user_id',Auth::id())->where('epic_id',NULL)
    ->where('VS_BU_ID',$request->unit_id)
    ->where('R_id',$request->RID)->get();          


    return view('objective.story-render',compact('story'));   

    }   
    
    
    public function DeleteNewStory(Request $request)
    {
        

    DB::table('epics_stroy')->where('id',$request->id)->delete();

    $story = DB::table('epics_stroy')->where('user_id',Auth::id())->where('epic_id',NULL)
    ->where('VS_BU_ID',$request->unit_id)
    ->where('R_id',$request->RID)->get();          


    return view('objective.story-render',compact('story'));   

    }
    
    public function SaveComment(Request $request)
    {
        

         $CommentId =  DB::table('epic_comment')->insertGetId([
            'comment' => $request->epic_comment,
            'r_id' => $request->RID,
            'user_id' => Auth::id(),  
            ]);
  
    $Comment = DB::table('epic_comment')->where('user_id',Auth::id())->where('epic_id',NULL)
    ->where('r_id',$request->RID)->get();
    return view('objective.epic-comment',compact('Comment'));            
    

    }
    
    public function UpdateEpicComment(Request $request)
    {
        

            DB::table('epic_comment')
           ->where('id',$request->id)
           ->update([
            'comment' => $request->title,
            'user_id' => Auth::id(),  
            ]);

        

    } 


    public function GetEpicComment(Request $request)
    {
        

    $Comment = DB::table('epic_comment')->where('user_id',Auth::id())->where('epic_id',$request->edit_epic_id)->get();
    return view('objective.edit-epic-comment',compact('Comment'));            
    

    }

    public function SaveEditComment(Request $request)
    {
        

         $CommentId =  DB::table('epic_comment')->insertGetId([
            'comment' => $request->epic_comment,
            'epic_id' => $request->epic,
            'user_id' => Auth::id(),  
            ]);
  
    $Comment = DB::table('epic_comment')->where('user_id',Auth::id())->where('epic_id',$request->epic)->get();
    return view('objective.edit-epic-comment',compact('Comment'));    

    }


    public function DeleteEpicComment(Request $request)
    {
        

    DB::table('epic_comment')->where('id',$request->id)->delete();
    DB::table('epic_comment_reply')->where('comment_id',$request->id)->delete();
    // $Comment = DB::table('epic_comment')->where('user_id',Auth::id())->where('epic_id',$request->epic)->get();
    // return view('objective.edit-epic-comment',compact('Comment'));    

    }


    public function EpicCommentReply(Request $request)
    {
        

            DB::table('epic_comment_reply')
           ->insert([
            'comment_id' => $request->id,
            'reply' => $request->title,
            'user_id' => Auth::id(),  
            ]);
 
    $EpicComment = DB::table('epic_comment')->where('user_id',Auth::id())->where('id',$request->id)->first();
    if($EpicComment->epic_id != NULL)
    {
    $Comment = DB::table('epic_comment')->where('user_id',Auth::id())->where('epic_id',$EpicComment->epic_id)->get();
    return view('objective.edit-epic-comment',compact('Comment'));
    }else
    {
    $Comment = DB::table('epic_comment')->where('user_id',Auth::id())->where('epic_id',NULL)
    ->where('r_id',$EpicComment->r_id)->get();
    return view('objective.epic-comment',compact('Comment'));   
    }      

    } 
    


}
