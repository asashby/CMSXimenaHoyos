<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentColumnsUserCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_courses', function (Blueprint $table) {
            $table->boolean('paid')->default(0)->after('flag_registered');
            $table->integer('external_order_id')->nullable()->after('paid');
            $table->string('link')->nullable()->after('external_order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_courses', function (Blueprint $table) {
            $table->dropColumn('paid');
            $table->dropColumn('external_order_id');
            $table->dropColumn('link');
        });
    }
}
