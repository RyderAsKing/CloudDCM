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
        Schema::table('vps', function (Blueprint $table) {
            //
            $table->string('cpu')->nullable();
            $table->string('memory')->nullable();
            $table->string('storage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vps', function (Blueprint $table) {
            //
            $table->dropColumn('cpu');
            $table->dropColumn('memory');
            $table->dropColumn('storage');
        });
    }
};
