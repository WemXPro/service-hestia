@extends(Theme::path('orders.master'))

@section('title', __('client.services'))

@section('content')
<div class="border-gray-200 dark:border-gray-800 flex justify-between items-end">       
    <div>
        <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white" id="content">Mail</h1>
        <p class="mb-4 text-lg text-gray-600 dark:text-gray-400">
            Manage your mail accounts
        </p>
    </div>

    <!-- drawer init and toggle -->
    <div class="text-right">
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
            Add Mail Domain
        </button>
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-right-create-ftp" data-drawer-show="drawer-right-create-ftp" data-drawer-placement="right" aria-controls="drawer-right-create-ftp">
            Create Email
        </button>
    </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Quota
                </th>
                <th scope="col" class="px-6 py-3">
                    Disk
                </th>
                <th scope="col" class="px-6 py-3">
                    Auto Reply
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $domain => $account)
                @foreach($account as $user => $address)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user . '@'. $domain}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $address['QUOTA'] }} MB
                    </td>
                    <td class="px-6 py-4">
                        {{ $address['U_DISK'] }} MB
                    </td>
                    <td class="px-6 py-4">
                        {{ $address['AUTOREPLY'] }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ 'https://'. settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/mail/' }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View <i class='bx bx-link-external'></i></a></a>
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>
 
 <!-- drawer component -->
 <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
    <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
        <svg class="w-4 h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        Create Mail Domain
    </h5>
    <button
        type="button"
        data-drawer-hide="drawer-right-example"
        aria-controls="drawer-right-example"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
    >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
        Add a new domain to create emails for
    </p>
    <form action="{{ route('hestia.mail.domain.create', $order->id) }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">  
            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domain</label>
            <input type="text" name="domain" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="example.com">
        </div>

    <div class="grid grid-cols-1 gap-4">
        <button
            type="submit"
            class="items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Create Domain
        </button>
    </div>
    </form>
    <div class="relative overflow-x-auto shadow-md sm:rounded">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Domain
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($domains as $key => $domain)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $domain }}
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

 <!-- drawer component -->
 <div id="drawer-right-create-ftp" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-create-ftp-label">
    <h5 id="drawer-create-ftp-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
        <svg class="w-4 h-4 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        Create Email Address
    </h5>
    <button
        type="button"
        data-drawer-hide="drawer-right-create-ftp"
        aria-controls="drawer-right-create-ftp"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
    >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <p class="mb-4 text-sm text-gray-500 dark:text-gray-400">
        Create a new domain that will be added to your Hestia Panel
    </p>
    <form action="{{ route('hestia.mail.create', $order->id) }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">
            <label for="domain" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Domain</label>
            <select id="account_domain" onchange="updatePreset()" name="domain" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($domains as $key => $domain)
                    <option value="{{ $domain }}">{{ $domain }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">  
            <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <div class="flex">
              <input type="text" name="username" id="website-admin" class="rounded-none rounded-l-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username">
              <span id="preset_domain" class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-l-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                
              </span>
            </div>
        </div>

        <div class="mb-4">  
            <label for="helper-text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="text" name="password" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password">
        </div>

    <div class="grid grid-cols-1 gap-4">
        <button
            type="submit"
            class="items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Create Domain
        </button>
    </div>
    </form>
</div>

<script>
    updatePreset();
    function updatePreset() {
        document.getElementById('preset_domain').innerHTML = '@' + document.getElementById('account_domain').value;
    }
</script>
@endsection