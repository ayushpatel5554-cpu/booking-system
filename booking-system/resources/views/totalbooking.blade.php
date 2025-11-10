<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Rentalwala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                <a class="nav-link-active flex items-center p-3 rounded-md transition duration-150" href="/dashboard">
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
        <nav class="bg-white shadow-lg lg:hidden mb-6">
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
        <header class="flex justify-between items-center mb-6 p-4 md:p-0 border-b pb-4">
            <h1 class="md:text-2xl text-xl font-semibold text-gray-800">Total Bookings</h1>
            <div class="flex items-center">
                <span class="mr-3 hidden sm:inline text-gray-600">Welcome, {{session('admin.email')}}</span>
                <img src="https://picsum.photos/40" alt="Admin Avatar" class="rounded-full border-2 border-accent-color w-10 h-10">
            </div>
        </header>

        <div class="bg-white shadow-lg rounded-lg">
            <div class="p-4 border-b text-lg font-semibold text-gray-800 flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0">

                <div>
                    All Rented Cholis (Total Bookings) <br>
                    <span class="text-sm font-normal text-gray-500">બધી ભાડાની ચોલીઓ (કુલ બુકિંગ)</span>
                </div>

                <div class="flex flex-col md:flex-row items-stretch md:items-center space-y-3 md:space-y-0 md:space-x-4 w-full md:w-auto">

                    <div class="relative w-full md:w-64">
                        <input
                            type="text"
                            id="searchInput"
                            onkeyup="filterTable()"
                            placeholder="Search by Choli No. or Customer..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>


                    <button
                        onclick="openBookingModal()"
                        class="bg-accent-color hover:bg-yellow-500 text-rental-dark font-bold py-2 px-4 rounded transition duration-150 shadow-md flex items-center text-sm w-full md:w-auto">
                        <i class="fas fa-plus mr-2"></i> Add New Booking
                    </button>
                </div>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-rental-dark">
                        <tr>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Choli No. <br> ચોલી નં.</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Photo <br> ફોટો.</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Choli Name <br> ચોલી નામ.</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Customer Name <br> ગ્રાહકનું નામ</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Contact Number <br> મોબાઇલ નંબર</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Delivery Date <br> આપવાની તારીખ
                            </th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Return Date <br> મેળવવાની તારીખ
                            </th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Deposit (₹) <br> જમા (₹)</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Rent (₹) <br> ભાડું (₹)</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Bill No. <br> બિલ નં.</th>
                            <th class="px-4 py-4 text-center text-xs font-semibold text-white uppercase tracking-wider">Action <br> કાર્ય</th>
                        </tr>
                    </thead>
                    <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                        <tr class="table-row" data-choli-id="{{ $booking->choli_no }}">
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $booking->choli_no ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                @if($booking->photo)
                                <img src="{{ asset('storage/' . $booking->photo) }}" alt="Choli Image"
                                    class="w-10 h-10 object-cover rounded cursor-pointer transition hover:scale-110"
                                    onclick="showLargeImage('{{ $booking->choli_no }}', '{{ asset('storage/' . $booking->photo) }}')">
                                @else
                                <span class="text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $booking->choli_name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $booking->customer_name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $booking->contact_number ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($booking->delivery_date)->format('d/m/Y') ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($booking->return_date)->format('d/m/Y') ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">₹{{ $booking->deposit_price ?? '0' }}</td>

                            <td class="px-4 py-3 text-sm text-gray-900">₹{{ $booking->rent_price ?? '0' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $booking->bill_no ?? '-' }}</td>
                            <td class="px-0 py-6 text-sm font-medium flex justify-center items-center space-x-2">
                                <button
                                    type="button"
                                    onclick="openEditBookingModal({{ json_encode($booking) }})"
                                    class="text-indigo-600 hover:text-indigo-900 transition duration-150">
                                    <i class="fas fa-edit"></i> Update
                                </button>

                                <form action="{{ route('totalbooking.delete', $booking->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-900 transition duration-150"
                                        onclick="return confirm('Are you sure you want to delete this booking?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                                <a
                                    href="{{ route('totalbooking.downloadBill', $booking->id) }}"
                                    class="text-green-600 hover:text-green-900 transition duration-150"
                                    target="_blank" {{-- Optional: Opens the bill in a new tab --}}>
                                    <i class="fas fa-file-download"></i> Download Bill
                                </a>
                            <td class="px-4 py-3 text-sm font-medium flex justify-center items-center space-x-2">
                                <?php
                                $message = rawurlencode("Dear $booking->customer_name,

                                    Thank you for choosing Chundari Designer Studio 💫  
                                    We truly appreciate your trust in our craftsmanship and creativity.

                                    Your satisfaction is our priority, and we hope you loved your outfit.  
                                    We’d be delighted if you could share your experience or a picture wearing it — it inspires our team to serve you even better! 👗

                                    Looking forward to designing something beautiful for you again soon.

                                    Warm regards,  
                                    ✨ Team Chundari Designer Studio  
                                    📍 Varachha Road, Surat  
                                    📞 +91 98243 62522");

                                $whatsappUrl = "https://wa.me/{$booking->contact_number}?text={$message}";
                                ?>

                                <a href="<?= $whatsappUrl; ?>" target="_blank"
                                    class="text-teal-600 hover:text-teal-900 transition duration-150">
                                    <i class="fab fa-whatsapp"></i> Send Bill Link (WA)
                                </a>
                            </td>

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-4 py-3 text-center text-gray-500">No bookings found.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button id="mobile-prev-btn" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Previous
                    </button>
                    <button id="mobile-next-btn" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next
                    </button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span id="current-start" class="font-medium">1</span> to <span id="current-end" class="font-medium">15</span> of <span id="total-records" class="font-medium">16</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <button id="prev-page-btn" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <i class="fas fa-chevron-left h-5 w-5"></i>
                            </button>
                            <div id="pagination-numbers" class="inline-flex">
                            </div>
                            <button id="next-page-btn" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <i class="fas fa-chevron-right h-5 w-5"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div id="bookingModalContent"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl m-4 transform transition-all duration-300 scale-95 opacity-0 overflow-hidden border border-gray-200 
        
        h-full max-h-[90vh] sm:h-auto sm:max-h-full flex flex-col">

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-5 flex justify-between items-center flex-shrink-0">
                <h3 class="text-xl font-semibold text-white">
                    Add New Booking <br>
                    <span class="text-sm font-normal text-indigo-200">નવું બુકિંગ ઉમેરો</span>
                </h3>
                <button onclick="closeBookingModal()" class="text-white hover:text-gray-200 transition-transform transform hover:rotate-90">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <form id="add-booking-form" action="{{ route('totalbooking.store') }}" method="POST" enctype="multipart/form-data"
                class="px-4 pt-6 pb-12 md:p-6 space-y-5 overflow-y-auto">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="bill_no" class="block text-sm font-medium text-gray-700">Bill No. / બિલ નં.</label>
                        <input type="text" name="bill_no" id="bill_no" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="e.g., B-2025-008">
                        @error('bill_no')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div>
                        <label for="choli_no" class="block text-sm font-medium text-gray-700">Choli No. / ચોલી નં.</label>
                        <select name="choli_no" id="choli_no" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" selected disabled>Select Choli</option>
                            @foreach ($cholis as $choli_no)
                            <option value="{{ $choli_no }}">{{ $choli_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name / ગ્રાહકનું નામ</label>
                        <input type="text" name="customer_name" id="customer_name" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Priya Shah">
                    </div>

                    <div>
                        <label for="choli_name" class="block text-sm font-medium text-gray-700">Choli Name / ચોલીનું નામ</label>
                        <input type="text" name="choli_name" id="choli_name" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Wedding Choli">
                    </div>

                    <div class="col-span-2 lg:col-span-1"> <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact No. / મોબાઇલ નંબર</label>
                        <input type="tel" name="contact_number" id="contact_number" required maxlength="10"
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="9876543210">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="delivery_date" class="block text-sm font-medium text-gray-700">Delivery Date / આપવાની તારીખ</label>
                        <input type="date" name="delivery_date" id="delivery_date" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div>
                        <label for="return_date" class="block text-sm font-medium text-gray-700">Return Date / મેળવવાની તારીખ</label>
                        <input type="date" name="return_date" id="return_date" required
                            class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label for="deposit_price" class="block  text-sm font-medium text-gray-700">deposit (₹) / ભાડું (₹)</label>
                    <input type="number" name="deposit_price" id="deposit_price" required min="1"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="e.g., 500">
                </div>

                <div>
                    <label for="rent_price" class="block text-sm font-medium text-gray-700">Rent Price (₹) / ભાડું (₹)</label>
                    <input type="number" name="rent_price" id="rent_price" required min="1"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="e.g., 3500">
                </div>

                <div class="pt-5 flex flex-col-reverse sm:flex-row justify-end space-y-3 sm:space-y-0 space-y-reverse sm:space-x-3 flex-shrink-0">
                    <button type="button" onclick="closeBookingModal()"
                        class="w-full sm:w-auto px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition duration-150">
                        Cancel
                    </button>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-medium rounded-lg shadow-md flex items-center justify-center transition duration-150">
                        <i class="fas fa-save mr-2"></i> Save Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editBookingModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 transition-opacity duration-300">
        <div id="editBookingModalContent"
            class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl m-4 transform transition-all duration-300 scale-95 opacity-0 overflow-hidden border border-gray-200">

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-5 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-white">
                    Edit Booking <br>
                    <span class="text-sm font-normal text-indigo-200">બુકિંગ સુધારો</span>
                </h3>
                <button onclick="closeEditBookingModal()" class="text-white hover:text-gray-200 transition-transform transform hover:rotate-90">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <form id="edit-booking-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="edit_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_bill_no" class="block text-sm font-medium text-gray-700">Bill No.</label>
                        <input type="text" name="bill_no" id="edit_bill_no" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                    </div>

                    <div>
                        <label for="edit_choli_no" class="block text-sm font-medium text-gray-700">Choli No.</label>
                        <select name="choli_no" id="edit_choli_no" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                            @foreach ($cholis as $choli_no)
                            <option value="{{ $choli_no }}">{{ $choli_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="edit_customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text" name="customer_name" id="edit_customer_name" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                    </div>

                    <div>
                        <label for="edit_choli_name" class="block text-sm font-medium text-gray-700">Choli Name</label>
                        <input type="text" name="choli_name" id="edit_choli_name" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                    </div>

                    <div>
                        <label for="edit_contact_number" class="block text-sm font-medium text-gray-700">Contact No.</label>
                        <input type="tel" name="contact_number" id="edit_contact_number" required maxlength="10" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_delivery_date" class="block text-sm font-medium text-gray-700">Delivery Date</label>
                        <input type="date" name="delivery_date" id="edit_delivery_date" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                    </div>

                    <div>
                        <label for="edit_return_date" class="block text-sm font-medium text-gray-700">Return Date</label>
                        <input type="date" name="return_date" id="edit_return_date" required class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                    </div>
                </div>

                <div>
                    <label for="edit_rent_price" class="block text-sm font-medium text-gray-700">Rent Price (₹)</label>
                    <input type="number" name="rent_price" id="edit_rent_price" required min="0" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>

                {{-- *** FIX APPLIED HERE *** --}}
                <div>
                    <label for="edit_deposit_price" class="block text-sm font-medium text-gray-700">Deposit Price (₹)</label>
                    <input type="number" name="deposit_price" id="edit_deposit_price" required min="0" class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2.5">
                </div>

                <div class="pt-5 flex justify-end space-x-3">
                    <button type="button" onclick="closeEditBookingModal()" class="px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg">Update Booking</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openEditBookingModal(booking) {
            document.getElementById('edit_id').value = booking.id;
            document.getElementById('edit_bill_no').value = booking.bill_no;
            document.getElementById('edit_choli_no').value = booking.choli_no;
            document.getElementById('edit_customer_name').value = booking.customer_name;
            document.getElementById('edit_choli_name').value = booking.choli_name;
            document.getElementById('edit_contact_number').value = booking.contact_number;
            document.getElementById('edit_delivery_date').value = booking.delivery_date;
            document.getElementById('edit_return_date').value = booking.return_date;

            // --- FIX APPLIED HERE ---
            // 1. Set rent_price correctly
            document.getElementById('edit_rent_price').value = booking.rent_price;

            // 2. Set deposit_price to its own field
            document.getElementById('edit_deposit_price').value = booking.deposit_price;
            // ------------------------

            // Set form action
            document.getElementById('edit-booking-form').action = `/totalbooking/${booking.id}`;

            // Show modal animation
            const modal = document.getElementById('editBookingModal');
            const content = document.getElementById('editBookingModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditBookingModal() {
            const modal = document.getElementById('editBookingModal');
            const content = document.getElementById('editBookingModalContent');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => modal.classList.add('hidden'), 200);
        }
    </script>



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
    <script>
        // Existing table pagination and setup
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#table-body tr.table-row');
            const rowsPerPage = 15;
            const totalRecords = rows.length;
            const totalPages = Math.ceil(totalRecords / rowsPerPage);
            let currentPage = 1;

            const tableBody = document.getElementById('table-body');
            const prevBtn = document.getElementById('prev-page-btn');
            const nextBtn = document.getElementById('next-page-btn');
            const mobilePrevBtn = document.getElementById('mobile-prev-btn');
            const mobileNextBtn = document.getElementById('mobile-next-btn');
            const pageNumbersContainer = document.getElementById('pagination-numbers');
            const currentStartSpan = document.getElementById('current-start');
            const currentEndSpan = document.getElementById('current-end');
            const totalRecordsSpan = document.getElementById('total-records');

            // Set the total records count
            totalRecordsSpan.textContent = totalRecords;

            function displayPage(page) {
                currentPage = page;
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                // 1. Hide all rows
                rows.forEach(row => row.style.display = 'none');

                // 2. Show rows for the current page
                for (let i = start; i < end && i < totalRecords; i++) {
                    rows[i].style.display = '';
                }

                // 3. Update status text
                currentStartSpan.textContent = start + 1;
                currentEndSpan.textContent = Math.min(end, totalRecords);

                // 4. Update button states
                prevBtn.disabled = currentPage === 1;
                mobilePrevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;
                mobileNextBtn.disabled = currentPage === totalPages;

                prevBtn.classList.toggle('opacity-50', prevBtn.disabled);
                mobilePrevBtn.classList.toggle('opacity-50', mobilePrevBtn.disabled);
                nextBtn.classList.toggle('opacity-50', nextBtn.disabled);
                mobileNextBtn.classList.toggle('opacity-50', mobileNextBtn.disabled);

                // 5. Update page number buttons
                updatePageNumbers();
            }

            function updatePageNumbers() {
                pageNumbersContainer.innerHTML = ''; // Clear existing buttons
                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement('button');
                    button.textContent = i;
                    button.setAttribute('data-page', i);
                    button.className = 'relative inline-flex items-center px-4 py-2 border text-sm font-medium';

                    if (i === currentPage) {
                        // Active style
                        button.classList.add('bg-rental-dark', 'border-rental-dark', 'text-white');
                        button.classList.remove('bg-white', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
                    } else {
                        // Inactive style
                        button.classList.add('bg-white', 'border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
                        button.classList.remove('bg-rental-dark', 'border-rental-dark', 'text-white');
                    }

                    button.addEventListener('click', () => displayPage(i));
                    pageNumbersContainer.appendChild(button);
                }
            }

            // Add event listeners for navigation buttons
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) displayPage(currentPage - 1);
            });
            mobilePrevBtn.addEventListener('click', () => {
                if (currentPage > 1) displayPage(currentPage - 1);
            });

            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) displayPage(currentPage + 1);
            });
            mobileNextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) displayPage(currentPage + 1);
            });

            // Initial display
            displayPage(1);
        });
    </script>
    <script>
        // Existing large image modal functions
        function showLargeImage(title, src) {
            document.getElementById('imageTitle').innerText = title;
            document.getElementById('largeImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // --- NEW BOOKING MODAL FUNCTIONS ---
        const bookingModal = document.getElementById('bookingModal');
        const bookingModalContent = document.getElementById('bookingModalContent');

        function openBookingModal() {
            bookingModal.classList.remove('hidden');
            // Animate in
            setTimeout(() => {
                bookingModal.classList.add('opacity-100');
                bookingModalContent.classList.remove('scale-95', 'opacity-0');
                bookingModalContent.classList.add('scale-100', 'opacity-100');
            }, 10); // Small delay for transition to work
        }

        function closeBookingModal() {
            // Animate out
            bookingModal.classList.remove('opacity-100');
            bookingModalContent.classList.remove('scale-100', 'opacity-100');
            bookingModalContent.classList.add('scale-95', 'opacity-0');

            // Hide after animation
            setTimeout(() => {
                bookingModal.classList.add('hidden');
            }, 300); // Matches the duration-300 transition class
        }

        // Optional: Close modal when clicking outside
        bookingModal.addEventListener('click', (e) => {
            if (e.target === bookingModal) {
                closeBookingModal();
            }
        });
    </script>
    <script>
        function filterTable() {
            var input, filter, tableBody, rows, i;

            // Get search text, convert to uppercase, and trim whitespace
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase().trim();

            tableBody = document.getElementById("table-body");
            rows = tableBody.getElementsByTagName("tr");

            // Loop through all table rows
            for (i = 0; i < rows.length; i++) {

                // --- 🎯 CORRECTED INDICES BASED ON YOUR TABLE HEADERS ---
                var tdCholiNo = rows[i].getElementsByTagName("td")[0]; // CHOLI NO. (Index 0)
                var tdCholiName = rows[i].getElementsByTagName("td")[2]; // CHOLI NAME (Index 2)
                var tdCustomerName = rows[i].getElementsByTagName("td")[3]; // CUSTOMER NAME (Index 3)
                var tdContact = rows[i].getElementsByTagName("td")[4]; // CONTACT NUMBER (Index 4)

                var match = false;

                function checkCell(td) {
                    if (td) {
                        var txtValue = (td.textContent || td.innerText).toUpperCase().trim();
                        return txtValue.indexOf(filter) > -1;
                    }
                    return false;
                }
                if (checkCell(tdCholiNo) ||
                    checkCell(tdCholiName) ||
                    checkCell(tdCustomerName) ||
                    checkCell(tdContact)) {
                    match = true;
                }

                if (match) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    </script>

</body>

</html>