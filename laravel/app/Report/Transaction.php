<?php

namespace App\Report;

use App\Core\Report\AbstractReport;
use App\Core\Report\Where\WhereEqual;
use App\Core\Report\Where\WhereLike;

/**
 * Class Transaction
 * @package App\Report
 */
class Transaction extends AbstractReport
{
    /**
     * where traits
     */
    use WhereEqual;
    use WhereLike;

    /**
     * @var string
     */
    protected $layout = 'landscape';

    /**
     * @return string
     */
    protected function template(): string
    {
        return 'report.transaction';
    }

    /**
     * @param array $filters
     * @return string
     * @SuppressWarnings(unused)
     */
    protected function instruction(array &$filters): string
    {
        $this->addWhereEqual($filters, '`users`.`id`', 'merchant');
        $this->addWhereLike($filters, '`transactions`.`id`', 'id');
        $this->addWhereLike($filters, '`transactions`.`integration`', 'integration');
        $this->addWhereLike($filters, '`transactions`.`origin`', 'origin');

        // updatedAt, createdAt, deletedAt,
        return "SELECT
                    `transactions`.`uuid`,
                    `transactions`.`id` as 'ID',
                    `transactions`.`integration` as 'integrationID', `transactions`.`origin` as 'originID', 
                    `transactions`.`createdAt`,
                    `userId`, `customer`, `amount`, `status`, `url`, `expired`, `declined`, `approved`
                FROM `transactions`
                JOIN `users` ON (`transactions`.`userId` = `users`.`uuid`)
                WHERE `transactions`.`deletedAt` IS NULL {$this->where()}
                ORDER BY `transactions`.`createdAt`";
    }
}