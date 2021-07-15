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
           <form action="{{ route('events.update.prizes', $event) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-text">
                Please check all items you wish to give the students as prizes.
            </div>
            <ul class="list-unstyled">
                <li>
                    <input type="checkbox" name="prize[]" {{ $event->isInPrice('Art Scene') ? 'checked':'' }} value="Art Scene"> Art Scene
                </li>
                <li>
                    <input type="checkbox" name="prize[]" {{ $event->isInPrice('Hall Pass to own book') ? 'checked':'' }} value="Hall Pass to own book"> Hall Pass to own book
                </li>
                <li>
                    <input type="checkbox" name="prize[]" {{ $event->isInPrice('Access to own spin-off') ? 'checked':'' }} value="Access to own spin-off"> Access to own spin-off
                </li>
                <li>
                    <input type="checkbox" name="prize[]" {{ $event->isInPrice('White Crystal') ? 'checked':'' }} value="White Crystal"> White Crystal
                </li>
                <div id="other">
                    Others.
                    <textarea name="other_prize" class="form-control" cols="30" rows="5" placeholder="Physical prizes at the cost of the Author. Please specify details and guidelines here.">{{ $event->game->other_prize }}</textarea>
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
                Quiz game ({{ $event->game->questions()->count() }} / 10)
            </div>
            <div class="card-body">
                
                   <!-- Button trigger modal -->
                        @if ($event->game->questions()->count() != 10)
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Add New Question
                            </button>
                        @endif

                       @foreach ($event->game->questions()->latest()->get() as $item)
                           <div class="card mt-2">
                               <div class="card-header">
                                   {{ $item->question }}
                               </div>
                               <div class="card-body">
                                   <div>
                                       <strong>Answers : </strong>
                                       @foreach ($item->array_answer as $a)
                                           <span class="mr-2 {{ $item->correct_answer == $a ? 'text-success':''}}">{{ $a }}</span>
                                       @endforeach
                                   </div>
                                   <div>
                                       <strong>Prize(s) : </strong>
                                       {{ $item->qty }} {{ $item->prize }}
                                   </div>
                               </div>
                           </div>
                       @endforeach

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create new Question</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('question.create') }}" method="POST">
                                    @csrf 
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <div class="form-group">
                                        <label for="">
                                            <strong>Question</strong>
                                        </label>
                                        <input type="text" name="question" class="form-control" required placeholder="Enter question here." >
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            <strong>Correct Answer </strong>
                                        </label>
                                        <input type="text" name="correct_answer" class="form-control" required placeholder="Enter Answer  here." >
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">
                                            <strong>
                                                Answer Choices
                                            </strong>
                                        </label>
                                        <input type="text" name="answers" class="form-control" required placeholder="Enter 3 Choices here separated by two asterisk (**), include the correct answer above."
                                        >
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <input type="number" name="qty" value="1" placeholder="qty" class="form-control">
                                        </div>
                                        <div class="col">
                                            <select name="prize" id="" class="custom-select">
                                                <option value="Hall passes" selected >Hall Passes</option>
                                                <option value="White Crystal">White Crystal</option>
                                                <option value="Art Scene">Art Scene</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary">Create</button>
                            </form>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                    
                
            </div>
        </div>
    @elseif($event->type == 'Slots Machine')
        @if (!$event->game->slot)
        {{-- @if (true) --}}

            <div class="card shadow">
            <div class="card-header">
                Setup Slots Machine
            </div>
            <div class="card-body">
                <form action="{{ route('events.update.slot', $event) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="#">
                            Set the number of tries your participant is allowed to spin the images upon entry.
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="{{ $event->game->slot->number_of_tries ?? 0}}" name="number_of_tries" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary">
                                    Set
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Setted prizes for the following combinations.</label>
                        <div class="mb-2 ">
                            <div class="d-flex">
                                <div class="">
                                    B + R + U
                                </div>
                               <div>
                                    = 3 Purple Crytals.
                               </div>
                            </div>
                        </div>
                        <div class="mb-2 ">
                            <div class="d-flex">
                                <div class="">
                                    B + B +B or R + R+ R or U + U + U
                                </div>
                                <div>
                                     = 2 Hall Passes & 1 Purple Crystal.
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 ">
                            <div class="d-flex">
                                <div class="">
                                    First 2 letters are the same. =
                                </div>
                                <div>
                                    1 Hall Pass
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @else 

        @endif
    @endif
    {{-- end of mini games --}}

    {{-- event banner --}}
    <div class="card mt-2">
        <div class="card-header">
            Event Banner
        </div>
        <div class="card-body">
            <form action="{{ route('events.update.banner', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">What event title should we write on your banner?</label>
                    <input type="text" class="form-control" name="banner_title" value="{{ $event->banner_title ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="">Upload banner</label>
                    <input type="file" accept="image/*" class="d-block" name="banner_image" required>
                    @if ($event->banner_image)
                        <a href="{{ url($event->banner_image) }}" target="_blank">show current banner</a>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">
                        Upload banner
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- end of event banner --}}
@endsection
@section('bottom')
    <script src="{{ asset('js/app.js') }}">
    </script>
   
@endsection
