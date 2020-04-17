<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class GradesCreate
 */
class GradesCreate extends TableCreate
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'grades';
    }

    /**
     * @param Table $table
     *
     * @return void
     */
    protected function withStatements(Table $table): void
    {
        $table->string('name');
        $table->string('shift');
    }
}

