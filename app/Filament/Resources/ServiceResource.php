<?php

namespace App\Filament\Resources;

use App\Filament\Pages\ServiceData;
use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use App\Models\ServiceCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Layanan')
                ->placeholder('Masukan Nama Layanan')
                ->required(),
            Forms\Components\Select::make(name: 'category_id')
                ->label('Kategori Layanan')
                ->placeholder('Pilih Kategori Layanan')
                ->native(false)
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
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('owner')
                    ->label('Pemilik Layanan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordAction('view-data')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view-data')
                    ->action(function ($record) {
                        return redirect('/admin/service-data?service_id=' . $record->id);
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function createForm(Form $form): Form
    {
        return self::form($form);
    }

    public static function editForm(Form $form): Form
    {
        return self::form($form);
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
            // 'view-data' => ServiceData::route('/'),
        ];
    }
}
