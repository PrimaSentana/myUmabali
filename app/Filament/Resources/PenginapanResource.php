<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenginapanResource\Pages;
use App\Filament\Resources\PenginapanResource\RelationManagers;
use App\Models\Penginapan;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenginapanResource extends Resource
{
    protected static ?string $model = Penginapan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                ->label('Title Penginapan')
                ->required()
                ->maxLength(255),
                TextInput::make('description')
                ->label('Deskripsi')
                ->required()
                ->maxLength(255),
                TextInput::make('room_count')
                ->label('Banyak Kamar')
                ->numeric()
                ->required(),
                TextInput::make('bathroom_count')
                ->label('Banyak Kamar Mandi')
                ->numeric()
                ->required(),
                TextInput::make('guest_count')
                ->label('Banyak Tamu')
                ->numeric()
                ->required(),
                TextInput::make('location_value')
                ->label('Detail Lokasi')
                ->required()
                ->maxLength(255),

                Map::make('lokasi_map')
                ->label('Lokasi Penginapan')
                ->columnSpanFull() 
                ->defaultLocation(latitude: -8.409518, longitude: 115.188919) 
                ->afterStateUpdated(function (Set $set, ?array $state) {
                    $set('latitude', $state['lat']);
                    $set('longitude', $state['lng']);
                })
                ->afterStateHydrated(function ($state, $record, Set $set) {
                    if ($record) {
                        $set('lokasi_map', [
                            'lat' => $record->latitude,
                            'lng' => $record->longitude,
                        ]);
                    }
                })
                ->liveLocation() 
                ->showMarker() 
                ->showFullscreenControl() 
                ->showZoomControl() 
                ->draggable() 
                ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png") 
                ->zoom(15),

                Group::make()
                ->schema([
                    TextInput::make('latitude')
                    ->required()
                    ->readOnly(),
                    TextInput::make('longitude')
                    ->required()
                    ->readOnly(),
                ])
                ->columns(2)
                ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                ->searchable(),
                ImageColumn::make('images.image_path')
                ->label('Image'),
                TextColumn::make('description')
                ->searchable(),
                TextColumn::make('room_count')
                ->searchable(),
                TextColumn::make('guest_count')
                ->searchable(),
                TextColumn::make('bathroom_count')
                ->searchable(),
                TextColumn::make('location_value')
                ->searchable(),
                TextColumn::make('price')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenginapans::route('/'),
            'create' => Pages\CreatePenginapan::route('/create'),
            'edit' => Pages\EditPenginapan::route('/{record}/edit'),
        ];
    }
}
