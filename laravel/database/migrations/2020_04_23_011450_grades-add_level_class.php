<?php

use App\Database\Migration\TableAlter;
use App\Database\Table;

/**
 * Class GradesAddLevelClass
 */
class GradesAddLevelClass extends TableAlter
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
     * @return void
     */
    protected function onUp(Table $table)
    {
        $table->string('level');
        $table->string('class');
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropColumn('level');
        $table->dropColumn('class');
    }
}
