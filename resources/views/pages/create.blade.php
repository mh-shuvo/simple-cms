<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Add New Page
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{route('pages.store')}}">
                        @csrf

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" value="Title" :required="true" />
                            <x-text-input
                                id="title" class="block mt-1 w-full"
                                type="text"
                                placeholder="Ex: Articles"
                                name="title" :value="old('title')"
                                required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div class="mt-4">
                            <x-input-label for="content" value="Content"  :required="true" />

                            <x-textarea-input
                                id="content"
                                class="block mt-1 w-full"
                                placeholder="Ex: Coming Soon"
                                name="content"
                                required/>

                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <!-- Meta Title -->
                        <div class="mt-4">
                            <x-input-label for="meta_title" value="Meta Title"  :required="true" />
                            <x-text-input
                                id="meta_title" class="block mt-1 w-full"
                                type="text"
                                placeholder="Ex: CMS Articles"
                                name="meta_title" :value="old('meta_title')"
                                required />
                            <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>

                        <!-- Meta Description -->
                        <div class="mt-4">
                            <x-input-label for="meta_description" value="Meta Description"  :required="true" />

                            <x-textarea-input
                                id="meta_description"
                                class="block mt-1 w-full"
                                placeholder="Ex: CMS Articles is the one of the best article sites."
                                name="meta_description"
                                required/>

                            <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                        </div>

                        <!-- Meta Keywords -->
                        <div class="mt-4">
                            <x-input-label for="meta_keywords" value="Meta Title"  :required="true" />
                            <x-text-input
                                id="meta_keywords" class="block mt-1 w-full"
                                type="text"
                                placeholder="Ex: CMS Article,Tech Article, tech article"
                                name="meta_keywords" :value="old('meta_keywords')"
                                required />
                            <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
