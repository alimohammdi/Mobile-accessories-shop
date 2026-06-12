<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SizeResource\Pages;
use App\Models\Size;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SizeResource extends Resource
{
    protected static ?string $model           = Size::class;
    protected static ?string $navigationIcon  = 'heroicon-o-hashtag';
    protected static ?string $navigationLabel = 'سایزها';
    protected static ?string $modelLabel      = 'سایز';
    protected static ?string $pluralModelLabel = 'سایزها / شماره ها';

    protected static ?int $navigationSort     = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('number')
                    ->label('شماره')
                    ->options(array_combine(range(1, 10), range(1, 10)))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
         ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->label('شماره')
                    ->sortable(),
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
            'index'  => Pages\ListSizes::route('/'),
            'create' => Pages\CreateSize::route('/create'),
            'edit'   => Pages\EditSize::route('/{record}/edit'),
        ];
    }
}
