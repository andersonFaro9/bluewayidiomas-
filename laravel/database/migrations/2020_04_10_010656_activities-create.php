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
        $table->string('name');
        $table->uuid('gradeId')->nullable();
        $table->foreign('gradeId', 'activities_grade_id_foreign')
            ->references('uuid')
            ->on('grades')
            ->onDelete('restrict');
    }
}

