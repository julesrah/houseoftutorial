<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

       
        Schema::create('admins', function (Blueprint $table) {

            $table->increments('id');
            $table->text('name',150);
            $table->text('job');
            $table->text('addrress');
            $table->text('phonenumber');
            $table->string('img_path');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");
            $table->timestamps();
            $table->softDeletes();
            });

    
      Schema::create('Instructors', function (Blueprint $table) {
                $table->increments('id');
                $table->text('petName',150);
                $table->text('Age');
                $table->text('Type');
                $table->text('Breed');
                $table->text('Sex');
                $table->text('Color');
                $table->string('img_path');
                $table->integer('customer_id')->unsigned();
                $table->foreign('customer_id')->references('id')->on('customers')->onDelete("cascade");
                $table->timestamps();
                $table->softDeletes();
                });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
