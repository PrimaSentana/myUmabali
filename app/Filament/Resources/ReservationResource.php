<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Booking')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled(), 

                        Select::make('listings_id')
                            ->relationship('listings', 'title')
                            ->disabled(),

                        DatePicker::make('check_in')->disabled(),
                        DatePicker::make('check_out')->disabled(),
                        
                        TextInput::make('total_price')
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled(),
                    ])->columns(2),

                Section::make('Update Status')
                    ->schema([
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'success' => 'Success (Paid)',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->native(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_id')
                ->label('Order Id')
                ->sortable()
                ->searchable(),

                TextColumn::make('user.name')
                ->label('Tamu')
                ->searchable()
                ->description(fn($record) => $record->user->email),

                TextColumn::make('listings.title')
                ->label('Penginapan')
                ->searchable()
                ->limit(30),

                TextColumn::make('check_in')
                ->label('Jadwal')
                ->date('j M Y')
                ->description(fn($record) => 'sampai ' . $record->check_out->format('j M Y')),

                TextColumn::make('total_price')
                ->label('Total')
                ->money('IDR', locale: 'id')
                ->sortable(),

                TextColumn::make('payment_status')
                ->badge()
                ->color(fn(string $state): string => match ($state) {
                    'pending' => 'warning',
                    'paid' => 'success',
                    'cancelled' => 'danger',
                    default => 'gray',
                }),

                TextColumn::make('created_at')
                ->since()
                ->label('Dibuat')
                ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('payment_status')
                ->options([
                    'pending' => 'Menunggu Bayar',
                    'paid' => 'Lunas',
                    'cancelled' => 'Dibatalkan',
                ]),
                Filter::make('check_in')
                ->form([
                    DatePicker::make('from')->label('Dari Tanggal'),
                    DatePicker::make('until')->label('Sampai Tanggal')
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                    ->when(
                        $data['from'],
                        fn (Builder $query, $date): Builder => $query->whereDate('check_in', '>=', $date),
                    )
                    ->when(
                        $data['until'],
                        fn (Builder $query, $date): Builder => $query->whereDate('check_in', '<=', $date),
                    );
                })
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
