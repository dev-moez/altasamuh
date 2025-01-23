<?php

namespace App\Filament\Pages;

use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;

class ManageGeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'إدارة المحتوى ';

    protected static string $settings = GeneralSettings::class;
    protected static ?string $title = 'الاعدادات العامة';

    public static function canAccess(): bool
    {
        return auth()->user()->can(Permission::PERMISSION_LIST['EDIT_GENERAL_SETTINGS']);
    }
    public static function getNavigationLabel(): string
    {
        return __('messages.General settings');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('messages.Footer'))
                    ->schema([
                        TextInput::make('whatsapp_url')
                            ->label(__('messages.Whatsapp URL'))
                            ->url(),
                        TextInput::make('facebook_url')
                            ->label(__('messages.Facebook URL'))
                            ->url(),
                        TextInput::make('linkedin_url')
                            ->label(__('messages.Linkedin URL'))
                            ->url(),
                        TextInput::make('youtube_url')
                            ->label(__('messages.Youtube URL'))
                            ->url(),
                        TextInput::make('instagram_url')
                            ->label(__('messages.Instagram URL'))
                            ->url(),
                        TextInput::make('x_url')
                            ->label(__('messages.X URL'))
                            ->url(),
                    ]),
                Section::make(__('messages.Contact us'))
                    ->schema([
                        TextInput::make('contact_address')
                            ->label(__('messages.Address')),
                        TextInput::make('contact_mailbox')
                            ->label(__('messages.Mailbox')),
                        TextInput::make('contact_phone_number')
                            ->label(__('messages.Phone number')),
                        TextInput::make('contact_email')
                            ->label(__('messages.Email')),
                        TextInput::make('contact_contact_us_link')
                            ->label(__('messages.Contact us link')),
                        TextInput::make('contact_whatsapp_link')
                            ->label(__('messages.Whatsapp link')),
                        TextInput::make('maps_location_url')
                            ->label(__('messages.Google Maps location url')),
                    ]),
                Section::make(__('messages.Header'))
                    ->schema([
                        TextInput::make('header_text')
                            ->label(__('messages.Header text')),
                        TextInput::make('header_url')
                            ->label(__('messages.Header url')),
                    ]),
                Section::make(__('messages.About'))
                    ->schema([
                        RichEditor::make('about_text')
                            ->label(__('messages.About text')),
                    ]),
            ]);
    }
}
