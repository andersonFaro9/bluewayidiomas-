<?php

declare(strict_types=1);

namespace App\Domains\Academic;

use App\Core\AbstractModel as Model;
use App\Domains\Academic\Shared\TeacherGrade;
use App\Domains\Admin\Profile;
use App\Domains\Admin\User;
use App\Exceptions\ErrorUserForbidden;
use App\Units\Common\UserSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;

/**
 * Class Registration
 *
 * @package App\Domains\Academic
 */
class Registration extends Model
{
    /**
     * @trait
     */
    use UserSession;
    use TeacherGrade;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registrations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gradeId',
        'userId',
        'date',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'gradeId' => ['required'],
        'userId' => ['required'],
        'date' => ['required'],
    ];

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'academic.registration';
    }

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return ['grade' => 'gradeId', 'student' => 'userId'];
    }

    /**
     * @return BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'gradeId', 'uuid');
    }

    /**
     * @return BelongsTo
     */
    public function student(): BelongsTo
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
            return $this->queryTeacherGrade($query, $userId);
        }

        throw new ErrorUserForbidden(['user' => 'unknown']);
    }
}
