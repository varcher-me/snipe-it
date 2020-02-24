<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('companies', function (Blueprint $table) {
            //Add company's full name and banner image.
            $table->string('abbreviation', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->dropColumn('abbreviation');
        });
    }
}
