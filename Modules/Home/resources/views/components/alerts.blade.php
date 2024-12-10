<div class="fixed bottom-[30px] right-[30px]">
    <x-alert type="success" class="bg-green-700 text-green-100 p-4 flex items-center gap-2">
        <x-heroicon-o-check-circle class="h-5 w-5" />
        {{ $component->message() }}
    </x-alert>
    <x-alert type="warning" class="bg-yellow-700 text-yellow-100 p-4 flex items-center gap-2">
        <x-heroicon-o-check-circle class="h-5 w-5" />
        {{ $component->message() }}
    </x-alert>
    <x-alert type="danger" class="bg-red-700 text-red-100 p-4 flex items-center gap-2">
        <x-heroicon-o-check-circle class="h-5 w-5" />
        {{ $component->message() }}
    </x-alert>
</div>
