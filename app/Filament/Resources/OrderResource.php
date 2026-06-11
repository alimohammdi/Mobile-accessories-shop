<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\BadgeColumn;

class OrderResource extends Resource
{
    protected static ?string $model           = Order::class;
    protected static ?string $navigationIcon  = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'سفارشات';
    protected static ?string $modelLabel      = 'سفارش';
    protected static ?string $pluralModelLabel = 'سفارشات';
    protected static ?int $navigationSort     = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات سفارش')
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->label('مشتری')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable(),
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
                            ->label('قیمت کل (تومان)')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('discount')
                            ->label('تخفیف (تومان)')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('final_price')
                            ->label('قیمت نهایی (تومان)')
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
                            ->label('یادداشت')
                            ->nullable()
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('آیتم‌های سفارش')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('محصول')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('تعداد')
                                    ->numeric()
                                    ->required()
                                    ->default(1),
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
                            ])->columns(3)
                            ->addActionLabel('افزودن محصول')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
         ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('شماره سفارش')
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('مشتری')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('final_price')
                    ->label('مبلغ نهایی')
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
                    ->formatStateUsing(fn($state) => match($state) {
                        'pending'    => 'در انتظار',
                        'processing' => 'در حال پردازش',
                        'shipped'    => 'ارسال شده',
                        'delivered'  => 'تحویل داده شده',
                        'cancelled'  => 'لغو شده',
                        default      => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
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
                Tables\Filters\Filter::make('created_at')
                    ->label('امروز')
                    ->query(fn($query) => $query->whereDate('created_at', today())),
            ])
            ->actions([
    Tables\Actions\Action::make('changeStatus')
        ->label('تغییر وضعیت')
        ->icon('heroicon-o-arrow-path')
        ->form([
            Forms\Components\Select::make('status')
                ->label('وضعیت جدید')
                ->options([
                    'pending'    => 'در انتظار',
                    'processing' => 'در حال پردازش',
                    'shipped'    => 'ارسال شده',
                    'delivered'  => 'تحویل داده شده',
                    'cancelled'  => 'لغو شده',
                ])
                ->required(),
        ])
        ->action(function (Order $record, array $data): void {
            $record->update(['status' => $data['status']]);
        })
        ->modalHeading('تغییر وضعیت سفارش')
        ->modalSubmitActionLabel('ثبت تغییر')
        ->modalCancelActionLabel('انصراف'),
        Tables\Actions\EditAction::make()->label('ویرایش'),
         Tables\Actions\DeleteAction::make()->label('حذف'),
        ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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