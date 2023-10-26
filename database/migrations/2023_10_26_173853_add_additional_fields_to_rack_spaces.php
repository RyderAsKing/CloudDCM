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
        Schema::table('rack_spaces', function (Blueprint $table) {
            // add switch_port, ipmi_port, subnet (all should be string and nullable)
            $table->string('switch_port')->nullable();
            $table->string('ipmi_port')->nullable();
            $table->string('subnet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rack_spaces', function (Blueprint $table) {
            //
            $table->dropColumn('switch_port');
            $table->dropColumn('ipmi_port');
            $table->dropColumn('subnet');
        });
    }
};
