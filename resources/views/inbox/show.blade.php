@extends('layouts.admin')
@section('main-content')
    <a href="{{ route('inbox.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div>
        <div class="card">
            <div class="card-header">
                <i class="fa fa-user mr-2"></i>
                @if(isset($message->admin_sender_id))
                    {{ $message->character }} 
                @else 
                    {{ $message->sender->full_name }} 
                @endif 
                    <span  style="font-size:10px">
                        &lt; {{ $message->created_at }} &gt;
                    </span>
            </div>
            <div class="card-body">
                Subject : {{ $message->subject }}
                <div class="card card-body">
                    {!! $message->body !!}
                </div>
                @if (count($message->replies))
                    <hr>
                    <div>
                        <span  style="font-size:10px">
                            &lt; Reply &gt;
                        </span>
                    </div>
                    @foreach ($message->replies as $reply)
                        <div class="card mb-2">
                            <div class="card-header">
                                <i class="fa fa-user mr-2"></i>
                                @if(isset($reply->admin_sender_id))
                                    {{ $reply->character }} 
                                @else 
                                    {{ $reply->sender->full_name == auth()->user()->full_name ? 'You' : auth()->user()->full_name }} 
                                @endif
                                <span  style="font-size:10px">
                                    &lt; {{ $message->created_at }} &gt;
                                </span>
                            </div>
                            <div class="card-body">
                                {!! $reply->body !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            @if ($message->replyable != null && count($message->replies) == 0)
            <div class="card-footer" x-data="{
                showform:false
            }">
                <form action="{{ route('inbox.store') }}" x-show="showform" method="POST">
                    @csrf
                    <input type="hidden" name="message_id" value="{{ $message->id }}">
                    <div class="form-group">
                        <label for="">Reply Message</label>
                        <textarea name="body" required id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm">
                            <i class="fa fa-paper-plane"></i> send
                        </button>
                    </div>
                </form>
                <button class="btn btn-success btn-sm" x-show="!showform" x-on:click="showform = true">
                    <i class="fa fa-reply"></i> Reply
                </button>
             </div>
            @else
            <div class="card-footer">
                <i>**** You cannot reply to this specific message. Should you need to, please contact us thru <a href="/support-chat">Email</a> or <a href="/support-chat">Tech Support</a>.***</i>
            </div>
            @endif
        </div>
    </div>
@endsection

@section('bottom')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('top')
  
@endsection