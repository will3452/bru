<div>
    <h3 class="mt-4">Featured Listings</h3>
    <form action="">
        <select wire:model="option" id="" class="form-control">
            @foreach (\App\Remark::get() as $item)
                <option value="{{$item->value}}">{{$item->value}}</option>
            @endforeach
        </select>
    </form>
    @foreach ($items as $item)
        <div class="card card-body mt-2">
            <div class="d-flex justify-content-between">
                <div>
                    Title: <strong>{{$item->recommendationable->title}}</strong> <span class="badge-success badge">{{$item->remark}}</span>
                    <div>
                        Type: <strong>
                            {{$item->type}}
                        </strong>
                    </div>
                    <div>
                        Owner: <strong>
                            {{$item->recommendationable->author ?? $item->recommendationable->artist ?? $item->recommendationable->owner}}
                        </strong>
                    </div>
                    <div>
                        Duration: <strong>
                            {{ $item->dateFormat($item->from_date) }} - {{ $item->dateFormat($item->to_date) }} / {{ $item->daysDurationCount() }} Day(s)
                        </strong>
                    </div>
                    <div>
                        Day(s) Left: <strong>{{ $item->daysDurationCount(now()) }}</strong>

                    </div>
                </div>
                <div>
                    <form action="{{route('admin.recommendation.destroy', $item->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger">
                            Remove
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{ $items->links() }}
</div>