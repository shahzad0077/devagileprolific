<?php

namespace App\Helpers;
use DB;
use Auth;

class Jira
{
	static $url=null;
	static $user = null;
	static $pass =  null;
	
	
	
	function __construct($url,$user, $pass) 
	{
		self::$url= $url;
		self::$user= $user;
		self::$pass= $pass;
	}
  
	public function GetJiraResource($resource,$data=null,$startat=null)
	{
		
		if($startat != null)
			$resource = $resource.'&startAt='.$startat;
		//echo $resource."<br>";
		
		$curl = curl_init();
		//curl_reset($curl);
		curl_setopt_array($curl, array(
		CURLOPT_USERPWD => self::$user.':'.self::$pass,
		CURLOPT_URL =>$resource,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HTTPHEADER => array('Content-type: application/json')));
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		if($data != null)
		{
			curl_setopt_array($curl, array(
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $data
				));
		}
		$result = curl_exec($curl);
		$ch_error = curl_error($curl);
		$code = curl_getinfo ($curl, CURLINFO_HTTP_CODE);
        
		
		
		if ($ch_error)
		{
			echo $ch_error;
			return [];
			
		}
		else if($code == 200)
		{
			
			$data = json_decode($result,true);
            
			$tasks = array();
			
			if(isset($data["issues"]))
			{
				$this->more = 0;
				if($data["maxResults"] == count($data["issues"]))
					$this->more = 1;
				if(count($data["issues"])==0)
				{
					return $tasks;
				}

				foreach($data["issues"] as $task)
				{
					//echo $task['key']."\n";
					$tasks[$task['key']] = $task;
				}
	
				return $tasks;
			}
			
			return [];
		}
		else
		{
			return [];
		}
	}
	public function Search($query,$fields=null,$maxresults=1000)
	{
		
		$tasks=[];
		$query = str_replace(" ","%20",$query);

		$resource=self::$url.'/rest/api/latest/'."search?jql=".$query.'&maxResults='.$maxresults;
		

		if($fields != null)
			$resource.='&fields='.$fields;
		
		//dump($resource);
		$startat=0;
		$utasks = [];
		$this->more=0;
		while(1)
		{
			$dt =  $this->GetJiraResource($resource,null,$startat);
			
			$utasks = array_merge($utasks, $dt);
			if($this->more == 1)
			{
				$startat = count($utasks);
				continue;
			}
			break;
		}


		return $utasks;
	}
	
	  public function UpdateBujira()
    {

     
        $jiraBaclog = DB::table('backlog_unit')->where('user_id',Auth::id())->where('jira_id','!=','')->get();
        if(count($jiraBaclog) > 0)
        {
        foreach ($jiraBaclog as $backlog)
        {
            
        $data = DB::table('jira_setting')->where('id',$backlog->account_id)->first();
        if($data)
        {
        $jira_url = $data->jira_url ; 
        $jira_user_name = $data->user_name; 
        $jira_token = $data->token;
        
        $jira = new Jira($jira_url,$jira_user_name,$jira_token);
        $items=$jira->Search('project="'.$backlog->jira_project.'" and issuetype=Epic','key,summary,description');
        
        foreach ($items as $item)
        {
         
                DB::table('backlog_unit')
                ->where('user_id',Auth::id())
                ->where('jira_id',$item['key'])
                ->update([
                    'epic_title' =>  $item['fields']['summary'],
                    'epic_detail' => $item['fields']['description'],

            
                    ]);   
        
        
        }
        }
        
        }
        }
       

    
    }
    
     public function UpdateBVsjira()
    {

     
        $jiraBaclog = DB::table('backlog')->where('user_id',Auth::id())->where('jira_id','!=','')->get();
        if(count($jiraBaclog) > 0)
        {
        foreach ($jiraBaclog as $backlog)
        {
            
        $data = DB::table('jira_setting')->where('id',$backlog->account_id)->first();
        if($data)
        {
        $jira_url = $data->jira_url ; 
        $jira_user_name = $data->user_name; 
        $jira_token = $data->token;
        
        $jira = new Jira($jira_url,$jira_user_name,$jira_token);
        $items=$jira->Search('project="'.$backlog->jira_project.'" and issuetype=Epic','key,summary,description');
        
        foreach ($items as $item)
        {
         
                DB::table('backlog')
                ->where('user_id',Auth::id())
                ->where('jira_id',$item['key'])
                ->update([
                    'epic_title' =>  $item['fields']['summary'],
                    'epic_detail' => $item['fields']['description'],

            
                    ]);   
        
        
        }
        }
        
        }
        }

    
    }
    
      public static function UpdateEpicjira()
    {

     
        $jiraBaclog = DB::table('epics')->where('user_id',Auth::id())->where('jira_id','!=','')->get();
        
        if(count($jiraBaclog) > 0)
        {
        foreach ($jiraBaclog as $backlog)
        {
            
        $data = DB::table('jira_setting')->where('id',$backlog->account_id)->first();
        if($data)
        {
        $jira_url = $data->jira_url; 
        $jira_user_name = $data->user_name; 
        $jira_token = $data->token;
        
        $jira = new Jira($jira_url,$jira_user_name,$jira_token);
        $items=$jira->Search('project="'.$backlog->jira_project.'" and issuetype=Epic','key,summary,description');
        
        foreach ($items as $item)
        {
         
                DB::table('epics')
                ->where('user_id',Auth::id())
                ->where('jira_id',$item['key'])
                ->update([
                    'epic_name' =>  $item['fields']['summary'],
                    'epic_detail' => $item['fields']['description'],

            
                    ]);   
        
        
        }
        }
        
        }
        
    }
       

    
    }
}
