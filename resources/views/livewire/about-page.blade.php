<div>
    @if (!empty($message))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <form action="{{ route('admin.about.store') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="">About header</label>
        <input type="text" name="title" value="{{ $title }}" class="form-control">
      </div>
        <textarea name="content" id="text" cols="30" rows="10" class="form-control" >{{ $text }}</textarea>
      <button class="btn btn-primary mt-2 px-4" >Save</button>
    </form>
</div>
