<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use App\Models\Role;
use App\Models\Permission;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): ?string
    {
        return __('messages.Admins');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('messages.Name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label(__('messages.Email'))
                            ->required()
                            ->email()
                            ->unique(User::class, 'email', ignoreRecord: true),
                        Forms\Components\TextInput::make('password')
                            ->label(__('messages.Password'))
                            ->password()
                            ->required()
                            ->minLength(8)
                            ->revealable()
                            ->visibleOn('create'),
                        // Forms\Components\TextInput::make('password_confirmation')
                        //     ->label(__('messages.Password confirmation'))
                        //     ->password()
                        //     ->required()
                        //     ->minLength(8)
                        // ->rules(['same:password']),
                        Select::make('permissions')
                            ->label(__('messages.Permissions'))
                            ->relationship('permissions', 'name')
                            ->multiple()
                            ->preload()
                            ->required()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('messages.Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('messages.Email'))
                    ->searchable(),
                TextColumn::make('permissions.name')
                    ->label(__('messages.Permissions'))
                    ->badge(),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('roles', fn(Builder $query) => $query->where('name', Role::ROLE_ADMIN));
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_ADMIN']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_ADMIN']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_ADMIN']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_ADMIN']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_ADMIN']);
    }
}
