<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('fellowships', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('fellowships', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
