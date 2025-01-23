<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MiscDonationResource\Pages;
use App\Filament\Resources\MiscDonationResource\RelationManagers;
use App\Models\MiscDonation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class MiscDonationResource extends Resource
{
    protected static ?string $model = MiscDonation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    // protected static ?string $navigationGroup = 'تبرعات متنوعة ';

    protected static ?string $modelLabel = 'تبرعات متنوعة ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('title')->label('الغرض')
                            ->required()
                            ->maxLength(255)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('الغرض')->searchable(),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at'))
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
            'index' => Pages\ListMiscDonations::route('/'),
            'create' => Pages\CreateMiscDonation::route('/create'),
            'view' => Pages\ViewMiscDonation::route('/{record}'),
            'edit' => Pages\EditMiscDonation::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_MISC_DONATION']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_MISC_DONATION']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_MISC_DONATION']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_MISC_DONATION']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_MISC_DONATION']);
    }
}
