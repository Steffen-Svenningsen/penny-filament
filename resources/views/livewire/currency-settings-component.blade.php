<div>

    <style>
        .fi-form-actions {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
        }
    </style>

    <form wire:submit="save">
        {{ $this->form }}

        <div class="fi-form-actions">
            <div>
                <x-filament::button type="submit">
                    {{ __('filament-edit-profile::default.save') }}
                </x-filament::button>
            </div>
        </div>
    </form>

    <x-filament-actions::modals />
</div>
