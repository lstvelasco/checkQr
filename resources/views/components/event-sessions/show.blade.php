@if ($eventSession->is_accepting_attendance == true)
    {{-- <x-application-shell> --}}
    {{-- <x-ui.post-card> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div id="reader" class="mx-auto flex flex-col justify-center items-center p-4"
        style="width: 80vw; height: 80vh; max-width: 600px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background-color: #fff;">
        <!-- Your content here -->
    </div>

    {{-- </x-ui.post-card> --}}
    {{-- </x-application-shell> --}}


    <script>
        let isSubmitting = false;

function onScanSuccess(decodedText, decodedResult) {
    if (isSubmitting) return;
    isSubmitting = true;

    // Get the Laravel Blade variables
    const eventId = @json($event->id);
    const eventSessionId = @json($eventSession->id);

    // Create a form element
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/attendance/${eventId}/${eventSessionId}/${decodedText}`;

    // Add CSRF token (required by Laravel for POST requests)
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();

    // Stop the scanner
    if (window.html5QrCode) {
        window.html5QrCode.stop().catch((error) => {
            console.error("Failed to stop the scanner.", error);
        });
    }

    // Optional: Log the result to the console (for debugging purposes)
    console.log(`Submitting form to ${form.action}`, decodedResult);
}





        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endif
