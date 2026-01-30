<x-filament-widgets::widget class="subscription-create-shortcut">

    <style>
        .subscription-create-shortcut-section {
            min-height: 92px;
        }

        .subscription-create-shortcut-section .fi-section-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .subscription-create-shortcut-section:hover {
            background-color: oklch(0.985 0 0);
        }

        .subscription-create-shortcut-section h1 {
            line-height: 24px;
        }

        .subscription-create-shortcut-section p {
            color: oklch(0.552 0.016 285.938);
        }

        .subscription-create-shortcut-section .heroicon {
            min-width: 40px;
            min-height: 40px;
            color: oklch(0.705 0.015 286.067);
            display: grid;
            place-items: center;
        }
    </style>

    <a href="{{ route('filament.app.resources.subscriptions.create') }}">
        <x-filament::section class="subscription-create-shortcut-section">
            <div class="heroicon">
                <x-heroicon-o-arrow-path-rounded-square />
            </div>
            <div>
                <h1 style="font-weight: bold; font-size: 16px;">{{ __('Create a subscription') }}</h1>
                <p>{{ __('Click here to create a subscription') }}</p>
            </div>
        </x-filament::section>
    </a>

</x-filament-widgets::widget>
