@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __($group->name) }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div class="card">
        <div class="card-header">
            Group Details
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>
                        Date Created
                    </th>
                    <td>
                        {{ $group->created_at->format('m/d/Y') }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Type
                    </th>
                    <td>
                        {{ $group->type }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Members
                    </th>
                    <td>
                        {{ $group->members->count() }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @if (!$group->approved)
        <div class="alert alert-warning mt-2">
            This group must be approved by the admnistrator for you to add members.
        </div>
    @else
        <div class="card mt-2" x-data="{showCreate:false}">
            <div class="card-header">
                Group Members
            </div>
            <div class="card-body">
                <button class="btn btn-primary" x-on:click="showCreate = !showCreate">
                    <i class="fa" :class="{'fa-angle-right':!showCreate, 'fa-angle-down':showCreate}"></i> Add Member
                </button>
                <div class="card card-body mt-2" x-show="showCreate">
                    <form action="">
                        <div class="form-group">
                            <label for="">Name</label>
                            <select name="user_id" id="" class="form-control">
                                @foreach (\App\User::where('id', '!=', auth()->user()->id)->get()  as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <button class="btn btn-primary">
                            Add member
                        </button>
                    </form>
                </div>
                <ul class="list-group mt-2">
                    @foreach ($group->members as $member)
                        <li class="list-group-item">
                            {{ $member->full_name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection

@section('top')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection