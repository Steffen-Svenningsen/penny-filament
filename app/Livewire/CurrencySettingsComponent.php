<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;

class CurrencySettingsComponent extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    public static function getSort(): int
    {
        return 1;
    }

    public function mount(): void
    {
        $this->form->fill([
            'currency' => Auth::user()->currency,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Currency Settings')
                    ->description('Choose your preferred currency for displaying prices')
                    ->schema([
                        Select::make('currency')
                            ->label('Preferred Currency')
                            ->options([
                                'USD' => '$ (USD)',
                                'EUR' => '€ (EUR)',
                                'GBP' => '£ (GBP)',
                                'JPY' => '¥ (JPY)',
                                'DKK' => 'kr (DKK)',
                                'SEK' => 'kr (SEK)',
                                'NOK' => 'kr (NOK)',
                                'CAD' => '$ (CAD)',
                                'AUD' => '$ (AUD)',
                            ])
                            ->required()
                            ->native(false),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        Auth::user()->update([
            'currency' => $data['currency'],
        ]);

        Notification::make()
            ->success()
            ->title('Currency updated')
            ->body('Your preferred currency has been saved.')
            ->send();
    }

    public function render()
    {
        return view('livewire.currency-settings-component');
    }
}
