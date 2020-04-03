<?php

use App\Database\Migration\TableAlter;
use App\Database\Table;

/**
 * Class UsersAddProfile
 */
class UsersAddProfile extends TableAlter
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'users';
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onUp(Table $table)
    {
        $table->uuid('profileId')->nullable();
        $table->foreign('profileId', 'users_profile_id_foreign')
            ->references('uuid')
            ->on('profiles')
            ->onDelete('restrict');
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropForeign('users_profile_id_foreign');
        $table->dropColumn('profileId');
    }
}
