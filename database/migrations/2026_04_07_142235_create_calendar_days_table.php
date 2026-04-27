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
        Schema::create('calendar_days', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('calendar_day_date');
            $table->text('calendar_day_ai_summary_text');
            $table->foreignID('user_id')->constrained()->onDelete('cascade');
            $table->foreignID('mood_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_days');
    }
};
