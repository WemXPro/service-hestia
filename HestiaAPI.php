<?php

namespace App\Services\Hestia;

use Illuminate\Support\Facades\Http;
use HestiaCP\Client;
use HestiaCP\Authorization\Credentials;
use Illuminate\Support\Facades\Cache;
use HestiaCP\Authorization\Host;
use App\Models\ServiceAccount;
use App\Models\Order;

class HestiaAPI
{
    public static function api()
    {
        $credentials = new Credentials(settings('hestia::username'), settings('encrypted::hestia::password'));
        $hostname = settings('hestia::hostname');
        $port = settings('hestia::port', 8083);
        $host = new Host($hostname, $credentials, $port);
        return new Client($host);
    }

    public static function user(Order $order)
    {
        if(!Cache::has("{$order->id}::hestia::user")) {
            try {
                $hestiaUser = ServiceAccount::where('order_id', $order->id)->first();
                $user = self::api()->getModuleUser()->detail($hestiaUser->username);

                $quota = ($user['DISK_QUOTA'] == 'unlimited') ? 9999 : $user['DISK_QUOTA'];
                $bandwith = ($user['BANDWIDTH'] == 'unlimited') ? 9999 : $user['BANDWIDTH'];

                $user['U_DISK_%'] = ($user['U_DISK'] !== "0") ? ($user['U_DISK'] / $quota) * 100 : 0;
                $user['U_BANDWIDTH_%'] = ($user['U_BANDWIDTH'] !== "0") ? ($user['U_BANDWIDTH'] / $bandwith) * 100 : 0;
                $user['USERNAME'] = $hestiaUser->username;
                Cache::put("{$order->id}::hestia::user", $user, 3600);
            } catch(\Exception $error) {
                
            }
        }

        return collect(Cache::get("{$order->id}::hestia::user", []));
    }
}