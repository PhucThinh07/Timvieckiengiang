<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    /**
     * Run the migrations.
     */
    public function up()
    : void{
        Schema::create('candidate_addresses', function (Blueprint $table){
            $table->id();
            $table->foreignId('candidate_id')->constrained();
            $table->foreignId('province_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->foreignId('ward_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    : void{
        Schema::dropIfExists('candidate_addresses');
    }
};
