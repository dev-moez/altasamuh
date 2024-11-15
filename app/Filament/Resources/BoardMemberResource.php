<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BoardMemberResource\Pages;
use App\Filament\Resources\BoardMemberResource\RelationManagers;
use App\Models\BoardMember;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class BoardMemberResource extends Resource
{
    protected static ?string $model = BoardMember::class;

    protected static ?string $navigationGroup = 'إدارة المحتوى ';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'عضو المجلس';
    }
    public static function getPluralLabel(): ?string
    {
        return 'أعضاء المجلس ';
    }

    public static function getPluralModelLabel(): string
    {
        return 'أعضاء المجلس ';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('messages.Name'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('role')
                            ->label(__('messages.Role'))
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('messages.Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label(__('messages.Role'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('messages.Created at'))

                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->reorderable('position');
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
            'index' => Pages\ListBoardMembers::route('/'),
            'create' => Pages\CreateBoardMember::route('/create'),
            'edit' => Pages\EditBoardMember::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_BOARD_MEMBER']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_BOARD_MEMBER']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_BOARD_MEMBER']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_BOARD_MEMBER']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_BOARD_MEMBER']);
    }
}
