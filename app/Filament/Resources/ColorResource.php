<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ColorResource\Pages;
use App\Models\Color;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ColorResource extends Resource
{
    protected static ?string $model           = Color::class;
    protected static ?string $navigationIcon  = 'heroicon-o-swatch';
    protected static ?string $navigationLabel = 'رنگ‌ها';
    protected static ?string $modelLabel      = 'رنگ';
    protected static ?string $pluralModelLabel = 'رنگ‌ها  ';

    protected static ?int $navigationSort     = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('نام رنگ')
                    ->required()
                    ->maxLength(255),
                Forms\Components\ColorPicker::make('hex_code')
                    ->label('کد رنگ')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
         ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ColorColumn::make('hex_code')
                    ->label('رنگ'),
                Tables\Columns\TextColumn::make('name')
                    ->label('نام رنگ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                   ->formatStateUsing(fn($state) => $state ? \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($state))->format('Y/m/d H:i') : '-')
                   ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()->label('ویرایش'),
                Tables\Actions\DeleteAction::make()->label("حذف"),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListColors::route('/'),
            'create' => Pages\CreateColor::route('/create'),
            'edit'   => Pages\EditColor::route('/{record}/edit'),
        ];
    }
}
