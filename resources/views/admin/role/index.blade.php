@extends('layouts.master')
@section('main-content')
    <div class="d-flex mb-2 align-items-center justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm "><i class="fa fa-angle-left"></i> Back</a>
    </div>
    <div id="role-app">
        <div class="mt-2 ">
            <h3>List of roles</h3>
            <ul>
                <li v-for="role in roles">
                    @{{ role.name }} - @{{ role.desc }}
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('bottom')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        new Vue({
           data:{
               roles: @json($roles)
           }
        }).$mount('#role-app');
    </script>
@endsection

