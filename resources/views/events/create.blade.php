@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Event') }}</h1>
    <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="">Hosted By</label>
            <select name="hosted_by" id="" class="custom-select select2">
                @foreach(auth()->user()->pens as $pen)
                <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" class="form-control" name="date" required>
            <div class="alert alert-warning d-flex mt-2">
                <i class="fa fa-info mr-2"></i>
                <div>
                    Event should at least be {{ \App\Setting::find(1)->event_day_away }} days away.
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="">Type</label>
            <select name="type" id="" class="select2 custom-select">
                <option value="Quiz Game">Quiz Game</option>
                <option value="Slots Machine">Slots Machine</option>
                <option value="Wheel">Wheel</option>
                <option value="Puzzle Game">Puzzle Game</option>
            </select>
        </div>
        <div class="alert alert-warning d-flex">
                <i class="fa fa-info mr-2"></i>
                <div>
                    <ul>
                        <li>Students shall be required to pay CRYSTAL to participate in your event.</li>
                        <li>Please select whether entry cost is WHITE CRYSTAL or PURPLE CRYSTAL.</li>
                        <li>Please set how many CRYSTAL will you be requiring from the students.</li>
                    </ul>
                </div>
        </div>
        <div class="form-group">
            <label for="">Crystal Type</label>
            <select name="gem" id="" class="custom-select">
                <option value="purple">PURPLE</option>
                <option value="white">WHITE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Entry Cost</label>
            
            <input type="text" name="cost" class="form-control" required>
            
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary">Create</button>
        </div>
    </form>
    
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection
@section('bottom')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(function(){
            $.fn.select2.defaults.set( "theme", "bootstrap" );
            $('select').select2();
            $('#tag').select2({
                tags:true,
                tokenSeparators: [',', ' ']
            });

            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            //rich editor
            CKEDITOR.replace('blurb',{height:"50vh", toolbarGroups: [{
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
      ],});
            CKEDITOR.replace('credit_page',{height:"50vh", toolbarGroups: [{
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
            $('#input-radio  *').css('cursor', 'pointer');
           
            //genre logic goes here
            if(!{{ $first->age_restriction ?? 0 }}){
                $('#age_level').prop('disabled', true);
            }

            $('#genre').change(function(){

                $.post('{{ route('genre.check') }}', {genre:$('#genre').val()}, function(data, res){
                    if(res !== 'success') alert('Please check your internet connection...');
                    else {
                        console.log(data);
                        if(data.age == 'only') {
                            $('#age_level').prop('disabled', false);
                            $('#age_display').hide();
                        }else {
                            $('#age_display').show();
                            $('#age_level').prop('disabled', true);
                        }
                        $('#heat_level').html("");
                        $('#violence_level').html("");
                        $.each(data['heats'], function(index, value){
                            let arr = value.split('@');
                            $('#heat_level').append(`<option value="${value}">${arr[0]}</option>`);
                        });

                        $.each(data['violences'], function(index, value){
                            let arr = value.split('@');
                            $('#violence_level').append(`<option value="${value}">${arr[0]}</option>`);
                        });
                    }
                })
            });
            
            let heat_age = 0;
            let vio_age;
            let age_str;
            $('#heat_level').change(function(){
                let val = $(this).val();
                heat_age = val.split('@')[1];
                let temp_age;
                if(heat_age > vio_age) temp_age = vio_age;
                else temp_age = heat_age;
                if(temp_age > 0) age_str = temp_age+' and up';
                else age_str = 'None';
                $('#age_count').text(age_str);
            });

            $('#violence_level').change(function(){
                let val = $(this).val();
                vio_age = val.split('@')[1];
                let temp_age;
                if(heat_age < vio_age) temp_age = heat_age;
                else temp_age = vio_age;
                if(temp_age > 0) age_str = temp_age+' and up';
                else age_str = 'None';
                $('#age_count').text(age_str);
            });
        })
    </script>
@endsection