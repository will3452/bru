@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Inbox') }}</h1>
    <a href="{{ route('home') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div id="vue-app">
        <div>
            <a href="#" v-on:click.prevent="hide = !hide">@{{ hide ? 'Unhide':'Hide' }}</a>
        </div>
        <div class="row">
            <div class="col-md-6" v-if="!hide">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                Messages
                            </div>
                            <div>
                                <a href="#" v-on:click.prevent="changeView('all')">All [@{{ latest.length }}]</a> / <a href="#" v-on:click.prevent="changeView('not_app')">Unread [@{{ unreadMessages.length }}]</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body"  style="height:80vh !important; overflow-y:auto !important;" >
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item " v-if="messages.length == 0">
                                No Message available.
                            </li>
                            <li class="list-group-item " :class="{'bg-unread':message.read_at == null}" v-for="message in messages" :key="message.id">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img :src="`/storage/character-avatar/${sender(message)}`" alt="" style="width:45px; height:45px;border-radius:50%;">
                                        <div class="ml-2">
                                            @{{ sender(message) }} <i title="read" class="fa fa-check " :class="{'text-success':message.read_at != null}"></i><br>
                                            <strong>@{{ message.subject }}</strong> <br>
                                            <small style="font-size:10px !important;">@{{ formatDate(message.created_at) }}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm" v-on:click="deletemsg(message)" >
                                            Delete
                                        </button>
                                        <button class="btn btn-sm" v-on:click="read(message)">
                                            Read
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="msg-loader" v-if="loaderShow"></div>
                <transition name="fade" mode="in-out">
                <div class="card"  v-if="selected.sender != '' ">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                            <i class="fa fa-user-circle"></i>  @{{ selected.sender }}
                            </div>
                            <div>
                                @{{  formatDate(selected.send_at) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>
                                @{{ selected.subject }}
                            </strong>
                        </p>
                        <div class="alert alert-info">
                            <div v-html="selected.message"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <i>
                            Please contact us.
                        </i>
                    </div>
                </div>
            </transition>
            </div>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="/js/app.js"></script>
    <script>
        const app = new Vue({
            el:"#vue-app",
            data:{
                hide:false,
                latest:@json($messages),
                messages:@json($messages),
                selected:{sender:'', send_at:'', subject:'', message:''},
                loaderShow:false
            },
            computed:{
                unreadMessages(){
                    return this.latest.filter(msg=>msg.read_at == null);
                }
            },
            methods: {
                formatDate(date){
                    dayjs.extend(LocalizedFormat)
                    return dayjs(date).format('llll');
                },
                changeView(type = 'all'){
                    if(type != 'all'){
                        this.messages = this.unreadMessages;
                    }else {
                        this.messages = this.latest;
                    }
                },
                sender(message){
                    if(message.messagable_type == `App\\Admin`){
                        return message.character_sender;
                    }else {
                        return 'from uknown!';
                    }
                },
                reset(){
                    this.selected.sender ='';
                    this.selected.send_at = '';
                    this.selected.subject = '';
                    this.selected.message ='';
                },
                deletemsg(message){
                    let sure = confirm("Are you sure you want to delete this message ? ");
                    if(!sure) return;
                    else {
                        this.loaderShow = true;
                        axios.delete('/inbox/'+message.id)
                            .then((res)=>{
                                console.log(res.data);
                                this.latest = this.latest.filter(e=>e.id != message.id);
                                this.messages = this.latest;
                                this.loaderShow = false;
                            })
                    }
                },
                read(message){
                    this.loaderShow = true;
                    this.reset();
                    //
                    if(message.read_at != null ){
                        this.selected.sender = message.character_sender;
                            this.selected.send_at = message.created_at;
                            this.selected.subject = message.subject;
                            this.selected.message = message.message;
                            this.loaderShow = false;
                            return;
                    }
                    axios.put('/inbox/'+message.id,{result:1})
                        .then(res=>{
                            this.messages.forEach(element => {
                                if(element.id == message.id){
                                    element.read_at = new Date();
                                }
                            });
                            this.selected.sender = message.character_sender;
                            this.selected.send_at = message.created_at;
                            this.selected.subject = message.subject;
                            this.selected.message = message.message;
                            this.loaderShow = false;
                        })
                }
            }
        });
    </script>

@endsection

@section('top')
    <style>
        .fade-enter-active{
            transition:all 250ms ease-in;
        }
        .fade-enter, .fader-enter-to{
            opacity: 0;
            transform: translateY(30%)
        }
                /* width */
        ::-webkit-scrollbar {
        width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: #eee;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #530794;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #3a0d5f;
        }
        .bg-unread{
            background: #f2f0e3;
        }

        #msg-loader {
            width: 25px;
            height: 25px;
            border: 0.3em solid #530794;
            border-bottom-color: #eee;
            border-radius: 50%;
            animation: rotforever 500ms linear 0ms infinite;
        }
        @keyframes rotforever{
            100%{
                transform: rotate(360deg);
            }
        }
    </style>
@endsection