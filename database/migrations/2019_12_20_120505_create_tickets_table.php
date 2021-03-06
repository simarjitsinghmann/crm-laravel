<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string('vendor');
            $table->string('plan');
            $table->string('amount');
            $table->string('solution')->nullable();
            $table->string('feedback')->nullable();
            $table->string('rating')->nullable();
            $table->string('status');
            $table->string('customer_id');
            $table->string('sales_id');
            $table->string('tech_id');
            $table->string('csupport_id')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
