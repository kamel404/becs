<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry Details')
                    ->schema([
                        TextInput::make('name')
                            ->disabled()
                            ->required(),
                        TextInput::make('email')
                            ->disabled()
                            ->required(),
                        TextInput::make('phone')
                            ->disabled(),
                        TextInput::make('subject')
                            ->disabled(),
                        Textarea::make('message')
                            ->disabled()
                            ->rows(6)
                            ->columnSpanFull(),
                        Toggle::make('is_read')
                            ->label('Mark as read/responded')
                            ->required(),
                    ]),
            ]);
    }
}
