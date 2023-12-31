<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Number;
use Gate;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Posts Management';

    protected static ?string $navigationLabel = 'Posts';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Group::make()

            ->schema([

                Forms\Components\Section::make('Details')

                ->schema([

                    Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\Select::make('user_id')
                        ->relationship('author', 'name')
                        ->label('Author')
                        ->options(function () {
                            return [
                                auth()->user()->id => auth()->user()->name,
                            ];
                        })
                        // ->options(auth()->user()->name)
                        // ->disabled()
                        ->dehydrated(),
                        Forms\Components\Section::make('Tags(Comma Separated)')
                    ->schema([
                        Forms\Components\TextInput::make('tags')
                        ->required(),
                    ]),
                    Forms\Components\MarkdownEditor::make('body')
                        ->required(),
                    Forms\Components\TextInput::make('comments_count')
                        ->default(0)
                        ->hidden()
                        ->rules('numeric'),

                    Forms\Components\Section::make('Associations')
                        ->schema([
                            Forms\Components\Select::make('categories')
                                ->relationship('category', 'name')
                                ->multiple()
                                ->required()
                                ->options(function () {
                                    return Category::pluck('name', 'id');
                                }),
                        ]),

                ])->columnSpanFull()

            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tags')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('upvote')
                    ->sortable(),
                Tables\Columns\TextColumn::make('body')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->searchable()
                    // ->dateTime() // mm/dd/yyyy format
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
