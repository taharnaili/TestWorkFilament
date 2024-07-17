<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Hidden;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    public static function canViewAny(): bool
    {
        return auth()->user()->can('viewProjects', User::class);
    }

    public static function form(Form $form): Form
    {

        $user = Filament::auth()->getUser();

        return $form
            ->schema([

                Hidden::make('user_id')
                ->default($user->getKey()),


                 TextInput::make('name')
                ->required()
                ->minLength(3)
                ->maxLength(27),

                MarkdownEditor::make('description')
                ->required(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                   TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('user.name'),
                TextColumn::make('created_at'),
            ])
            ->filters([
                //Listé les projets par users .

                 Tables\Filters\Filter::make('own_projects')
                    ->query(fn (Builder $query) => $query->where('user_id', Auth::id()))
                    ->default(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
