<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UserFormsTable extends Migration
{
    public function up()
    {
        Schema::create('userforms', function (Blueprint $table) {
            //$table->unsignedBigInteger('userID');
            $table->char('estID', 3);
            $table->string('first_name');
            $table->string('last_name');
            $table->char('gender', 1);
            $table->string('email'); 
            $table->string('address');    
            $table->float('bodyTemp', 3, 1);
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
        Schema::dropIfExists('userforms');
    }
}
