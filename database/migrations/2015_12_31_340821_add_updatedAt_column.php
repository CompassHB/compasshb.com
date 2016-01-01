<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedAtColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->timestamp('updatedAt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('updatedAt');
        });
    }
}
