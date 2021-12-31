@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $data['role'] }} {{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            Issues unassigned 
    
                        </div>
                        <div class="card card-body" id='uIssuesCard'>
                            
                            <table class="table">
                                <tr>
                                    <th>ID</th>
                                    <th>Issue</th>
                                    <th>Description</th>
                                    <th>Assigned to</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            @foreach($data['unassignedIssues'] as $Issue)
                                @if ($Issue->assignedToUserID === 0)
                                        @php 
                                            $assigned = false; 
                                            $btnClass = "btn-warning"
                                        @endphp
                                @elseif ($Issue->assignedToUserID > 0)
                                        @php 
                                            $assigned = true;
                                            $btnClass = "btn-success"
                                        @endphp
                                @endif
                                <tr>
                                    <td>{{ $Issue->id }}</td>
                                    <td>{{ $Issue->name }}</td>
                                    <td>{{ $Issue->description }}</td>
                                    <td>
                                        <div class="btn {{ $btnClass }}" onclick="assignmentTo({{ $Issue->id }})" id="AssignmentChange" data-bs-toggle="modal" data-bs-target="#assignmentModal" data-bs-issue="{{ $Issue->id }}">  
                                            @if ($Issue->assignedToUserID === 0)
                                                    Assign
                                            @elseif ($Issue->assignedToUserID > 0)
                                                    {{ $Issue->assignedToUserID }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                                            
                                        <a href="#">
                                            @if ($Issue->stateID === 0)  
                                                <div class="btn btn-info">  
                                                    Untouched
                                                </div>
                                            @elseif ($Issue->stateID === 1)
                                                <div class="btn btn-warning">  
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
                            <div class="modal fade" id="assignmentModal" tabindex="-1" role="dialog" aria-labelledby="assignmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Assign to</h5>
                                            <button type="button" class="btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="smallBody">
                                            <div>
                                                <form method='POST' action='changeAssignment'>
                                                    @csrf
                                                    <input id='issueIDInput' name='issueID' value='-1' hidden/>
                                                    @foreach ($data['team'] as $teammate)
                                                        <div class="row">
                                                            <input type="submit" id="assignTo" name="assignTo[{{$teammate->id}}]" value="{{ $teammate->firstName }} {{ $teammate->lastName }}" />
                                                        </div>
                                                    @endforeach
                                                </form>
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
    function assignmentTo(issue) {
        var issueIDInput = document.querySelector('#assignmentModal input#issueIDInput')
        issueIDInput.value = issue
    }
</script>
@endsection