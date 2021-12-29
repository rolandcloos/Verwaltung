<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Issues;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['role'] = User::getRole(Auth::id());

        switch (Auth::user()->roleID) {
            case 1:
                echo "RoleID: 1";
                $data['unassignedIssues'] = Issues::getUnassignedIssues(Auth::id());
                $data['team'] = User::getTeam(Auth::id());
                return view('admin.dash', ['data' => $data] );
                
            case 2:
                echo "RoleID: 2";
                return view('client.dash', ['data' => $data] );
            
            case 3:
                $data['userIssues'] = Issues::getUserIssues(Auth::id());
                return view('user.dash', ['data' => $data] );
            
            Default:
            echo "RoleID: Default";
                return view('client.dash', ['data' => $data] );
        }

    }

    /**
     * Show the ADMIN application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        $openIssues = IssuesController::getOpenIssues();
        echo "huhuuuuuuu";
        return view('admin.index')->with($openIssues);
    }

    public function changeAssignment(Request $request)
    {
        echo "Assignment<br>";
        $assignedUserID = array_keys($request->input('assignTo'));
        $issueID = $request->input('issueID');

        Issues::assignToID($issueID, $assignedUserID);


        return;
        return redirect()->back();
    }
}
