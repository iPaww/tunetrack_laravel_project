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
    Schema::table('category', function (Blueprint $table) {
        $table->string('image')->nullable(); // Add the image field as nullable
    });
}

public function down()
{
    Schema::table('category', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
