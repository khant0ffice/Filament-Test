<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use App\Models\Employee;
use Filament\Actions;
use Filament\Forms\Components\Builder;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Database\Schema\Builder as SchemaBuilder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subWeek()))->badge(Employee::query()->where('date_hired', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subMonth()))->badge(Employee::query()->where('date_hired', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subYear()))->badge(Employee::query()->where('date_hired', '>=', now()->subYear())->count()),

        ];
    }
}
