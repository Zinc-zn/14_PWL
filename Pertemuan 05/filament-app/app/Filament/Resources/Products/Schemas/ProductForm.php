<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Product Info')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Group::make()->schema([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->label('SKU')
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make('description')
                                ->required()
                                ->columnSpanFull(),
                        ]),
                    Step::make('Pricing & Stock')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->minValue(1),
                            TextInput::make('stock')
                                ->required()
                                ->numeric(),
                        ]),
                    Step::make('Media & Status')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->image()
                                ->disk('public')
                                ->directory('products'),
                            Checkbox::make('is_active')
                                ->default(true),
                            Checkbox::make('is_featured')
                                ->default(false),
                        ]),
                ])
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->color('primary')
                        ->submit('save')
                )
                ->columnSpanFull()
            ]);
    }
}
