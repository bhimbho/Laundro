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
        Schema::create('booking_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title'); // e.g. "Payment for service"
            $table->foreignUuid('transaction_id')->constrained();
            $table->foreignUuid('attire_type_id')->constrained();
            $table->foreignUuid('service_id')->constrained();
            $table->foreignUuid('quantity');
            $table->timestamps();
            $table->timestamp('expected_collection_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_records');
    }
};
