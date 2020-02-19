<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateCalendersTable.
 */
class CreateCalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // conference room crud
        // calender type
        Schema::create('calenders', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->dateTime('from');
            $table->dateTime('to');
            $table->unsignedBigInteger('conference_room_id')->default(1);
            $table->longText('description');

            $table->unsignedBigInteger('type_id')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');

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
        Schema::drop('calenders');
    }
}
