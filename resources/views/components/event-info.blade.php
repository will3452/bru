@props(['event'])
<div class="card mb-2">
    <div class="card-header d-flex justify-content-between">
        <div>
            Event Information
        </div>
        <div>
            <small>Created At :</small> {{ $event->created_at->format('m / d / Y') }}
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>
                    Event Name
                </th>
                <td>
                    {{ $event->name }}
                </td>
            </tr>
            <tr>
                <th>
                    Description
                </th>
                <td>
                    {{ $event->desc }}
                </td>
            </tr>
            <tr>
                <th>
                    Date
                </th>
                <td>
                    {{ \Carbon\Carbon::parse($event->date)->format('m / d / Y') }}
                </td>
            </tr>
            <tr>
                <th>
                    Hosted By
                </th>
                <td>
                    {{ $event->hosted_by }}
                </td>
            </tr>
            <tr>
                <th>
                    Specific Work
                </th>
                <td>
                    {{ $event->work() ? $event->work()['title'].' ( '.$event->work()['type'].' )': 'N/A' }}
                </td>
            </tr>
        </table>
    </div>
</div>