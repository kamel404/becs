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

        $table->foreignId('project_category_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('title');
        $table->string('slug')->unique();

        $table->text('short_description')
            ->nullable();

        $table->longText('description')
            ->nullable();

        $table->string('location')
            ->nullable();

        $table->string('client')
            ->nullable();

        $table->date('completion_date')
            ->nullable();

        $table->string('featured_image')
            ->nullable();

        $table->enum('status', [
            'ongoing',
            'completed'
        ])->default('ongoing');

        $table->boolean('is_featured')
            ->default(false);

        $table->timestamps();
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
