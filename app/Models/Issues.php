<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Auth;
use DB;

class Issues extends Model
{
    use HasFactory;
/*
    public static function getIssues($id) {
        $issues = Issues::leftjoin('users', 'users.id', '=', 'issues.assignedToUserID')
                            ->select('issues.*', 'users.firstname  AS assignedFirstName', 'users.lastname AS assignedLastName')
                            ->where('issues.assignedToUserID', $id)
                            ->get();
                            
        return $issues;
    }
*/
    public static function getUserIssues($userID = null) {
        $user = User::select('clientID')
                        ->where('users.id' , Auth::id())
                        ->get();
        $clientID = @$user[0]->clientID;
        $whereSQL = [ ['issues.clientID', 'like' , '%' . $clientID . '%'], ['issues.assignedToUserID', 'like', '%' . $userID . '%'] ]; 
        if($clientID === $userID) { $whereSQL = [ ['issues.clientID', 'like' , '%' . $clientID . '%'] ]; }
        if($clientID === null || $clientID === 0 ) { $whereSQL = [ ['issues.assignedToUserID', 'like', '%' . $userID . '%'] ]; }

        $issues = Issues::leftjoin('users', 'users.id', '=', 'issues.assignedToUserID')
                        ->leftjoin('issueStates', 'issueStates.id', '=', 'issues.stateID')
                        ->select('issues.*', 'issueStates.name AS state', 'users.firstname  AS assignedFirstName', 'users.lastname AS assignedLastName', 'users.clientID')
                        ->where($whereSQL)->get();     
        return $issues;
    }

    public static function getUnassignedIssues($clientID = null) {
        if($clientID) {
            $issues = Issues::leftjoin('issueStates', 'issueStates.id', '=', 'issues.stateID')
                            ->select('issues.*')
                            ->where('issues.clientID', $clientID)
                            ->where('issues.assignedToUserID', null)
                            ->get();
        } else {
            $issues = Issues::select('issues.*')
                            ->get();
        }

        return $issues;
    }

    public static function getAssignedIssues($clientID = null) {
        if($clientID) {
            $issues = Issues::leftjoin('users', 'users.id', '=', 'issues.assignedToUserID')
                            ->leftjoin('issueStates', 'issueStates.id', '=', 'issues.stateID')
                            ->select('issues.*', 'users.firstname  AS assignedFirstName', 'users.lastname AS assignedLastName')
                            ->where('issues.clientID', $clientID)
                            ->get();
        } else {
            $issues = Issues::select('issues.*')
                            ->get();
        }

        return $issues;
    }

    public static function assignToID($issueID, $userID) {
        echo "Assignment needed in Models/Issues<br>";
        echo "DONE, assigned issue " . $issueID . " to user " . $userID . "<br>";
        Issues::where('id', $issueID)
            ->update(['assignedToUserID' => $userID]);
        return true;
    }

}
