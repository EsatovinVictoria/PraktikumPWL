<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Support\Markdown;
use Tiptap\Core\Mark;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make("Product Details")
                        ->description("Isi informasi produk")
                        ->icon("heroicon-o-information-circle")
                        ->schema([
                            Group::make([
                                TextInput::make("name")
                                    ->required(),
                                TextInput::make("sku")
                                    ->required(),
                            ])->columns(2),
                            MarkdownEditor::make("description")
                        ]),
                    Step::make('Product Price and Stock')
                        ->description('Isi harga produk')
                        ->icon("heroicon-o-currency-dollar")
                        ->schema([
                            Group::make([
                                TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0),
                                TextInput::make('stock')
                                    ->required()
                                    ->numeric(),
                            ])->columns(2),
                            MarkdownEditor::make("description")
                        ]),
                    Step::make('Media and Status')
                        ->description('Isi gambar produk')
                        ->icon("heroicon-o-photo")
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('product'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured')
                        ]),
                        
                ])
                ->columnSpanFull()
                ->submitAction(
                    Action::make('save')
                        ->label('Save Product')
                        ->button()
                        ->color('primary')
                        ->submit('save')
                )
            ]);
    }
}
