<?php

use DeviTools\Database\Migration\TableCreate as TableCreate;
use DeviTools\Database\Table;

/**
 * Class PermissionsCreate
 */
class PermissionsCreate extends TableCreate
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'actions';
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function withStatements(Table $table): void
    {
        $table->uuid('actionId')->nullable();
        $table->string('name');
        $table->string('namespace')->unique();
        $table->string('path');
        $table->string('icon')->default('');
        $table->boolean('separated')->default(0);
        $table->integer('assortment')->default(0);
    }
}
