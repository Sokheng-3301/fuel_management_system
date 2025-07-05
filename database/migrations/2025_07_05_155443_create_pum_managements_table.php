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
        Schema::create('pump_managements', function (Blueprint $table) {
            $table->id();
            $table->string('pump_code')->unique()->nullable();
            $table->unsignedBigInteger('fuel_type_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('delete_status')->default(1)->comment('1:active, 0:deleted'); // 1 = active,
            $table->string('delete_by')->nullable();
            $table->timestamp('deleted_at')->nullable()->comment('Soft delete timestamp');
            $table->integer('status')->default(1)->comment('1 for active, 0 for inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pump_managements');
    }
};
