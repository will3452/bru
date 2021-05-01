<div class="card" id="createForm">
    <h5 class="card-header">
        Create Featured Lists
    </h5>
    <div class="card-body">
        <form action="{{ route('admin.recommendation.store') }}" method="POST">
            @csrf
            <div class="row form-group">
                <div class="col-md-12">
                    <label for="">Remark</label>
                    <select name="remark" id="" class="d-block w-100 p-2" required>
                        <option value="" selected disabled>Please select a remark</option>
                        @foreach (\App\Remark::get() as $remark)
                            <option value="{{$remark->value}}">{{$remark->value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="">
                        Work Type
                    </label>
                    <select name="type" required wire:model="type" id="" class="d-block w-100 p-2">
                        <option value="" disabled selected>Select Type</option>
                        <option value="Book">Book</option>
                        <option value="Art">Art Scene</option>
                        <option value="Audio">Audio Book</option>
                        <option value="Thrailer">Film</option>
                        <option value="Song">Song</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="">
                        Add Work to the List
                    </label>
                    @if (count($options))
                    <select name="id" id="" required class="d-block w-100 p-2">
                        <option value="" disabled selected>Select Item</option>
                        @foreach ($options as $option)
                            <option value="{{$option->id}}">{{$option->title}}</option>
                        @endforeach
                    </select>
                    @else
                    <div class="alert alert-warning">No Item Found.</div>
                    @endif
                </div>
                
            </div>
            <div class="text-right form-group">
                <button class="btn btn-primary" :disabled="!lock">
                    Add
                </button>
            </div>
        </form>
    </div>
    
</div>