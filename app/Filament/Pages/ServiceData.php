<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ServiceData extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.service-data';

    public $posts;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(Request $request)
    {
        $serviceId = $request->query('service_id');

        $service = Service::where('id', $serviceId)->first();

        if ($service) {
            $response = Http::get($service->url);

            if ($response->successful()) {
                $this->posts = $response->json();
            } else {
                $this->posts = [];
            }
        } else {
            $this->posts = [];
        }
    }
}
