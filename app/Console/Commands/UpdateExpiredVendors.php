<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateExpiredVendors extends Command
{
    // કમાન્ડ રન કરવા માટેનું નામ (ટર્મિનલ માટે)
    protected $signature = 'vendors:update-expired';

    protected $description = 'Expire vendors whose validity has passed';

    public function handle()
    {
        // ડેટાબેઝ અપડેટ લોજિક
        $affected = DB::table('vendors')
            ->where('is_paid', 1)
            ->where('expired_at', '<', now())
            ->update(['is_paid' => 0]);
            
        $this->info("Expired vendors ($affected) updated to pending successfully!");
    }
}