<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function getLabel(): ?string
    {
        $locale = app()->getLocale();
        if ($locale == "id") {
            return "Pemesanan";
        } else {
            return "Booking";
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('field_id')
                    ->options(function () {
                        $query = \App\Models\Field::query();
                        if (!auth()->user()->hasRole('superadmin')) {
                            $query->whereRelation('place', 'user_id', auth()->id());
                        }
                        return $query->pluck('name', 'id');
                    })
                    ->label('Lapang')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
                TextInput::make('start_at')
                    ->label('Start Time')
                    ->required()
                    ->type('time')
                    ->rule(function ($get) {
                        return function (string $attribute, $value, $fail) use ($get) {
                            $tanggal = $get('date');
                            $field = $get('field_id');
                            $jam = sprintf('%2d:00', $value);
                            $exists = Booking::where('field_id', $field)->where('date', $tanggal)
                                ->where('start_at', $jam)
                                ->exists();

                            if ($exists) {
                                $fail("Booking untuk tanggal {$tanggal} pada jam {$jam} sudah ada.");
                            }
                        };
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('field.name')
                    ->label('Lapang')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date('l, d F Y')
                    ->label('Hari, Tanggal')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_at')
                    ->sortable()
                    ->time('H:i')
                    ->label('Dari'),
                Tables\Columns\TextColumn::make('end_at')
                    ->sortable()
                    ->label('Sampai')
                    ->time('H:i'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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


    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->latest();

        if (!auth()->user()->hasRole('superadmin')) {
            $query->whereHas('field', function (Builder $query) {
                $query->whereRelation('place', 'user_id', auth()->id());
            });
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
