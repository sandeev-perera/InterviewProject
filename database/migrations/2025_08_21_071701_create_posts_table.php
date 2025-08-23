<?php

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
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->from(5000);
            $table->string("title");
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string("image_path");
            $table->enum("category", ["Educational", "Authentic", "General"]);
            $table->integer("painted_year");
            $table->string("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
