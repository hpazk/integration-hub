<?php

namespace App\Filament\Pages;

use App\Models\Service;
use App\Models\ServiceCategory;
use Exception;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\BasePage;
use Filament\Notifications\Notification;

class ServiceFormPage extends BasePage implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.service-form-page';

    public ?array $data = [];

    protected function getHeader(): string
    {
        return 'Registrasi API Layanan Publik';
    }

    protected function getDescription(): string
    {
        return 'Daftarkan layanan publik Anda dan bergabunglah dengan ekosistem API untuk integrasi yang lebih baik.';
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Layanan')
                ->placeholder('Masukan Nama Layanan')
                ->required(),
            Forms\Components\Select::make(name: 'category_id')
                ->label('Kategori Layanan')
                ->placeholder('Pilih Kategori Layanan')
                ->options(ServiceCategory::all()->pluck('name', 'id'))
                ->required(),
            Forms\Components\TextInput::make(name: 'url')
                ->label('URL Endpoint API')
                ->placeholder('Masukan URL Endpoint API')
                ->required(),
            Forms\Components\TextInput::make('owner')
                ->label('Pemilik Layanan')
                ->placeholder(placeholder: 'Masukan Nama Pemilik Layanan')
                ->required(),
        ])
            ->statePath('data');
    }

    public function submit()
    {

        $form = $this->form->getState();

        try {
            Service::create([
                'name' => $form['name'],
                'category_id' => $form['category_id'],
                'url' => $form['url'],
                'owner' => $form['owner'],
            ]);

            Notification::make()
                ->title('Success')
                ->success()
                ->send();

            return redirect()->route('services.index');
        } catch (Exception $e) {
            Notification::make()
                ->title('Failed to save')
                ->body($e)
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
