<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin All Choli | Rentalwala</title>
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
                        'logobg': '#143452' 
                    },
                    spacing: {
                        'sidebar': '250px',
                    }
                }
            }
        }
    </script>
    <style>
        .main-content {
            margin-left: 250px;
        }

        .nav-link-active {
            @apply bg-white bg-opacity-10 text-accent-color border-l-4 border-accent-color;
        }

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
            <i class="fas fa-chart-line fa-fw mr-3"></i> Dashboard
        </a>
    </li>

    <li>
        <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/totalbooking">
            <i class="fas fa-clipboard-list fa-fw mr-3"></i> Total Booking
        </a>
    </li>

    <li>
        <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/allcholi">
            <i class="fas fa-store fa-fw mr-3"></i> All Choli
        </a>
    </li>

    <li>
        <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/bridalcholi">
            <i class="fas fa-gem fa-fw mr-3"></i> Bridal Choli
        </a>
    </li>

    <li>
        <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/admin/customer">
            <i class="fas fa-user-friends fa-fw mr-3"></i> Customers
        </a>
    </li>

    <li>
        <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="#">
            <i class="fas fa-user-tie fa-fw mr-3"></i> Vendor
        </a>
    </li>

    <li>
        <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="#">
            <i class="fas fa-tools fa-fw mr-3"></i> Settings
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
        <header class="flex justify-between items-center mb-6 p-4 md:p-0 border-b pb-4">
            <h1 class="md:text-2xl text-xl font-semibold text-gray-800">All Bridal Choli For Rent</h1>
            <div class="flex items-center">
                <span class="mr-3 hidden sm:inline text-gray-600">Welcome, {{session('admin.email')}}</span>
                <img src="https://picsum.photos/40" alt="Admin Avatar" class="rounded-full border-2 border-accent-color w-10 h-10">
            </div>
        </header>

        <div class="bg-white shadow-lg rounded-lg">
            <div class="p-4 border-b text-lg font-semibold text-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">

                <div class="leading-snug">
                    <span class="text-base sm:text-lg block">All Rented Cholis</span>
                    <span class="text-sm sm:text-base font-normal block text-gray-600">બધી ભાડાની ચોલીઓ</span>
                </div>

                <button onclick="openAddModal()"
                    class="w-full sm:w-auto bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-150 shadow-md flex items-center justify-center sm:justify-start text-sm">
                    <i class="fas fa-plus mr-2"></i> Add New Bridal
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto divide-y divide-gray-200 text-sm">
                    <!-- Table Header -->
                    <thead class="bg-rental-dark">
                        <tr>
                            <th class="w-1/6 h-16 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Choli No. <br> ચોલી નં.
                            </th>
                            <th class="w-1/6 h-16 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Photo <br> ફોટો.
                            </th>
                            <th class="w-2/6 h-16 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Choli Name <br> ચોલી નામ.
                            </th>
                            <th class="w-1/6 h-16 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Rent (₹) <br> ભાડું (₹)
                            </th>
                            <th class="w-1/6 h-16 text-center text-xs font-semibold text-white uppercase tracking-wider">
                                Action <br> કાર્ય
                            </th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody id="table-body" class="bg-white divide-y divide-gray-200">
                        @forelse($bridalCholis as $choli)
                        <tr class="table-row h-16" data-choli-id="{{ $choli->choli_no }}">
                            <!-- Choli No -->
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">
                                {{ $choli->choli_no }}
                            </td>

                            <!-- Choli Image -->
                            <td class="px-4 py-3 text-sm text-gray-600 text-center">
                                @if($choli->photo)
                                <img src="{{ asset('storage/' . $choli->photo) }}"
                                    alt="Choli Image"
                                    class="w-12 h-12 object-cover rounded mx-auto cursor-pointer transition hover:scale-110"
                                    onclick="showLargeImage('{{ $choli->choli_no }}', '{{ asset('storage/' . $choli->photo) }}')">
                                @else
                                <span class="text-gray-400">No Image</span>
                                @endif
                            </td>

                            <!-- Choli Name -->
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">
                                {{ $choli->choli_name }}
                            </td>

                            <!-- Rent Price -->
                            <td class="px-4 py-3 text-sm text-gray-900 text-center">
                                ₹{{ number_format($choli->rent_price, 2) }}
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3 text-sm font-medium text-center">
                                <button
                                    onclick="openUpdateModal({
        id: '{{ $choli->id }}',
        choli_no: '{{ $choli->choli_no }}',
        choli_name: '{{ addslashes($choli->choli_name) }}',
        rent_price: '{{ $choli->rent_price }}',
        photo_url: '{{ $choli->photo ? asset('storage/' . $choli->photo) :''}}'
    })"
                                    class="text-indigo-600 hover:text-indigo-900 mr-2">
                                    <i class="fas fa-edit"></i> Update
                                </button>



                                <form action="{{ route('bridalcholi.destroy', $choli->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 transition duration-150"
                                        title="Delete Choli {{ $choli->choli_no }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                No Bridal Cholis found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>


            <!-- Modal for Large Image -->
            <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
                <div class="relative bg-white p-4 rounded-lg max-w-lg w-full">
                    <button class="absolute top-2 right-2 text-gray-600 text-xl font-bold" onclick="closeModal()">×</button>
                    <h2 id="imageTitle" class="text-lg font-semibold mb-2">Choli Preview</h2>
                    <img id="largeImage" src="" alt="Large Choli" class="w-full h-auto rounded">
                </div>
            </div>
            <div id="addCholiModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
                <div class="relative bg-white p-6 rounded-lg max-w-lg w-full shadow-2xl">
                    <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold transition"
                        onclick="closeAddModal()">×</button>

                    <h2 class="text-2xl font-bold mb-6 text-rental-dark">Add New Choli</h2>

                    <form action="{{ route('bridalcholi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="choli_no" class="block text-sm font-medium text-gray-700">Choli No. / ચોલી નં.</label>
                            <input type="text" id="choli_no" name="choli_no" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-accent-color focus:border-accent-color sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="choli_name" class="block text-sm font-medium text-gray-700">Choli Name / ચોલી નામ</label>
                            <input type="text" id="choli_name" name="choli_name" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-accent-color focus:border-accent-color sm:text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="rent_price" class="block text-sm font-medium text-gray-700">Rent Price (₹) / ભાડું (₹)</label>
                            <input type="number" id="rent_price" name="rent_price" required min="100"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-accent-color focus:border-accent-color sm:text-sm">
                        </div>

                        <div class="mb-6">
                            <label for="photo" class="block text-sm font-medium text-gray-700">Choli Photo / ચોલી ફોટો</label>
                            <input type="file" id="photo" name="photo" accept="image/*" **required**
                                class="mt-1 block w-full text-gray-700 border border-gray-300 rounded-md shadow-sm p-1">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeAddModal()"
                                class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                                Cancel
                            </button>
                            <button type="submit"
                                class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-rental-dark hover:bg-rental-dark/90 transition duration-150">
                                <i class="fas fa-save mr-2"></i> Save Choli
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="updateCholiModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
                <div class="relative bg-white p-6 rounded-lg max-w-lg w-full shadow-2xl">
                    <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold transition"
                        onclick="closeUpdateModal()">×</button>

                    <h2 class="text-2xl font-bold mb-6 text-rental-dark">Update Choli</h2>

                    <form id="update-choli-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="update-choli-id" name="id">

                        <div class="mb-4">
                            <label for="update-choli-no" class="block text-sm font-medium text-gray-700">Choli No.</label>
                            <input type="text" id="update-choli-no" name="choli_no" class="w-full border p-2 rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="update-choli-name" class="block text-sm font-medium text-gray-700">Choli Name</label>
                            <input type="text" id="update-choli-name" name="choli_name" class="w-full border p-2 rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="update-rent-price" class="block text-sm font-medium text-gray-700">Rent Price</label>
                            <input type="number" id="update-rent-price" name="rent_price" class="w-full border p-2 rounded" required>
                        </div>

                        <div class="mb-4">
                            <label for="update-choli-photo" class="block text-sm font-medium text-gray-700">Choli Photo</label>
                            <img id="update-choli-photo-preview" class="w-24 h-24 mb-2 rounded">
                            <input type="file" id="update-choli-photo" name="photo" accept="image/*" class="w-full border p-2 rounded">
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeUpdateModal()" class="py-2 px-4 bg-gray-200 rounded">Cancel</button>
                            <button type="submit" class="py-2 px-4 bg-rental-dark text-white rounded">Update</button>
                        </div>
                    </form>
                </div>
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
        function showLargeImage(title, src) {
            document.getElementById('imageTitle').innerText = title;
            document.getElementById('largeImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>
    <script>
        function openAddModal() {
            document.getElementById('addCholiModal').classList.remove('hidden');
        }

        function closeAddModal() {
            document.getElementById('addCholiModal').classList.add('hidden');
        }

        function openUpdateModal(choli) {
            const modal = document.getElementById('updateCholiModal');
            modal.classList.remove('hidden');

            document.getElementById('update-choli-id').value = choli.id;
            document.getElementById('update-choli-no').value = choli.choli_no;
            document.getElementById('update-choli-name').value = choli.choli_name;
            document.getElementById('update-rent-price').value = choli.rent_price;
            document.getElementById('update-choli-photo-preview').src = choli.photo_url || '';

            const form = document.getElementById('update-choli-form');
            form.action = '/admin/bridalcholi/' + choli.id;
        }

        function closeUpdateModal() {
            document.getElementById('updateCholiModal').classList.add('hidden');
        }
    </script>
</body>

</html>