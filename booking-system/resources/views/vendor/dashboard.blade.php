<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard | Rentalwala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sidebar-bg': '#1a1d21', // થોડો અલગ ડાર્ક કલર
                        'accent-color': '#ffc107',
                        'logobg': '#143452',
                    },
                    spacing: { 'sidebar': '250px' }
                }
            }
        }
    </script>
    <style>
        .main-content { margin-left: 250px; }
        .kpi-card { border-top: 4px solid #ffc107; transition: all 0.3s; }
        .kpi-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0, 0, 0, .1); }
        @media (max-width: 1023px) { .main-content { margin-left: 0; } }
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
                <a class="nav-link-active flex items-center p-3 rounded-md transition duration-150" href="/">
                    <i class="fas fa-chart-line fa-fw mr-3"></i> Dashboard
                </a>
            </li>

            <li>
                <a class="text-white hover:text-accent-color flex items-center p-3 rounded-md transition duration-150" href="/vendor/totalbooking">
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
                    <i class="fas fa-tools fa-fw mr-3"></i> Settings
                </a>
            </li>
        </ul>

        <div class="mt-auto pt-4 border-t border-gray-600">
            <a href="{{route('vendor.logout')}}" class="text-red-500 hover:text-red-400 flex items-center p-3 rounded-md transition duration-150">
                <i class="fas fa-sign-out-alt fa-fw mr-3"></i> Logout
            </a>
        </div>
    </aside>

    <main class="main-content p-6 lg:p-10">
        <header class="flex justify-between items-center mb-8 bg-white p-4 rounded-lg shadow-sm border">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ session('vendor_name') }}</h1>
                <p class="text-sm text-gray-500">તમારી દુકાનનું આજનું સ્ટેટસ</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right hidden sm:block">
    <p class="text-sm font-semibold text-gray-800">Customer ID: #{{ session('vendor_id') }}</p>
    
    @php
        // Vendors table mathi direct check karo
        $vendor = \DB::table('vendors')->where('id', session('vendor_id'))->first();
        
        $isOnline = false;
        if ($vendor && $vendor->last_seen) {
            // Jo chella 5 minute ma activity hoy to Online
            $isOnline = \Carbon\Carbon::parse($vendor->last_seen)->gt(now()->subMinutes(5));
        }
    @endphp

    @if($isOnline)
        <p class="text-xs text-green-600 font-bold">● Online</p>
    @else
        <p class="text-xs text-red-400 font-bold">● Offline</p>
    @endif
</div>
                <img src="https://ui-avatars.com/api/?name={{ session('vendor_name') }}&background=143452&color=fff" class="rounded-full w-12 h-12 border-2 border-accent-color">
            </div>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm kpi-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">મારા ચણિયાચોળી</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalCholiStock }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg text-green-600"><i class="fas fa-tshirt text-xl"></i></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm kpi-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">કુલ બુકિંગ</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalbooking }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-lg text-yellow-600"><i class="fas fa-shopping-bag text-xl"></i></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm kpi-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">કુલ કમાણી (Earnings)</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">₹{{ number_format($totalRevenue) }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg text-blue-600"><i class="fas fa-wallet text-xl"></i></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm kpi-card">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">ગ્રાહકો</p>
                        <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $Allcustomer }}</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg text-red-600"><i class="fas fa-users text-xl"></i></div>
                </div>
            </div>
        </section>

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="p-5 border-b flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-lg">તાજેતરના ઓર્ડર્સ (Recent Orders)</h3>
                <button class="text-blue-600 text-sm font-bold hover:underline">બધા જુઓ</button>
            </div>
            <div class="p-0">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b text-gray-600 uppercase text-xs font-bold">
                        <tr>
                            <th class="px-6 py-4">Bill No</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Item</th>
                            <th class="px-6 py-4">Rent</th>
                            <th class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($topcholis as $booking)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-bold text-gray-700">#{{ $booking->bill_no }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $booking->customer_name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $booking->choli_name }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900">₹{{ number_format($booking->rent_price) }}</td>
                            <td class="px-6 py-4 text-center">
                                <button class="bg-gray-100 hover:bg-gray-200 p-2 rounded text-blue-600"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">કોઈ ડેટા ઉપલબ્ધ નથી</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>