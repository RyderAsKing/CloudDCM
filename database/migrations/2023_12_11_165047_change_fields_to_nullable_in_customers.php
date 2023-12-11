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
            $table
                ->string('company_name')
                ->nullable()
                ->change();
            $table
                ->string('phone')
                ->nullable()
                ->change();
            $table
                ->string('email')
                ->nullable()
                ->change();
            $table
                ->string('contact_name')
                ->nullable()
                ->change();
            $table
                ->string('address')
                ->nullable()
                ->change();
            $table
                ->string('city')
                ->nullable()
                ->change();
            $table
                ->string('sales_person')
                ->nullable()
                ->change();
            $table
                ->integer('num_desktops')
                ->nullable()
                ->change();
            $table
                ->integer('num_notebooks')
                ->nullable()
                ->change();
            $table
                ->integer('num_printers')
                ->nullable()
                ->change();
            $table
                ->integer('num_servers')
                ->nullable()
                ->change();
            $table
                ->integer('num_firewalls')
                ->nullable()
                ->change();
            $table
                ->integer('num_wifi_access_points')
                ->nullable()
                ->change();
            $table
                ->integer('num_switches')
                ->nullable()
                ->change();
            $table
                ->string('quote_provided')
                ->nullable()
                ->change();
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

            $table
                ->string('company_name')
                ->nullable(false)
                ->change();
            $table
                ->string('phone')
                ->nullable(false)
                ->change();
            $table
                ->string('email')
                ->nullable(false)
                ->change();
            $table
                ->string('contact_name')
                ->nullable(false)
                ->change();
            $table
                ->string('address')
                ->nullable(false)
                ->change();
            $table
                ->string('city')
                ->nullable(false)
                ->change();
            $table
                ->string('sales_person')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_desktops')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_notebooks')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_printers')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_servers')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_firewalls')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_wifi_access_points')
                ->nullable(false)
                ->change();
            $table
                ->integer('num_switches')
                ->nullable(false)
                ->change();
            $table
                ->string('quote_provided')
                ->nullable(false)
                ->change();
        });
    }
};
