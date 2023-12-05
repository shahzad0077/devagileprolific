<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\orders;
use App\Models\orderdetails;
use Twilio\Rest\Client;
use App\Models\orderstatus;
use App\Models\activities;
use App\Models\Member_order;
use Mail;
use Illuminate\Support\Facades\Http;

use OneSignal;
class Cmf
{ 
    public static function get_file_extension($file_name) {
        return substr(strrchr($file_name,'.'),1);
    }
    public static function save_activity($user_id , $activity,$type,$value_id)
    {
        $act = new activities();
        $act->user_id = $user_id;
        $act->activity = $activity;
        $act->is_read = 1;
        $act->type = $type;
        $act->value_id = $value_id;
        $act->save();
    }
    public static function create_time_ago($time)
    {
        $year = date('Y', strtotime($time));
        $month = date('m', strtotime($time));
        $day = date('d', strtotime($time));
        $datetime = Carbon::parse($time);
        return $datetime->diffForHumans();
    }
    public static function date_format($data)
    {
        return date('d M Y, h:s a ', strtotime($data));
    }
    public static function currenturl()
    {
       return $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    }
    public static function sendimagetodirectory($imagename)
    {
        $file = $imagename;
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        return $filename;
    }
    public static function shorten_url($text)
    {
        $words = explode('-', $text);
        $five_words = array_slice($words,0,12);
        $String_of_five_words = implode('-',$five_words)."\n";

        $String_of_five_words = preg_replace('~[^\pL\d]+~u', '-', $String_of_five_words);
        $String_of_five_words = iconv('utf-8', 'us-ascii//TRANSLIT', $String_of_five_words);
        $String_of_five_words = preg_replace('~[^-\w]+~', '', $String_of_five_words);
        $String_of_five_words = trim($String_of_five_words, '-');
        $String_of_five_words = preg_replace('~-+~', '-', $String_of_five_words);
        $String_of_five_words = strtolower($String_of_five_words);
        if (empty($String_of_five_words)) {
          return 'n-a';
        }
        return $String_of_five_words;
    }
}
