<?php

namespace App\Services\Hestia\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Http;
use Illuminate\Routing\Controller;
use App\Services\Hestia\HestiaAPI;
use App\Models\ServiceAccount;
use Illuminate\Http\Request;
use App\Rules\ValidDomain;
use App\Models\Order;

class HestiaServiceController extends Controller
{
    public function domains(Order $order)
    {
        try {
            $client = HestiaAPI::api()->getModuleWeb(HestiaAPI::user($order)->get('USERNAME'));
            $domains = collect($client->listDomains());
        } catch(\Exception $error) {
            return redirect()->route('dashboard')->withError("[Hestia] {$error->getMessage()}");
        }

        return view('hestia::client.tailwind.domains', compact('order', 'domains'));
    }

    public function createDomain(Request $request, Order $order)
    {
        $validated = $request->validate([
            'domain' => ['required', new ValidDomain],
        ]);

        try {
            $client = HestiaAPI::api()->getModuleWeb(HestiaAPI::user($order)->get('USERNAME'));
            $response = $client->addDomain($request->get('domain'));
        } catch(\Exception $error) {
            return redirect()->back()->withError("[Hestia] {$error->getMessage()}");
        }

        return redirect()->back()->withSuccess($request->input('domain') . ' has been created');
    }

    public function createFTP(Request $request, Order $order)
    {
        $validated = $request->validate([
            'domain' => ['required', new ValidDomain],
            'username' => ['required'],
            'password' => ['required'],
        ]);

        try {
            $client = HestiaAPI::api()->getModuleWeb(HestiaAPI::user($order)->get('USERNAME'));
            $response = $client->addDomainFtp($request->get('domain'), $request->get('username'), $request->get('password'));
        } catch(\Exception $error) {
            return redirect()->back()->withError("[Hestia] {$error->getMessage()}");
        }

        return redirect()->back()->withSuccess($request->input('username') . ' FTP User for '. $request->get('domain') .' has been created');
    }

    public function mail(Order $order)
    {
        try {
            $client = HestiaAPI::api()->getModuleMail(HestiaAPI::user($order)->get('USERNAME'));
            $domains = collect($client->listDomains())->keys();
    
            $accounts = [];
            foreach($domains as $domain) {
                $accounts[$domain] = $client->listAccounts($domain);
            }
        } catch(\Exception $error) {
            return redirect()->route('dashboard')->withError("[Hestia] {$error->getMessage()}");
        }

        $accounts = collect($accounts);
        return view('hestia::client.tailwind.mail', compact('order', 'domains', 'accounts'));
    }

    public function createMailDomain(Request $request, Order $order)
    {
        $validated = $request->validate([
            'domain' => ['required', new ValidDomain],
        ]);

        try {
            $client = HestiaAPI::api()->getModuleMail(HestiaAPI::user($order)->get('USERNAME'));
            $response = $client->addDomain($request->get('domain'));
        } catch(\Exception $error) {
            return redirect()->back()->withError("[Hestia] {$error->getMessage()}");
        }

        return redirect()->back()->withSuccess($request->input('domain') . ' has been created');
    }

    public function createEmail(Request $request, Order $order)
    {
        $validated = $request->validate([
            'domain' => ['required', new ValidDomain],
            'username' => ['required'],
            'password' => ['required'],
        ]);

        try {
            $client = HestiaAPI::api()->getModuleMail(HestiaAPI::user($order)->get('USERNAME'));
            $response = $client->addAccount($request->get('domain'), $request->get('username'), $request->get('password'));
        } catch(\Exception $error) {
            return redirect()->back()->withError("[Hestia] {$error->getMessage()}");
        }

        return redirect()->back()->withSuccess($request->input('username') . '@'. $request->get('domain') .' has been created');
    }

    public function databases(Order $order)
    {
        try {
            $client = HestiaAPI::api()->getModuleDatabase(HestiaAPI::user($order)->get('USERNAME'));
            $databases = collect($client->listDatabases());
        } catch(\Exception $error) {
            return redirect()->route('dashboard')->withError("[Hestia] {$error->getMessage()}");
        }

        return view('hestia::client.tailwind.databases', compact('order', 'databases'));
    }

    public function createDatabase(Request $request, Order $order)
    {
        $validated = $request->validate([
            'type' => ['required'],
            'database' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
        ]);

        try {
            $client = HestiaAPI::api()->getModuleDatabase(HestiaAPI::user($order)->get('USERNAME'));
            $response = $client->add($request->get('database'), $request->get('username'), $request->get('password'), $request->get('type'));
        } catch(\Exception $error) {
            return redirect()->back()->withError("[Hestia] {$error->getMessage()}");
        }

        return redirect()->back()->withSuccess($request->get('database'). ' has been created');
    }

    public function backups(Order $order)
    {
        try {
            $client = HestiaAPI::api()->getModuleBackup(HestiaAPI::user($order)->get('USERNAME'));
            $backups = collect($client->listBackups());
        } catch(\Exception $error) {
            return redirect()->route('dashboard')->withError("[Hestia] {$error->getMessage()}");
        }

        return view('hestia::client.tailwind.backups', compact('order', 'backups'));
    }

    public function createBackup(Order $order)
    {
        try {
            $client = HestiaAPI::api()->getModuleBackup(HestiaAPI::user($order)->get('USERNAME'));
            $client->backup();
        } catch(\Exception $error) {
            return redirect()->back()->withSuccess("Your backup has been adding to the queue. You will receive an email once its done.");
        }

        return redirect()->back()->withSuccess("Your backup has been adding to the queue. You will receive an email once its done.");
    }
}