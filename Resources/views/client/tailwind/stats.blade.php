<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 pr-2 mb-4">
        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Disk Space</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ HestiaAPI::user($order)->get('U_DISK') }} MB / {{ HestiaAPI::user($order)->get('DISK_QUOTA') }} MB</p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ceil(HestiaAPI::user($order)->get('U_DISK_%')) }}%"></div>
            </div>
            <div class="flex justify-between mt-1">
                <small class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ HestiaAPI::user($order)->get('U_DISK_%') }}% Used</small>
                <small class="mb-3 font-normal text-gray-700 dark:text-gray-400">updates every hour</small>
            </div>
        </div>

    </div>
    <div class="w-full md:w-1/2 pl-2 mb-4">

        <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Bandwith</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ HestiaAPI::user($order)->get('U_BANDWIDTH') }} MB / {{ HestiaAPI::user($order)->get('BANDWIDTH') }} MB</p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ceil(HestiaAPI::user($order)->get('U_BANDWIDTH_%', 51)) }}%"></div>
            </div>
            <div class="flex mt-1">
                <small class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ HestiaAPI::user($order)->get('U_BANDWIDTH_%') }}% Used</small>
            </div>
        </div>

    </div>
</div>