<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSlugToAliasColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('slug', 'alias');
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->renameColumn('slug', 'alias');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->renameColumn('slug', 'alias');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->renameColumn('slug', 'alias');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->renameColumn('slug', 'alias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->renameColumn('alias', 'slug');
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->renameColumn('alias', 'slug');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->renameColumn('alias', 'slug');
        });

        Schema::table('passages', function (Blueprint $table) {
            $table->renameColumn('alias', 'slug');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->renameColumn('alias', 'slug');
        });
    }
}
