<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Rentalwala</title>
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
                        'sidebar-bg': '#212529', // Dark Gray (Bootstrap's dark)
                        'accent-color': '#ffc107', // Amber/Yellow (Bootstrap's warning/primary)
                        'rental-dark': '#192A56', // Custom text color from your logo
                        'logobg': '#143452',
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

        /* Active sidebar link styling (mimicking Bootstrap's custom class) */
        .nav-link-active {
            @apply bg-white bg-opacity-10 text-accent-color border-l-4 border-accent-color;
        }

        /* KPI card styling (mimicking Bootstrap's custom class) */
        .kpi-card {
            border-left: 5px solid var(--tw-colors-accent-color);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, .15);
        }

        /* Responsive adjustment for small screens (sidebar collapses) */
        @media (max-width: 1023px) {

            /* Equivalent to Bootstrap's lg breakpoint */
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <aside class="sidebar fixed top-0 left-0 w-sidebar h-screen bg-sidebar-bg text-white p-6 hidden lg:flex flex-col">
        <div class="logo text-center mb-0 ">
            <img
                class=" w-100 h-100 -mt-10 mx-auto object-contain"
                src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}"
                alt="Rentalwala Logo">

        </div>

        <ul class="flex flex-col space-y-2">
            <li>
                <a class="nav-link-active flex items-center p-3 rounded-md transition duration-150" href="#">
                    <i class="fas fa-tachometer-alt fa-fw mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/totalbooking">
                    <i class="fas fa-calendar-check fa-fw mr-3"></i> Total Booking
                </a>
            </li>

            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/allcholi">
                    <i class="fas fa-tshirt fa-fw mr-3"></i> All Choli
                </a>
            </li>
            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/bridalcholi">
                    <i class="fas fa-tshirt fa-fw mr-3"></i> Bridal Choli
                </a>
            </li>

            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/customer">
                    <i class="fas fa-users fa-fw mr-3"></i> Customers
                </a>
            </li>

            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="#">
                    <i class="fas fa-cog fa-fw mr-3"></i> Settings
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-4 border-t border-gray-600">
            <a href="/admin-logout" class="text-red-500 hover:text-red-400 flex items-center p-3 rounded-md transition duration-150">
                <i class="fas fa-sign-out-alt fa-fw mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content p-0 lg:p-10">
        <nav class="bg-logobg shadow lg:hidden mb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <span class="text-xl font-bold">
                        <img src="{{ asset('Gemini_Generated_Image_haytaihaytaihayt1-removebg-preview.png') }}" alt="Logo" class="h-20 w-auto inline mr-2 object-contain">
                    </span>

                    <button
                        type="button"
                        class="lg:hidden p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu-content"
                        aria-expanded="false"
                        onclick="toggleMobileMenu()">

                        <i class="fas fa-bars h-6 w-6" id="menu-icon-open"></i>

                        <i class="fas fa-times h-6 w-6 hidden" id="menu-icon-close"></i>
                    </button>
                </div>
            </div>

            <div
    class="fixed inset-0 z-50 bg-gray-900 bg-opacity-95 transform transition-transform duration-300 ease-in-out lg:hidden"
    id="mobile-menu-overlay"
    style="transform: translateX(100%);">
    
    <div
        class="bg-gray-800 w-3/4 sm:w-2/5 h-full shadow-2xl overflow-y-auto"
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

                <a class="text-yellow-400 hover:bg-gray-700 hover:text-yellow-400 block px-3 py-2 rounded-md transition duration-150" href="/admin/totalbooking">
                    <i class="fas fa-calendar-check fa-fw mr-3"></i> Total Bookings
                </a>

                <a class="text-blue-400 hover:bg-gray-700 hover:text-blue-400 block px-3 py-2 rounded-md transition duration-150" href="/admin/upcomingreturns">
                    <i class="fas fa-clock fa-fw mr-3"></i> Upcoming Returns
                </a>
            </div>

            <div class="pt-2">
                <div class="text-xs font-semibold uppercase text-gray-400 px-3 py-1">Inventory</div>

                <a class="text-green-400 hover:bg-gray-700 hover:text-green-400 block px-3 py-2 rounded-md transition duration-150" href="/admin/allcholi">
                    <i class="fas fa-tshirt fa-fw mr-3"></i> All Cholis
                </a>

                <a class="text-pink-400 hover:bg-gray-700 hover:text-pink-400 block px-3 py-2 rounded-md transition duration-150" href="/admin/bridalcholi">
                    <i class="fas fa-crown fa-fw mr-3"></i> Bridal Cholis
                </a>
            </div>

            <div class="pt-2">
                <div class="text-xs font-semibold uppercase text-gray-400 px-3 py-1">Business</div>

                <a class="text-teal-400 hover:bg-gray-700 hover:text-teal-400 block px-3 py-2 rounded-md transition duration-150" href="/admin/customer">
                    <i class="fas fa-users fa-fw mr-3"></i> Customers
                </a>

                <a class="text-orange-400 hover:bg-gray-700 hover:hover:text-orange-400 block px-3 py-2 rounded-md transition duration-150" href="/admin/reports">
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

        <header class="flex justify-between items-center mb-6 p-4 md:p-0  border-b pb-4">
            <h1 class="text-xl md:text-2xl  font-semibold text-gray-800">Dashboard Overview</h1>
            <div class="flex items-center">
                <span class="mr-3 hidden sm:inline text-gray-600">Welcome, {{session('admin.email')}}</span>
                <img src="https://picsum.photos/40" alt="Admin Avatar" class="rounded-full border-2 border-accent-color w-10 h-10">
            </div>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            <div class="shadow-md rounded-lg bg-white kpi-card">
                <div class="p-5 flex items-center">
                    <i class="fas fa-box-open fa-2x text-green-500 mr-4"></i>
                    <div>
                        <h4 class="text-2xl font-bold mb-0 text-gray-900">{{ $totalCholiStock }}</h4>
                        <p class="text-md text-gray-700 mt-1">Total Cholis in Stock</p>
                        <p class="text-sm text-gray-700">કુલ ચોલી સ્ટોકમાં છે</p>
                    </div>
                </div>
            </div>

            <div class="shadow-md rounded-lg bg-white kpi-card">
                <div class="p-5 flex items-center">
                    <i class="fas fa-calendar-check fa-2x text-accent-color mr-4"></i>
                    <div>
                        <h4 class="text-2xl font-bold mb-0 text-gray-900">{{$totalbooking}}</h4>
                        <p class="text-md text-gray-700 mt-1">Total Booking</p>
                        <p class="text-sm text-gray-700">કુલ બુકિંગ</p>
                    </div>
                </div>
            </div>

            <div class="shadow-md rounded-lg bg-white kpi-card">
                <div class="p-5 flex items-center">
                    <i class="fas fa-rupee-sign fa-2x text-blue-500 mr-4"></i>
                    <div>
                        <h4 class="text-2xl font-bold mb-0 text-gray-900">₹ {{$totalRevenue}}</h4>
                        <p class="text-md text-gray-700 mt-1">Total Revenue (YTD)</p>
                        <p class="text-sm text-gray-700">કુલ આવક</p>
                    </div>
                </div>
            </div>

            <div class="shadow-md rounded-lg bg-white kpi-card">
                <div class="p-5 flex items-center">
                    <i class="fas fa-user-circle fa-2x text-red-500 mr-4"></i>
                    <div>
                        <h4 class="text-2xl font-bold mb-0 text-red-500">{{$Allcustomer}}</h4>
                        <p class="text-md text-gray-700 mt-1">Total Visited Customers</p>
                        <p class="text-sm text-gray-700">ગ્રાહકો</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-8">
                <div class="bg-white shadow-lg rounded-lg">
                    <div class="p-4 border-b text-lg font-semibold text-gray-800">
                        Recent Orders
                    </div>
                    <div class="p-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rental Dates</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#1001</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Priya S.</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Oct 5 - Oct 8</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 tag">Confirmed</span></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">₹3,600</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#1002</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Aisha B.</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Oct 2 - Oct 6</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 tag">Pending</span></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">₹2,100</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#1003</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Neha R.</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Oct 10 - Oct 12</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 tag">Shipped</span></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">₹4,500</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">#1004</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Rina K.</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Oct 15 - Oct 18</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 tag">Confirmed</span></td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">₹3,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="#" class="inline-block text-blue-600 hover:text-blue-800 font-medium px-4 py-3 transition duration-150">View All Orders →</a>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white shadow-lg rounded-lg">
                    <div class="p-4 border-b text-lg font-semibold text-gray-800">
                        Top 5 Rented Cholis
                    </div>
                    <div class="p-4">
                        <ul class="divide-y divide-gray-200">
                            <li class="flex justify-between items-center py-2">
                                <span class="text-gray-900">Blue Designer Choli</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-500 text-white">25 Rents</span>
                            </li>
                            <li class="flex justify-between items-center py-2">
                                <span class="text-gray-900">Classic Red Choli</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-500 text-white">18 Rents</span>
                            </li>
                            <li class="flex justify-between items-center py-2">
                                <span class="text-gray-900">Mirror Work Blouse</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-300 text-gray-800">15 Rents</span>
                            </li>
                            <li class="flex justify-between items-center py-2">
                                <span class="text-gray-900">Green Traditional Choli</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">11 Rents</span>
                            </li>
                            <li class="flex justify-between items-center py-2">
                                <span class="text-gray-900">Pink Georgette Top</span>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-500 text-white">9 Rents</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
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