<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_membership', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->unsigned();
          $table->bigInteger('membership_id')->unsigned();
          $table->string('card_number');
          $table->date('card_expirated');
          $table->string('card_ccv');

          $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

          $table->foreign('membership_id')->references('id')
                ->on('memberships')->onDelete('cascade');

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
        Schema::dropIfExists('user_membership');
    }
}
