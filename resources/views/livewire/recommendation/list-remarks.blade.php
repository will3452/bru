<div>
    @if ($done)
    <div class="alert alert-success">
        Done!
    </div>
    @endif
    <ul class="list-group mt-2">
        @foreach ($remarks as $remark)
            <li class="list-group-item align-items-center d-flex justify-content-between">
                {{$remark->value}}
                <form action="#" wire:submit.prevent="remove({{$remark->id}})">
                    <button class="btn btn-danger">Remove</button>
                </form>
            </li>
        @endforeach
    </ul>
    @if (!count($remarks))
        <div class="alert alert-warning">Please Add new Remarks</div>
    @endif
</div>