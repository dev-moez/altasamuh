<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Category;

class SubcategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'children';
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('messages.Subcategories');
    }

    protected static function getModelLabel(): ?string
    {
        return __('messages.Subcategory');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make(Category::MEDIA_CATEGORY)
                    ->collection(Category::MEDIA_CATEGORY)
                    ->image()
                    ->maxSize(2048)
                    ->label(__('messages.Image'))
                    ->helperText(__('messages.Only jpeg, png, jpg, gif, svg images are allowed. Maximum size: 2MB')),
                Forms\Components\TextInput::make('name')
                    ->label(__('messages.Name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label(__('messages.Description'))
                    ->maxLength(255),
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('messages.Name')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
