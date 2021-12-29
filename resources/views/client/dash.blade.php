@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary font-weight-bold text-light">{{ $data['role'] }} {{ __('Dashboard') }}</div>

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
                            @foreach($data['userIssues'] as $Issue)
                                <tr>
                                    <td>{{ $Issue->id }}</td>
                                    <td>{{ $Issue->name }}</td>
                                    <td>{{ $Issue->description }}</td>
                                    <td>{{ $Issue->assignedLastName}}, {{ $Issue->assignedFirstName}}</td>
                                    <td>
                                                              
                                        <a href="#">
                                            @if ($Issue->stateID === 0)  
                                                <div class="btn btn-info" id="stateChange">  
                                                    Untouched
                                                </div>
                                            @elseif ($Issue->stateID === 1)
                                                <div class="btn btn-warning" id="stateChange">  
                                                    working
                                                </div>
                                            @endif
                                        </a>                                   
                                        
                                    </td>
                                    <td>
                                        <div class="btn btn-dark">Edit</div>
                                    </td>
                                </tr>
                            @endforeach     
                            </table>
            
                            <!-- small modal -->
                            <div class="modal fade" id="stateChangeModal" tabindex="-1" role="dialog" aria-labelledby="stateChangeModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">Helloooo</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="smallBody">
                                            <div>
                                                <!-- the result to be displayed apply here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                      
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });
</script>
@endsection
