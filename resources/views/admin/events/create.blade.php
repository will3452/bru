@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create new Event') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        {{-- <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Create new event</a> --}}
    </div>

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        {{-- <div class="form-group">
            <label for="">Hosted By</label>
            <select name="hosted_by" id="" class="custom-select select2">
                @foreach(auth()->user()->pens as $pen)
                <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" class="form-control" name="date" required>
            <div class="alert alert-warning d-flex mt-2">
                <i class="fa fa-info mr-2"></i>
                <div>
                    Event should at least be {{ \App\Setting::find(1)->event_day_away }} days away.
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Type</label>
            <select name="type" id="" class="select2 custom-select">
                <option value="Quiz Game">Quiz Game</option>
                <option value="Slots Machine">Slots Machine</option>
                <option value="Wheel">Wheel</option>
                <option value="Puzzle Game">Puzzle Game</option>
            </select>
        </div>
        <div class="alert alert-warning d-flex">
                <i class="fa fa-info mr-2"></i>
                <div>
                    <ul>
                        <li>Students shall be required to pay CRYSTAL to participate in your event.</li>
                        <li>Please select whether entry cost is WHITE CRYSTAL or PURPLE CRYSTAL.</li>
                        <li>Please set how many CRYSTAL will you be requiring from the students.</li>
                    </ul>
                </div>
        </div>
        <div class="form-group">
            <label for="">Crystal Type</label>
            <select name="gem" id="" class="custom-select">
                <option value="purple">PURPLE</option>
                <option value="white">WHITE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Entry Cost</label>
            
            <input type="text" name="cost" class="form-control" required>
            
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary">Create</button>
        </div>
    </form>
    
@endsection