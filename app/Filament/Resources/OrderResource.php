<?php
namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model           = Order::class;
    protected static ?string $navigationIcon  = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'سفارشات';
    protected static ?string $modelLabel      = 'سفارش';
    protected static ?int $navigationSort     = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات سفارش')
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->label('مشتری')
                            ->relationship('customer', 'first_name')
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('وضعیت')
                            ->options([
                                'pending'    => 'در انتظار',
                                'processing' => 'در حال پردازش',
                                'shipped'    => 'ارسال شده',
                                'delivered'  => 'تحویل داده شده',
                                'cancelled'  => 'لغو شده',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('total_price')
                            ->label('قیمت کل')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('discount')
                            ->label('تخفیف')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('final_price')
                            ->label('قیمت نهایی')
                            ->numeric()
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('اطلاعات ارسال')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label('آدرس')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('postal_code')
                            ->label('کد پستی')
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label('توضیحات')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('اقلام سفارش')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('محصول')
                                    ->relationship('product', 'name')
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('تعداد')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->label('قیمت')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('discount')
                                    ->label('تخفیف')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('color')
                                    ->label('رنگ')
                                    ->nullable(),
                                Forms\Components\TextInput::make('size')
                                    ->label('سایز')
                                    ->nullable(),
                            ])->columns(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('شماره سفارش')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->label('مشتری')
                    ->searchable(),
                Tables\Columns\TextColumn::make('final_price')
                    ->label('قیمت نهایی')
                    ->money('IRR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('وضعیت')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'processing',
                        'info'    => 'shipped',
                        'success' => 'delivered',
                        'danger'  => 'cancelled',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending'    => 'در انتظار',
                        'processing' => 'در حال پردازش',
                        'shipped'    => 'ارسال شده',
                        'delivered'  => 'تحویل داده شده',
                        'cancelled'  => 'لغو شده',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ سفارش')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('وضعیت')
                    ->options([
                        'pending'    => 'در انتظار',
                        'processing' => 'در حال پردازش',
                        'shipped'    => 'ارسال شده',
                        'delivered'  => 'تحویل داده شده',
                        'cancelled'  => 'لغو شده',
                    ]),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit'   => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
