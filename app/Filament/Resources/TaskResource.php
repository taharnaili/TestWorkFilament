<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Hidden;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Components\Button;



class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny(): bool
    {
        return auth()->user()->can('viewProjects', User::class);
    }

    public static function form(Form $form): Form
    {

        $user = Auth::user();

        return $form
            ->schema([

                TextInput::make('name')
                ->required()
                ->minLength(3)
                ->maxLength(27),



                MarkdownEditor::make('description')
                ->required()
                ->minLength(3),

              BelongsToSelect::make('project_id')
                    ->relationship('project', 'name')
                    ->options(function () use ($user) {
                        // Recupéré les projets créés par l'utilisateur connecté
                        return Project::where('user_id', $user->id)->get()->pluck('name', 'id');
                    })
                    ->required(),

                Select::make('status')
                ->options([
                        'pending' => 'Pending',
                        'in-progress'=> 'in-progress',
                        'completed' => 'Completed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                TextColumn::make('project.name')->label('Project'),
                TextColumn::make('status')
                 ->url(function (Task $record) {
            return route('task.modal',compact('record'));
        })
             ])
            //afficher seuelement les tasks de utilisateurs par tout les tasks

            ->filters([
                Tables\Filters\Filter::make('own_tasks')
                    ->query(fn (Builder $query) => $query->whereHas('project', fn ($q) => $q->where('user_id', Auth::id())))
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
