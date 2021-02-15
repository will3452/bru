@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create new Admin') }}</h1>
    <div class="d-flex mb-2 align-items-center justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm "><i class="fa fa-angle-left"></i> Back</a>
    </div>
    <div class="card" id="password-app">
        <div class="card-body">
            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <div class="row">
                        <div class="col">
                            <input type="text" required placeholder="First name" name="first_name" class="form-control">
                        </div>
                        <div class="col">
                            <input type="text" required  placeholder="Last name" name="last_name" class="form-control">
                        </div>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" required placeholder="example@bru" name="email" class="form-control">
                </div>
                <div class="form-group" >
                    <div class="d-flex justify-content-between">
                        <label for="">Password </label><a href="#" v-on:click.prevent = "getNewPassword">Generate again ?</a>
                    </div>
                    <input type="text" required placeholder="Password" v-model="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-block btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        new Vue({
            data:{
                password:'{{ $genPassword }}'
            },
            methods:{
                getNewPassword(){
                    axios.get('{{ route('admin.password.generate') }}')
                        .then(res=>this.password = res.data)
                        .catch(err=>alert('something is wrong, please try again.'))
                }
            }
        }).$mount('#password-app');
    </script>
@endsection

