<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{

    public ?string $whatsapp_number;
    public ?string $youtube_url;
    public ?string $x_url;
    public ?string $instagram_url;
    public ?string $facebook_url;
    public ?string $linkedin_url;

    public ?string $header_text;
    public ?string $header_url;

    public ?string $about_text;

    public ?string $contact_address;
    public ?string $contact_mailbox;
    public ?string $contact_phone_number;
    public ?string $contact_email;

    public ?string $maps_location_url;
    public ?string $contact_contact_us_link;
    public ?string $contact_whatsapp_link;

    public static function group(): string
    {
        return 'general';
    }
}
