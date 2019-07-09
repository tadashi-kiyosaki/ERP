<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyStatus extends Model
{
    //
    protected $table = 'tbl_properties_status';
    protected $fillable = ['id', 'property_id', 'tenant_id', 'start_date', 'end_date', 'deposit'];
}
