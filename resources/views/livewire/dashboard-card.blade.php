<div class="col-md-3 mt-2" x-data="{showPane:false}">
    <div x-text="showPane"></div>
    <div class="card border-{{$color}} border-top-0 border-right-0 border-bottom-0" style="border-left-width:2px;">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-baseline text-uppercase">
                <i class="fa fa-2x {{$icon}} mr-2"></i> <h5>{{$count}} {{$item}}</h5>
            </div>
            <button x-on:click="showPane = !showPane" class="btn btn-sm rounded"><i class="fa fa-angle-down"></i></button>
        </div>
        <div class="card-footer" x-show.transition="showPane">
            @foreach ($details as $key=>$val)
                <div class="d-flex align-items-center justify-content-between">
                    <strong>{{$key}}</strong>
                    <div class="badge badge-{{$color}}">
                        {{$val}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>