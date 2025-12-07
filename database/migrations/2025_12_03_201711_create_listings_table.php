<?php

use App\Models\Category;
use App\Models\User;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });

        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained();
            $table->string('title');
            $table->text('description');
            $table->integer('room_count');
            $table->integer('room_status'); // untuk monitor sisa kamar
            $table->integer('bathroom_count');
            $table->integer('guest_count');
            $table->string('location_value');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
        Schema::dropIfExists('categories');
    }
};
