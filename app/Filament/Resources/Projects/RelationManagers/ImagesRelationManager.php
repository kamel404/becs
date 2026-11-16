<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $title = 'Gallery';

    protected static ?string $modelLabel = 'image';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle('image')
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->height(80)
                    ->width(120),

                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->since(),
            ])
            ->reorderable('order')
            ->defaultSort('order')
            ->paginated(false)
            ->emptyStateHeading('No gallery images yet')
            ->emptyStateDescription('Upload images to show them as thumbnails on the project page.')
            ->headerActions([
                Action::make('upload')
                    ->label('Upload images')
                    ->icon(Heroicon::OutlinedArrowUpTray)
                    ->modalHeading('Upload gallery images')
                    ->modalSubmitActionLabel('Add to gallery')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Images')
                            ->helperText('You can select several images at once. Max 10 MB each.')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('projects/gallery')
                            ->maxSize(10240)
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $project = $this->getOwnerRecord();
                        $order = (int) $project->images()->max('order');

                        foreach ($data['images'] as $path) {
                            $project->images()->create([
                                'image' => $path,
                                'order' => ++$order,
                            ]);
                        }

                        Notification::make()
                            ->title(count($data['images']) . ' image(s) added to the gallery')
                            ->success()
                            ->send();
                    }),
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
