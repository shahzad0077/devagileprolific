<?php

namespace App\Helpers;
use Carbon\Carbon;
use Auth;
use DB;
class Quarters
{
	function GetQuarter($start_date,$end_date)
 {
    $startDate = Carbon::parse($start_date);
    $endDate = Carbon::parse($end_date);
    
    $quarters = [];
    
    while ($startDate->lte($endDate)) {
   
        $year = $startDate->year;
        $quarter = ceil($startDate->month / 3);
    
        if (!isset($quarters[$year])) {
            $quarters[$year] = [];
        }
        $quarters[$year][$quarter][] = $startDate->format('F');
        $startDate->addMonth();
    }
    
    return $quarters;
   }
   
   function GetQuarterYear($start_date,$end_date,$data)
 {
    $startDate = Carbon::parse($start_date);
    $endDate = Carbon::parse($end_date);
    // $totalMonths = $startDate->diffInMonths($endDate);
    
     $currentDate = $startDate->copy();
    
    $monthCount = 0;
    
    while ($currentDate->lte($endDate)) {
        $monthCount++;
    
        $currentDate->addMonth();
    }
    
    
     $quarters = [];
     $currentDate = $startDate;

    $year = $currentDate->year;

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
        $counter++;
        $quarterId = DB::table('quarter')->insertGetId([
            'quarter_name' => 'Q' .$quarterNum,
            'year' => $year,
            'initiative_id' => $data,
            'user_id' => Auth::id(),
            'loop_index' => $counter,
        ]);
        
         foreach ($months as $monthName) {
         
            DB::table('quarter_month')->insert([
                'quarter_id' => $quarterId,
                'month' => $monthName,
                'user_id' => Auth::id(),
                'initiative_id' => $data,
                 'quarter_name' => 'Q' .$quarterNum,
                 'year' => $year,
            ]);
        }
        
    }
} 
   }
   
   
   function jiraUpdate($jira,$title,$startdate,$enddate,$detail)
   {
    $issueKeyOrId = $jira;
    $apiEndpoint = "https://orgstructure.atlassian.net/rest/api/3/issue/{$issueKeyOrId}";

    $auth = base64_encode("hadilton@gmail.com:ATATT3xFfGF0TD7Sw8fRSjk4ORfoMCdXDQSvqIKjT_vop02tdWvYFrelapFcKB7rod1veRrGSWETHJ4pQmimhKLmqKd34OPsI_3LR7wONDFQGocuhdeOO9Rk_dSablQaxMZH2dQgAoNfpMUN_3IXHrYRRGUCbZ8SMYY-Zs7L-7BYOdsdxH2hxAo=DCAF0CBF"); // Replace with your username and API token

        $updateData = [
            "fields" => [
                "summary" => $title,
                'customfield_10015' => $startdate,
                'duedate' => $enddate,
                'description' => $detail,
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
