<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\PermissionRegistrar;

class CreateDistrictsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('district_name');       
            $table->string('no_province');
            $table->string('no_regency');
            $table->string('no_district')->unique();

            $table->foreign('no_province')->references('no_province')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('no_regency')->references('no_regency')->on('regencies')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        // Schema::dropIfExists('districts');
    }
}
