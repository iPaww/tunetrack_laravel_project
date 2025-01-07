<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->unsignedBigInteger('appointment_id')->nullable();  // Add the appointment_id column
        $table->foreign('appointment_id')->references('id')->on('appointments'); // Add the foreign key constraint
    });

    Schema::table('orders_item', function (Blueprint $table) {

        $table->foreign('order_id')->references('id')->on('orders'); // Add the foreign key constraint
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['appointment_id']);
        $table->dropColumn('appointment_id');
    });

    Schema::table('orders_item', function (Blueprint $table) {
        $table->dropForeign(['order_id']);
        $table->dropColumn('order_id');
    });
}
};
