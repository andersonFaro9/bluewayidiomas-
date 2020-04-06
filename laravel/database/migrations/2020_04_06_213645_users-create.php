<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Class UsersCreate
 */
class UsersCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up()
    {
        DatabaseSeeder::instance()->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
