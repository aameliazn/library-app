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
        Schema::create('relation_book_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bookId')->constrained('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('categoryId')->constrained('book_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation_book_categories');
    }
};
