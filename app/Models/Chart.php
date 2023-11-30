<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Chart extends Model

{

    use HasFactory;



    protected $table = 'chart_data';



    protected $fillable = [

        'target_value',
        'target_month',
        'title',
        'subtitle',
        'user_id',
        'kpi_setting_id',
        'updated_at',
        'created_at',



    ];



}
