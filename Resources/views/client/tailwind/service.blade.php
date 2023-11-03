<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    {{-- <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Shortcuts</h5> --}}
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"></p>

    <div class="flex flex-wrap ">
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ settings('hestia::hostname') . ':' . settings('hestia::port'). '/fm/#/' }}" target="_blank" class="flex flex-col items-center justify-center">
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
            <a href="{{ settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/dns/' }}" target="_blank" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-cog'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">DNS Manager</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ settings('hestia::hostname') . '/phpmyadmin' }}" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bx-code-block'></i>
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">PhpMyAdmin</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/stats/' }}" target="_blank" class="flex flex-col items-center justify-center">
                <div class="flex justify-center items-center mb-2 w-10 h-10 bg-primary-100 rounded dark:bg-primary-900 lg:h-16 lg:w-16">
                    <span class="flex items-center justify-center text-primary-600 dark:text-primary-300 lg:w-8 lg:h-8 bx-md">
                        <i class='bx bxs-bar-chart-square' ></i>            
                    </span>
                </div>
                <h3 class="mb-2 text-md font-bold text-gray-900 dark:text-white">Statistics</h3>
            </a>
        </div>
        <div class="w-1/2 md:w-1/4 pr-4 pl-4 mb-4">
            <a href="{{ settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/cron/' }}" target="_blank" class="flex flex-col items-center justify-center">
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
