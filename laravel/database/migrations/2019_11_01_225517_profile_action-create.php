<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class ProfileActionCreate
 */
class ProfileActionCreate extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profile_action', function (Blueprint $table) {
            $table->uuid('profileId');
            $table->uuid('actionId');

            $table->primary(['profileId', 'actionId']);

            $table->foreign('profileId', 'profile_action_profile_id_foreign')
                ->references('uuid')
                ->on('profiles')
                ->onDelete('cascade');

            $table->foreign('actionId', 'profile_action_action_id_foreign')
                ->references('uuid')
                ->on('actions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('profile_action');
    }
}
