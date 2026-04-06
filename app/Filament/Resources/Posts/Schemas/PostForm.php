<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Filament\Support\Markdown;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    // icon(Heroicon::RocketLaunch)
                    ->icon("heroicon-o-document-text")
                    ->schema([
                    Group::make([
                        TextInput::make("title")
                            ->rules(['required', 'min:5'])
                            ->validationMessages([
                                'required' => 'Perlu judul bro',
                            ]), 
                        TextInput::make("slug")
                            ->unique()
                            ->rules('required', 'min:3')
                            ->validationMessages([
                                'unique' => 'The slug must be unique.'
                            ]),
                        Select::make("category_id")
                            ->relationship("category", "name")
                            ->preload()
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Jangan sampe kosong bro',
                            ]),
                        ColorPicker::make("color"),
                    ])->columns(2),

                        MarkdownEditor::make("content")
                        ->maxHeight("6vh"),
                    ])->columnSpan(2),
                    
                // RichEditor::make("content"),

                Group::make([
                    // section 2 - image
                    Section::make("Image Upload")
                    ->icon("heroicon-o-photo")
                    ->schema([
                        FileUpload::make("image")
                            ->disk("public")
                            ->directory("posts")
                            ->visibility("public")
                            ->image()
                            ->required(),
                    ]),

                    // section 3 - meta
                    Section::make("Meta Information")
                    ->icon("heroicon-o-tag")
                    ->schema([
                        TagsInput::make("tags"),
                        Checkbox::make("published"),
                    ])
                ])->columnSpan(1),

                DatePicker::make("published_at")
                ->columnSpanFull(),
            ])->columns(3);
    }
}
