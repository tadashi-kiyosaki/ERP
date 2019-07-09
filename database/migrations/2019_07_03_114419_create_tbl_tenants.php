<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTenants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('sur_name');
            $table->string('id_number');
            $table->string('pin_number');
            $table->string('vat_number');
            $table->string('primary_phone_number');
            $table->string('alternate_phone_number')->nullable();
            $table->string('primary_phone_code');
            $table->string('alternate_phone_code')->nullable();
            $table->string('primary_country_code');
            $table->string('alternate_country_code')->nullable();
            $table->string('po_box');
            $table->string('postal_code');
            $table->string('country');
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('document')->nullable();
            $table->string('email');
            $table->string('bill_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tenants');
    }
}
