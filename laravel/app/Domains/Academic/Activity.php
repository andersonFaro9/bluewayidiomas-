<?php

namespace App\Domains\Academic;

use App\Domains\Academic\Shared\TeacherGrade;
use App\Domains\Admin\Profile;
use DeviTools\Exceptions\ErrorUserForbidden;
use App\Units\Common\UserSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Uuid;
use DeviTools\Persistence\AbstractModel;

/**
 * Class Activity
 *
 * @package App\Domains\Academic
 */
class Activity extends AbstractModel
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
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gradeId',
        'type',
        'documentType',
        'linkType',
        'name',
        'description',
        'document',
        'link',
        'publishDate',
        'deliveryDate',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'gradeId' => 'required',
        'type' => 'required',
        'name' => 'required',
        'description' => 'required',
    ];

    /**
     * @return array
     */
    public function manyToOne(): array
    {
        return ['grade' => 'gradeId'];
    }

    /**
     * @return BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'gradeId', 'uuid');
    }

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'academic.activity';
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

        if ($user->profile->reference === Profile::REFERENCE_STUDENT) {
            return $query->whereIn('gradeId', static function ($query) use ($userId) {
                $query->select('gradeId')
                    ->from('registrations')
                    ->where('userId', $userId);
            });
        }

        throw new ErrorUserForbidden(['user' => 'unknown']);
    }
}
