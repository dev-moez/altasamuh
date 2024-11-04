<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'المعاملات ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_id')->label(__('Invoice ID')),
                TextColumn::make('amount')->label(__('messages.Amount')),
                TextColumn::make('status')->label(__('messages.Status')),
                TextColumn::make('user.name')
                    ->label(__('messages.User name'))
                    ->getStateUsing(function ($record) {
                        return $record->user ? $record->user->name : 'فاعل خير';
                    }),
                TextColumn::make('user.phone_number')
                    ->label(__('messages.User phone number'))
                    ->getStateUsing(function ($record) {
                        return $record->user ? $record->user->phone_number : 'فاعل خير';
                    }),
                TextColumn::make('cart.phone_number')
                    ->label(__('messages.Phone number')),
                TextColumn::make('order_id')->label('Order ID'),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at')),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
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
