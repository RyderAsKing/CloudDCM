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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('company_name');
            $table->string('phone');
            $table->string('email');
            $table->string('contact_name');
            $table->string('address');
            $table->string('city');
            $table->string('sales_person');
            $table->integer('num_desktops');
            $table->integer('num_notebooks');
            $table->integer('num_printers');
            $table->integer('num_servers');
            $table->integer('num_firewalls');
            $table->integer('num_wifi_access_points');
            $table->integer('num_switches');
            $table->integer('quote_provided');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
