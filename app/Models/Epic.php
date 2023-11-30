<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epic extends Model
{
    
    protected $table = 'epics';

    protected $fillable = ['user_id', 'month_id'];

}