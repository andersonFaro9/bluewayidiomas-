<?php

use DeviTools\Database\Migration\TableCreate;
use DeviTools\Database\Table;

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
        $table->uuid('userId')->nullable();

        $table->string('name');
        $table->string('shift');

        $table->foreign('userId', 'gradesUserId')
            ->references('uuid')
            ->on('users')
            ->onDelete('set null');
    }
}

