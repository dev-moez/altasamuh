<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Boolean;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationGroup = 'إدارة المحتوى ';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return 'المقالة';
    }
    public static function getPluralLabel(): ?string
    {
        return 'المقالات ';
    }

    public static function getPluralModelLabel(): string
    {
        return 'المقالات ';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('file')
                            ->name('file')
                            ->required()
                            ->rules(['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'])
                            ->helperText(__('messages.Only jpeg, png, jpg, gif, svg images are allowed. Maximum size: 2MB'))
                            ->label(__('messages.Image'))
                            ->collection(Article::MEDIA_COVER)
                            ->image()
                            ->imageCropAspectRatio('16:9'),
                        TextInput::make('title')
                            ->label(__('messages.Title'))
                            ->maxLength(255)
                            ->required()
                            ->live(onBlur: true, debounce: 600)
                            ->afterStateUpdated(function (callable $set, callable $get) {
                                if (filled($get('title')))
                                    // $set('slug', str_replace(' ', '-', $get('title')));
                                    $set('slug', Str::slug($get('title'), '-'));
                            }),
                        RichEditor::make('content')
                            ->label(__('messages.Content'))
                            ->required(),
                        Toggle::make('is_published')
                            ->label(__('messages.Published'))
                            ->default(true)
                            ->onColor('success')
                            ->offColor('gray'),
                        Toggle::make('is_pinned')
                            ->label(__('messages.Pinned'))
                            ->default(false)
                            ->onColor('success')
                            ->offColor('gray'),
                        TextInput::make('slug')
                            ->label(__('messages.Slug'))
                            ->maxLength(255)
                            ->unique(Article::class, 'slug', ignoreRecord: true)

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label(__('messages.Image'))
                    ->collection(Article::MEDIA_COVER)
                    ->size(50)
                    ->alignCenter(),
                TextColumn::make('title')
                    ->label(__('messages.Title'))
                    ->searchable(),
                IconColumn::make('is_published')
                    ->label(__('messages.Published'))
                    ->alignCenter()
                    ->boolean(),
                IconColumn::make('is_pinned')
                    ->label(__('messages.Pinned'))
                    ->alignCenter()
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label(__('messages.Created at'))
                    ->sortable()
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['VIEW_ARTICLE']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['CREATE_ARTICLE']);
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_ARTICLE']);
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_ARTICLE']);
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['DELETE_ARTICLE']);
    }
}
