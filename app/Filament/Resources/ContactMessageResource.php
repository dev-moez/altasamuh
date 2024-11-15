<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'رسالة تواصل';
    }
    public static function getPluralLabel(): ?string
    {
        return 'رسائل التواصل';
    }

    public static function getPluralModelLabel(): string
    {
        return 'رسائل التواصل';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('messages.Name'))
                            ->required(),
                        TextInput::make('phone_number')
                            ->label(__('messages.Phone number'))
                            ->required(),
                        Textarea::make('message')
                            ->label(__('messages.Message'))
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('messages.Name'))
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label(__('messages.Phone number'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at'))

                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'create' => Pages\CreateContactMessage::route('/create'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_CONTACT_MESSAGE']);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_CONTACT_MESSAGE']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_CONTACT_MESSAGE']);
    }
}
