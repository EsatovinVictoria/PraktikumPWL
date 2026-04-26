<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Schemas\Components\Image;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Symfony\Component\Console\Color;


class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title")
                    ->sortable(),
                TextColumn::make("slug")
                    ->sortable(),
                TextColumn::make("category.name")
                    ->sortable(),
                ColorColumn::make("color"),
                IconColumn::make("published")
                    ->boolean(),
                ImageColumn::make("image")
                    ->disk("public"),
                TextColumn::make("created_at")
                    ->label("Created At")
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort("created_at", "desc")
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
