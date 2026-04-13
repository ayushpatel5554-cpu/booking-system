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
                            <th class="px-6 py-4 text-left text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Trial Status
                            </th>

                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Access Control

                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Valid Date
                                <div class="pt-0 mt-0">
                                    <br> <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter lg:pr-10">Starts</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">expires</span>
                                </div>
                            </th>


                            <th class="px-6 py-4 text-center text-xs font-bold text-indigo-700 uppercase tracking-wider">
                                Actions
                            </th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach($AllVendors as $vendor)
                        <tr class="hover:bg-indigo-50/30 transition-all duration-200 group">
                            <td class="px-6 py-4">
                                <span class="text-xs font-bold bg-gray-100 text-gray-600 px-2.5 py-1 rounded-lg">#{{ $vendor->id }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">

                                    <div>
                                        <div class="text-sm font-bold text-slate-800 leading-tight">{{ $vendor->shop_name }}</div>
                                        <div class="text-[11px] text-gray-400 mt-0.5 italic">Owner: {{ $vendor->owner_name }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex flex-col space-y-1">
                                    <div class="text-xs font-bold text-slate-700 flex items-center">
                                        <i class="fas fa-phone-alt mr-2 text-indigo-400"></i> {{ $vendor->contact_number }}
                                    </div>
                                    <div class="text-[11px] text-blue-500 hover:underline flex items-center">
                                        <i class="fas fa-envelope mr-2 opacity-70"></i> {{ $vendor->email }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if($vendor->is_paid == 1)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-green-100 text-green-700 border border-green-200">
                                    <i class="fas fa-crown  mr-1.5 text-xs"></i> Paid
                                </span>
                                @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-rose-100 text-rose-700 border border-rose-200">
                                    <i class="fas fa-exclamation-circle mr-1.5 text-xs"></i> Pending
                                </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
    @php
        // ૧. ડેટાબેઝમાંથી તારીખ મેળવો (expired_at અથવા trial_ends_at જે નામ હોય તે)
        $endDate = $vendor->expired_at ?? $vendor->trial_ends_at;
        
        $trialEnds = $endDate ? \Carbon\Carbon::parse($endDate) : null;
        $now = \Carbon\Carbon::now();
        
        // ૨. દિવસોનો તફાવત ગણો (Ciel વાપરવાથી આજનો દિવસ પણ ગણતરીમાં આવશે)
        $diff = $trialEnds ? ceil($now->diffInHours($trialEnds, false) / 24) : 0;
        
        // ૩. 7 દિવસના ટ્રાયલ મુજબ ટકાવારી (બારની પહોળાઈ માટે)
        $percentage = $diff > 0 ? min(100, max(0, ($diff / 7) * 100)) : 0;
    @endphp

    <div class="flex flex-col space-y-1">
        @if($trialEnds && $diff > 0)
            <div class="flex flex-col">
                <span class="text-[11px] font-black text-blue-600 mb-1 flex items-center">
                    <i class="fas fa-hourglass-half mr-1 text-[10px]"></i> {{ (int)$diff }} Days Left
                </span>
                
                <div class="w-full bg-gray-200 rounded-full h-1.5 max-w-[100px] overflow-hidden border border-gray-100 shadow-sm">
    <div class="bg-blue-500 h-1.5 rounded-full transition-all duration-500" 
         x-data="{ width: '{{ $percentage }}%' }" 
         :style="{ width: width }">
    </div>
</div>
            </div>
        @else
            <span class="text-[10px] font-black text-rose-500 uppercase tracking-wider animate-pulse flex items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i> Trial Expired
            </span>
        @endif
    </div>
</td>



                            <td class="px-6 py-4">
                                @php
                                $isOnline = $vendor->last_seen ? \Carbon\Carbon::parse($vendor->last_seen)->gt(now()->subMinutes(1)) : false;
                                @endphp
                                <div class="flex flex-col">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold {{ $isOnline ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                                        <span class="w-1.5 h-1.5 mr-1.5 rounded-full {{ $isOnline ? 'bg-green-500 animate-pulse' : 'bg-slate-400' }}"></span>
                                        {{ $isOnline ? 'ONLINE' : 'OFFLINE' }}
                                    </span>
                                    <span class="text-[9px] text-slate-400 mt-1 uppercase">
                                        {{ $vendor->last_seen ? \Carbon\Carbon::parse($vendor->last_seen)->diffForHumans(now()) : 'Never Active' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-1.5">
                                    <div class="flex flex-col items-end">

                                        <span class="text-[11px] font-black bg-slate-50 border border-slate-200 px-2 py-0.5 rounded text-slate-600">
                                            {{ \Carbon\Carbon::parse($vendor->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <i class="fas fa-arrow-right text-[10px] text-indigo-300 mt-3"></i>
                                    <div class="flex flex-col items-start">

                                        <span class="text-[11px] font-black bg-indigo-50 border border-indigo-200 px-2 py-0.5 rounded text-indigo-700">
                                            {{ $vendor->expired_at ? \Carbon\Carbon::parse($vendor->expired_at)->format('d/m/Y') : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-3  transition-opacity">
                                    <button type="button"
                                        class="edit-vendor-btn w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                        data-id="{{ $vendor->id }}"
                                        data-shop="{{ $vendor->shop_name }}"
                                        data-owner="{{ $vendor->owner_name }}"
                                        data-contact="{{ $vendor->contact_number }}"
                                        data-email="{{ $vendor->email }}"
                                        data-paid="{{ $vendor->is_paid }}"
                                        data-expired_at="{{ $vendor->expired_at }}"
                                        data-updated_at="{{ $vendor->created_at }}"> 
                                        <i class="fas fa-pen-nib text-xs"></i>
                                    </button>

                                    <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" class="inline m-0">
                                        @csrf @method('DELETE')
                                        <button type="button" onclick="confirmDelete(event, this)"
                                            class="w-9 h-9 flex items-center justify-center rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- edit data model -->
        <div id="editVendorModal" class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm transition-all duration-300">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
                <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
                    <h2 class="text-lg font-bold flex items-center">
                        <i class="fas fa-user-edit mr-2"></i> Edit Vendor Details
                    </h2>
                    <button type="button" onclick="closeEditModal()" class="text-white hover:text-gray-200 text-2xl transition">&times;</button>
                </div>

                <form id="editVendorForm" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Shop Name</label>
                        <input type="text" name="shop_name" id="edit_shop_name" required
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Owner Name</label>
                        <input type="text" name="owner_name" id="edit_owner_name" required
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Started / Updated At</label>
                        <input type="date" name="updated_at" id="edit_updated_at" required
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Validity / Expired At</label>
                        <input type="date" name="expired_at" id="edit_expired_at" required
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Payment Status</label>
                        <select name="is_paid" id="edit_is_paid"
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition cursor-pointer">
                            <option value="0">Pending</option>
                            <option value="1">Paid</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">New Password</label>
                        <input type="password" name="password" placeholder="Leave blank to keep current"
                            class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="closeEditModal()"
                            class="px-5 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2 text-sm font-bold bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md hover:shadow-lg transition-all active:scale-95">
                            Update Vendor
                        </button>
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
            cancelButtonColor: '#6b7280', // Gray
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
                    didOpen: () => {
                        Swal.showLoading()
                    }
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
            // attr() નો ઉપયોગ કરો જેથી લેટેસ્ટ ડેટા મળે
            let id     = $(this).attr('data-id');
            let shop   = $(this).attr('data-shop');
            let owner  = $(this).attr('data-owner');
            let paid   = $(this).attr('data-paid');
            let expiry = $(this).attr('data-expired_at');
            let started = $(this).attr('data-updated_at');

            // ૧. Started / Updated At સેટ કરો (Simple Split Logic)
            if (started && started !== "") {
                let startedDate = started.toString().split(' ')[0]; 
                $('#edit_updated_at').val(startedDate);
            } else {
                $('#edit_updated_at').val('');
            }

            // ૨. Validity / Expired At સેટ કરો (Simple Split Logic - Best for HTML Date Input)
            if (expiry && expiry !== "") {
                let expiryDate = expiry.toString().split(' ')[0];
                $('#edit_expired_at').val(expiryDate);
            } else {
                $('#edit_expired_at').val('');
            }

            // ૩. બાકીના ફિલ્ડ્સ ભરો
            $('#edit_shop_name').val(shop);
            $('#edit_owner_name').val(owner);
            $('#edit_is_paid').val(paid);

            // ૪. Action URL સેટ કરો
            $('#editVendorForm').attr('action', '/admin/vendors/update/' + id);

            // ૫. મોડલ બતાવો
            $('#editVendorModal').removeClass('hidden').addClass('flex');
        });
    });

    function closeEditModal() {
        $('#editVendorModal').addClass('hidden').removeClass('flex');
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