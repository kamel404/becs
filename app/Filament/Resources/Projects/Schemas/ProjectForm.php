<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\ProjectCategory;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Details')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->columnSpan(1),

                            Select::make('project_category_id')
                                ->label('Category')
                                ->options(ProjectCategory::pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->columnSpan(1),
                        ]),

                        Grid::make(2)->schema([
                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->columnSpan(1),

                            Select::make('status')
                                ->options([
                                    'ongoing'   => 'Ongoing',
                                    'completed' => 'Completed',
                                ])
                                ->default('ongoing')
                                ->required()
                                ->columnSpan(1),
                        ]),

                        Textarea::make('short_description')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ]),

                Section::make('Project Info')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('client')->default(null),
                            TextInput::make('location')->default(null),
                        ]),
                        Grid::make(2)->schema([
                            DatePicker::make('completion_date'),
                            Toggle::make('is_featured')
                                ->label('Featured on homepage')
                                ->default(false),
                        ]),
                    ]),

                Section::make('Featured Image')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->image()
                            ->disk('public')
                            ->directory('projects')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
