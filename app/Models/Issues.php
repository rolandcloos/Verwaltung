<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Issues extends Model
{
    use HasFactory;

    public static function getUserIssues($id)
    {
        $issues = Issues::leftjoin('users', 'users.id', '=', 'issues.assignedToUserID')
                            ->select('issues.*', 'users.firstname  AS assignedFirstName', 'users.lastname AS assignedLastName')
                            ->where('issues.assignedToUserID', $id)
                            ->get();
                            
        return $issues;
    }

}
