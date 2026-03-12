<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Management | Rentalwala Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    spacing: {
                        'sidebar': '250px'
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
            @apply bg-white bg-opacity-10 text-accent-color border-l-4 border-accent-color font-semibold;
        }

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
            <li><a class="flex items-center p-3 rounded-md hover:bg-white hover:bg-opacity-10 transition" href="/admin/dashboard"><i class="fas fa-chart-line fa-fw mr-3"></i> Dashboard</a></li>
            <li><a class="nav-link-active flex items-center p-3 rounded-md transition" href="{{ route('admin.vendors') }}"><i class="fas fa-user-tie fa-fw mr-3"></i> Vendors</a></li>
            <li><a class="flex items-center p-3 rounded-md hover:bg-white hover:bg-opacity-10 transition" href="/admin/setting"><i class="fas fa-tools fa-fw mr-3"></i> Settings</a></li>
        </ul>

        <div class="mt-auto pt-4 border-t border-gray-600">
            <a href="/admin-logout" class="text-red-400 hover:text-red-300 flex items-center p-3 rounded-md transition">
                <i class="fas fa-sign-out-alt fa-fw mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content p-4 sm:p-6 lg:p-10">
        <header class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
            <h1 class="text-3xl font-bold text-rental-dark">Vendor Management</h1>
            <div class="flex items-center space-x-3">
                <span class="hidden sm:inline text-gray-600 font-medium">welcome, {{session('admin.email')}}</span>
                <img src="https://ui-avatars.com/api/?name={{ session('admin.email') }}&background=192A56&color=fff" alt="Avatar" class="rounded-full border-2 border-accent-color w-10 h-10">
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="shadow-md rounded-lg bg-white border-l-4 border-green-500 transition hover:scale-105">
                <div class="p-5 flex items-center">
                    <i class="fas fa-signal fa-2x text-green-500 mr-4"></i>
                    <div>
                        <h4 class="text-2xl font-bold mb-0 text-green-600">
                            {{ \DB::table('vendors')->where('last_seen', '>=', now()->subMinutes(1))->count() }}
                        </h4>
                        <p class="text-sm text-gray-600 font-semibold uppercase">Online Now</p>

                    </div>
                </div>
            </div>
            <div class="shadow-md rounded-lg bg-white border-l-4 border-red-500 transition hover:scale-105">
                <div class="p-5 flex items-center">
                    <i class="fas fa-signal fa-2x text-red-500 mr-4"></i>
                    <div>
                        <h4 class="text-2xl font-bold text-red-600">
                            {{ \DB::table('vendors')->where('last_seen', '<', now()->subMinutes(1))
                    ->orWhereNull('last_seen')
                    ->count() }}
                        </h4>
                        <p class="text-sm text-gray-600 font-semibold uppercase">Offline Now</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            <div class="p-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                <div class="relative">
                    <input type="text" id="vendorSearch" placeholder="Search Shop or Owner..." class="pl-10 pr-4 py-2 border rounded-md text-sm w-64 focus:ring-2 focus:ring-accent-color outline-none">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <button onclick="openModal()" class="bg-rental-dark text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-opacity-90 transition">
                    <i class="fas fa-plus mr-2"></i> Add New Vendor
                </button>

                <div id="vendorModal" class="fixed inset-0 z-50 hidden modal-overlay items-center justify-center p-4 bg-black/60 backdrop-blur-md transition-opacity duration-300 ease-out">
                    <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
                        <div class="bg-rental-dark p-4 text-white flex justify-between items-center">
                            <h2 class="text-lg font-bold">Add New Vendor</h2>
                            <button onclick="closeModal()" class="text-white hover:text-accent-color text-2xl">&times;</button>
                        </div>

                        <form action="{{ route('vendor.store') }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Shop Name</label>
                                <input type="text" name="shop_name" required class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-accent-color outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Owner Name</label>
                                <input type="text" name="owner_name" required class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-accent-color outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text" name="contact_number" required class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-accent-color outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" required class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-accent-color outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Set Password</label>
                                <input type="password" name="password" required placeholder="Enter password for vendor"
                                    class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-accent-color outline-none">
                            </div>
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-accent-color text-rental-dark font-bold rounded-md hover:bg-yellow-500">Save Vendor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                ID
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Shop & Owner
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Contact Details
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Payment Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Access Control
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach($AllVendors as $vendor)
                        <tr class="hover:bg-yellow-50 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium">{{ $vendor->id }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-rental-dark">{{ $vendor->shop_name }}</div>
                                <div class="text-xs text-gray-500">Owner: {{ $vendor->owner_name }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-medium">{{ $vendor->contact_number }}</div>
                                <div class="text-xs text-blue-500 underline">{{ $vendor->email }}</div>
                            </td>

                            <td class="px-6 py-4">
                                @if($vendor->is_paid == 1)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                    <i class="fas fa-check-circle mr-1"></i> Paid
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @php
                                $isOnline = false;
                                if ($vendor->last_seen) {
                                $lastSeenTime = \Carbon\Carbon::parse($vendor->last_seen);
                                $isOnline = $lastSeenTime->gt(now()->subMinutes(1));
                                }
                                @endphp

                                @if($isOnline)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full animate-pulse"></span> Online
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <span class="w-2 h-2 mr-1.5 bg-red-400 rounded-full"></span> Offline
                                </span>
                                @endif

                                <div class="text-[10px] text-gray-400 mt-1">
                                    Last seen:
                                    @if($vendor->last_seen)
                                    {{ \Carbon\Carbon::parse($vendor->last_seen)->diffForHumans(now()) }}
                                    @else
                                    Never
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center space-x-3">
                                <button
                                    type="button"
                                    class="edit-vendor-btn text-blue-600 hover:text-blue-800"
                                    data-id="{{ $vendor->id }}"
                                    data-shop="{{ $vendor->shop_name }}"
                                    data-owner="{{ $vendor->owner_name }}"
                                    data-contact="{{ $vendor->contact_number }}"
                                    data-email="{{ $vendor->email }}"
                                    data-paid="{{$vendor ->is_paid}}">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="inline delete-form">
    @csrf
    @method('DELETE')
    
    <button type="button" 
            onclick="confirmDelete(event, this)"
            class="group relative inline-flex items-center justify-center w-10 h-10 text-red-500 bg-red-50 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 shadow-sm focus:outline-none">
        
        <i class="fas fa-trash-alt text-sm"></i>
        
        <span class="absolute -top-8 scale-0 transition-all rounded bg-gray-800 px-2 py-1 text-[10px] text-white group-hover:scale-100 z-10 shadow-lg">
            Delete
        </span>
    </button>
</form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- edit data model -->
        <div id="editVendorModal" class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm transition-all duration-300 bg-opacity-50">
            <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
                <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
                    <h2 class="text-lg font-bold">Edit Vendor Details</h2>
                    <button type="button" onclick="closeEditModal()" class="text-white hover:text-gray-200 text-2xl">&times;</button>
                </div>

                <form id="editVendorForm" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Shop Name</label>
                        <input type="text" name="shop_name" id="edit_shop_name" required class="w-full mt-1 p-2 border rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Owner Name</label>
                        <input type="text" name="owner_name" id="edit_owner_name" required class="w-full mt-1 p-2 border rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Payment Status</label>
                        <select name="is_paid" id="edit_is_paid" class="w-full mt-1 p-2 border rounded-md focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="0" default>Pending</option>
                            <option value="1">Paid</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">New Password (Leave blank to keep same)</label>
                        <input type="password" name="password" placeholder="Set new password if lost" class="w-full mt-1 p-2 border rounded-md outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-md">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700">Update Vendor</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
function confirmDelete(event, button) {
    // પેજ રિફ્રેશ થતું અટકાવો
    event.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "All data from this vendor will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444', // Red
        cancelButtonColor: '#6b7280',  // Gray
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
        reverseButtons: false,
        backdrop: `rgba(0,0,123,0.1) blur(4px)` // હળવું બ્લર
    }).then((result) => {
        if (result.isConfirmed) {
            // બટન જે ફોર્મની અંદર છે તેને શોધીને સબમિટ કરો
            button.closest('form').submit();
            
            // પ્રોફેશનલ લોડર બતાવો
            Swal.fire({
                title: 'Deleting...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading() }
            });
        }
    });
}
</script>
<script>
    function openModal() {
        const modal = document.getElementById('vendorModal');
        const modalContent = modal.querySelector('.transform'); // અંદરનું મેઈન બોક્સ

        // 1. પહેલા મોડલને ડિસ્પ્લે કરો
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // 2. એક નાનો વિલંબ (10ms) આપો જેથી બ્રાઉઝર એનિમેશન ઓળખી શકે
        setTimeout(() => {
            modal.classList.add('opacity-100'); // બેકગ્રાઉન્ડ દેખાશે
            if (modalContent) {
                modalContent.classList.remove('scale-95', 'translate-y-8', 'opacity-0');
                modalContent.classList.add('scale-100', 'translate-y-0', 'opacity-100');
            }
        }, 10);
    }

    function closeModal() {
        const modal = document.getElementById('vendorModal');
        const modalContent = modal.querySelector('.transform');

        // 1. રિવર્સ એનિમેશન (પહેલા ગાયબ થશે)
        modal.classList.remove('opacity-100');
        if (modalContent) {
            modalContent.classList.add('scale-95', 'translate-y-8', 'opacity-0');
            modalContent.classList.remove('scale-100', 'translate-y-0', 'opacity-100');
        }

        // 2. એનિમેશન પૂરું થયા પછી (300ms બાદ) 'hidden' કરો
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }

    // બહાર ક્લિક કરવાથી મોડલ બંધ થાય
    window.onclick = function(event) {
        const modal = document.getElementById('vendorModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

<!-- script for edit button working... -->
<script>
    $(document).ready(function() {
        $('.edit-vendor-btn').on('click', function() {
            // Button mathi data fetch karo
            let id = $(this).data('id');
            let shop = $(this).data('shop');
            let owner = $(this).data('owner');
            let contact = $(this).data('contact');
            let email = $(this).data('email');
            const paid = $(this).data('paid');

            // Modal na fields ma data bharo
            $('#edit_vendor_id').val(id);
            $('#edit_shop_name').val(shop);
            $('#edit_owner_name').val(owner);
            $('#edit_contact_number').val(contact);
            $('#edit_email').val(email);
            $('#edit_is_paid').val(paid);

            // JavaScript માં આ લાઇન ચેક કરો
            $('#editVendorForm').attr('action', '/admin/vendors/update/' + id);

            // Modal show karo
            $('#editVendorModal').removeClass('hidden');
        });
    });

    function closeEditModal() {
        $('#editVendorModal').addClass('hidden');
    }
</script>

<!-- for searching a vendor by name and shop name -->
<script>
    $(document).ready(function() {
        $("#vendorSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            // ટેબલની બોડીમાં રહેલી દરેક રો ને ફિલ્ટર કરો
            $("tbody tr").filter(function() {
                // માત્ર Shop Name અને Owner Name વાળા કોલમનો ટેક્સ્ટ ચેક કરો
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

</html>