<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCookiePolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->json('cookiePolicy')->nullable()->after('helpCenter');
            $table->json('privacyPolicy')->nullable()->after('cookiePolicy');
            $table->json('companySeo')->nullable()->after('privacyPolicy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('cookiePolicy');
            $table->dropColumn('privacyPolicy');
            $table->dropColumn('companySeo');
        });
    }
}
