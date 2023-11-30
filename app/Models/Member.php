<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    
    protected $table = 'members';

    protected $fillable = ['user_id', 'name', 'email', 'phone','image','org_id','org_user','role','status'];

}