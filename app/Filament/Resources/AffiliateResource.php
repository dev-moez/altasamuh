<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AffiliateResource\Pages;
use App\Filament\Resources\AffiliateResource\RelationManagers;
use App\Models\Affiliate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Colors\Color;

class AffiliateResource extends Resource
{
    protected static ?string $model = Affiliate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return ' رابط الاعلان';
    }
    public static function getPluralLabel(): ?string
    {
        return ' رابط الاعلان ';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->label(__('messages.Project'))
                    ->relationship('project', 'title')
                    ->preload()
                    ->searchable()
                    ->required(),
                TextInput::make('name')
                    ->label(__('messages.Name')),
                TextInput::make('tracking_code')
                    ->label(__('messages.Tracking code'))
                    ->default(uniqid()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('messages.Name'))
                    ->searchable(),
                TextColumn::make('project.title')
                    ->label(__('messages.Project')),
                TextColumn::make('tracking_code')
                    ->label(__('messages.Tracking code'))
                    ->searchable(),
                TextColumn::make('link')
                    ->label(__('messages.Link'))
                    ->getStateUsing(fn($record) => route('projects.view', ['project' => $record->project, 'affiliate' => $record->tracking_code]))
                    ->color(Color::Blue)
                    ->copyable(),
                TextColumn::make('visits')
                    ->label(__('messages.Visits')),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at'))
            ])
            ->filters([
                SelectFilter::make(__('messages.Project'))
                    ->label(__('messages.Project'))
                    ->relationship('project', 'title')
                    ->searchable()
                    ->preload()
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
            'index' => Pages\ListAffiliates::route('/'),
            'create' => Pages\CreateAffiliate::route('/create'),
            'edit' => Pages\EditAffiliate::route('/{record}/edit'),
        ];
    }
}