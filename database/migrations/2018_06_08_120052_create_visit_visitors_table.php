<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->string('group');
            $table->string('purpose');
            $table->string('other');
            $table->integer('company_id')->unsigned()->index();
            $table->string('plan');
            $table->string('status');
            $table->time('time');
            $table->time('endtime');
            $table->string('comments');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('visit_visitors', function (Blueprint $table) {
            $table->integer('visit_id')->unsigned()->index();
            $table->integer('visitor_id')->unsigned()->index();
            $table->string('commingfrom')->index();
            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
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
        Schema::dropIfExists('visit_visitors');
        Schema::dropIfExists('visits');
    }
}
