<?php

namespace App\Filament\Components\Actions;

use Filament\Actions\Action;
use Public\Enums\CommentStatus;

class CommentStatusActions
{
    public static function make()
    {
        return [
            Action::make('approve')
                ->label(trans('public.comments.status.approved'))
                ->color('success')
                ->requiresConfirmation()
                ->hidden(fn($record) => $record->status === CommentStatus::Approved->value)
                ->action(fn($record) => $record->update(['status' => CommentStatus::Approved->name])),

            Action::make('reject')
                ->label(trans('public.comments.status.rejected'))
                ->color('danger')
                ->requiresConfirmation()
                ->hidden(fn($record) => $record->status === CommentStatus::Rejected->value)
                ->action(fn($record) => $record->update(['status' => CommentStatus::Rejected->name])),

            Action::make('hide')
                ->label(trans('public.comments.status.hidden'))
                ->color('warning')
                ->requiresConfirmation()
                ->hidden(fn($record) => $record->status === CommentStatus::Hidden->value)
                ->action(fn($record) => $record->update(['status' => CommentStatus::Hidden->name])),
        ];
    }
}
