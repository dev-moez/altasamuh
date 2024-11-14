<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class DonationsRelationManager extends RelationManager
{
    protected static string $relationship = 'donations';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('messages.Donations');
    }

    protected static function getModelLabel(): ?string
    {
        return __('messages.Donations') . " ";
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('id')
                //     ->required()
                //     ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label(__('messages.Name')),
                Tables\Columns\TextColumn::make('user.phone_number')->label(__('messages.Phone number')),
                Tables\Columns\TextColumn::make('amount')->label(__('messages.Amount'))->suffix(' د.ك'),
                Tables\Columns\TextColumn::make('transaction.status')->label(__('messages.Payment status')),
                Tables\Columns\TextColumn::make('transaction.invoice_id')->label(__('INVOICE ID')),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
