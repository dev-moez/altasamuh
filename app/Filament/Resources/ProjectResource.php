<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Filament\Resources\ProjectResource\RelationManagers\DonationsRelationManager;
use App\Filament\Resources\ProjectResource\RelationManagers\QuickDonationValuesRelationManager;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\TextColumn;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'المشاريع ';

    protected static ?string $modelLabel = 'المشاريع ';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make(Project::MEDIA_COLLECTION)
                            ->label(__('messages.Project cover'))
                            ->collection(Project::MEDIA_COLLECTION)
                            ->required(),
                        Select::make('categories')
                            ->label(__('messages.Categories'))
                            ->multiple()
                            ->relationship('categories', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('title')
                            ->label(__('messages.Title'))
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('description')
                            ->label(__('messages.Description'))
                            ->required(),
                        RichEditor::make('details')
                            ->label(__('messages.Details'))
                            ->required(),
                        TextInput::make('donationـofficer_name')
                            ->label(__('messages.Donation officer name'))
                            ->required(),
                        TextInput::make('donationـofficer_number')
                            ->label(__('messages.Donation officer number'))
                            ->required(),
                        Toggle::make('display_in_navbar')
                            ->label(__('messages.Display in navbar')),
                        Toggle::make('display_in_homepage')
                            ->label(__('messages.Display in home page')),
                        TextInput::make('required_donation_value')
                            ->label(__('messages.Required donation value'))
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                        TextInput::make('minimum_donation_value')
                            ->label(__('messages.Minimum donation value'))
                            ->numeric()
                            ->minValue(1)
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('messages.Title'))
                    ->searchable(),
                TextColumn::make('required_donation_value')
                    ->label(__('messages.Required donation value'))
                    ->suffix(' د.ك'),
                TextColumn::make('donations_amount')
                    ->label(__('messages.Donations amount'))
                    ->getStateUsing(function (Project $record) {
                        return $record->donations()
                            ->whereHas('transaction', fn($query) => $query->whereNotNull('paid_at'))
                            ->sum('amount');
                    })->suffix(' د.ك'),
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
            QuickDonationValuesRelationManager::class,
            DonationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
