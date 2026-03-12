<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENTALWALA - Vendor Sign In</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rental-dark': '#143452', // Dark Blue
                        'rental-accent': '#20BF9B', // Teal/Aqua
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-white flex items-center justify-center min-h-screen">
    <div id="session-data" 
     data-success="{{ session('success') }}" 
     data-error="{{ session('error') }}" 
     data-errors="{{ $errors->any() ? implode(',', $errors->all()) : '' }}">
</div>
    <div class="flex flex-col md:flex-row w-full min-h-screen md:h-screen bg-white overflow-hidden">

        <div class="w-full h-1/3 md:w-1/2 md:max-w-md lg:max-w-lg md:h-full bg-rental-dark text-white flex items-center justify-center p-8 flex-shrink-0">
            <div class="text-center">
                <img src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}" alt="Rentalwala Logo" class="max-w-xs">
                <p class="mt-4 text-rental-accent font-medium tracking-widest uppercase text-sm">Vendor Partnership</p>
            </div>
        </div>

        <div class="w-full min-h-2/3 md:flex-grow flex items-center justify-center p-6 md:p-12">
            <form action="{{ route('vendor.login.post') }}" method="POST" class="w-full max-w-sm">
                @csrf

                <h2 class="text-3xl font-semibold text-gray-800 mb-2">Vendor Login</h2>
                <p class="text-gray-500 mb-8 font-medium">તમારી દુકાનનું બુકિંગ મેનેજ કરવા માટે લોગિન કરો.</p>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">E-Mail Address (ઈમેઈલ)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-envelope text-xs"></i>
                        </span>
                        <input type="email" id="email" name="email" required placeholder="Enter shop email" 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rental-dark/20 focus:border-rental-dark transition">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password (પાસવર્ડ)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-lock text-xs"></i>
                        </span>
                        <input type="password" id="password" name="password" required placeholder="Enter your password"
                            class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-rental-dark/20 focus:border-rental-dark transition">

                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-rental-dark">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-8 p-3 bg-blue-50 border-l-4 border-rental-dark rounded-r-md">
                    <div class="flex">
                        <i class="fas fa-info-circle text-rental-dark mt-0.5 mr-2 text-xs"></i>
                        <p class="text-[11px] text-gray-600 leading-tight">
                            જો તમે પાસવર્ડ ભૂલી ગયા હોવ, તો કૃપા કરીને રીસેટ કરવા માટે <strong>સિસ્ટમ એડમિન</strong> નો સંપર્ક કરો.
                        </p>
                    </div>
                </div>

                <button type="submit"
                    class="group w-full bg-rental-dark py-3 px-4 text-white font-bold rounded-md shadow-lg hover:bg-opacity-90 transition duration-300 flex items-center justify-center space-x-2">
                    <span>LOGIN NOW</span>
                    <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const icon = togglePassword.querySelector('i');

        // શો/હાઈડ પાસવર્ડ લોજિક
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
<script>
$(document).ready(function() {
    toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
    // HTML માંથી ડેટા ખેંચો
    const sessionDiv = $('#session-data');
    const successMsg = sessionDiv.data('success');
    const errorMsg = sessionDiv.data('error');
    const validationErrors = sessionDiv.data('errors');

    // ૧. જો સક્સેસ મેસેજ હોય
    if (successMsg) {
        toastr.success(successMsg);
    }

    // ૨. જો સિંગલ એરર હોય (Wrong password)
    if (errorMsg) {
        toastr.error(errorMsg);
    }

    // ૩. જો વેલિડેશન એરર્સ હોય
    if (validationErrors) {
        const errorArray = validationErrors.split(',');
        errorArray.forEach(function(msg) {
            toastr.error(msg);
        });
    }
});
</script>
</body>

</html>