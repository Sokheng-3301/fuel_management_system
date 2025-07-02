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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile_img')->nullable();
            $table->string('id_card')->unique()->nullable();
            $table->string('fullname_kh')->nullable();
            $table->string('fullname_en')->nullable();
            $table->string('username')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->char('gender')->nullable();
            $table->bigInteger('position_id')->nullable();
            $table->string('role')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->integer('account_status')->default(1)->comment('1 for active and 0 for inactive');
            $table->string('blocked_by')->nullable();
            $table->timestamp('blocked_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
