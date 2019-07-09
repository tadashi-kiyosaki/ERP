<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = 'tbl_properties';
    protected $fillable = ['landlord_id', 'type', 'size', 'mgt', 'unit_rent', 'service_charges', 'occupation_status'];
}
