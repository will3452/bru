@extends('layouts.master')

@section('main-content')
    <!-- Page Heading -->
  
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-users"></i> Users</h1>
    </div>
    
    <div>
        
        <div>
            <table id="aan_table" class="table table-striped  table-bordered w-100">
                <thead>
                    <tr>
                        <th>
                            Account Name
                        </th>
                        <th>
                            Email Address
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Date Joined
                        </th>
                        <th>
                            Disable
                        </th>
                        <th>
                            Delete Permanently
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\User::get() as $user)
                        <tr x-data="
                        {
                            off:@if(isset($user->disabled))  false @else true @endif,
                            async update(){
                                console.log(window.axios);
                                let result = await axios.put('{{ route('admin.users.update', $user->id) }}')
                                if(result.status == 200) {
                                    this.off = !this.off
                                }
                            },
                            delete(){
                                if(confirm('Please type in your password to permanently delete this account.')){
                                    this.$xrefs.formdelete.submit();
                                }
                            }
                            
                        }
                        ">
                            <td>
                                {{ $user->full_name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->vip ? 'VIP ':'' }} <span style="text-transform: capitalize">{{ $user->role ?? 'reader' }}</span>
                            </td>
                            <td>
                                {{ $user->created_at->format('m/d/y') }}
                            </td>
                            <td>
                                <div class="toggle" :class="{'off':off, 'on':!off}" x-on:click="update()">
                                    <div style="">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form x-ref="formdelete" action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" x-on:click="delete()">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>
@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        .toggle{
            position:relative;width:40px;height:20px;
            cursor: pointer;
            transition: all 250ms;
        }
        .toggle div {
            position:absolute;width:20px;height:20px;
        }
        .off {
            background:#aaa; border-radius:10px;
        }
        .off div{
            background:#777;border-radius:50%;
            transform: translateX(0px);
        }
        .on{
            background:rgb(178, 220, 178); border-radius:10px;
        }
        .on div{
            background:green;border-radius:50%;
            transform: translateX(20px);

        }
    </style>
@endsection
@section('bottom')  
    <script src="{{ asset('js/app.js') }}"></script>
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
            $('#aan_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf','colvis'
            'copy', 'excel', 'pdf'
        ]
    });
        $('button').addClass('.btn')
        })
    </script>
@endsection
