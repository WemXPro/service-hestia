<?php

namespace App\Services\Hestia;

use App\Services\ServiceInterface;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Package;
use App\Models\ServiceAccount;

class Service implements ServiceInterface
{
    /**
     * Unique key used to store settings 
     * for this service.
     * 
     * @return string
     */
    public static $key = 'hestia'; 

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    
    /**
     * Returns the meta data about this Server/Service
     *
     * @return object
     */
    public static function metaData(): object
    {
        return (object)
        [
          'display_name' => 'Hestia',
          'autor' => 'WemX',
          'version' => '1.0.0',
          'wemx_version' => ['*'],
        ];
    }

    /**
     * Define the default configuration values required to setup this service
     * i.e host, api key, or other values. Use Laravel validation rules for
     *
     * Laravel validation rules: https://laravel.com/docs/10.x/validation
     *
     * @return array
     */
    public static function setConfig(): array
    {
        return [
            [
                "key" => "hestia::hostname",
                "name" => "Hostname",
                "description" => "The hostname of your Hestia Panel i.e panel.example.com:8083",
                "type" => "text", // text, textarea, password, number, date, checkbox, url, email, select
                "rules" => ['required'], // laravel validation rules
            ],
            [
                "key" => "hestia::port",
                "name" => "Port",
                "description" => "The port of your Hestia Panel i.e panel.example.com:8083",
                "type" => "number", // text, textarea, password, number, date, checkbox, url, email, select
                "rules" => ['required', 'numeric'], // laravel validation rules
            ],
            [
                "key" => "hestia::username",
                "name" => "Hestia Username",
                "description" => "Username of an administrator on Hestia",
                "type" => "text",
                "rules" => ['required'], // laravel validation rules
            ],
            [
                "key" => "encrypted::hestia::password",
                "name" => "Hestia Password",
                "description" => "Password of an administrator on Hestia",
                "type" => "password",
                "rules" => ['required'], // laravel validation rules
            ],
        ];
    }

    /**
     * Define the default package configuration values required when creatig
     * new packages. i.e maximum ram usage, allowed databases and backups etc.
     *
     * Laravel validation rules: https://laravel.com/docs/10.x/validation
     *
     * @return array
     */
    public static function setPackageConfig(Package $package): array
    {
       $packages = self::getHestiaPackages()->mapWithKeys(function ($item, $key) {
            return [$key => $key];
        });

        return [
            [
                "col" => "col-12",
                "key" => "package",
                "name" => "Hestia Package",
                "description" => "Select the Hestia Package that belongs to this Package",
                "type" => "select",
                "options" => $packages,
                "rules" => ['required'], // laravel validation rules
            ],
        ];
    }

    protected static function getHestiaPackages()
    {
        return collect(self::api()->getModuleUser()->listUserPackages());
    }

    /**
     * Define the checkout config that is required at checkout and is fillable by
     * the client. Its important to properly sanatize all inputted data with rules
     *
     * Laravel validation rules: https://laravel.com/docs/10.x/validation
     *
     * @return array
     */
    public static function setCheckoutConfig(Package $package): array
    {
        return [];    
    }

    /**
     * Define buttons shown at order management page
     *
     * @return array
     */
    public static function setServiceButtons(Order $order): array
    {
        return [
            [
                "name" => "Login to Hestia",
                "color" => "primary",
                "href" => 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port')
            ],
        ];    
    }

    /**
     * Define sidebar buttons
     *
     * @return array
     */
    public static function setServiceSidebarButtons(Order $order): array
    {
        return [
            [
                "name" => "Domains",
                "icon" => "<i class='bx bx-globe' ></i>",
                "href" => route('hestia.domains.view', $order->id)
            ],
            [
                "name" => "Mail",
                "icon" => "<i class='bx bxs-envelope' ></i>",
                "href" => route('hestia.mail.view', $order->id)
            ],
            [
                "name" => "Databases",
                "icon" => "<i class='bx bxs-data' ></i>",
                "href" => route('hestia.databases.view', $order->id)
            ],
            [
                "name" => "Backups",
                "icon" => "<i class='bx bxs-cloud-download' ></i>",
                "href" => route('hestia.backups.view', $order->id)
            ]
        ];    
    }

