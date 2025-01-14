<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">

                    <a href="{{ route('users.create') }}"
                        class="mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        Create
                    </a>

                    <div class="min-w-full align-middle">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="bg-gray-50 px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Name</span>
                                    </th>
                                    <th class="w-56 bg-gray-50 px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Email</span>
                                    </th>
                                    <th class="w-56 bg-gray-50 px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Hobby</span>
                                    </th>
                                    <th class="w-56 bg-gray-50 px-6 py-3 text-left">
                                        <span
                                            class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Action</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                            @if (auth()->user()->id == $user->id)
                                                <span class="text-xs font-semibold text-red-500">(your account)</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <ul>
                                                @foreach ($user->hobbies as $hobby)
                                                    <li>{{ $hobby->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                Edit
                                            </a>
                                            @if (auth()->user()->id != $user->id)
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')"
                                                    style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button>
                                                        Delete
                                                    </x-danger-button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
