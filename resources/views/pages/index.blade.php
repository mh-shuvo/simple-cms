<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pages
            </h2>
            <x-primary-button class="ml-3">
                <a href="{{route('pages.create')}}">Add New Page</a>
            </x-primary-button>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-right mb-6">
                        <div class="mb-6">
                            <form action="{{url()->full()}}">
                                <x-text-input name="q" placeholder="Search by title,status, keywords" class="top-0 right-0"/>
                                <x-primary-button type="submit" class="ml-3 bg-green-600 hover:bg-green-600">
                                    Search
                                </x-primary-button>
                            </form>
                        </div>
                        <div class="flex justify-between {{!request()->has('q') ? 'hidden':''}}">
                            <p>
                                Search with <b>" {{request()->get('q')}} "</b>
                            </p>
                            <button type="button" class="ml-3 bg-indigo-600 hover:bg-indigo-600 text-white pl-2 pr-2 pt-1 pb-1 rounded ">
                                <a href="{{route('pages')}}">Clear</a>
                            </button>
                        </div>
                    </div>
                    <table class="border-collapse border border-slate-500 w-full mb-6">
                        <thead>
                        <th class="text-left border border-slate-600 p-3">#</th>
                        <th class="text-left border border-slate-600 p-3">Title</th>
                        <th class="text-left border border-slate-600 p-3">Status</th>
                        <th class="text-left border border-slate-600 p-3" width="10%">Action</th>
                        </thead>
                        <tbody>
                        @forelse($pages as $key => $page)
                            <tr>
                                <td class="border border-slate-600 p-3">{{$key +1}}</td>
                                <td class="border border-slate-600 p-3">{{$page->title}}</td>
                                <td class="border border-slate-600 p-3">{{ucfirst($page->status)}}</td>
                                <td class="border border-slate-600 p-3">
                                    <div class="flex justify-between">
                                        <x-info-button class="ml-3">
                                            <a href="{{route('pages.edit',[$page->slug])}}">Edit</a>
                                        </x-info-button>
                                        <x-danger-button class="ml-3 py-1 deletePage" data-key="{{$page->slug}}"> Delete </x-danger-button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-2 text-center text-gray-500">No data found.</td>
                                </tr>
                        @endforelse
                        </tbody>
                    </table>
                {{$pages->links()}}
                </div>
            </div>
        </div>
    </div>

    <form action="" method="POST"  id="deletePageForm">
        @csrf
        @method('DELETE')
    </form>

</x-app-layout>
