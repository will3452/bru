@extends('layouts.master')
@section('main-content')
    <div class="d-flex justify-content-between align-items-center">
      <h1>Setting up About Page</h1>
      <a href="/about?back=true" class="btn btn-primary "><i class="fa fa-file"></i> View About Page</a>
    </div>
    @livewire('about-page')
    <br>
    <h1>Setting up About Link Accounts</h1>
    <div x-data="{showCreate:false}">
      <div class="text-right">
        <button class="btn btn-primary" x-on:click="showCreate = !showCreate">
          <div x-text="!showCreate ? 'Create Account':'Close'"></div>
        </button>
      </div>
      <div class="card card-body mt-2" x-show.transition="showCreate">
        <form action="{{ route('admin.aboutaccount.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group" >
            <label for="">Account Picture</label>
            <input type="file" class="d-block" name="picture" required>
          </div>
          <div class="form-group">
            <label for="">Account Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label for="">Account Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>
          <div class="form-group">
            <label for="">FB link</label>
            <input type="text" class="form-control" name="fb_link" required>
          </div>
          <div class="form-group">
            <label for="">IG link</label>
            <input type="text" class="form-control" name="ig_link" required>
          </div>
          <button class="btn btn-block btn-primary">Add Account</button>
        </form>
      </div>
    </div>
   <div class="row mt-2">
      @foreach (\App\AboutAccount::get() as $account)
      <div class="col-md-6 p-1">
        <div class="card " x-data="{isEdit:false}">
          <div class="d-flex justify-content-between card-body">
            <img src="{{ $account->picture }}" alt="" style="height:100px;width:100px;object-fit:cover;" class="rounded-circle">
            <div x-show="!isEdit">
              <div>
                <strong>Name: </strong>
                {{ $account->name }}
              </div>
              <div>
                <strong>Title: </strong>
                {{ $account->title }}
              </div>
              <div>
                <strong>FB: </strong>
                {{ $account->fb_link }}
              </div>
              <div>
                <strong>IG: </strong>
                {{ $account->ig_link }}
              </div>
              <div class="truncate">
                <strong>PIC: </strong>
                {{ \Str::limit($account->picture, 20) }}
              </div>
              <a href="#" xref="editbutton" x-on:click.prevent="isEdit = true">Edit</a>
            </div>
            <div x-show="isEdit">
              <form action="{{ route('admin.aboutaccount.update', $account) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group" >
                  <label for="">Account Picture</label>
                  <input type="file" class="d-block" name="picture" required>
                </div>
                <div class="form-group">
                  <label for="">Account Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $account->name }}" required>
                </div>
                <div class="form-group">
                  <label for="">Account Title</label>
                  <input type="text" class="form-control" name="title" value="{{ $account->title }}" required>
                </div>
                <div class="form-group">
                  <label for="">FB link</label>
                  <input type="text" class="form-control" name="fb_link" value="{{ $account->fb_link }}" required>
                </div>
                <div class="form-group">
                  <label for="">IG link</label>
                  <input type="text" class="form-control" name="ig_link" value="{{ $account->ig_link }}" required>
                </div>
                <button class="btn btn-primary">Save</button>
                <button type="button" x-on:click="isEdit=false" class="btn btn-secondary">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach
   </div>
@endsection
@section('top')
    @livewireStyles
@endsection


@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        // config.extraPlugins = 'font';
        CKEDITOR.replace('text',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
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
      ]});
      
    </script>
    @livewireScripts
@endsection