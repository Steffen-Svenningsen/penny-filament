<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->placeholder('e.g., Netflix, Spotify')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->prefix(fn () => Auth::user()->currency),
                DatePicker::make('bill_date')
                    ->required()
                    ->default(today())
                    ->native(false),
                Select::make('cycle')
                    ->options([
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                        'weekly' => 'Weekly',
                        'daily' => 'Daily',
                    ])
                    ->default('monthly')
                    ->required()
                    ->native(false),
                Select::make('status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ])
                    ->default(1)
                    ->native(false)
                    ->required(),
                Select::make('color')
                    ->options([
                        'red' => 'Red',
                        'blue' => 'Blue',
                        'green' => 'Green',
                        'yellow' => 'Yellow',
                        'purple' => 'Purple',
                        'orange' => 'Orange',
                        'pink' => 'Pink',
                        'gray' => 'Gray',
                    ])
                    ->native(false)
                ,
            ]);
    }
}
