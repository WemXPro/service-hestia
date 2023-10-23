
@if(HestiaAPI::user($order)->get('USERNAME'))
<div class="mb-4 p-6 bg-white rounded-lg shadow dark:bg-gray-800 flex justify-between items-end">
    <div>
        <a href="#">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Hestia Account</h5>
        </a>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ HestiaAPI::user($order)->get('USERNAME') }} ({{ HestiaAPI::user($order)->get('CONTACT') }})</p>
    </div>
    <button type="button" data-drawer-target="drawer-change-password" data-drawer-show="drawer-change-password" data-drawer-placement="right" aria-controls="drawer-change-password" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Change Password
        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
        </svg>
    </button>
</div>
@endif

<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    {{-- <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Shortcuts</h5> --}}
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"></p>

    <div class="flex flex-wrap ">
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port'). '/fm/#/' }}" target="_blank" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-folder-open'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">File Manager</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ route('hestia.databases.view', $order->id) }}" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-data'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">Databases</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ route('hestia.domains.view', $order->id) }}" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bx-globe'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">Domains</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/dns/' }}" target="_blank" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-cog'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">DNS Manager</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ 'https://'. settings('hestia::hostname') . '/phpmyadmin' }}" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bx-code-block'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">PhpMyAdmin</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/stats/' }}" target="_blank" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-bar-chart-square' ></i>            
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">Statistics</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/cron/' }}" target="_blank" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-time' ></i>          
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">Cron Jobs</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ route('hestia.backups.view', $order->id) }}" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-cloud-download' ></i>          
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">Backups</h3>
            </a>
        </div>
    </div>
</div>

<!-- Change Password -->
<div id="drawer-change-password" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-change-password-label">
    <h5 id="drawer-change-password-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400"><svg class="w-4 h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>Change Password</h5>
   <button type="button" data-drawer-hide="drawer-change-password" aria-controls="drawer-change-password" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close menu</span>
   </button>
   <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">Change your Hestia password.</p>
    <form action="{{ route('hestia.change-password', $order) }}" method="POST">
        @csrf
    <div class="mb-6">
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
        <input type="text" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="New Password" required>
    </div>

    <div class="mb-6">
        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm New Password</label>
        <input type="text" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Confirm New Password" required>
    </div>

    <div class="">
        <button type="submit" style="width: 100%" class="items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Update Password
        </button>
    
    </div>
    </form>
</div>