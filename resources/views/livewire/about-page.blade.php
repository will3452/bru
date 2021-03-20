<div>
    @if (!empty($message))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="">Art</label>
          <input type="file" class="d-block" name="art">
        </div>
        <textarea name="content" id="text" cols="30" rows="10" class="form-control" >{{ $text }}</textarea>
      <button class="btn btn-primary mt-2 px-4 btn-block" >Save</button>
    </form>
</div>
