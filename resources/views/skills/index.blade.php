<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class='flex justify-end m-2 p-2'>
                <a href="{{ route('skills.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    New Skill
                </a>
            </div>

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Image
                            </th>
                            <th scope="col" class="py-3 px-6">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skills as $skill)
                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $skill->name }}
                            </th>
                            <td class="py-4 px-6">
                                <img src="{{ asset('storage/'.$skill->image) }}" class="w-12 h-12">
                            </td>
                            <td class="flex justify-end py-4 px-6">
                                <a href="{{ route('skills.edit',$skill->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Edit</a>
                                <form method='POST' action='{{ route('skills.destroy',$skill->id) }}'>
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('skills.destroy',$skill->id) }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline mr-3">Delete</a>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>
                                <h2>No skills</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
