<?php

namespace App\Database\Migration;

use App\Database\Migration;
use App\Database\Schema;
use App\Database\Table;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class TableCreate
 * @package App\Database\Migration
 */
abstract class TableCreate extends Migration
{
    /**
     * @var bool
     */
    protected $modifiable = true;

    /**
     * @return string
     */
    abstract protected function table(): string;

    /**
     * @param Table $table
     * @return void
     */
    abstract protected function withStatements(Table $table);

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->table())) {
            return;
        }
        Schema::create($this->table(), function (Blueprint $blueprint) {
            $table = Table::make($blueprint);

            $table->uuid('uuid')->primary();
            $table->string('id')->unique();

            $this->withStatements($table);

            $this->timestamps($table);
        });
    }

    /**
     * @param Table $table
     */
    private function timestamps(Table $table)
    {
        if ($this->modifiable) {
            $table->timestamp('updatedAt')->nullable();
        }
        $table->timestamp('createdAt')->nullable();
        $table->timestamp('deletedAt')->nullable();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table());
    }
}
