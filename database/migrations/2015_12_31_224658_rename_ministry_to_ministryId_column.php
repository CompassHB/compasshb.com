<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMinistryToMinistryIdColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->renameColumn('ministry', 'ministryId');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->renameColumn('ministry', 'ministryId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->renameColumn('ministryId', 'ministry');
        });

        Schema::table('series', function (Blueprint $table) {
            $table->renameColumn('ministryId', 'ministry');
        });

    }
}
