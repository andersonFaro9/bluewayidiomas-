<?php

use App\Database\Migration\TableAlter;
use App\Database\Table;

/**
 * Class UsersAddDetails
 */
class UsersAddDetails extends TableAlter
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
        $table->boolean('active')->default(0);
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropColumn('birthday');
    }
}
