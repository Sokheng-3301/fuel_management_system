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
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('fuel_type_kh')->nullable()->unique();
            $table->string('fuel_type_en')->nullable()->unique();
            $table->float('today_price')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('updated_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted');
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_date')->nullable();
            $table->integer('visibility')->default(1)->comment('1 for active and 0 for hidden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_types');
    }
};
