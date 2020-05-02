<?php

use DeviTools\Database\Migration\TableCreate;
use DeviTools\Database\Table;

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
        $table->uuid('gradeId');
        $table->string('type');
        $table->string('name');
        $table->text('description');

        $table->string('documentType')->nullable();
        $table->string('linkType')->nullable();
        $table->string('document')->nullable();
        $table->string('link')->nullable();

        $table->foreign('gradeId', 'activitiesGradeId')
            ->references('uuid')
            ->on('grades')
            ->onDelete('restrict');
    }
}

