<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$notifications" />

        <main class="h-auto p-4 pt-20 md:ml-64">

            <x-ui.heading>
                @if ($conversation->title == null)
                Messages
                @else
                {{ $conversation->title }}
                @endif
            </x-ui.heading>

            <x-messages.layout>
                <x-messages.messages :messages="$messages" :conversation='$conversation'>

                </x-messages.messages>
            </x-messages.layout>

            <x-footer />
        </main>
    </div>
</x-layout>
