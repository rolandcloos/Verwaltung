
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

            <pre>
                <?php //var_dump($data['Issues']); ?>
            </pre>

        @foreach($data['Issues'] as $Issue)
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
                                {{ $Issue->assignedFirstName . ' ' . $Issue->assignedLastName }}
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
                                {{ $Issue->state ?? '' }}
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