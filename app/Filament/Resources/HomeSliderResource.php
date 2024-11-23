<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSliderResource\Pages;
use App\Filament\Resources\HomeSliderResource\RelationManagers;
use App\Models\HomeSlider;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class HomeSliderResource extends Resource
{
    protected static ?string $model = HomeSlider::class;

    protected static ?string $navigationGroup = 'إدارة المحتوى ';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('messages.Home slider');
    }
    public static function getPluralLabel(): ?string
    {
        return __('messages.Home sliders');
    }

    public static function getPluralModelLabel(): string
    {
        return __('messages.Home sliders');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('desktop_slider')
                            ->collection(HomeSlider::HOME_SLIDER_MEDIA_DESKTOP)
                            ->label(__('messages.Image (Desktop)'))
                            ->rules(['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'])
                            ->helperText(__('messages.Only jpeg, png, jpg, gif, svg images are allowed. Maximum size: 2MB'))
                            ->required(),
                        SpatieMediaLibraryFileUpload::make('mobile_slider')
                            ->collection(HomeSlider::HOME_SLIDER_MEDIA_MOBILE)
                            ->label(__('messages.Image (Mobile)'))
                            ->rules(['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'])
                            ->helperText(__('messages.Only jpeg, png, jpg, gif, svg images are allowed. Maximum size: 2MB'))
                            ->required(),
                        Forms\Components\TextInput::make('url')
                            ->activeUrl()
                            ->label(__('messages.URL'))
                            ->maxLength(255),

                        Forms\Components\TextInput::make('display_order')
                            ->label(__('messages.Display order'))
                            ->required()
                            ->numeric()
                            ->default(HomeSlider::count() + 1),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('file')
                    ->label(__('messages.Image'))
                    ->collection(HomeSlider::HOME_SLIDER_MEDIA_DESKTOP)
                    ->size(50, 50)
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('url')
                    ->label(__('messages.URL'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('display_order')
                    ->label(__('messages.Display order'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('messages.Created at'))
                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeSliders::route('/'),
            'create' => Pages\CreateHomeSlider::route('/create'),
            'edit' => Pages\EditHomeSlider::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_HOME_SLIDER']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_HOME_SLIDER']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_HOME_SLIDER']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_HOME_SLIDER']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_HOME_SLIDER']);
    }
}
