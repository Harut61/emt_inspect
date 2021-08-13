<div class="task-body mytable" data-type="{{ $type }}">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped mb-4">
            <thead>
                <tr>
                    <th>Error Dates/Time</th>
                    <th>Error Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message['date']->format('d M,Y - h:iA') }}</td>
                        <td>{{ $message['message'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('pagination.default', ['paginator' => $messages])
</div>
