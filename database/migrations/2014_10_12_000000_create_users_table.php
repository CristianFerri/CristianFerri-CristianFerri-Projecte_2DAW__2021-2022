<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->integer('phone')->unique()->nullable();
            $table->text('about')->nullable();
            $table->string('image')->default('images/user.png');
            $table->boolean('admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['username' => 'admin', 'name' => 'admin', 'surname' => 'adminSurname', 'email' => 'admin@admin.com', 'phone' => '999999999', 'about' => 'IM THE ADMIN', 'password' => '$2y$10$UT4c074xM1fGZiXXMKwgWOL/tAM7hJfGqQl8Pdp/tQixQCtMfBEaS', 'admin' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
