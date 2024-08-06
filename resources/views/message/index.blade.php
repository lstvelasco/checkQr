<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">

            {{-- <div class="flex justify-between">
                <x-ui.heading>
                    Messages
                </x-ui.heading>
                <x-messages.search />

            </div> --}}
            
                <x-ui.heading>
                    Messages
                </x-ui.heading>




            <x-messages.layout>
                <x-messages.conversations :conversations="$conversations">

                </x-messages.conversations>
            </x-messages.layout>


            <x-footer />
        </main>
    </div>
</x-layout>
