<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('in');
            $table->string('startTime');
            $table->integer('atOffice');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->integer('isHalfDay');
            $table->integer('isLate');
            $table->integer('out');
            $table->string('endTime');
            $table->integer('workingHours');
            $table->integer('isOvertime');
            $table->integer('account_id');
            $table->integer('department_id');
            $table->integer('team_id');
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
        Schema::dropIfExists('attendances');
    }
}
