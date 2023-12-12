<?php

namespace Pardalsalcap\LinterTestimonials\Resources\TestimonialResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Pardalsalcap\LinterTestimonials\Models\Testimoniable;
use Pardalsalcap\LinterTestimonials\Models\Testimonial;

class TestimoniableRelationManager extends RelationManager
{
    protected static string $relationship = 'testimonials';

    protected static ?string $inverseRelationship = 'contents';

    public function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('testimonial_type')
                    ->label(__('linter-testimonials::testimonial.testimonial_type_column')),
                Tables\Columns\TextColumn::make('commenter_name')
                    ->formatStateUsing(function (Testimonial $model) {
                        return $model->commenter_name;
                    })
                    ->label(__('linter-testimonials::testimonial.commenter_name_field')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->recordSelect(
                        fn () => Select::make('recordId')
                            ->options(function () {
                                return Testimonial::whereNotIn('testimonials.id',
                                    Testimoniable::where('testimoniable_type', $this->ownerRecord::class)
                                        ->where('testimoniable_id', $this->ownerRecord->id)
                                        ->pluck('testimonial_id')
                                )
                                    ->pluck('commenter_name', 'testimonials.id');

                            })
                    )
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('testimonial_type')
                            ->required()
                            ->label(__('linter-testimonials::testimonial.testimonial_type_field')),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('linter-testimonials::testimonial.relation_testimonial_title');
    }

    public static function getModelLabel(): string
    {
        return __('linter-testimonials::testimonial.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('linter-testimonials::testimonial.model_label_plural');
    }
}
