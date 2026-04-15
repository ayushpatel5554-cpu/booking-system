<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENTALWALA - Admin Sign In</title>

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
                        'rental-dark': '#143452  ', // Dark Blue
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
    <script src="{{ asset('js/script.js') }}"></script>

    <div class="flex flex-col md:flex-row w-full min-h-screen md:h-screen bg-white overflow-hidden">

        <div class="w-full h-1/3 md:w-1/2 md:max-w-md lg:max-w-lg md:h-full bg-rental-dark text-white flex items-center justify-center p-8 flex-shrink-0">
            <div class="text-center p-5 bg-rental-dark rounded-lg"> <img src="{{ asset('rental_admin.png') }}" alt="Logo" class="mix-blend-lighten inv ert">
            </div>
        </div>

        <div class="w-full min-h-2/3 md:flex-grow flex items-center justify-center p-6 md:p-12">
            <form action="{{ route('admin.login') }}" method="POST" class="w-full max-w-sm">
                @csrf

                <h2 class="text-3xl font-semibold text-gray-800 mb-2">Admin Login In</h2>
                <p class="text-gray-500 mb-5">Access the RENTALWALLA management dashboard.</p>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-Mail</label>
                    <input type="email" id="email" name="email" placeholder="Enter your E-Mail"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-rental-dark">
                </div>

                <div class="mb-8">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Enter your Password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-rental-dark pr-10">

                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="group  text-center a py-3  mx-32  text-white font-semibold rounded-md  transition duration-300   focus:ring-rental-dark focus:ring-opacity-50 flex items-center justify-center">

                    <img src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}"
                        alt="Sign in"
                        class="h-24 w-auto mr-2 transition duration-300 
                group-hover:filter group-hover:brightness-0 group-hover:invert-50">
                </button>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const icon = togglePassword.querySelector('i');

        // ૧. પેજ લોડ થાય ત્યારે ચેક કરો કે લોકલ સ્ટોરેજમાં પાસવર્ડ છે કે નહીં
        window.onload = function() {
            const savedPassword = localStorage.getItem('user_password');
            if (savedPassword) {
                passwordInput.value = savedPassword;
            }
        };

        // ૨. જ્યારે યુઝર પાસવર્ડ ટાઈપ કરે ત્યારે તેને સેવ કરો
        passwordInput.addEventListener('input', function() {
            localStorage.setItem('user_password', passwordInput.value);
        });

        // ૩. શો/હાઈડ પાસવર્ડ લોજિક (તમારા બટન માટે)
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // આઈકોન બદલવા માટે
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