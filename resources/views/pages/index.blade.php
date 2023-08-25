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
                    <table class="border-collapse border border-slate-500 w-full mb-6">
                        <thead>
                        <th class="text-left border border-slate-600 p-3">#</th>
                        <th class="text-left border border-slate-600 p-3">Title</th>
                        <th class="text-left border border-slate-600 p-3">Meta Title</th>
                        <th class="text-left border border-slate-600 p-3">Action</th>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td class="border border-slate-600 p-3">{{$page->title}}</td>
                                <td class="border border-slate-600 p-3">{{$page->meta_title}}</td>
                                <td class="border border-slate-600 p-3">{{strlen($page->meta_keywords) > 50 ? $page->meta_keywords.'...':$page->meta_keywords}}</td>
                                <td class="border border-slate-600 p-3">
                                    <div class="flex justify-between">
                                        <x-info-button class="ml-3">
                                            <a href="{{route('pages')}}">Edit</a>
                                        </x-info-button>
                                        <x-danger-button class="ml-3 py-1">
                                            <a href="{{route('pages')}}">Delete</a>
                                        </x-danger-button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                {{$pages->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
