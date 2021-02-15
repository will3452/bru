@extends('layouts.master')
@section('main-content')
    <div id="admin-app">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Show Admin') }}</h1>
        <div class="d-flex mb-2 align-items-center justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm "><i class="fa fa-angle-left"></i> Back</a>
        </div>
        <div class="card" >
            <div class="card-body">
                <form action="{{ route('admin.admins.update', $admin) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" required placeholder="First name" v-model="firstname" name="first_name" class="form-control">
                            </div>
                            <div class="col">
                                <input type="text" required  placeholder="Last name" v-model="lastname" name="last_name" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" required placeholder="example@bru" v-model="email" name="email" class="form-control">
                    </div>
                    <div class="form-group" >
                        <div class="d-flex justify-content-between">
                            <label for="">New Password </label>
                        </div>
                        <input type="text" placeholder="New Password" v-model="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-2 card">
            <div class="card-header">
                Roles
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group" v-for="role in roles">
                        <input type="checkbox" v-on:click="updateRole(role.id)" :checked='checkRole(role.id)' :key="role.id"> <strong>@{{ role.name }}</strong> - @{{ role.desc }}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        new Vue({
            data:{
                firstname:'{{ $admin->first_name }}',
                lastname: '{{ $admin->last_name }}',
                email:'{{ $admin->email }}',
                password: '',
                roles:@json($roles),
                adminRoles:@json($admin->roles)
            },
            methods:{
                checkRole(id){
                    let result = false;
                    this.adminRoles.forEach(element => {
                        if(element.id == id ) result = true;
                    });
                    return result;
                },
                updateRole(id){
                    axios.post('{{ route('admin.toggle-role', $admin) }}', {id:id})
                        .then(res=>{
                            console.log(res.data)
                        })
                        .catch(err=>alert('somethis is wrong, please try again'));
                }
            }
        }).$mount('#admin-app');
    </script>
@endsection

