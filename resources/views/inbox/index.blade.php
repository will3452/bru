@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Inbox') }}</h1>
    <a href="{{ route('home') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <ul class="list-group">
        @foreach ($messages as $message)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <div class="d-flex">
                    <img src="https://via.placeholder.com/150" alt="" style="width:50px; height:50px; border-radius:50%">
                    <div class="ml-2">
                        <div>
                            @if(isset($message->admin_sender_id))
                            {{ $message->character }} 
                            @else 
                            {{ $message->sender->full_name }} 
                            @endif 
                            <span  style="font-size:10px">
                                &lt; {{ $message->created_at }} &gt;
                            </span>
                        </div>
                        <div style="font-size:10px">
                            {{ $message->subject }}
                        </div>
                        <div style="font-size:10px">
                            @if($message->read_at) <i class="fa fa-envelope-open"></i>
                            @else <i class="fa fa-envelope"></i>
                            @endif 
                        </div>
                    </div>
                </div>
                <div>
                    @if($message->read_at) <a href="{{ route('inbox.show', $message) }}" class="btn btn-outline-success btn-sm">read</a>
                    @else
                    <form action="{{ route('inbox.update', $message) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-success">Read</button>
                    </form>
                    @endif 
                    
                </div>
            </li>
        @endforeach
    </ul>
@endsection

@section('bottom')
    
@endsection

@section('top')
  
@endsection