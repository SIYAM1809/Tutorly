<?php

namespace App\Livewire\Navigation;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LanguageSwitcher extends Component
{
    public string $currentLocale = 'en';

    public function mount(): void
    {
        $this->currentLocale = App::getLocale();
    }

    public function switchLanguage(string $locale): void
    {
        if (!in_array($locale, ['en', 'bn'])) {
            return;
        }

        $this->currentLocale = $locale;
        Session::put('locale', $locale);
        App::setLocale($locale);

        if (Auth::check()) {
            Auth::user()->update(['preferred_language' => $locale]);
        }

        $this->redirect(request()->header('Referer', route('dashboard')), navigate: true);
    }

    public function render()
    {
        return view('livewire.navigation.language-switcher');
    }
}
