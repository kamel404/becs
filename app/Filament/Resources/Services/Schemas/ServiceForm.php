<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Service Details')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->columnSpan(1),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->columnSpan(1),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('icon')
                                ->label('Icon class (e.g. fas fa-cubes)')
                                ->placeholder('fas fa-cubes')
                                ->default(null)
                                ->columnSpan(1),

                            TextInput::make('order')
                                ->label('Display Order')
                                ->numeric()
                                ->default(0)
                                ->required()
                                ->columnSpan(1),
                        ]),

                        Textarea::make('short_description')
                            ->label('Short Description (shown on home page)')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->label('Full Description')
                            ->columnSpanFull(),
                    ]),

                Section::make('Service Image')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('services')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
