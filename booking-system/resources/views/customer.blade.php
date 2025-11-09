<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management | Rentalwala Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        // Custom color configuration for Tailwind
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sidebar-bg': '#212529', // Dark Gray
                        'accent-color': '#ffc107', // Amber/Yellow
                        'rental-dark': '#192A56', // Custom primary color
                        'primary-text': '#333333', // Darker text for readability
                    },
                    spacing: {
                        'sidebar': '250px', // Custom width variable
                    }
                }
            }
        }
    </script>
    <style>
        /* Base styles for the main layout */
        .main-content {
            margin-left: 250px;
        }

        /* Active sidebar link styling (mimicking a clean selection state) */
        .nav-link-active {
            @apply bg-white bg-opacity-10 text-accent-color border-l-4 border-accent-color font-semibold;
        }

        /* Custom style for the modal to be fixed on top */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Responsive adjustment for small screens */
        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen text-primary-text">

    <aside class="sidebar fixed top-0 left-0 w-sidebar h-screen bg-sidebar-bg text-white p-6 hidden lg:flex flex-col z-20">
        <div class="logo text-center mb-0">
            <img
                class=" w-100 h-100 -mt-10 mx-auto object-contain"
                src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}"
                alt="Rentalwala Logo">
        </div>

        <ul class="flex flex-col space-y-2">
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/dashboard">
                    <i class="fas fa-tachometer-alt fa-fw w-5 mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/totalbooking">
                    <i class="fas fa-calendar-check fa-fw w-5 mr-3"></i> Total Booking
                </a>
            </li>
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/allcholi">
                    <i class="fas fa-tshirt fa-fw w-5 mr-3"></i> All Choli
                </a>
            </li>
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/bridalcholi">
                    <i class="fas fa-tshirt fa-fw w-5 mr-3"></i> Bridal Choli
                </a>
            </li>
            <li>
                <a class="nav-link-active flex items-center p-3 rounded-md transition duration-150" href="/admin/customer">
                    <i class="fas fa-users fa-fw w-5 mr-3"></i> Customers
                </a>
            </li>
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="#">
                    <i class="fas fa-cog fa-fw w-5 mr-3"></i> Settings
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-4 border-t border-gray-600">
            <a href="/admin-logout" class="text-red-400 hover:text-red-300 flex items-center p-3 rounded-md transition duration-150">
                <i class="fas fa-sign-out-alt fa-fw w-5 mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content p-4 sm:p-6 lg:p-10">
        <nav class="bg-white shadow lg:hidden mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between h-16">
                    <span class="text-xl font-bold">
                        <img src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}" alt="Logo" class="h-20 w-auto inline mr-2 object-contain">
                    </span>

                    <button
                        type="button"
                        class="md:hidden p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu-content"
                        aria-expanded="false"
                        onclick="toggleMobileMenu()">
                        <i class="fas fa-bars h-6 w-6" id="menu-icon-open"></i>

                        <i class="fas fa-times h-6 w-6 hidden" id="menu-icon-close"></i>
                    </button>
                </div>
            </div>

            <div
                class="fixed inset-0 z-50 bg-gray-900 bg-opacity-95 transform transition-transform duration-300 ease-in-out md:hidden"
                id="mobile-menu-overlay"
                style="transform: translateX(100%);">

                <div
                    class="bg-gray-800 w-3/4 h-full shadow-2xl overflow-y-auto"
                    id="mobile-menu-content">

                    <div class="flex items-center justify-between p-4 border-b border-gray-700">
                        <div class="text-2xl font-bold text-white">RENTALWALLA</div>
                        <button onclick="toggleMobileMenu()" class="text-gray-400 hover:text-white transition duration-150">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>

                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-white">

                        <a class="bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium transition duration-150" href="/dashboard">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>

                        <div class="pt-2">
                            <div class="text-xs font-semibold uppercase text-gray-400 px-3 py-1">Operations</div>

                            <a class="text-yellow-400 hover:bg-gray-700 hover:text-accent-color block px-3 py-2 rounded-md transition duration-150" href="/admin/totalbooking">
                                <i class="fas fa-calendar-check fa-fw mr-3"></i> Total Bookings
                            </a>

                            <a class="text-blue-400 hover:bg-gray-700 hover:text-accent-color block px-3 py-2 rounded-md transition duration-150" href="/admin/upcomingreturns">
                                <i class="fas fa-clock fa-fw mr-3"></i> Upcoming Returns
                            </a>
                        </div>

                        <div class="pt-2">
                            <div class="text-xs font-semibold uppercase text-gray-400 px-3 py-1">Inventory</div>

                            <a class="text-green-400 hover:bg-gray-700 hover:text-accent-color block px-3 py-2 rounded-md transition duration-150" href="/admin/allcholi">
                                <i class="fas fa-tshirt fa-fw mr-3"></i> All Cholis
                            </a>

                            <a class="text-pink-400 hover:bg-gray-700 hover:text-accent-color block px-3 py-2 rounded-md transition duration-150" href="/admin/bridalcholi">
                                <i class="fas fa-crown fa-fw mr-3"></i> Bridal Cholis
                            </a>
                        </div>

                        <div class="pt-2">
                            <div class="text-xs font-semibold uppercase text-gray-400 px-3 py-1">Business</div>

                            <a class="text-teal-400 hover:bg-gray-700 hover:text-accent-color block px-3 py-2 rounded-md transition duration-150" href="/admin/customer">
                                <i class="fas fa-users fa-fw mr-3"></i> Customers
                            </a>

                            <a class="text-orange-400 hover:bg-gray-700 hover:text-accent-color block px-3 py-2 rounded-md transition duration-150" href="/admin/reports">
                                <i class="fas fa-chart-line fa-fw mr-3"></i> Reports
                            </a>
                        </div>


                        <a class="text-red-500 hover:bg-gray-700 hover:text-red-400 block px-3 py-2 rounded-md text-base font-medium border-t border-gray-700 mt-4 pt-4" href="/admin-logout">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <header class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-rental-dark">Customer Management</h1>
            <div class="flex items-center">
                <span class="mr-3 hidden sm:inline text-gray-600 font-medium">Welcome, {{session('admin.email')}}</span>
                <img src="https://picsum.photos/40" alt="Admin Avatar" class="rounded-full border-2 border-accent-color w-10 h-10 object-cover">
            </div>
        </header>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">

            <div class="p-5 border-b border-gray-200 bg-gray-50 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">

                <div class="flex flex-wrap items-center space-x-4">
                    <div class="relative">
                        <input type="text" id="search-input" placeholder="Search by name or phone..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-rental-dark focus:border-rental-dark text-sm w-full sm:w-64">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-xs"></i>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Phone
                            </th>

                            <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody id="table-body" class="divide-y divide-gray-100">
                        @foreach($AllCustomer as $customer)
                        <tr class="odd:bg-white even:bg-gray-50 hover:bg-yellow-50 transition duration-100" data-phone="9876543210">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-rental-dark">
                                {{$customer->customer_name}}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <span class="text-sm font-medium">{{$customer->contact_number}}</span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        title="Delete Customer"
                                        class="text-red-600 hover:text-red-800 text-lg transition duration-150">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="px-4 py-4 flex items-center justify-between border-t border-gray-200 bg-gray-50 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button id="mobile-prev-btn" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100">
                        Previous
                    </button>
                    <button id="mobile-next-btn" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span id="current-start" class="font-medium">1</span> to <span id="current-end" class="font-medium">3</span> of <span id="total-records" class="font-medium">3</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm" aria-label="Pagination">
                            <button id="prev-page-btn" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-100">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left h-5 w-5"></i>
                            </button>
                            <div id="pagination-numbers" class="inline-flex">
                                <button class="relative inline-flex items-center px-4 py-2 border text-sm font-medium bg-rental-dark border-rental-dark text-white">1</button>
                            </div>
                            <button id="next-page-btn" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-100">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right h-5 w-5"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script>
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobile-menu-overlay');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            // Check if the menu is currently closed (i.e., translated off-screen)
            const isClosed = overlay.style.transform === 'translateX(100%)' || overlay.style.transform === '';

            if (isClosed) {
                // OPEN MENU: Slide into view
                overlay.style.transform = 'translateX(0)';

                // Icon swap (optional, but good UX)
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
            } else {
                // CLOSE MENU: Slide off-screen
                overlay.style.transform = 'translateX(100%)';

                // Icon swap
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            }
        }

        // Make sure the hamburger button in your header still calls toggleMobileMenu()
    </script>
</body>

</html>