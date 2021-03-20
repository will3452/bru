<div class="" x-data="{active:1}">
    <div>
        <button class="btn " :class="{'btn-primary':active == 1, 'btn-outline-primary':active != 1}" x-on:click="active = 1">Not Approved</button>
        <button class="btn " :class="{'btn-primary':active == 2, 'btn-outline-primary':active != 2}" x-on:click="active = 2">Approved</button>
    </div>
    <div x-show.transition="active == 1">
        <table class="table mt-2">
            <tr>
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Created By
                    </th>
                    <th>
                        #
                    </th>
                    <th>
                        #
                    </th>
                </thead>
            </tr>
            @foreach ($unapproved as $item)
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                    <td>
                        {{ $item->creator->full_name }}
                    </td>
                    <td>
                        <form action="{{ route('admin.group.update', $item) }}" method="POST">
                            @csrf
                            @method('put')
                            <button class="btn btn-success btn-sm">Approved</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.group.destroy', $item) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div x-show.transition="active == 2">
        <table class="table mt-2">
            <tr>
                <thead>
                    <th>
                        Name
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Created By
                    </th>
                    <th>
                        #
                    </th>
                </thead>
            </tr>
            @foreach ($approved as $item)
                <tr>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                    <td>
                        {{ $item->creator->full_name }}
                    </td>
                    <td>
                        <form action="{{ route('admin.group.destroy', $item) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
