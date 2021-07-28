@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Event') }}</h1>
    <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    @livewire('create-event')
    
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