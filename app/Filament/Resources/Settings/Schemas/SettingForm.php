<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Setting')
                    ->schema([
                        TextInput::make('key')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Setting keys are predefined and cannot be changed.'),

                        Textarea::make('value')
                            ->label('Value')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
