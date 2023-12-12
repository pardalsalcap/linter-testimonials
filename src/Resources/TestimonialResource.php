<?php

namespace Pardalsalcap\LinterTestimonials\Resources;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Pardalsalcap\LinterTestimonials\Models\Testimonial;
use Pardalsalcap\LinterTestimonials\Resources\TestimonialResource\Pages\CreateTestimonial;
use Pardalsalcap\LinterTestimonials\Resources\TestimonialResource\Pages\EditTestimonial;
use Pardalsalcap\LinterTestimonials\Resources\TestimonialResource\Pages\ListTestimonials;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 600;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('commenter_name')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->required()
                            ->label(__('linter-testimonials::testimonial.commenter_name_field')),
                        TextInput::make('commenter_position')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->required()
                            ->label(__('linter-testimonials::testimonial.commenter_position_field')),
                        TextInput::make('commenter_company')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->required()
                            ->label(__('linter-testimonials::testimonial.commenter_company_field')),
                        Textarea::make('comment')
                            ->required()
                            ->minLength(3)
                            ->maxLength(255)
                            ->required()
                            ->label(__('linter-testimonials::testimonial.comment_field')),
                        TextInput::make('position')
                            ->required()
                            ->numeric()
                            ->required()
                            ->label(__('linter-testimonials::testimonial.position_field')),
                        Select::make('lang')
                            ->options(config('linter.available_locales'))
                            ->default(app()->getLocale())
                            ->required()
                            ->label(__('linter-testimonials::testimonial.lang_field')),
                        Toggle::make('status')
                            ->label(__('linter-testimonials::testimonial.status_field')),
                        Toggle::make('real')
                            ->label(__('linter-testimonials::testimonial.real_field')),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('commenter_name')
                    ->label(__('linter-testimonials::testimonial.commenter_name_field'))
                    ->searchable(),
                TextColumn::make('commenter_company')->description(fn (Model $record): string => $record->commenter_position)
                    ->label(__('linter-testimonials::testimonial.commenter_company_field'))
                    ->searchable(),
                TextColumn::make('comment')->limit(50)
                    ->label(__('linter-testimonials::testimonial.comment_field'))
                    ->searchable(),
                TextColumn::make('lang')
                    ->label(__('linter-testimonials::testimonial.language_field'))
                    ->formatStateUsing(fn (string $state): string => config('linter.available_locales.'.$state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('linter-testimonials::testimonial.navigation');
    }

    public static function getModelLabel(): string
    {
        return __('linter-testimonials::testimonial.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('linter-testimonials::testimonial.model_label_plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('linter-testimonials::testimonial.navigation_group');
    }
}
