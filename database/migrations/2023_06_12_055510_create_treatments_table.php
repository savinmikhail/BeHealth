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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
//            $table->foreignId('unit_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
//            $table->foreignId('unit_code')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('unit_code')->constrained('units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kit_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->decimal('dose');
//            $table->string('comment');
            $table->enum('comment', ['before', 'while', 'after'])->unique();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
