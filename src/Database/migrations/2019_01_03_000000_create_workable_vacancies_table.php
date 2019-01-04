<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkableVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workable_vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vacancy_id');
            $table->string('title');
            $table->string('full_title');
            $table->string('shortcode');
            $table->string('code');
            $table->string('state');
            $table->string('department')->nullable();
            $table->string('url');
            $table->string('application_url');
            $table->string('shortlink');
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('workable_created_at');
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('employment_type')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
}
