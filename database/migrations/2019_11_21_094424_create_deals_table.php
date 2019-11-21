<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('company_type');
            $table->string('industry');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('amount_to_raise');
            $table->string('company_cover_photo');
            $table->string('company_details');
//booleans
            $table->boolean('business_plan');
            $table->boolean('memo_of_understanding');
            $table->boolean('cert_of_registration');
            $table->boolean('financial_state');
            $table->boolean('cash_flow');
            $table->boolean('contract_doc');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('deals');
    }
}
