<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileAndAddressAndGenderAndImageAndStatusToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->after('password')->nullable();
            $table->string('address')->after('mobile')->nullable();
            $table->string('gender')->after('address')->nullable();
            $table->string('image')->after('gender')->nullable();
            $table->tinyInteger('status')->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile',  'address', 'gender', 'image', 'status']);
        });
    }
}
