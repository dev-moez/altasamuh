<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.header_text', null);
        $this->migrator->add('general.header_url', null);

        $this->migrator->add('general.about_text', null);

        $this->migrator->add('general.contact_address', null);
        $this->migrator->add('general.contact_mailbox', null);
        $this->migrator->add('general.contact_phone_number', null);
        $this->migrator->add('general.contact_email', null);
        $this->migrator->add('general.contact_contact_us_link', null);
        $this->migrator->add('general.contact_whatsapp_link', null);

        $this->migrator->add('general.whatsapp_number', null);
        $this->migrator->add('general.facebook_url', null);
        $this->migrator->add('general.linkedin_url', null);
        $this->migrator->add('general.instagram_url', null);
        $this->migrator->add('general.youtube_url', null);
        $this->migrator->add('general.x_url', null);

        $this->migrator->add('general.maps_location_url', null);
    }
};
