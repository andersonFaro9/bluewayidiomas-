<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class ProfileCreate
 */
class ProfileCreate extends TableCreate
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'profiles';
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function withStatements(Table $table)
    {
        $table->string('name');
        $table->string('reference');
    }
}

