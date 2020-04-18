<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class ActivitiesCreate
 */
class ActivitiesCreate extends TableCreate
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'activities';
    }

    /**
     * @param Table $table
     *
     * @return void
     */
    protected function withStatements(Table $table): void
    {
        $table->uuid('gradeId')->nullable();
        $table->string('type');
        $table->string('documentType');
        $table->string('name');
        $table->text('description');
        $table->string('document');

        $table->foreign('gradeId', 'actions_action_id_foreign')
            ->references('uuid')
            ->on('grades')
            ->onDelete('restrict');
    }
}

