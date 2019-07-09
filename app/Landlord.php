<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    //
    protected $table = 'tbl_landlords';

    protected $fillable = ['title', 'first_name', 'middle_name', 'sur_name', 'id_number', 'pin_number', 'vat_number',
        'primary_phone_number', 'alternate_phone_number', 'primary_phone_code', 'alternate_phone_code', 'primary_country_code', 'alternate_country_code', 'po_box', 'postal_code', 'country', 'state', 'city', 'document', 'email'];

}
