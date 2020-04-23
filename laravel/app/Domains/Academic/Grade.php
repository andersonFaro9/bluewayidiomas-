<?php

namespace App\Domains\Academic;

use App\Core\AbstractModel;
use App\Domains\Admin\Profile;
use App\Domains\Admin\User;
use App\Exceptions\ErrorUserForbidden;
use App\Units\Common\UserSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

/**
 * Class Grade
 *
 * @package App\Domains\Academic
 */
class Grade extends AbstractModel
{
    /**
     * @trait
     */
    use UserSession;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grades';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'name',
        'level',
        'class',
        'shift',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'level' => 'required',
        'class' => 'required',
    ];

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'academic.grade';
    }

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return ['teacher' => 'userId'];
    }

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'uuid');
    }

    /**
     * @param bool $excludeDeleted
     *
     * @return Builder
     * @noinspection ReturnTypeCanBeDeclaredInspection
     * @throws ErrorUserForbidden
     */
    public function newQuery($excludeDeleted = true)
    {
        $user = $this->getUser();
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $query = parent::newQuery($excludeDeleted);

        if ($user->profile->reference === Profile::REFERENCE_ADMIN) {
            return $query;
        }

        $userId = Uuid::fromString($user->uuid)->getBytes();

        if ($user->profile->reference === Profile::REFERENCE_TEACHER) {
            return $query->where('userId', $userId);
        }

        if ($user->profile->reference === Profile::REFERENCE_STUDENT) {
            return $query->whereIn('uuid', static function ($query) use ($userId) {
                $query->select('gradeId')
                    ->from('registrations')
                    ->where('userId', $userId);
            });
        }

        throw new ErrorUserForbidden(['user' => 'unknown']);
    }
}
