<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
    {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
        Schema::create('users', function (Blueprint $table)
            {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('vrb_number')->nullable();
            $table->string('isk_number')->nullable();
            $table->string('profile_pic')->nullable();
            $table->enum('is_active',['1','0'])->default('1');                        
            $table->rememberToken();
            $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
        {
     
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
        }
    };