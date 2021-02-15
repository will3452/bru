@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Show Event '.$event->name) }}</h1>
    <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div class="card shadow">
        <div class="card-header">
            Prizes
        </div>
        {{-- {{ $event }} --}}
        <div class="card-body">
           <form action="">
            <div class="card-text">
                Please check all items you wish to give the students as prizes.
            </div>
            <ul class="list-unstyled">
                <li>
                    <input type="checkbox" name="prize[]" value="Art Scene"> Art Scene
                </li>
                <li>
                    <input type="checkbox" name="prize[]" value="Hall Pass to own book"> Hall Pass to own book
                </li>
                <li>
                    <input type="checkbox" name="prize[]" value="Access to own spin-off"> Access to own spin-off
                </li>
                <li>
                    <input type="checkbox" name="prize[]" value="White Gem"> White Gem
                </li>
                <li>
                    <input type="checkbox" id="other_prize"> Physical prizes at the cost of the Author. Please specify details and guidelines here.
                </li>
                <div class="d-none" id="other">
                    <textarea name="prize[]" class="form-control" cols="30" rows="5" placeholder="Aa"></textarea>
                </div>
            </ul>
            <div class="form-group">
                <button class="btn-primary btn">
                    Update Prizes
                </button>
            </div>
           </form>
        </div>
    </div>
    {{-- mini games --}}
    <br>
    <div class="alert alert-info">
      <i class="fa fa-info-circle"></i>  Please take note of the game mechanics for your consideration. 
    </div>
    @if($event->type == 'Quiz Game')
        <div class="card shadow">
            <div class="card-header">
                Setup Quiz Game
            </div>
            <div class="card-body">
                <form action="">
                    @for($i = 0; $i < 10; $i++)
                        
                        <div class="card card-shadow card-body my-2">
                            <div class="form-group">
                                <label for="">
                                    <strong>Question # {{ $i+1 }}</strong>
                                </label>
                                <input type="text" name="question[]" class="form-control" required placeholder="Enter question {{ $i+1 }} here.">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <strong>Correct Answer # {{ $i+1 }}</strong>
                                </label>
                                <input type="text" name="answer[]" class="form-control" required placeholder="Enter Answer {{ $i+1 }} here.">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input type="number" name="price_qty[]" placeholder="qty" class="form-control">
                                </div>
                                <div class="col">
                                    <select name="prize[]" id="" class="custom-select">
                                        <option value="Hall passes">Hall Passes</option>
                                        <option value="White Gem">White Gem</option>
                                        <option value="Art Scene">Art Scene</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-group">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @elseif($event->type == 'Slots Machine')
        <div class="card shadow">
            <div class="card-header">
                Setup Slots Machine
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-group">
                        <label for="#">
                            Set the number of tries your participant is allowed to spin the images upon entry.
                        </label>
                        <input type="number" name="attempt" class="form-control" value="3">
                    </div>
                    <div class="form-group">
                        <label for="">Set prizes for the following combinations.</label>
                        <div class="mb-2 d-flex">
                            <div class="">
                                <div class="text-lg badge badge-primary">
                                    B + R + U
                                </div>
                                =
                            </div>
                            <div class="col-8">
                                <select name="prize[]" id="" class="custom-select">
                                    <option value="" selected disabled>Major Prize</option>
                                    <option value="Hall passes">Hall Passes</option>
                                    <option value="White Gem">White Gem</option>
                                    <option value="Art Scene">Art Scene</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 d-flex">
                            <div class="">
                                <div class="text-lg badge badge-primary">
                                    B + B +B or R + R+ R or U + U + U
                                </div>
                                =
                            </div>
                            <div class="col-8">
                                <select name="semi_major_prize" id="" class="custom-select">
                                    <option value="" selected disabled>Semi-Major Prize</option>
                                    <option value="Hall passes">Hall Passes</option>
                                    <option value="White Gem">White Gem</option>
                                    <option value="Art Scene">Art Scene</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 d-flex">
                            <div class="">
                                <div class="">
                                    First 2 letters are the same. =
                                </div>
                            </div>
                            <div class="col-8">
                                <select name="minor_prize" id="" class="custom-select">
                                    <option value="" selected disabled>Minor Prize</option>
                                    <option value="Hall passes">Hall Passes</option>
                                    <option value="White Gem">White Gem</option>
                                    <option value="Art Scene">Art Scene</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    {{-- end of mini games --}}
@endsection
@section('bottom')
    <script src="{{ asset('js/app.js') }}">
    </script>
    <script>
        $(function(){
            alert('this page is not yet working');
            $('#other_prize').click(function(){
                if($(this).prop('checked') == true) {
                    $('#other').removeClass('d-none');
                }else {
                    $('#other').addClass('d-none');
                }
            })
        })
    </script>
@endsection
