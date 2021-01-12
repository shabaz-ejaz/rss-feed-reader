<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>{{ $feed->feed_title }}</h1>

                    <br />


                    @foreach($feed->feed->get_items() as $story)
                        <div style="margin-top: 60px">
                            <h2><strong><a href="{{ $story->get_link() }}">{{ $story->get_title() }}</a></strong></h2>
                            <span style="font-size: 14px">{{ $story->get_date() }}</span>
                            <p>{{ $story->get_description() }}</p>
                        </div>
                    @endforeach

                </div>
        </div>
    </div>
</x-app-layout>
