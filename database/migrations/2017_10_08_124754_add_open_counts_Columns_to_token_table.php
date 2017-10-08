<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenCountsColumnsToTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tokens', function(Blueprint $table) {
            $table->unsignedInteger('open_count')->default(0);
            $table->unsignedInteger('open_unique_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tokens', function(Blueprint $table) {
            $table->dropColumn('open_count');
            $table->dropColumn('open_unique_count');
        });
    }
}
