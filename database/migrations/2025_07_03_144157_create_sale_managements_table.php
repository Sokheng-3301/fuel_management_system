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
        Schema::create('sale_managements', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code')->unique()->nullable();
            $table->string('customer_id')->nullable();
            $table->string('fuel_type_id')->nullable();
            $table->string('vichle_number')->nullable();
            $table->string('quantity')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('total_price')->nullable();
            $table->date('sale_date')->nullable();
            $table->string('note')->nullable();
            $table->string('payment_method')->nullable()->comment('1:cash, 2:credit, 3:Mobile pay, 4:bank transfer');
            $table->string('employee_id')->nullable();
            $table->float('discount')->default(0)->comment('Discount amount');
            $table->string('tax')->default(0)->comment('Tax amount');

            $table->string('updated_by')->nullable();
            $table->string('delete_status')->default(1)->comment('1:active, 0:deleted'); // 1 = active,
            $table->string('delete_by')->nullable();
            $table->timestamp('deleted_at')->nullable()->comment('Soft delete timestamp');
            $table->integer('status')->default(1)->comment('1 for completed, 0 for pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_managements');
    }
};
