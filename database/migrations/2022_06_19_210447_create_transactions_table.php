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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->string('title'); // e.g. "Payment for service"
            $table->foreignUuid('customer_id')->nullable()->constrained();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('tag_no');
            $table->string('payment_type')->default('cash'); // cash, debit_card, trasnfer, etc.
            $table->foreignUuid('authorised_by')->constrained('administrators')->onDelete('cascade');
            $table->foreignUuid('delivery_method_id')->constrained('delivery_methods'); // delivery, pickup, etc.
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
