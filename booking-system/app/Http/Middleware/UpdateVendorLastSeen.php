<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UpdateVendorLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    if (session()->has('vendor_id')) {
        $vendorId = session('vendor_id');
        $lastSeen = DB::table('vendors')->where('id', $vendorId)->value('last_seen');

        // જો last_seen ૧ મિનિટ કરતા વધુ જૂનું હોય, તો જ અપડેટ કરો
        if (!$lastSeen || \Carbon\Carbon::parse($lastSeen)->diffInMinutes(now()) >= 1) {
            DB::table('vendors')
                ->where('id', $vendorId)
                ->update(['last_seen' => now()]);
        }
    }

    return $next($request);
}
}
