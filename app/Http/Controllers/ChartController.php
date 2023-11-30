<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ChartController extends Controller
{
    
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function ChartData()
    {
        $data = DB::table('kpi_setting')->where('user_id', Auth::id())->orderby('id', 'DESC')->first();
        return view('Chart.chart', compact('data'));

    }
    public function fileImport(Request $request)
    {
        if ($request->collapseGroup == 'yes') {
            $green = $request->greenvalue;
            $red = NULL;
            $target_opt = $request->target_opt;
            $amber = NULL;
            $g_display = $request->g_display;

        } else {
            $green = $request->greenvalueopt;
            $red = $request->redvalueopt;
            $amber = $request->ambervalue;
            $target_opt = NULL;
            $g_display = $request->g_display_2;

        }
        
         
        
  
        DB::table('kpi_setting')->insert([

            't_value' => $request->t_value,
            'green' => $green,
            'red' => $red,
            'amber' => $amber,
            'target_option' => $request->collapseGroup,
            't_date' => $request->t_date,
            'trend_line' => $request->t_line,
            'chart_type' => $request->t_bar,
            'user_id' => Auth::id(),
             
            'target_opt' => $target_opt,
            't_display' => $request->t_display,
            'g_display' => $g_display,
            'chart_title' => $request->title,
            'chart_subtitle' => $request->subtitle,
            'stream_id' => $request->stream_id,
            'type' => $request->type
        ]);
        
        $data = DB::table('kpi_setting')->orderby('id', 'DESC')->first();
        Excel::import(new UsersImport($request->title, $request->subtitle, $data->id), $request->file('file'));
        
        if($request->hasFile('file')){
        
        $filename ="";

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $path= public_path();
        $file->move($path.'/' , $filename);
        }
        
        DB::table('kpi_setting')->where('id',$data->id)->update(['csv' =>  $filename,]);
        
        $chart = DB::table('chart_data')->where('kpi_setting_id',$data->id)->whereNotNull('target_value')->orderby('id','DESC')->first();
        
        if ($request->collapseGroup == 'yes')
        {
        if ($target_opt == 'Greater')
        {
        if ($chart->target_value > $green)
        {
        DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Green']);
        }else
        {
        DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Red']);
        }
        
        }
        if ($target_opt == 'Less')
        {
        if ($chart->target_value < $green)
        {
        DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Red']);
        }else
        {
        DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Green']);   
        }
        }
        }
       
        
        if ($request->collapseGroup == 'no')
        {
        if ($chart->target_value < $green)
        {
        DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Green']);
        }elseif($chart->target_value > $red)
        {
         DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Red']);
        }else
        {
        DB::table('kpi_setting')->where('id',$data->id)->update(['c_status' => 'Amber']);
        }
        
        }
        return back();
        
        
    }

    public function ChartCsv()
    {
        $data = DB::table('kpi_setting')->join('chart_data', 'chart_data.kpi_setting_id', '=', 'kpi_setting.id')
            ->where('kpi_setting.user_id', Auth::id())
            ->select('kpi_setting.*', 'chart_data.*')
            ->get();

        return $data;

    }

    public function EditChart(Request $request)
    {
        // $data = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $request->id)->get();
         $data = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $request->id)
                        ->whereNotNull('target_value') 
                        ->whereRaw('target_value REGEXP "^[0-9]+$"')
                        ->get();
        $id = $request->id;
        return view('Chart.edit-chart', compact('data', 'id'));

    }

    public function UpdateChart(Request $request)
    {
        foreach ($request['months'] as $key => $value) {
            DB::table('chart_data')
                ->where('id', $request->chartIds[$key])
                ->update([
                    'target_month' => $request['months'][$key],
                    'target_value' => $request['values'][$key],
                    'updated_at' => Carbon::now(),

                ]);
        }
        
        $chart = DB::table('chart_data')->where('kpi_setting_id',$request->kpi)->whereNotNull('target_value')->orderby('id','DESC')->first();
        $chart_data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('id',$request->kpi)->first();

        if ($chart_data->target_option == 'yes')
        {
        if ($chart_data->target_opt == 'Greater')
        {
        if ($chart->target_value > $chart_data->green)
        {
        DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Green']);
        }else
        {
        DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Red']);
        }
        
        }
        if ($chart_data->target_opt == 'Less')
        {
        if ($chart->target_value < $chart_data->green)
        {
        DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Red']);
        }else
        {
        DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Green']);
        }
        }
        }
       
        
        if ($chart_data->target_option == 'no')
        {
        if ($chart->target_value < $chart_data->green)
        {
        DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Green']);
        }elseif($chart->target_value > $chart_data->red)
        {
         DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Red']);
        }else
        {
        DB::table('kpi_setting')->where('id',$request->kpi)->update(['c_status' => 'Amber']);
        }
        
        }
       
       if($request->filter == 'N')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->id)->where('target_option','null')->get();
      return view('Chart.chart-rendor',compact('data'));

      }
      if($request->filter == 'Green')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->id)->where('c_status','Green')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      if($request->filter == 'Red')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->id)->where('c_status','Red')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      
      
      if($request->filter == 'Amber')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->id)->where('c_status','Amber')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
        
        $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->id)->get();
        return view('Chart.chart-rendor',compact('data'));
        
     
    }

    public function AddNewChart(Request $request)
    {

        $chart = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $request->id)->first();

        DB::table('chart_data')
            ->insert([
                'target_month' => $request->month,
                'target_value' => $request->value,
                'title' => $chart->title,
                'subtitle' => $chart->subtitle,
                'kpi_setting_id' => $request->id,
                'user_id' => Auth::id(),
                'updated_at' => Carbon::now(),

            ]);

        // $data = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $request->id)->get();
        $data = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $request->id)
                        ->whereNotNull('target_value') 
                        ->whereRaw('target_value REGEXP "^[0-9]+$"')
                        ->get();
        $id = $request->id;

        return view('Chart.edit-chart', compact('data', 'id'));

    }

    public function DeleteChart(Request $request)
    {
        $datachart = DB::table('kpi_setting')->where('user_id', Auth::id())->where('id', $request->chart)->delete();
        $chart = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $request->chart)->delete();
        
        $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->get();
        return view('Chart.chart-rendor',compact('data'));

    }

    public function EditBasicChart(Request $request)
    {
        $data = DB::table('kpi_setting')->where('user_id', Auth::id())->where('id', $request->id)->first();
        return $data;
    }

    public function UpdateBasicChart(Request $request)
    {
      
        if ($request->collapseGroup == 'yes') {
            $green = $request->greenvalue;
            // $red = $request->redvalue;
            $red = NULL;
            $amber = NULL;
            $target_opt = $request->target_status;
            $g_display = $request->g_display_edit;
        } else {
            $green = $request->greenvalueopt;
            $red = $request->redvalueopt;
            $amber = $request->ambervalue;
            $target_opt = NULL;
            $g_display = $request->g_display_edit_2; 
        }
        DB::table('kpi_setting')->where('id',$request->id)->update([

            't_value' => $request->target,
            'green' => $green,
            'red' => $red,
            'amber' => $amber,
            'target_option' => $request->collapseGroup,
            't_date' => $request->target_date,
            'trend_line' => $request->target_line,
            'chart_type' => $request->target_bar,
            'user_id' => Auth::id(),
            'target_opt' => $target_opt,
            't_display' => $request->t_display_edit,
            'g_display' => $request->g_display_edit,
            'chart_title' => $request->title,
            'chart_subtitle' => $request->subtitle,
        ]);
        
        $chart = DB::table('chart_data')->where('kpi_setting_id',$request->id)->whereNotNull('target_value')->orderby('id','DESC')->first();
        
        if ($request->collapseGroup == 'yes')
        {
        if ($target_opt == 'Greater')
        {
        if ($chart->target_value > $green)
        {
        DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Green']);
        }else
        {
        DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Red']);
        }
        
        }
        if ($target_opt == 'Less')
        {
        if ($chart->target_value < $green)
        {
        DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Red']);
        }else
        {
        DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Green']);
        }
        }
        }
       
        
        if ($request->collapseGroup == 'no')
        {
        if ($chart->target_value < $green)
        {
        DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Green']);
        }elseif($chart->target_value > $red)
        {
         DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Red']);
        }else
        {
        DB::table('kpi_setting')->where('id',$request->id)->update(['c_status' => 'Amber']);
        }
        
        }
        
      if($request->filter == 'N')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('target_option','null')->get();
      return view('Chart.chart-rendor',compact('data'));

      }
      if($request->filter == 'Green')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('c_status','Green')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      if($request->filter == 'Red')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('c_status','Red')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      
      
      if($request->filter == 'Amber')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('c_status','Amber')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
        
        $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->get();
        return view('Chart.chart-rendor',compact('data'));
       
    }

    public function Deletegraphval(Request $request)
    {
        $kpi = DB::table('chart_data')->where('user_id', Auth::id())->where('id', $request->id)->first();

        DB::table('chart_data')->where('user_id', Auth::id())->where('id', $request->id)->delete();

        // $data = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $kpi->kpi_setting_id)->get();
        $data = DB::table('chart_data')->where('user_id', Auth::id())->where('kpi_setting_id', $kpi->kpi_setting_id)
                        ->whereNotNull('target_value') 
                        ->whereRaw('target_value REGEXP "^[0-9]+$"')
                        ->get();

        $id =  $kpi->kpi_setting_id;

        return view('Chart.edit-chart', compact('data', 'id'));

    }
    
 
    
     public function getDownload($file_name)
     {

    $pathToFile = public_path()."/".$file_name;
    $name = $file_name;
    $headers = array('Content-Type: application/csv',);
    return response()->download($pathToFile, $name,$headers);

    }

     public function ChartFilter(Request $request)
    {
      if($request->val == 'N')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('target_option','null')->get();
      return view('Chart.chart-rendor',compact('data'));

      }
      if($request->val == 'Green')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('c_status','Green')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      if($request->val == 'Red')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('c_status','Red')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      
      if($request->val == 'all')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      
      if($request->val == 'Amber')
      {    
      $data = DB::table('kpi_setting')->where('user_id',Auth::id())->where('stream_id',$request->stream_id)->where('c_status','Amber')->get();
      return view('Chart.chart-rendor',compact('data'));
      }
      

    }

}
