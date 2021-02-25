<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('est_monitors', function (Blueprint $table) {
            $table->date('date');
            $table->char('estID', 3);
            $table->string('estName');
            $table->integer('currentIn')->default('0');
            $table->integer('totalIn')->default('0');
            
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
        Schema::dropIfExists('est_monitors');
    }
}
