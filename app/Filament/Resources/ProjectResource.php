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
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use Filament\Tables\Filters\SelectFilter;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Filament\Tables\Actions\Action;
use App\Models\Permission;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Model;
use Malzariey\FilamentDaterangepickerFilter\Filters\DateRangeFilter;

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
                        Repeater::make('details')
                            ->label(__('messages.Details'))
                            ->schema([
                                TextInput::make('key')
                                    ->label(__('messages.Key'))
                                    ->required(),
                                TextInput::make('value')
                                    ->label(__('messages.Details'))
                                    ->required(),
                            ])
                            ->reorderable()
                            ->required()
                            ->columns(2),
                        TextInput::make('donationـofficer_name')
                            ->label(__('messages.Donation officer name'))
                            ->required(),
                        TextInput::make('donationـofficer_number')
                            ->label(__('messages.Donation officer number'))
                            ->required(),
                        Toggle::make('requires_donator_phone_number')
                            ->label(__('messages.Requires donator phone number')),
                        Toggle::make('is_published')
                            ->label(__('messages.Published'))
                            ->default(true),
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
                        TextInput::make('project_number')
                            ->label(__('messages.Project number'))
                            ->default(Project::count() + 1)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No. ')
                    ->rowIndex(),
                TextColumn::make('project_number')
                    ->label(__('messages.Project number'))
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection(Project::MEDIA_COLLECTION)
                    ->label(__('messages.Image')),
                TextColumn::make('title')
                    ->label(__('messages.Title'))
                    ->searchable(),
                TextColumn::make('required_donation_value')
                    ->label(__('messages.Required donation value'))
                    ->getStateUsing(fn($record) => number_format($record->required_donation_value, 0, ',', ','))
                    ->suffix(' د.ك'),
                TextColumn::make('donations_amount')
                    ->label(__('messages.Donations amount'))
                    ->getStateUsing(function (Project $record) {
                        return number_format($record->donations()
                            ->where(function ($query) {
                                $query->whereHas('transaction', fn($query) => $query->whereNotNull('paid_at'))
                                    ->orWhere('transaction_id', null);
                            })
                            ->sum('amount'), 0, ',', ',');
                    })->suffix(' د.ك'),
                TextColumn::make('categories.name')
                    ->label(__('messages.Categories'))
                    ->badge(),
                TextColumn::make('views')
                    ->label(__('messages.Views')),
                ToggleColumn::make('is_published')
                    ->label(__('messages.Published')),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at')),
            ])
            ->filters([
                DateRangeFilter::make('created_at')->label(__('messages.Created at')),
                SelectFilter::make(__('messages.Category'))
                    ->label(__('messages.Categories'))
                    ->relationship('categories', 'name')
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('go_to_project')
                    ->label('الذهاب الي المشروع')
                    ->url(fn($record) => route('projects.view', $record))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('project_number', 'desc')
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')->fromTable()
                        ->except(['index']),
                ])->visible(auth()->user()->can(Permission::PERMISSION_LIST['EXPORT_PROJECTS']))
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

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_PROJECT']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_PROJECT']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_PROJECT']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_PROJECT']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_PROJECT']);
    }
}
