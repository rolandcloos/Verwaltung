<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issues;

class IssuesController extends Controller
{
    /**
     * Display Issues that are currently unassigned.
     *
     * @return App\Models\Issues::getUnassignedIssues($id)
     */
    public static function getUnassignedIssues($id)
    {
        if (!$id) { $id = auth()->user(); }
        return Issues::getUnassignedIssues($user->id);

    }

    /**
     * Returns all User assigned Issues.
     *
     * @return App\Models\Issues::getUserIssues($id)
     */
    public static function getUserIssues($userID)
    {
        return Issues::getUserIssues(null, $userID);

    }

    public function changeAssignment(Request $request)
    {
        var_dump($request->input('assignTo'));
        $assignedUserID = array_keys($request->input('assignTo'));
        $issueID = $request->input('issueID');
        if (Issues::assignToID($issueID, $assignedUserID[0])) 
        return redirect()->back();

        echo "Error while assigning Issue " . $issueID . " to User " . print_r($assignedUserID) . "<br>";
        return "Please contact the administrator";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
