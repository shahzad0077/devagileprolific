<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationContacts extends Model
{
    
    protected $table = 'organization_contacts';

    protected $fillable = ['name','email','phone','image','org_id','role'];

}