    /**
     * This function is responsible for upgrading or downgrading an instance of
     * the service. This method is called when a order is upgraded or downgraded
     * 
     * @return void
    */
    public function upgrade(Package $oldPackage, Package $newPackage)
    {
        $user = $this->order->user;
        try {

            $hestiaUser = ServiceAccount::where('order_id', $this->order->id)->first();
            self::api()->getModuleUser()->changeUserPackage($hestiaUser->username, $newPackage->data('package'));

        } catch(\Exception $error) {
            ErrorLog("hestia::suspend::service", "[Hestia] Hestia failed to suspend $user->username Error: {$error->getMessage()}", 'CRITICAL');
        }
    }

    /**
     * This function is responsible for creating an instance of the
     * service. This can be anything such as a server, vps or any other instance.
     * 
     * @return void
     */
    public function create(array $data = [])
    {
        $order = $this->order;
        $user = $this->order->user;
        
        try {
            $fullname = $user->first_name . ' '. $user->last_name;
            $password = Str::random(15);
            $username = $user->username . rand(100, 999); // generate 3 random numbers to prevent duplicate usernames
    
            $response = self::api()->getModuleUser()->add(
                $username,
                $password,
                $user->email,
                $order->package->data('package'),
                $fullname
            );

            // store the account on wemx
            ServiceAccount::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'service' => 'hestia',
                'username' => $username,
                'email' => $user->email,
                'password' => encrypt($password),
            ]);

            $this->emailDetails($user, $password);

            // create the domain on hestia if specified in order
            if($order->domain) {
                self::api()->getModuleWeb($username)->addDomain($order->domain);
            }
        } catch(\Exception $error) {
            ErrorLog("hestia::create::service", "[Hestia] Hestia failed to create $user->username Error: {$error->getMessage()}", 'CRITICAL');
        }
    }

    protected function emailDetails($user, $password): void
    {
        $user->email([
            'subject' => 'Hestia Account',
            'content' => "
                Your Hestia Account details: <br> <br>
                - Email: {$user->email} <br>
                - Username: {$user->username} <br>
                - Password: {$password} <br>
            ",
            'button' => [
                'name' => 'Hestia Panel',
                'url' => 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port'),
            ],
        ]);
    }

    /**
     * This function is responsible for suspending an instance of the
     * service. This method is called when a order is expired or
     * suspended by an admin
     * @return Renderable
    */
    public function suspend(array $data = [])
    {
        $user = $this->order->user;
        try {
            $hestiaUser = ServiceAccount::where('order_id', $this->order->id)->first();
            self::api()->getModuleUser()->suspend($hestiaUser->username);
        } catch(\Exception $error) {
            ErrorLog("hestia::suspend::service", "[Hestia] Hestia failed to suspend $user->username Error: {$error->getMessage()}", 'CRITICAL');
        }
    }

    /**
     * This function is responsible for unsuspending an instance of the
     * service. This method is called when a order is activated or
     * unsuspended by an admin
     * @return Renderable
    */
    public function unsuspend(array $data = [])
    {
        $user = $this->order->user;
        try {
            $hestiaUser = ServiceAccount::where('order_id', $this->order->id)->first();            
            self::api()->getModuleUser()->unsuspend($hestiaUser->username);
        } catch(\Exception $error) {
            ErrorLog("hestia::unsuspend::service", "[Hestia] Hestia failed to unsuspend $user->username Error: {$error->getMessage()}", 'CRITICAL');
        }
    }

    /**
     * This function is responsible for deleting an instance of the
     * service. This can be anything such as a server, vps or any other instance.
     * @return Renderable
    */
    public function terminate(array $data = [])
    {
        $user = $this->order->user;
        try {
            $hestiaUser = ServiceAccount::where('order_id', $this->order->id)->first();             
            self::api()->getModuleUser()->delete($hestiaUser->username);
        } catch(\Exception $error) {
            ErrorLog("hestia::terminate::service", "[Hestia] Hestia failed to delete $user->username Error: {$error->getMessage()}", 'CRITICAL');
        }
    }

    /**
     * Initiate a connection with the Hestia API
     * 
    */
    protected static function api(array $data = [])
    {
        return HestiaAPI::api();
    }
}
