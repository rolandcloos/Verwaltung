<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Issues extends Model
{
    use HasFactory;

    public static function getUserIssues($id) {
        $issues = Issues::leftjoin('users', 'users.id', '=', 'issues.assignedToUserID')
                            ->select('issues.*', 'users.firstname  AS assignedFirstName', 'users.lastname AS assignedLastName')
                            ->where('issues.assignedToUserID', $id)
                            ->get();
                            
        return $issues;
    }

    public static function getUnassignedIssues($clientID = null) {
        if($clientID) {
            $issues = Issues::select('issues.*')
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
