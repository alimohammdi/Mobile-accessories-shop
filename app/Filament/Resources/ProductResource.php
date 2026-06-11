<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model           = Product::class;
    protected static ?string $navigationIcon  = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'محصولات';
    protected static ?string $modelLabel      = 'محصول';
   protected static ?string $pluralModelLabel = 'محصولات';

    protected static ?int $navigationSort     = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('اطلاعات اصلی')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام محصول')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('uni_code')
                            ->label('کد محصول')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\Select::make('category_id')
                            ->label('دسته‌بندی')
                            ->relationship('category', 'name')
                            ->required(),
                        Forms\Components\Select::make('brand_id')
                            ->label('برند')
                            ->relationship('brand', 'name')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('قیمت و موجودی')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('قیمت (تومان)')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('discount')
                            ->label('تخفیف (%)')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('stock')
                            ->label('موجودی')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('فعال')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('توضیحات')
                    ->schema([
                       Forms\Components\Section::make('توضیحات')
                       ->schema([
        Forms\Components\Select::make('description_template')
            ->label('انتخاب از قالب‌های آماده')
            ->options(
                \App\Models\DescriptionTemplate::where('is_active', true)
                    ->pluck('title', 'id')
            )
            ->live()
            ->afterStateUpdated(function ($state, Forms\Set $set) {
                if ($state) {
                    $template = \App\Models\DescriptionTemplate::find($state);
                    if ($template) {
                        $set('description', $template->content);
                    }
                }
            })
            ->placeholder('یک قالب انتخاب کنید...')
            ->columnSpanFull(),
        Forms\Components\Textarea::make('description')
            ->label('توضیحات')
            ->nullable()
            ->rows(5)
            ->columnSpanFull(),
                                ]),
                    ]),

                Forms\Components\Section::make('تصاویر')
                    ->schema([
                        Forms\Components\FileUpload::make('image_1')
                            ->label('تصویر اول')
                            ->image()
                            ->nullable()
                            ->disk('public')
                            ->directory('products')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('250')
                            ->imageResizeTargetHeight('250'),
                        Forms\Components\FileUpload::make('image_2')
                            ->label('تصویر دوم')
                            ->image()
                            ->nullable()
                            ->disk('public')
                            ->directory('products')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('250')
                            ->imageResizeTargetHeight('250'),
                        Forms\Components\FileUpload::make('image_3')
                            ->label('تصویر سوم')
                            ->image()
                            ->nullable()
                            ->disk('public')
                            ->directory('products')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('250')
                            ->imageResizeTargetHeight('250'),
                    ])->columns(3),
                Forms\Components\Section::make('رنگ‌ها')
                    ->schema([
                        Forms\Components\Select::make('colors')
                            ->label('رنگ‌ها')
                            ->relationship('colors', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()->nullable(),
                    ]),
                Forms\Components\Section::make('سایزها')
                    ->schema([
                        Forms\Components\Select::make('sizes')
                            ->label('سایزها')
                            ->relationship('sizes', 'number')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->nullable(),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_1')
                    ->label('تصویر')
                    ->width(65)
                    ->height(65),
                Tables\Columns\TextColumn::make('name')
                    ->label('نام محصول')
                    ->searchable(),
                Tables\Columns\TextColumn::make('uni_code')
                    ->label('کد محصول')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('دسته‌بندی')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('برند')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت')
                    ->money('IRR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->label('تخفیف')
                    ->suffix('%'),
                Tables\Columns\TextColumn::make('stock')
                    ->label('موجودی')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('فعال')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ایجاد')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('دسته‌بندی')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('brand')
                    ->label('برند')
                    ->relationship('brand', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('وضعیت'),
            ])
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
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
