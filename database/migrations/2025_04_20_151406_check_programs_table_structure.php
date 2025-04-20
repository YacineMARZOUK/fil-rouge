<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CheckProgramsTableStructure extends Migration
{
    public function up()
    {
        if (Schema::hasTable('programs')) {
            $columns = Schema::getColumnListing('programs');
            print_r($columns);
        } else {
            echo "Programs table does not exist!";
        }
    }

    public function down()
    {
        // No action needed for down()
    }
}