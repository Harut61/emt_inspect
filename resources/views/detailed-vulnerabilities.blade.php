@extends('layouts.app')

@section('content')
    @parent

    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3>Vulnerability Details</h3>
                </div>
            </div>

            <div id="vulnListDetails" class="widget-content widget-content-area">
                <div class="row">
                    <form class="form-inline pt-3 col-12"
                        action="{{ url()->action('DetailedVulnerabilityListController@downloadResultsCSV', ['result_ids' => $result_ids, 'type' => $type, 'start_of_day' => $startOfDay]) }}"
                        method="GET" role="form">
                        @csrf
                        <div class="form-group col-11">
                            <button class="dt-button buttons-csv btn btn-default btn-rounded btn-sm mb-4" type="submit">
                                <span>Export CSV</span>
                            </button>
                        </div>
                        @if ($showTypeSelect)
                            <div class="form-group mb-3 col-1">
                                <select name="type" class="form-control mycontrol">
                                    <option value="secure">Secure</option>
                                    <option value="insecure">Insecure</option>
                                    <option value="all" selected>All</option>
                                </select>
                            </div>
                        @endif
                    </form>
                </div>


                <div class="table-responsive">
                    <table id="vulnDetails" class="table table-bordered table-hover table-striped mb-4">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Version</th>
                                <th>Status</th>
                                @if ($showCriticalityColumn)
                                    <th>Criticality</th>
                                    <th>Count</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr role="row" class="odd">
                                    <td>
                                        @if(isset($result->OsSoft->os_soft_name))
                                            {{$result->OsSoft->os_soft_name}}
                                        @else
                                            {{ $result->os_soft_name }}
                                        @endif
                                    </td>
                                    <td>{{ $result->version }}</td>
                                    <td>
                                        @if ($result->secure !== 0)
                                        Secure
                                        @elseif ($result->criticality === null)
                                        EOL
                                        @else
                                        Insecure
                                        @endif
                                    </td>
                                    @if ($showCriticalityColumn)
                                        @if ($result->criticality === null)
                                            <td><span class="badge badge-vuln badge-eol">EOL</span></td>
                                        @else
                                            @switch($result->criticality)
                                                @case(0)
                                                @case(1)
                                                <td><span class="badge badge-vuln badge-critical">Extremely critical</span></td>
                                                @break
                                                @case(2)
                                                <td><span class="badge badge-vuln badge-danger">Highly critical</span></td>
                                                @break
                                                @case(3)
                                                <td><span class="badge badge-vuln badge-success">Moderately critical</span></td>
                                                @break
                                                @case(4)
                                                <td><span class="badge badge-vuln badge-info">Less critical</span></td>
                                                @break
                                                @case(5)
                                                <td><span class="badge badge-vuln badge-normal">Not critical</span></td>
                                                @break
                                            @endswitch
                                        @endif

                                        <td>{{ $result->installationCount }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
