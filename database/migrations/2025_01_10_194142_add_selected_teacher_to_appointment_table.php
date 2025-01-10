<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointment', function (Blueprint $table) {
            // Add the teacher_id field to the appointments table
            $table->unsignedBigInteger('teacher_id')->nullable();
    
            // Set a foreign key constraint, ensuring teacher_id refers to the id of users table
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('appointment', function (Blueprint $table) {
        $table->dropForeign(['teacher_id']); // Drop the foreign key constraint
        $table->dropColumn('teacher_id'); // Drop the teacher_id column
    });
}
};
