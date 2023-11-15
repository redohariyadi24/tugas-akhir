<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenjualanResource\Pages;
use App\Filament\Resources\PenjualanResource\RelationManagers;
use App\Models\Penjualan;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PenjualanResource extends Resource
{
    protected static ?string $model = Penjualan::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('tanggal'),
                        Select::make('user_id')->required()->relationship('user', 'name'),
                        Select::make('produk_id')->required()->relationship('produk', 'nama'),
                        TextInput::make('jumlah')->required()->numeric(),
                        TextInput::make('total')->required()->numeric(),
                        // ->content(function ($get) {
                        //     $produk = $get('produk');
                        //     if ($produk) {
                        //         $hargaProduk = $produk->harga;
                        //         $jumlahProduk = $get('jumlah');
                        //         $total = $hargaProduk * $jumlahProduk;
                        //         return $total;
                        //     } else {
                        //         return 0; // Atau nilai default lainnya jika tidak ada produk
                        //     }
                        // })                       
                        Select::make('status')
                            ->options(['diproses' => 'Diproses', 'dalam pengiriman' => 'Sedang dikirim', 'selesai' => 'Selesai'])
                            ->default('diproses')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')->sortable()->searchable(),
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('produk.nama')->searchable(),
                TextColumn::make('jumlah'),
                TextColumn::make('total')
                    ->money('IDR'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'diproses' => 'warning',
                        'dalam pengiriman' => 'info',
                        'selesai' => 'success',
                    })->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListPenjualans::route('/'),
            'create' => Pages\CreatePenjualan::route('/create'),
            'edit' => Pages\EditPenjualan::route('/{record}/edit'),
        ];
    }
}
