@extends('layouts.app')

@section('title', 'Groups')

@section('content')
    <section class="container">
        @component('components.heading', ['title' => 'Groups', 'url' => route('groups.index')])
            <a href="{{ route('groups.create') }}" class="btn btn-primary btn-pill mr-2">New group</a>

            {!! Form::open(['route' => 'groups.index', 'method' => 'GET']) !!}
                {!! Form::search('filter[name]', request('filter.name'), ['placeholder' => 'Filter', 'class' => 'field']) !!}
                {!! Form::submit('Search', ['class' => 'btn btn-primary sr-only']) !!}
            {!! Form::close() !!}
        @endcomponent

        @livewire('groups-table', ['items' => $groups->getCollection()])

        {{ $groups->appends(['filter' => request()->get('filter'), 'sort' => request()->get('sort')])->links() }}
    </section>
@endsection
