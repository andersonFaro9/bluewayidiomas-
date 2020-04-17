<?php

use App\Database\Migration\TableCreate;
use App\Database\Table;

/**
 * Class UsersCreateTable
 */
class UsersCreateTable extends TableCreate
{
    /**
     * @return string
     */
    protected function table(): string
    {
        return 'users';
    }

    /**
     * @param Table $table
     * @return void
     */
    protected function withStatements(Table $table): void
    {
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password')->default('M5mTytfy7U4xsxUitNWVJjC0AvV3FwXvXZQmYXab');
        $table->rememberToken();
    }
}
