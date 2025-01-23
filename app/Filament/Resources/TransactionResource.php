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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use App\Models\Permission;

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
        $statusOptions = Transaction::getStatusOptions();
        return $table
            ->columns([
                TextColumn::make('invoice_id')->label(__('Invoice ID'))
                    ->searchable(),
                TextColumn::make('amount')->label(__('messages.Amount')),
                TextColumn::make('status')->label(__('messages.Status')),
                TextColumn::make('user.name')
                    ->label(__('messages.User name'))
                    ->getStateUsing(function ($record) {
                        return $record->user ? $record->user->name : 'فاعل خير';
                    })->searchable(),
                TextColumn::make('user.phone_number')
                    ->label(__('messages.User phone number'))
                    ->getStateUsing(function ($record) {
                        return $record->user ? $record->user->phone_number : 'فاعل خير';
                    })->searchable(),
                TextColumn::make('cart.phone_number')
                    ->label(__('messages.Anonymous phone number'))->searchable(),
                TextColumn::make('order_id')->label('Order ID')->searchable(),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at')),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label(__('messages.Payment status'))
                    ->options($statusOptions),
                DateRangeFilter::make('created_at')->label(__('messages.Created at')),

            ])
            ->actions([])
            ->bulkActions([])
            ->headerActions([
                ExportAction::make('export')
                    ->exports([
                        ExcelExport::make('table')->fromTable()->queue(),
                    ])->visible(auth()->user()->can(Permission::PERMISSION_LIST['EXPORT_TRANSACTIONS'])),
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

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_TRANSACTION']);
    }
}
