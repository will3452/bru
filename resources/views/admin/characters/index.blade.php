@extends('layouts.master')
@section('main-content')
    <div id="char">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Characters') }}</h1>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        </div>
        <div class="alert alert-primary">
            <i class="fa fa-info-circle"></i> This page, allows you to add and remove CHARACTERS for sending messages. 
        </div>
        <div class="card">
            <div class="card-header">
                <i class="fa fa-plus-circle"></i>&nbsp; Add New Character
            </div>
            <div class="card-body">
                <form action="/admin/characters" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="d-block">Image</label>
                        <input type="file" name="picture" accept="image/*" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Name of character">
                        <div class="input-group-append">
                            <button class="btn btn-primary ">ADD</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5" v-if="characters.length > 0">
            <h3>
                List Of Characters
            </h3>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between" v-for="character in characters" :key="character.id">
                    <div>
                        <img :src="character.avatar" alt="" class="rounded-circle" style="width:25px; height:25px; object-fit:cover;">
                        @{{ character.name }} 
                    </div>
                    <div>
                        <a href="#" class="text-danger" v-on:click="remove(character.id)">remove</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="/js/app.js"></script>
    <script>
        const app = new Vue({
            el:"#char",
            data:{
                characters:@json($characters),
                character:'',
            },
            methods:{
                remove(id){
                    axios.delete('/admin/characters/'+id)
                        .then(res=>{
                            this.characters = this.characters.filter(e=>e.id != id);
                        })
                        .catch(e=>{
                            alert('something is wrong, Please try again.');
                        })
                },
            }
        });
    </script>

@endsection