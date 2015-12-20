<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('blogs', function ($table) {
            $table->softDeletes();
        });

        Schema::table('passages', function ($table) {
            $table->softDeletes();
        });

        Schema::table('series', function ($table) {
            $table->softDeletes();
        });

        Schema::table('sermons', function ($table) {
            $table->softDeletes();
        });

        Schema::table('songs', function ($table) {
            $table->softDeletes();
        });

        Schema::table('teams', function ($table) {
            $table->softDeletes();
        });

        Schema::table('users', function ($table) {
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blogs', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('passages', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('series', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('sermons', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('songs', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('teams', function ($table) {
            $table->dropSoftDeletes();
        });

        Schema::table('users', function ($table) {
            $table->dropSoftDeletes();
        });
    }
}
