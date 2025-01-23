<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Filament\Resources\DonationResource\RelationManagers;
use App\Filament\Resources\DonationResource\Widgets\DonationsStats;
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
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;
use App\Models\Permission;

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
                    ->getStateUsing(fn($record) => $record->transaction->invoice_id ?? 'MANUAL')
                    ->searchable(),
                TextColumn::make('donationable.title')->label(__('messages.Donationable'))
                    ->searchable(),
                TextColumn::make('amount')->label(__('messages.Amount'))
                    ->getStateUsing(function ($record) {
                        return number_format($record->amount, 0, ',', ',');
                    })
                    ->suffix(' د.ك'),
                TextColumn::make('phone_number')->label(__('messages.Phone number'))->searchable(),
                TextColumn::make('name')->label(__('messages.Name'))->searchable(),
                TextColumn::make('affiliate.name')->label(__('messages.Affiliate'))->searchable(),
                TextColumn::make('created_at')->label(__('messages.Created at')),
            ])
            ->filters([
                // SelectFilter::make('project_id')
                //     ->label(__('messages.Project'))
                //     ->relationship('donationable', 'title')
                //     ->searchable(),
                DateRangeFilter::make('created_at')->label(__('messages.Created at')),
            ])
            ->actions([])
            ->bulkActions([])
            ->headerActions([
                ExportAction::make('export')
                    ->exports([
                        ExcelExport::make('table')->fromTable()->queue(),
                    ])->visible(auth()->user()->can(Permission::PERMISSION_LIST['EXPORT_DONATIONS'])),
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'view' => Pages\ViewDonation::route('/{record}'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_DONATION']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_DONATION']);
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

    public static function getWidgets(): array
    {
        return [
            DonationsStats::class
        ];
    }
}
