@extends('layouts.master')
@section('main-content')
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('admin.home') }}" class="btn btn-sm btn-primary">Back to Dashboard</a>
        <div>
            <a href="{{ route('admin.messages.index') }}?utype=user" class="btn btn-sm btn-primary"><i class="fas fa-check-circle fa-sm mr-2"></i>Outbox</a>
            <a href="{{ route('admin.messages.index') }}?utype=user&mtype=in" class="btn btn-sm btn-primary"><i class="fas fa-inbox fa-sm mr-2"></i>Inbox</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div>
                <i class="fa fa-pen mr-2">
                </i> Write New Message
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.messages.store') }}" method="POST" x-data="{
                type:'user',
                updateType(){
                    this.type = document.getElementById('typeSelector').value;
                }
            }">
            @csrf
                <div class="form-group">
                    <label for="">
                        A Message for
                    </label>
                    <select name="type" id="typeSelector" class="custom-select" x-on:change="updateType()">
                        <option value="user">User</option>
                        <option value="scholars">All Scholars</option>
                        <option value="students">All Students</option>
                        <option value="integrated school">All IS Students</option>
                        <option value="reagan">All Reagan Students</option>
                        <option value="berkeley">All Berkeley Students</option>
                        <option value="users">All Users</option>
                        <option value="vip">All VIP</option>
                    </select>
                </div>
                <template x-if="type == 'user' " >
                    <div class="form-group">
                        <label for="">Select User</label>
                        <select name="receiver_id" id="" class="custom-select">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if(isset(request()->email) && request()->email == $user->id) selected @endif >
                                    {{ $user->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </template>
                <div class="form-group">
                    <label for="">
                        Send as
                    </label>
                    <select name="character" id="" class="custom-select">
                        @foreach ($characters as $character)
                            <option value="{{ $character->name }}">
                                {{ $character->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">
                        Subject
                    </label>
                    <input type="text" class="form-control" name="subject" value="@if(isset(request()->ticket))  Admin Reply: {{ request()->ticket }} @elseif(isset(request()->subject))  {{ request()->subject }} @endif" required>
                </div>
                <div class="form-group">
                    <label for="">Body</label>
                    <textarea name="body" id="" cols="30" rows="10">{!! request()->message !!}</textarea>
                </div>
                <input type="hidden" name="to_ticket" value="{{ request()->ticket }}">
                <div class="form-group" x-show="type == 'user'">
                    <label for="">Replyable ? </label>
                    <span>
                    <input type="checkbox" name="replyable" value="1">
                    Yes
                    </span>
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('top') 
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
@endsection

@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('body')
    </script>

@endsection