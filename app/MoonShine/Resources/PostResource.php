<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;

use Modules\Post\Models\Post;
use MoonShine\Fields\Date;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Статьи';

    /**
     * @return list<Field>
     */
    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            Date::make('Анонс', 'anons'),
            BelongsTo::make('Автор', 'user', resource: new UserResource()),
            Switcher::make('Опубликовано', 'is_published'),
        ];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            Date::make('Анонс', 'anons'),
            TinyMce::make('Описание', 'description'),
            BelongsTo::make('Автор', 'user', resource: new UserResource()),
            Switcher::make('Опубликовано', 'is_published'),
        ];
    }

    /**
     * @return list<Field>
     */
    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Заголовок', 'title'),
            Date::make('Анонс', 'anons'),
            TinyMce::make('Описание', 'description'),
            BelongsTo::make('Автор', 'user', resource: new UserResource()),
            Switcher::make('Опубликовано', 'is_published'),
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'is_published' => 'required|boolean',
            'user_id' => 'required|int|exists:users,id',
            'anons' => 'required|date',
        ];
    }
}
