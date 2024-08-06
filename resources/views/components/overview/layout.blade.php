@props(['applications'])

<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    <div class="h-full border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600">
        <x-overview.revenue />
    </div>
    @if (Auth::user()->account_type == 'Photographer' || Auth::user()->account_type == 'Model')
    <div class="h-full border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600">
        <x-overview.application :applications="$applications" />
    </div>
    @endif
</div>
