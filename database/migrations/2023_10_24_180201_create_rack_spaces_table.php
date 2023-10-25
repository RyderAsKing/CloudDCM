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
        Schema::create('rack_spaces', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('rack_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('unit_number');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('client_email')->nullable();
            $table->unique(['rack_id', 'unit_number']); // makes sure that the combination of rack_id and unit_number is unique
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
        Schema::dropIfExists('rack_spaces');
    }
};
