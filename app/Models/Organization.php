<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    
    protected $table = 'organization';

    protected $fillable = ['user_id', 'organization_name', 'email', 'phone_no','logo','detail','code'];

}
