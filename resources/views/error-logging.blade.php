@extends('layouts.app')

@section('content')
    @parent

    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>Error Logging</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="myh"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="form-inline col-12"
                                action="{{ url()->action('ErrorsLoggingController@downloadLogsCSV') }}" method="GET"
                                role="form">
                                @csrf
                                <div class="form-group">
                                    <button class="dt-button buttons-csv btn btn-default btn-rounded btn-sm mb-4"
                                        type="submit">
                                        <span>Export CSV</span>
                                    </button>
                                </div>
                            </form>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
