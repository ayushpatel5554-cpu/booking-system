<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings | Rentalwala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sidebar-bg': '#212529',
                        'accent-color': '#ffc107',
                        'rental-dark': '#192A56',
                        'primary-text': '#333333',
                    },
                    spacing: { 'sidebar': '250px' }
                }
            }
        }
    </script>
    <style>
        .main-content { margin-left: 250px; }
        .nav-link-active { @apply bg-white bg-opacity-10 text-accent-color border-l-4 border-accent-color font-semibold; }
        @media (max-width: 1023px) { .main-content { margin-left: 0; } }
    </style>
</head>

<body class="bg-gray-100 min-h-screen text-primary-text">

    <aside class="sidebar fixed top-0 left-0 w-sidebar h-screen bg-sidebar-bg text-white p-6 hidden lg:flex flex-col z-20">
        <div class="logo text-center mb-0">
            <img class="w-100 h-100 -mt-10 mx-auto object-contain" src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}" alt="Rentalwala Logo">
        </div>

        <ul class="flex flex-col space-y-2">
            <li><a class="flex items-center p-3 rounded-md hover:bg-white hover:bg-opacity-10 transition" href="/admin/dashboard"><i class="fas fa-chart-line fa-fw mr-3"></i> Dashboard</a></li>
            <li><a class="flex items-center p-3 rounded-md hover:bg-white hover:bg-opacity-10 transition" href="{{ route('admin.vendors') }}"><i class="fas fa-user-tie fa-fw mr-3"></i> Vendors</a></li>
            <li><a class="nav-link-active flex items-center p-3 rounded-md transition" href="#"><i class="fas fa-tools fa-fw mr-3"></i> Settings</a></li>
        </ul>

        <div class="mt-auto pt-4 border-t border-gray-600">
            <a href="/admin-logout" class="text-red-400 hover:text-red-300 flex items-center p-3 rounded-md transition">
                <i class="fas fa-sign-out-alt fa-fw mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content p-4 sm:p-6 lg:p-10">
        <header class="flex justify-between items-center mb-10 pb-4 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-rental-dark">System Settings</h1>
            <div class="flex items-center space-x-3">
                <span class="hidden sm:inline text-gray-600 font-medium">welcome, {{session('admin.email')}}</span>
                <img src="https://ui-avatars.com/api/?name={{ session('admin.email') }}&background=192A56&color=fff" alt="Avatar" class="rounded-full border-2 border-accent-color w-10 h-10">
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="bg-white p-6 rounded-lg shadow-lg border-t-4 border-red-500">
                <h2 class="text-xl font-bold mb-6 text-gray-700">
                    <i class="fas fa-user-shield mr-2 text-red-500"></i> Admin Security
                </h2>
                <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-4">
    @csrf
    
    <div>
        <label class="block text-sm font-semibold text-gray-600">New Password</label>
        <input type="password" name="new_password" required 
               class="w-full mt-1 p-3 border rounded-md focus:ring-2 focus:ring-red-500 outline-none" 
               placeholder="New Password">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-600">Confirm New Password</label>
        <input type="password" name="new_password_confirmation" required 
               class="w-full mt-1 p-3 border rounded-md focus:ring-2 focus:ring-red-500 outline-none" 
               placeholder="Confirm New Password">
    </div>

    <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded-md hover:bg-red-700 transition">
        Update Admin Password
    </button>
</form>
            </div>

           

        </div>

        <div class="mt-10 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 rounded-md">
            <p class="text-sm">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Note:</strong> Settings updated here will reflect across the RentFlow booking system and customer-facing pages.
            </p>
        </div>
    </main>

    @if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

</body>
</html>