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

                    @if(!empty(session('error')))
                        <div style="font-size: 18px;color: red">{{ session('error') }}</div>
                    @endif

                    @if(!empty(session('message')))
                        <div style="font-size: 18px;color: green">{{ session('message') }}</div>
                    @endif

                    <form action="{{url('feed')}}" method="POST">
                        @method('POST')
                        @csrf

                        <label for="url">Add Feed URL:</label>
                        <input id="url" required name="url" type="text" class="@error('url') is-invalid @enderror">

                        <input type="submit">
                        @error('url')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </form>
                    <br/>


                    <h1>Your RSS personal list:</h1>

                    @foreach($feeds as $feed)
                        <div style="margin-top: 60px">
                            <h2><strong>Feed:</strong> <a
                                    href="{{ route('feed', ['id' => $feed->id])}}">{{ $feed->feed_title }}</a></h2>
                            <p><strong>Story count:</strong> {{ $feed->story_count }}</p>
                        </div>

                    @endforeach


                </div>
            </div>
        </div>
</x-app-layout>
