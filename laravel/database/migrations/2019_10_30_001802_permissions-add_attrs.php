<?php

use DeviTools\Database\Migration\TableAlter;
use DeviTools\Database\Table;

/**
 * Class PermissionsAddAttrs
 */
class PermissionsAddAttrs extends TableAlter
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
    protected function onUp(Table $table)
    {
        $table->foreign('actionId')
            ->references('uuid')
            ->on($this->table())
            ->onDelete('cascade');
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropForeign('actions_action_id_foreign');
    }
}
