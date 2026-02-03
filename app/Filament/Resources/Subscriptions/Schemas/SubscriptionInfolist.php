<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class SubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->heading('Subscription Details')
                    ->columnSpanFull()
                    ->components([
                        TextEntry::make('name'),
                        TextEntry::make('price')
                            ->money(fn () => Auth::user()->currency),
                        TextEntry::make('bill_date')
                            ->date(),
                        TextEntry::make('formatted_cycle')
                            ->label('Cycle'),
                        IconEntry::make('status')
                            ->boolean(),
                    ])->columns(2),
                Section::make()
                    ->heading('Additional Information')
                    ->columnSpanFull()
                    ->collapsed()
                    ->components([
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
