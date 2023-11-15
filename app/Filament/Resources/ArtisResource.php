<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtisResource\Pages;
use App\Filament\Resources\ArtisResource\RelationManagers;
use App\Models\Artis;
use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArtisResource extends Resource
{
    protected static ?string $model = Artis::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Artis')
                    ->icon('heroicon-m-users')
                    ->schema([
                        TextInput::make('nama')->required(),
                        MarkdownEditor::make('deskripsi')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    TextColumn::make('nama')
                        ->icon('heroicon-m-user')
                        ->weight(FontWeight::Bold)
                        ->size(TextColumn\TextColumnSize::Large),
                    TextColumn::make('deskripsi')
                        ->wrap()
                        ->size(TextColumn\TextColumnSize::ExtraSmall)
                ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtis::route('/'),
            // 'create' => Pages\CreateArtis::route('/create'),
            // 'edit' => Pages\EditArtis::route('/{record}/edit'),
        ];
    }
}
