<?php

namespace App\Filament\Resources\GalleryResource\RelationManagers;

use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('messages.Gallery items');
    }

    protected static function getModelLabel(): ?string
    {
        return __('messages.Gallery item');
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('caption')
                    ->label(__('messages.Caption'))
                    ->required()
                    ->maxLength(255),
                SpatieMediaLibraryFileUpload::make('file')
                    ->name('file')
                    ->rules(['required_if:youtube_url,==,null', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'])
                    ->helperText(__('messages.Only jpeg, png, jpg, gif, svg images are allowed. Maximum size: 2MB'))
                    ->label(__('messages.Image'))
                    ->collection(GalleryItem::GALLERY_MEDIA)
                    ->image()
                    ->imageCropAspectRatio('16:9'),
                Forms\Components\TextInput::make('youtube_url')
                    ->label(__('messages.Youtube ID'))
                    ->maxLength(255),
                TextInput::make('display_order')
                    ->label(__('messages.Display order'))
                    ->numeric()
                    ->minValue(1)
                    ->default($this->ownerRecord->items()->count() + 1)
            ])->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                SpatieMediaLibraryImageColumn::make(GalleryItem::GALLERY_MEDIA)
                    ->collection(GalleryItem::GALLERY_MEDIA)
                    ->conversion('thumb')
                    ->size(50, 50)
                    ->label(__('messages.Image')),
                Tables\Columns\TextColumn::make('caption')
                    ->label(__('messages.Caption')),
                TextColumn::make('youtube_url')
                    ->label(__('messages.Youtube code')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('messages.Created at')),
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
