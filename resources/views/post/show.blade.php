<x-layout>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <x-navbar>
        </x-navbar>

        <!-- Sidebar -->

        <x-sidebar :notifications="$activities" />

        <main class="h-auto p-4 pt-20 md:ml-64">
            <div class="flex justify-between">
                <x-ui.heading>
                    Feed
                </x-ui.heading>
                @auth
                    <x-post />
                @endauth
            </div>

            <div class="min-h-[61vh] md:min-h-[65vh]">
                <x-post.post :post="$post"></x-post.post>
            </div>

            <x-footer />
        </main>
    </div>
</x-layout>
