@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Works in Bin') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    <div class="alert alert-info">
        <i class="fa fa-bell"></i> <span> Hi, {{ auth()->guard('admin')->user()->full_name }}! This list shows books, trailers and artworks that have been deleted from the app. Please note that clicking RESTORE will return the work to the account of the owner.</span>
    </div>
    <div class="my-2">
        <form action="{{ url()->current() }}" id="typeForm">
            <div class="form-group">
                <select name="type" class="custom-select" onchange="document.getElementById('typeForm').submit()">
                    <option value="books" @if($type == 'book') selected  @endif >Books</option>
                    <option value="arts" @if($type == 'art') selected  @endif >Arts</option>
                    <option value="audio" @if($type == 'audio') selected  @endif >Audio Books</option>
                    <option value="trailers" @if($type == 'trailer')selected  @endif >Trailers / Animation / Films</option>
                    <option value="song" @if($type == 'song')selected  @endif >Songs</option>
                    <option value="podcast" @if($type == 'podcast')selected  @endif >Podcasts</option>
                </select>
            </div>
        </form>
    </div>
    @if($type == 'book')
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Cover
                </th>
                <th>
                    
                    Title
                </th>
                <th>
                    Class
                </th>
                <th>
                    Date Deleted
                </th>
                <th>
                    Category
                </th>
                <th>
                    Language
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th>
                    Is Published
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($books))
            @foreach($books as $key=>$book)
            <tr >
                <td class=""><img src="{{ $book->cover}}"  class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    {{ $book->title }}
                </td>
                <td>{{  $book->class }}</td>
                <td>{{ $book->deleted_at}}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->language }}</td>
                <td>{{ $book->cost }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>{!! $book->ispublic ? '<i class="fa fa-check fa-xs" ></i> Yes':'<i class="fa fa-times fa-xs" ></i> No'!!}</td>
                <td >
                    <form action="{{ route('admin.bin.restore', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="book">
                        <button class="btn btn-success btn-sm"><i class="fa fa-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.bin.delete', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="book">
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteForm()"><i class="fa fa-cancel"></i> Permanently delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @elseif($type == 'art')
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Artwork
                </th>
                <th>
                    Title
                </th>
                <th>
                    Artist
                </th>
                <th>
                    Date Deleted
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($books))
            @foreach($books as $key=>$book)
            <tr>
                <td class="d-flex justify-content-center"><img src="{{ $book->file}}"  class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    {{ $book->title }}
                </td>
                <td>
                    {{ $book->artist }}
                </td>
                <td>{{ $book->deleted_at}}</td>
                <td>{{ $book->cost }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>
                    <form action="{{ route('admin.bin.restore', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="art">
                        <button class="btn btn-success btn-sm"><i class="fa fa-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.bin.delete', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="art">
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteForm()"><i class="fa fa-cancel"></i> Permanently delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @elseif($type =='trailer')
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Author
                </th>
                <th>
                    Video
                </th>
                <th>
                    Status
                </th>
                <th>
                    Date Deleted
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($books))
            @foreach($books as $key=>$book)
            <tr>
                <td>
                    {{ $book->title }}
                </td>
                <td>
                    {{ $book->author }}
                </td>
                <td>
                    <a href="{{ $book->video }}">{{ Str::limit($book->video, 10) }}</a>
                </td>
                <td>
                    {{ $book->approved!= null ? 'Approved':'Not Approved' }}
                </td>
                <td>{{ $book->deleted_at}}</td>
                <td>{{ $book->cost }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>
                    <form action="{{ route('admin.bin.restore', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="trailer">
                        <button class="btn btn-success btn-sm"><i class="fa fa-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.bin.delete', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="trailer">
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteForm()"><i class="fa fa-cancel"></i> Permanently delete</button>
                    </form>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @elseif($type =='audio')
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Author
                </th>
                <th>
                    Video
                </th>
                <th>
                    Status
                </th>
                <th>
                    Date Deleted
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($books))
            @foreach($books as $key=>$book)
            <tr>
                <td>
                    {{ $book->title }}
                </td>
                <td>
                    {{ $book->author }}
                </td>
                <td>
                    <a href="{{ $book->video }}">{{ Str::limit($book->video, 10) }}</a>
                </td>
                <td>
                    {{ $book->approved!= null ? 'Approved':'Not Approved' }}
                </td>
                <td>{{ $book->deleted_at}}</td>
                <td>{{ $book->cost }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>
                    <form action="{{ route('admin.bin.restore', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="audio">
                        <button class="btn btn-success btn-sm"><i class="fa fa-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.bin.delete', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="audio">
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteForm()"><i class="fa fa-cancel"></i> Permanently delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @elseif($type == 'song')
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Cover
                </th>
                <th>
                    Title
                </th>
                <th>
                    Class
                </th>
                <th>
                    Date Deleted
                </th>
                <th>
                    Genre
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($books))
            @foreach($books as $key=>$book)
            <tr >
                <td class=""><img src="{{ $book->cover}}"  class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    {{ $book->title }}
                </td>
                <td>{{  $book->class }}</td>
                <td>{{ $book->deleted_at}}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->cost }} {{ $book->cost_type }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td >
                    <form action="{{ route('admin.bin.restore', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="song">
                        <button class="btn btn-success btn-sm"><i class="fa fa-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.bin.delete', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="song">
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteForm()"><i class="fa fa-cancel"></i> Permanently delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @elseif($type == 'podcast')
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Cover
                </th>
                <th>
                    Title
                </th>
                <th>
                    Date Deleted
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($books))
            @foreach($books as $key=>$book)
            <tr >
                <td class=""><img src="{{ $book->cover}}"  class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    {{ $book->title }}
                </td>
                <td>{{ $book->deleted_at}}</td>
                <td>{{ $book->cost }} {{ $book->cost_type }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td >
                    <form action="{{ route('admin.bin.restore', $book->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="podcast">
                        <button class="btn btn-success btn-sm"><i class="fa fa-restore"></i> Restore</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.bin.delete', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="type" value="podcast">
                        <button class="btn btn-danger btn-sm" type="button" onclick="deleteForm()"><i class="fa fa-cancel"></i> Permanently delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @endif
@endsection

@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection
@section('bottom')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
    <script>
        $(function(){
                $('#bookstable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf','colvis'
                'pdf'
            ],
        });
        $('button').addClass('.btn')
        })
        function deleteForm(e){
            let con = confirm('are you sure you want to permanent delete this work ?');
            if(con){
                e.target.parentElement.submit();
            }
        }
    </script>
@endsection