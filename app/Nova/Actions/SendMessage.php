<?php

namespace App\Nova\Actions;

use App\Character;
use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use NumaxLab\NovaCKEditor5Classic\CKEditor5Classic;

class SendMessage extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            Message::create([
                'subject' => $fields['subject'],
                'character' => $fields['character'],
                'body' => $fields['body'],
                'replyable' => $fields['replyable'],
                'admin_sender_id' => auth()->id(),
                'receiver_id' => $model->id,
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Subject')
                ->required(),

            Select::make('Character')
                ->options(Character::get()->pluck('name', 'name'))
                ->required(),

            CKEditor5Classic::make('body')
                ->required()
                ->options([
                    'toolbar' => ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                ]),

            Boolean::make('Allow Reply ?', 'replyable')
                ->required()
                ->default(function () {
                    return false;
                }),
        ];
    }
}
