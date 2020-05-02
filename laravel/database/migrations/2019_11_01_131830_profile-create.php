<?php

use DeviTools\Database\Migration\TableCreate;
use DeviTools\Database\Table;

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
    protected function withStatements(Table $table): void
    {
        $table->string('name');
        $table->string('reference');
    }
}

