<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;
use App\Settings\GeneralSettings;

class ContactUs extends Component
{
    public $name;
    public $phone_number;
    public $message;

    public function render()
    {
        $generalSettings = app(GeneralSettings::class);
        return view('livewire.contact-us', compact('generalSettings'));
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'message' => 'required',
        ]);

        try {
            ContactMessage::create([
                'name' => $this->name,
                'phone_number' => $this->phone_number,
                'message' => $this->message
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('error-message', ['message' => 'حدث خطأ ما، يرجى المحاولة مرة أخرى']);
            return;
        }

        $this->dispatch('success-message', ['message' => 'لقد تم ارسال رسالتك بنجاح']);

        // Send email
        // Mail::to(config('mail.from.address'))->send(new ContactUsMail($this->name, $this->email, $this->message));

        $this->reset();
    }
}
