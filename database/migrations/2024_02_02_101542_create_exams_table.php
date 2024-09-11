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
        Schema::create('Exams', function (Blueprint $table) {
            $table->id();
            $table->string('exam_name');
            $table->bigInteger('subject_id');
            $table->string('date');
            $table->string('time');
            $table->string('created_at')->useCurrent();
            $table->string('updated_at')->useCurrent()->useCurrentOnUpdate();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Exams');
    }
};
