// public/js/script.js

// Configure Toastr options once
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
};

// Function to show toastr messages
function showToastrMessages(success, error, errorsArray) {
    // Only show if the success message is a non-empty string
    if (success && typeof success === 'string' && success.length > 0) {
        toastr.success(success);
    }

    // Only show if the error message is a non-empty string
    if (error && typeof error === 'string' && error.length > 0) {
        toastr.error(error);
    }

    // Check if errorsArray is an array and has items
    if (Array.isArray(errorsArray) && errorsArray.length > 0) {
        errorsArray.forEach(function(err) {
            // Ensure the error message itself is a string before displaying
            if (typeof err === 'string' && err.length > 0) {
                toastr.error(err);
            }
        });
    }
}

// Call automatically after DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    // Check for the global object defined by Blade
    if (window.laravelData) {
        showToastrMessages(
            window.laravelData.success,
            window.laravelData.error,
            window.laravelData.errors
        );
    }
});
document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.getElementById('email');
    const savedEmail = localStorage.getItem('email');
    if (savedEmail) {
        emailInput.value = savedEmail;
    }
    emailInput.addEventListener('change', () => {
        const email = emailInput.value.trim();
        if (email) {
            localStorage.setItem('email', email);
        }
    });
});

