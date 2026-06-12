<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'نظرات';
    protected static ?string $modelLabel = 'نظر';
    protected static ?string $pluralModelLabel = 'نظرات';
    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات نظر')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('محصول')
                            ->relationship('product', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\Select::make('customer_id')
                            ->label('مشتری')
                            ->relationship('customer', 'first_name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('rating')
                            ->label('امتیاز')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->required(),
                        Forms\Components\Toggle::make('is_approved')
                            ->label('تایید شده')
                            ->default(false),
                        Forms\Components\Textarea::make('comment')
                            ->label('متن نظر')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
         ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('محصول')
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->label('مشتری')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('نظر')
                    ->limit(50),
                Tables\Columns\TextColumn::make('rating')
                    ->label('امتیاز')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('تایید شده')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->formatStateUsing(fn($state) => $state ? \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($state))->format('Y/m/d H:i') : '-')
                    ->sortable(),
                    Tables\Columns\IconColumn::make('is_admin_reply')
                    ->label('پاسخ ادمین')
                    ->boolean()
                    ->trueIcon('heroicon-o-shield-check')
                    ->falseIcon('heroicon-o-minus'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('وضعیت تایید'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('تایید')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn(Comment $record) => !$record->is_approved)
                    ->action(fn(Comment $record) => $record->update(['is_approved' => true])),
                Tables\Actions\EditAction::make()->label('ویرایش'),
                Tables\Actions\Action::make('reply')
    ->label('پاسخ')
    ->icon('heroicon-o-arrow-uturn-left')
    ->color('info')
    ->visible(fn(Comment $record) => !$record->parent_id)
    ->form([
        Forms\Components\Textarea::make('reply')
            ->label('متن پاسخ')
            ->required(),
    ])
    ->action(function (Comment $record, array $data): void {
        Comment::create([
            'product_id' => $record->product_id,
            'customer_id' => $record->customer_id,
            'comment' => $data['reply'],
            'rating' => 0,
            'is_approved' => true,
            'parent_id' => $record->id,
            'is_admin_reply' => true,
        ]);
    })
    ->modalHeading('پاسخ به نظر')
    ->modalSubmitActionLabel('ارسال پاسخ')
    ->modalCancelActionLabel('انصراف'),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}