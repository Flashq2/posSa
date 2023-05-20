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
        Schema::create('Item_Stock', function (Blueprint $table) {
            $table->id();
            $table->string('Item_no');
            $table->string('Item_Uom');
            $table->decimal('Quantity_Instock');
            $table->decimal('Stock_Out');
            $table->decimal('Remain');
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
        Schema::dropIfExists('Item_Stock');
    }
};
