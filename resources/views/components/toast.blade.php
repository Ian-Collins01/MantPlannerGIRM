<!-- Toast Container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <!-- Success Toast -->
    @if ($successMessage)
        <div id="liveToastSuccess" class="toast bg-success text-white border-0 shadow-lg" role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Éxito</strong>
                <small>Ahora</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $successMessage }}
            </div>
        </div>
    @endif

    <!-- Error Toast -->
    @if (count($errors) > 0)
        <div id="liveToastError" class="toast bg-danger text-white border-0 shadow-lg" role="alert"
             aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Error</strong>
                <small>Ahora</small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>

<script src="{{ asset('js/toastMessage.js') }}"></script>
