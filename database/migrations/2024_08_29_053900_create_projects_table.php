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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name', 150);
            $table->text('user_ids')->nullable(); // Consider using a pivot table for many-to-many relationships
            $table->text('description')->nullable();
            $table->string('start_date', 100)->nullable();
            $table->string('end_date', 100)->nullable();
            $table->enum('status', ['pending', 'complete'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
