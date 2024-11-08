<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use App\Models\Project;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'التبرعات ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->label(__('messages.Project'))
                    ->searchable()
                    ->options(Project::all()->pluck('title', 'id'))
                    ->required(),
                TextInput::make('phone_number')->label(__('messages.Phone number')),
                TextInput::make('name')->label(__('messages.Name')),
                TextInput::make('amount')->label(__('messages.Amount'))
                    ->numeric()
                    ->minValue(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction.invoice_id')->label(__('Invoice ID'))
                    ->getStateUsing(fn($record) => $record->transaction->invoice_id ?? 'MANUAL'),
                TextColumn::make('donationable.title')->label(__('messages.Donationable')),
                TextColumn::make('amount')->label(__('messages.Amount'))
                    ->getStateUsing(function ($record) {
                        return number_format($record->amount, 0, ',', ',');
                    })
                    ->suffix(' د.ك'),
                TextColumn::make('phone_number')->label(__('messages.Phone number')),
                TextColumn::make('name')->label(__('messages.Name')),
                TextColumn::make('created_at')->label(__('messages.Created at')),
            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'view' => Pages\ViewDonation::route('/{record}'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canView(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
}
