<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MiscDonationValueResource\Pages;
use App\Filament\Resources\MiscDonationValueResource\RelationManagers;
use App\Models\MiscDonationValue;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class MiscDonationValueResource extends Resource
{
    protected static ?string $model = MiscDonationValue::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'قيم تبرعات متنوعة ';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('value')->label('قيمة')
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('value')->label('قيمة')
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
            'index' => Pages\ListMiscDonationValues::route('/'),
            // 'create' => Pages\CreateMiscDonationValue::route('/create'),
            // 'view' => Pages\ViewMiscDonationValue::route('/{record}'),
            // 'edit' => Pages\EditMiscDonationValue::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_MISC_DONATION_VALUE']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_MISC_DONATION_VALUE']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_MISC_DONATION_VALUE']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_MISC_DONATION_VALUE']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_MISC_DONATION_VALUE']);
    }
}
