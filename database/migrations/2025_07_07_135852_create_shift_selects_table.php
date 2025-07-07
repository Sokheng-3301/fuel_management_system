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
        Schema::create('shift_selects', function (Blueprint $table) {
            $table->id();
            $table->string('shift_kh')->unique()->nullable();
            $table->string('shift_en')->unique()->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('delete_status')->default(1)->comment('1:active, 0:deleted'); // 1 = active,
            $table->string('delete_by')->nullable();
            $table->timestamp('deleted_at')->nullable()->comment('Soft delete timestamp');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_selects');
    }
};
