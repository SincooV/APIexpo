<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('studentclass', function (Blueprint $table) {
            $table->id();
            $table->char('class_name');
            $table->integer('class_year');
            $table->integer('year');
            $table->string('class')->unique();
            $table->timestamp('created_at')-> nullable();
            $table->timestamp('updated_at')->nullable();    
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('studentclass');
    }
};
