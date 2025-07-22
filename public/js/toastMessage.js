document.addEventListener('DOMContentLoaded', function () {
    // Mostrar el toast de éxito
    const toastElementSuccess = document.getElementById('liveToastSuccess');
    if (toastElementSuccess) {
        const successMessage = toastElementSuccess.querySelector('.toast-body').textContent.trim();
        if (successMessage) {
            const toastBootstrapSuccess = bootstrap.Toast.getOrCreateInstance(toastElementSuccess);
            toastBootstrapSuccess.show();
        }
    }

    // Mostrar el toast de error
    const toastElementError = document.getElementById('liveToastError');
    if (toastElementError) {
        const errorMessages = toastElementError.querySelector('.toast-body').innerHTML.trim();
        if (errorMessages) {
            const toastBootstrapError = bootstrap.Toast.getOrCreateInstance(toastElementError);
            toastBootstrapError.show();
        }
    }
});
