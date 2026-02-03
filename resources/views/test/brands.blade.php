<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Test') }}
        </h2>
    </x-slot>
    <section class="w-100">
        @isset($brand)
        <form class="mt-6 space-y-6" enctype="multipart/form-data" action="{{route('brand.update',$brand->id)}}" method="post">
            @csrf
            @method('PUT')
            <div>
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{$brand->name}}" />
            </div>
            <div>
                <x-input-label for="slug" :value="__('slug')"/>
                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" value="{{$brand->slug}}"/>
            </div>
            <div>
                <x-input-label for="logo" :value="__('logo')"/>
                <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full"/>
                <img src="{{$brand->logo_url}}" class="rounded-2xl w-50" alt=""/>
            </div>


            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

            </div>
        </form>
        @else
            <form class="mt-6 space-y-6" enctype="multipart/form-data" action="{{route('brand.store')}}" method="post">
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Name')"/>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name"/>
                </div>
                <div>
                    <x-input-label for="slug" :value="__('slug')"/>
                    <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" autocomplete="slug"/>
                </div>
                <div>
                    <x-input-label for="logo" :value="__('logo')"/>
                    <x-text-input id="logo" name="logo" type="file" class="mt-1 block w-full" autocomplete="slug"/>
                </div>


                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                </div>
            </form>
        @endisset

        <table class="table bg-purple-100 text-black-700 mt-5">
            <tr>
                <th>{{__("Picture")}}</th>
                <th>{{__("Slug")}}</th>
                <th>{{__("Name")}}</th>
                <th>{{__("Process")}}</th>
            </tr>
            @foreach($brands as $brand)
                <tr>
                    <td><img class="w-1/2 rounded-xl" src="{{$brand->logo_url}}" alt=""/></td>
                    <td>{{$brand->name }}</td>
                    <td>{{$brand->slug}}</td>
                    <td><a href="{{route('test.brands.edit',$brand->slug)}}" class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 inset-ring inset-ring-yellow-600/20 dark:bg-yellow-400/10 dark:text-yellow-500 dark:inset-ring-yellow-400/20" >{{__('Edit')}}</a>
                        <form action="{{route('brand.destroy',$brand->slug)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 inset-ring inset-ring-red-600/10 dark:bg-red-400/10 dark:text-red-400 dark:inset-ring-red-400/20">{{__('Delete')}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
</x-guest-layout>
