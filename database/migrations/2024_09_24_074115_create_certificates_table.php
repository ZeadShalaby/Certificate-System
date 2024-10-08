<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('courses');
            $table->string('groups');
            $table->string('name');
            $table->string('gmail')->unique();
            $table->unsignedBigInteger('acdemic_number')->unique();
            $table->string('title');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->timestamp('send_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
