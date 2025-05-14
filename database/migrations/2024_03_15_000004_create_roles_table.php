<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['name' => 'Teacher', 'slug' => 'teacher', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Student', 'slug' => 'student', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}; 