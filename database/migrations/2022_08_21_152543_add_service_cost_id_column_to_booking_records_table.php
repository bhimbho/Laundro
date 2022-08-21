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
        Schema::table('booking_records', function (Blueprint $table) {
            $table->double('service_cost_id')->after('status')->constrained('service_costs')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_records', function (Blueprint $table) {
            $table->dropColumn('service_cost_id');
        });
    }
};
