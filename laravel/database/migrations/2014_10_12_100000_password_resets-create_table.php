<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class PasswordResetsCreateTable
 */
class PasswordResetsCreateTable extends TableCreate
{
    /**
     * @var bool
     */
    protected $modifiable = false;

    /**
     * @return string
     */
    protected function table(): string
    {
        return 'password_resets';
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function withStatements(Table $table)
    {
        $table->string('email')->index();
        $table->string('token');
    }
}
