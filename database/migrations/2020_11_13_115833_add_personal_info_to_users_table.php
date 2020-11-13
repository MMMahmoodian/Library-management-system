<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonalInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name');
            $table->string("last_name");
            $table->string("national_code");
            $table->enum('sex', ['female', 'male', 'others'])->nullable();
            $table->date("birth_date")->nullable();
//            $table->string('nationality');
            $table->string('phone');
            $table->string('mobile');
            $table->text('address');
            $table->string('postal_code');
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
            //
        });
    }
}
