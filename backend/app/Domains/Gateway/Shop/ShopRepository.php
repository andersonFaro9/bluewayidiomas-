<?php

namespace App\Domains\Gateway\Shop;

use App\Core\AbstractRepository;
use App\Domains\Gateway\Shop;

/**
 * Class ShopRepository
 *
 * @package App\Domains\Gateway\Shop
 */
class ShopRepository extends AbstractRepository
{
    /**
     * The entity class name used in repository
     *
     * @var string
     */
    protected $prototype = Shop::class;

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return ['name', 'url', 'clientId', 'clientSecret'];
    }
}
