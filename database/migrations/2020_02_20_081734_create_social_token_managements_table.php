<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSocialTokenManagementsTable.
 */
class CreateSocialTokenManagementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('social_token_managements', function(Blueprint $table) {
            $table->increments('id');
            $table->enum('provider',['twitter','facebook','google','github']);
            $table->longText('token');
            $table->longText('object');
            $table->dateTime('token_valid_until');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_active')->default(0);



            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('social_token_managements');
	}
}
