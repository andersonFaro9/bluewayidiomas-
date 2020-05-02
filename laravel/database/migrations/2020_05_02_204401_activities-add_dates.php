<?php

use DeviTools\Database\Migration\TableAlter;
use DeviTools\Database\Table;

/**
 * Class ActivitiesAddDates
 */
class ActivitiesAddDates extends TableAlter
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
     * @return void
     */
    protected function onUp(Table $table)
    {
        $table->date('deliveryDate')->nullable();
        $table->date('publishDate')->nullable();
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function onDown(Table $table)
    {
        $table->dropColumn('deliveryDate');
        $table->dropColumn('publishDate');
    }
}
