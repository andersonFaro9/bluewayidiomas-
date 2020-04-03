<?php

use App\Database\Migration\TableCreate as TableCreate;
use App\Database\Table;

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
    protected function withStatements(Table $table)
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