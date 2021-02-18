<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('type_id');
            $table->integer('status_id');
            $table->timestamp('date')->nullable();
            $table->time('time')->nullable();
            $table->string('information')->nullable();
            $table->string('engineer')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('postcode')->nullable();
            $table->bigInteger('invoice_number')->nullable();
            $table->float('first_hour_cost')->nullable();
            $table->float('material_cost')->nullable();
            $table->float('labour_cost')->nullable();
            $table->float('paypal_fee')->nullable();
            $table->float('booking_fee')->nullable();
            $table->float('vat')->nullable();
            $table->float('total')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
