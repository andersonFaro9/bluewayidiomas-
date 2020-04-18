<?php

namespace App\Domains\Admin;

use App\Core\AbstractModel;
use App\Core\AbstractModel as Model;
use App\Core\Model\Fill;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use function PhpBrasil\Collection\pack;

/**
 * Class Profile
 *
 * @package App\Domains\Admin
 */
class Profile extends Model
{
    /**
     * @var string
     */
    public const REFERENCE_ADMIN = 'admin';

    /**
     * @var string
     */
    public const REFERENCE_TEACHER = 'teacher';

    /**
     * @var string
     */
    public const REFERENCE_STUDENT = 'student';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'reference',
    ];

    /**
     * @var array
     */
    protected $rules = [
        'name' => ['required'],
        'reference' => ['required', 'in:admin,teacher,student'],
    ];

    /**
     * @return array
     */
    public function manyToMany(): array
    {
        return ['actions' => 'actionId'];
    }

    /**
     * @return BelongsToMany
     */
    public function actions(): BelongsToMany
    {
        return $this
            ->belongsToMany(Action::class, 'profile_action', 'profileId', 'actionId')
            ->using(ProfileAction::class);
    }

    /**
     * @return void
     */
    protected static function configure(): void
    {
        static::saved(
            static function (Profile $model) {
                $actions = $model->getFilled('actions');
                if (!is_array($actions)) {
                    return;
                }

                $ids = pack($actions)
                    ->map(
                        static function ($action) use ($model) {
                            return static::encodeUuid($action[$model->exposedKey()]);
                        }
                    )
                    ->records();
                $model->actions()->sync($ids);
            }
        );
    }

    /**
     * @return string
     */
    public function prefix(): string
    {
        return 'admin.profile';
    }
}
