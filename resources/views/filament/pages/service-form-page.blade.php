<x-filament::card class="p-6 space-y-4">

    <h1 class="text-2xl font-bold mb-4">{{ $this->getHeader() }}</h1>
    <p class="text lead mb-4">{{ $this->getDescription() }}</p>

    <form wire:submit="submit" class="space-y-6" wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="flex justify-end">
            <x-filament::button wire:click="submit" style="float: right; margin-top:10px">
                Submit
            </x-filament::button>
        </div>

    </form>

</x-filament::card>

{{--
<div class="flex justify-end">
    <x-filament::button type="submit"
        class="px-4 py-2 border border-white text-white bg-transparent rounded-lg hover:bg-white hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 mt-4">
        Submit
    </x-filament::button>
</div> --}}
