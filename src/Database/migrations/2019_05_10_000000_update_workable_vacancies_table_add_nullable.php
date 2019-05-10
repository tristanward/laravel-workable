<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWorkableVacanciesTableAddNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workable_vacancies', function (Blueprint $table) {
            $table->string('vacancy_id')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->string('full_title')->nullable()->change();
            $table->string('shortcode')->nullable()->change();
            $table->string('code')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->string('url')->nullable()->change();
            $table->string('application_url')->nullable()->change();
            $table->string('shortlink')->nullable()->change();
            $table->string('workable_created_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workable_vacancies', function (Blueprint $table) {
            $table->string('vacancy_id')->nullable(false)->change();
            $table->string('title')->nullable(false)->change();
            $table->string('full_title')->nullable(false)->change();
            $table->string('shortcode')->nullable(false)->change();
            $table->string('code')->nullable(false)->change();
            $table->string('state')->nullable(false)->change();
            $table->string('url')->nullable(false)->change();
            $table->string('application_url')->nullable(false)->change();
            $table->string('shortlink')->nullable(false)->change();
            $table->string('workable_created_at')->nullable(false)->change();
        });
    }
}
