@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __($group->name) }}</h1>
    <a href="{{route('home') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
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
                    <form action="{{ route('group-member.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $group->id }}">
                        <div class="form-group">
                            <label for="">Name</label>
                            <select name="user_id" id="" class="form-control">
                                @foreach (\App\User::where('id', '!=', auth()->user()->id)->get()  as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>`    
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <button class="btn btn-primary">
                            Add member
                        </button>
                    </form>
                </div>
                <ul class="list-group mt-2">
                    @foreach ($group->members as $member)
                        <li class="list-group-item d-flex justify-content-between" x-data="{isEdit:false}">
                            <div class="d-flex">
                            {{ $member->full_name }} 
                            <span x-show="!isEdit"> | {{ $member->groups()->find($group->id)->pivot->title ?? 'unknown' }}</span>
                            <a x-show="!isEdit" x-on:click.prevent = "isEdit = !isEdit" href="#" class="text-sm mx-1"> Edit</a>
                                <form action="{{ route('group-member.update', $group) }}"  x-show="isEdit" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" x-on:click.prevent="isEdit = false" class="btn btn-sm btn-danger">Cancel</button>
                                    <input type="text" name="title" value="{{ $member->groups()->find($group->id)->pivot->title }}" required>
                                    <input type="hidden" name="user_id" value="{{ $member->id }}">
                                    <button class="btn btn-sm btn-primary">Save</button>
                                </form>
                            </div>
                            @if (auth()->user()->id == $group->creator_id)
                            <form action="{{ route('group-member.destroy', $group) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ $member->id }}">
                                <button class=" btn btn-sm btn-danger">Remove</button>
                            </form>
                            @endif
                            
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