@if (session('toast_success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast('toast-success', 'animate-slide-in', 'animate-slide-out');
        });
    </script>
@endif

@if (session('toast_danger'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast('toast-danger', 'animate-slide-in', 'animate-slide-out');
        });
    </script>
@endif

@if (session('toast_warning'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showToast('toast-warning', 'animate-slide-in', 'animate-slide-out');
        });
    </script>
@endif

<div id="toast-success"
    class="fixed flex items-center hidden w-full max-w-xs p-4 mb-4 text-gray-500 bg-white border border-green-300 rounded-lg shadow-lg bottom-4 right-4 z-60 dark:text-gray-400 dark:bg-gray-800 dark:border-green-700"
    role="alert">
    <div
        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
        </svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="text-sm font-normal ms-3">{{ session('toast_success') }}</div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>

<div id="toast-danger"
    class="fixed flex items-center hidden w-full max-w-xs p-4 mb-4 text-gray-500 bg-white border border-red-300 rounded-lg shadow-lg bottom-4 right-4 z-60 dark:text-gray-400 dark:bg-gray-800 dark:border-red-700"
    role="alert">
    <div
        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
        </svg>
        <span class="sr-only">Error icon</span>
    </div>
    <div class="text-sm font-normal ms-3">{{ session('toast_danger') }}</div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#toast-danger" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>

<div id="toast-warning"
    class="fixed flex items-center hidden w-full max-w-xs p-4 mb-4 text-gray-500 bg-white border border-orange-300 rounded-lg shadow-lg bottom-4 right-4 z-60 dark:text-gray-400 dark:bg-gray-800 dark:border-orange-700"
    role="alert">
    <div
        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
        </svg>
        <span class="sr-only">Warning icon</span>
    </div>
    <div class="text-sm font-normal ms-3">{{ session('toast_warning') }}</div>
    <button type="button"
        class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
        data-dismiss-target="#toast-warning" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
    </button>
</div>

<script>
   function showToast(id, inAnimation, outAnimation) {
    const toast = document.getElementById(id);
    if (toast) {
        toast.classList.remove('hidden');
        toast.classList.add(inAnimation);

        // Adjust the bottom position dynamically to stack toasts
        const toasts = document.querySelectorAll('[id^="toast-"]');
        let offset = 0;
        toasts.forEach(t => {
            t.style.bottom = `${offset}px`;
            offset += t.offsetHeight + 16; // Adjust for height of the toast and margin
        });

        setTimeout(() => {
            toast.classList.remove(inAnimation);
            toast.classList.add(outAnimation);

            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove(outAnimation);
            }, 500); // Match the duration of the slide-out animation
        }, 3000); // Display duration
    }
}

</script>

