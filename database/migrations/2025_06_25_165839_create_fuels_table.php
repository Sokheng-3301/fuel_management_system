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
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fuel_type_id')->nullable();
            $table->bigInteger('supplier_id')->nullable();
            $table->text('fuel_specification')->nullable();
            $table->float('qty')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('total_price')->nullable();
            $table->string('fuel_code')->nullable();
            $table->text('note')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('updated_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted');
            $table->string('deleted_by')->nullable();
            $table->timestamp('deleted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuels');
    }
};
