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
        Schema::create('bible_chapters', function (Blueprint $table) {
            $table->id();
            $table->string('book_id')->constrained('bible_books')->onDelete('cascade');
            $table->string('chapter_number');
            $table->string('verse_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bible_chapters');
    }
};
