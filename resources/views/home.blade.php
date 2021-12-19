@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Issue</th>
                                    <th>Description</th>
                                    <th>Assigned to</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            @foreach($userIssues as $Issue)
                                <tr>
                                    <td>{{ $Issue->id }}</td>
                                    <td>{{ $Issue->name }}</td>
                                    <td>{{ $Issue->description }}</td>
                                    <td>{{ $Issue->assignedLastName}}, {{ $Issue->assignedFirstName}}</td>
                                    <td>
                                        @if ($Issue->stateID === 0)
                                        <div class="btn btn-info">Untouched</div>
                                        @elseif ($Issue->stateID === 1)
                                        <div class="btn btn-success">working</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn btn-warning">Edit</div>
                                    </td>
                                </tr>
                            @endforeach    
 
                            </table>
            

                      
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
