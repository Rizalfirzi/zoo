<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\PermissionRegistrar;

class CreateVillagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('village_name');       
            $table->string('no_province');
            $table->string('no_regency');
            $table->string('no_district');
            $table->string('no_village')->unique();

            $table->foreign('no_province')->references('no_province')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('no_regency')->references('no_regency')->on('regencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('no_district')->references('no_district')->on('districts')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        // Schema::dropIfExists('villages');
    }
}
