<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;

use Modules\Auth\Models\User;
use MoonShine\Fields\Password;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<User>
 */
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Пользователи';

    protected string $column = 'full_name';

    /**
     * @return list<Field>
     */
    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('ФИО', 'full_name'),
            Text::make('email', 'email'),
            BelongsTo::make('Роль', 'role', resource: new UserRoleResource()),
            Switcher::make('Бан', 'is_banned'),
            Text::make('Дата регистрации', 'created_at'),
        ];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('ФИО', 'full_name')->required(),
            Text::make('email', 'email')->required(),
            Password::make('Пароль', 'password'),
            Switcher::make('Бан', 'is_banned'),
            BelongsTo::make('Роль', 'role', resource: new UserRoleResource())->required(),
        ];
    }

    /**
     * @return list<Field>
     */
    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('ФИО', 'full_name'),
            Text::make('email', 'email'),
            Password::make('Пароль', 'password'),
            BelongsTo::make('Роль', 'role', resource: new UserRoleResource()),
            Switcher::make('Бан', 'is_banned'),
            Text::make('Дата регистрации', 'created_at'),
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'full_name' => 'bail|required|string|max:255',
            'email' => 'bail|required|string|email|max:255',
            'password' => 'bail|nullable|string|min:6|confirmed',
            'is_banned' => 'bail|boolean',
        ];
    }
}
