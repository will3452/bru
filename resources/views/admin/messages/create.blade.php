@extends('layouts.master')
@section('main-content')
<div id="message">
    <h1 class="h3 mb-4 text-gray-800">{{ __('Compose Message') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i>List of Messages</a>
    </div>
    <div class="my-2">
        <div>
            <strong>
                A Message to: 
            </strong>
            <div>
                <a href="#" class="btn btn-outline-primary" v-on:click="selected = 1" :class="{'btn-secondary':selected == 1}">Invidual User</a>
                    <a href="#" class="btn btn-outline-primary" :class="{'btn-secondary':selected == 2}" v-on:click="selected = 2">All Users</a>
                    <a href="#" class="btn btn-outline-primary" :class="{'btn-secondary':selected == 3}" v-on:click="selected = 3">All Scholars</a>
                    <a href="#" class="btn btn-outline-primary" :class="{'btn-secondary':selected == 4}" v-on:click="selected = 4">All Integrated School Students</a>
                    <a href="#" class="btn btn-outline-primary" :class="{'btn-secondary':selected == 5}" v-on:click="selected = 5">All Reagan Students</a>
                    <a href="#" class="btn btn-outline-primary" :class="{'btn-secondary':selected == 6}" v-on:click="selected = 6">All Berkeley Students</a>
                    <a href="#" class="btn btn-outline-primary" :class="{'btn-secondary':selected == 6}" v-on:click="selected = 7">All VIP users</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            New Message for <span style="text-transform:capitalize">@{{ selected|usertype }}</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.messages.store') }}" method="POST">
            @csrf
            <div v-if="selected == 1">
               
                    <input type="hidden" :value="selected" name="type">
                    <div class="form-group">
                        <label for="">to User: </label>
                        <select name="to" id="" class="custom-select" >
                            <option value="" selected disabled>----</option>
                            <option :value="user.id" v-for="user in users" :selected="user.id == selectedUserId">
                                @{{ user.email }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Send As: </label>
                        <select name="character_sender" id="" class="custom-select">
                            <option value="" selected disabled>----</option>
                            @foreach ($characters as $char)
                                <option value="{{ $char->name }}">{{$char->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Subject : </label>
                        <input type="text" class="form-control" name="subject" required>
                    </div>
                    
                    
            </div>

            <div v-else>
                
                    <input type="hidden" :value="selected" name="type">
                    <div class="form-group">
                        <label for="">Send As: </label>
                        <select name="character_sender" id="" class="custom-select">
                            <option value="" selected disabled>----</option>
                            @foreach ($characters as $char)
                                <option value="{{ $char->name }}">{{$char->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Subject : </label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
            </div>
            <div class="form-group">
                <label for="">Message:</label>
                <textarea name="message" required id="fes" cols="30" rows="7" class="form-control" placeholder="Aa">{{ request()->message??'' }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block">Send Now</button>
            </div>
        </form>
        </div>
    </div>
    
</div>

@endsection

@section('bottom')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script>
        const app = new Vue({
            el:"#message",
            data:{
                selected:1,
                users:@json($users),
                selectedUserId:{{ request()->email ?? 0}}
            },
            filters:{
                usertype(a){
                    switch(a){
                        case 1: return 'individual User';
                        case 2: return 'all users';
                        case 3: return 'all scholars';
                        case 4: return 'all I.S students';
                        case 5: return 'all Reagan students';
                        case 6: return 'all Berkeley students';
                        case 7: return 'all VIP users';
                    }
                }
            },
            methods:{
                
            }
        });
    </script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('fes',{height:"50vh", toolbarGroups: [{
            "name": "basicstyles",
            "groups": ["basicstyles"]
            },
            {
            "name": "paragraph",
            "groups": ["list", "blocks"]
            },
            {
            "name": "links",
            "groups": ["links"]
            },
            {
            "name": "document",
            "groups": ["mode"]
            },
            {
            "name": "insert",
            "groups": ["insert"]
            },
            {
            "name": "styles",
            "groups": ["styles"]
            }
        ],});
    </script>
@endsection

@section('top')
    <style>
        
    </style>
@endsection 