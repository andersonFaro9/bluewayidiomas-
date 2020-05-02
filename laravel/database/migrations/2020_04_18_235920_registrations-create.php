<?php

use DeviTools\Database\Migration\TableCreate;
use DeviTools\Database\Table;

/**
 * Class RegistrationsCreate
 */
class RegistrationsCreate extends TableCreate
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'registrations';
    }

    /**
     * @param Table $table
     *
     * @return void
     */
    protected function withStatements(Table $table): void
    {
        $table->uuid('gradeId');
        $table->uuid('userId');

        $table->date('date');

        $table->foreign('gradeId', 'registrationsGradeId')
            ->references('uuid')
            ->on('grades')
            ->onDelete('restrict');

        $table->foreign('userId', 'registrationsUserId')
            ->references('uuid')
            ->on('users')
            ->onDelete('restrict');
    }
}
