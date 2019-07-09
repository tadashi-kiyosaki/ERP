<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblBillType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_bill_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('bill_logo');
            $table->text('bill_title');
            $table->text('bill_description');
            $table->text('created_by');
            $table->integer('ismanual');
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
        Schema::dropIfExists('tbl_bill_type');
    }
}
