<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Register_Open',function(Blueprint $table){
            $table->id();
            $table->dateTime('open');
            $table->dateTime('close');
            $table->decimal('cash_inhand');
            $table->decimal('total_sales_without_cash_inhand');
            $table->decimal('total_sales_wit_cash_inhand');
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Register_Open');
    }
};
