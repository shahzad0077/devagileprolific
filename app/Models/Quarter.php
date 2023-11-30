<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    
    protected $table = 'quarter';

    protected $fillable = ['user_id', 'quarter_name','initiative_id'];

}