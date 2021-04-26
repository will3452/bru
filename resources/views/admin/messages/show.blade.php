@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Message') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        <a href="{{ route('admin.messages.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i> Write New Message</a>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                   <div>
                    <strong>To:</strong>  @if($msg->to_id != null)
                    {{ $msg->i_receiver()->email }}
                @else
                    {{ $msg->desc }}
                @endif
                   </div>
                   <div>
                       <strong>Subject:</strong> {{ $msg->subject }}
                   </div>
                </div>
                <div>
                    <small class="text-sm">{{ $msg->created_at }}</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p>- {!! $msg->message !!}</p>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
   

@endsection
