<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
            if (Schema::hasColumn('customers', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
            // check if user_id column exists
            if (!Schema::hasColumn('customers', 'user_id')) {
                $table->foreignId('user_id');
            }
        });
    }
};