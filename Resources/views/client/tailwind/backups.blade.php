@extends(Theme::path('orders.master'))

@section('title', __('client.services'))

@section('content')
<div class="border-gray-200 dark:border-gray-800 flex justify-between items-end">       
    <div>
        <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white" id="content">Backups</h1>
        <p class="mb-4 text-lg text-gray-600 dark:text-gray-400">
            Manage your backups
        </p>
    </div>

    <!-- drawer init and toggle -->
    <div class="text-right mb-4">
        <a href="{{ route('hestia.backups.create', $order->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Create Backup
        </a>
    </div>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Filename
                </th>
                <th scope="col" class="px-6 py-3">
                    Size
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Runtime
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $key => $backup)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $key }}
                </th>
                <td class="px-6 py-4">
                    {{ $backup['SIZE'] }} MB
                </td>
                <td class="px-6 py-4">
                    {{ $backup['TYPE'] }}
                </td>
                <td class="px-6 py-4">
                    {{ $backup['RUNTIME'] }} minute(s)
                </td>
                <td class="px-6 py-4">
                    {{ $backup['DATE'] }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ settings('hestia::hostname') . ':' . settings('hestia::port'). '/list/backups/' }}" target="_blank" class="ml-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">View <i class='bx bx-link-external'></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
