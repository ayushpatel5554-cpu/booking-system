<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RENTALWALA - Start 7-Day Free Trial</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rental-dark': '#143452',
                        'rental-accent': '#20BF9B',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen py-10 px-4">

    <div class="w-full max-w-4xl bg-white shadow-2xl rounded-2xl overflow-hidden flex flex-col md:flex-row">
        
        <div class="w-full md:w-2/5 bg-rental-dark p-8 text-white flex flex-col justify-center">
            <div class="mb-8">
                <h1 class="text-3xl font-bold mb-2 text-rental-accent italic">RENTALWALA</h1>
                <p class="text-sm opacity-80 uppercase tracking-widest">Vendor Registration</p>
            </div>

            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-rental-accent/20 p-2 rounded-lg">
                        <i class="fas fa-clock text-rental-accent"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">7-Day Free Trial</h4>
                        <p class="text-xs opacity-70">બધા જ ફીચર્સનો ઉપયોગ કરો બિલકુલ ફ્રીમાં ૭ દિવસ સુધી.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-rental-accent/20 p-2 rounded-lg">
                        <i class="fas fa-chart-line text-rental-accent"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">Business Growth</h4>
                        <p class="text-xs opacity-70">તમારા ઓર્ડર્સ અને બુકિંગને ડિજિટલી મેનેજ કરો.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="bg-rental-accent/20 p-2 rounded-lg">
                        <i class="fas fa-headset text-rental-accent"></i>
                    </div>
                    <div>
                        <h4 class="font-bold">Full Support</h4>
                        <p class="text-xs opacity-70">ટેકનિકલ સપોર્ટ માટે અમે હંમેશા હાજર છીએ.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-3/5 p-8 md:p-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Vendor Account</h2>
            
            <form action="{{ route('vendor.register.post') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Shop Name</label>
                        <input type="text" name="shop_name" required placeholder="Shop Name" 
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-rental-accent outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Owner Name</label>
                        <input type="text" name="owner_name" required placeholder="Owner Name" 
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-rental-accent outline-none transition text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Contact Number</label>
                        <input type="text" name="contact_number" required placeholder="Phone Number" 
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-rental-accent outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Email Address</label>
                        <input type="email" name="email" required placeholder="Email Address" 
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-rental-accent outline-none transition text-sm">
                    </div>
                </div>

                

                <div>
                    <label class="block text-xs font-bold text-gray-600 mb-1 uppercase">Set Password</label>
                    <input type="password" name="password" required placeholder="Min 6 characters" 
                           class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-rental-accent outline-none transition text-sm">
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="w-full bg-rental-accent text-white font-bold py-3 rounded-md shadow-lg hover:bg-opacity-90 transition duration-300">
                        START MY 7-DAY FREE TRIAL
                    </button>
                </div>

                <p class="text-center text-xs text-gray-500 mt-4">
                    Already have an account? 
                    <a href="{{ route('vendor.login') }}" class="text-rental-dark font-bold hover:underline">Login Here</a>
                </p>
            </form>
        </div>
    </div>

</body>
</html>