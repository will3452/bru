@extends('layouts.master')
@section('main-content')
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        {{-- <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Create new event</a> --}}
    </div>

    <form action="#" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" value="{{ $event->name }}" name="name" required readonly>
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
            {{-- 2000-01-02 --}}
            <input type="date" readonly class="form-control" name="date" required value="{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="">Type</label>
            <select  name="type" id="" class="select2 custom-select" disabled>
                <option value="Quiz Game" {{ $event->type == 'Quiz Game' ? 'selected' : '' }}>Quiz Game</option>
                <option value="Slots Machine" {{ $event->type == 'Slots Machine' ? 'selected':'' }}>Slots Machine</option>
                <option value="Wheel" {{ $event->type ==  'Wheel' ? 'selected':''}}>Wheel</option>
                <option value="Puzzle Game" {{ $event->type ==  'Puzzle Game' ? 'selected':''}}>Puzzle Game</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Crystal Type</label>
            <select name="gem" id="" class="custom-select" disabled>
                <option value="purple" {{ $event->gem == 'purple' ? 'selected':'' }}>PURPLE</option>
                <option value="white" {{ $event->gem == 'white' ? 'selected':'' }}>WHITE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Entry Cost</label>
            
            <input type="text" name="cost" class="form-control" value="{{ $event->cost }}" readonly>
            
        </div>
    </form>
    
@endsection