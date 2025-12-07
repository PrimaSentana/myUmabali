<?php

use App\Models\Facility;
use App\Models\Listings;
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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::create('facility_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Facility::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Listings::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('facility_listings');
    }
};
