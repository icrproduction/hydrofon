@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
    <section class="container">
        @component('components.heading', ['title' => 'Bookings', 'url' => route('bookings.index')])
            <x-forms.button
                type="link"
                class="rounded-full mr-2"
                :href="route('bookings.create')"
            >New booking</x-forms.button>

            {!! Form::open(['route' => 'bookings.index', 'method' => 'GET']) !!}
                {!! Form::search('filter[start_time]', request('filter.start_time'), ['placeholder' => 'Filter', 'class' => 'field']) !!}
                <x-forms.button class="sr-only">
                    Search
                </x-forms.button>
            {!! Form::close() !!}
        @endcomponent

        {!! Form::open(['route' => 'bookings.index', 'method' => 'GET']) !!}
            <section class="lg:flex items-end py-2 px-3 bg-gray-100">
                <div class="mb-2 lg:mb-0 lg:mr-4">
                    {!! Form::label('filter[resource_id]', 'Resource', ['class' => 'lg:mr-1 text-xs uppercase']) !!}
                    {!! Form::select('filter[resource_id]', \App\Models\Resource::orderBy('name')->pluck('name', 'id'), request('filter.resource_id'), ['placeholder' => 'All', 'class' => 'field inline-block lg:w-auto']) !!}
                </div>

                <div class="mb-2 lg:mb-0 lg:mx-4">
                    {!! Form::label('filter[user_id]', 'User', ['class' => 'lg:mr-1 text-xs uppercase']) !!}
                    {!! Form::select('filter[user_id]', \App\Models\User::orderBy('name')->pluck('name', 'id'), request('filter.user_id'), ['placeholder' => 'All', 'class' => 'field inline-block lg:w-auto']) !!}
                </div>

                <div class="mb-2 lg:mb-0 lg:mx-4">
                    {!! Form::label('filter[start_time]', 'Start Time', ['class' => 'lg:mr-1 text-xs uppercase']) !!}
                    {!! Form::text('filter[start_time]', request('filter.start_time'), ['placeholder' => 'Start Time', 'class' => 'field inline-block lg:w-auto']) !!}
                </div>

                <div class="mb-2 lg:mb-0 lg:mx-4">
                    {!! Form::label('filter[end_time]', 'End Time', ['class' => 'lg:mr-1 text-xs uppercase']) !!}
                    {!! Form::text('filter[end_time]', request('filter.end_time'), ['placeholder' => 'End Time', 'class' => 'field inline-block lg:w-auto']) !!}
                </div>

                <div class="flex-grow text-right">
                    @if(request()->has('filter') && !empty(array_filter(request('filter'))))
                        <x-forms.link
                            :href="route('bookings.index', request()->except(['filter', 'page']))"
                        >Clear</x-forms.link>
                    @endif

                    <x-forms.button>
                        Filter
                    </x-forms.button>
                </div>
            </section>
        {!! Form::close() !!}

        @livewire('bookings-table', ['items' => $bookings->getCollection()])

        {{ $bookings->appends(['filter' => request()->get('filter'), 'sort' => request()->get('sort')])->links() }}
    </section>
@endsection
