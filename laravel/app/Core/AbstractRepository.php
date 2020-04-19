<?php

namespace App\Core;

use App\Core\Repository\Basic;
use App\Core\Repository\Count;
use App\Core\Repository\Create;
use App\Core\Repository\Destroy;
use App\Core\Repository\Helper;
use App\Core\Repository\Read;
use App\Core\Repository\Restore;
use App\Core\Repository\Search;
use App\Core\Repository\Update;
use App\Domains\Util\Instance;

/**
 * Class AbstractRepository
 *
 * @package App\Core
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @trait
     */
    use Helper;
    use Instance;

    /**
     * Basic operations
     */
    use Basic;
    use Count;
    use Create;
    use Destroy;
    use Read;
    use Restore;
    use Search;
    use Update;

    /**
     * @var ModelInterface
     */
    protected $model;

    /**
     * @var string
     */
    protected string $prototype;

    /**
     * PHP 5 allows developers to declare constructor methods for classes.
     * Classes which have a constructor method call this method on each newly-created object,
     * so it is suitable for any initialization that the object may need before it is used.
     * Note: Parent constructors are not called implicitly if the child class defines a constructor.
     * In order to run a parent constructor, a call to parent::__construct() within the child constructor is required.
     * param [ mixed $args [, $... ]]
     *
     * @link http://php.net/manual/en/language.oop5.decon.php
     *
     * @param ModelInterface $model
     */
    public function __construct(ModelInterface $model = null)
    {
        if (!$model) {
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $model = app($this->prototype);
        }
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function getFilterable(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getManyToOne(): array
    {
        return $this->model->manyToOne();
    }
}
