@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of your events') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Create new event</a>
        <form action="{{ url()->current() }}"  method="GET" id="filterForm">
            <select name="filter" id="" onchange="document.getElementById('filterForm').submit()">
                <option value="approved">Approved</option>
                <option value="pending" {{ request()->has('filter') && request()->filter == 'pending' ? 'selected':'' }}>Pending</option>
            </select>
        </form>
    </div>
    <div class="row">
        @foreach ($events as $event)
            <x-dashboard-card>
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-truncate">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
                        </div>
                    </div>
                    <div class="col-auto">
                        @if ($event->type)
                            <span class="badge badge-primary">
                                {{ $event->type}}
                            </span>
                        @endif
                    </div>
                </div>
            </x-dashboard-card>
        @endforeach
    </div>
    @if (!count($events))
        <x-empty/>
    @endif
@endsection