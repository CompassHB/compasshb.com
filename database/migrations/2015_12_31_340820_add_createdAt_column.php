<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedAtColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->timestamp('createdAt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('createdAt');
        });
    }
}
