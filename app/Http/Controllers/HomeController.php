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
                // Admin
                $data['clients'] = User::getClients();
                $data['team'] = User::getTeam(Auth::id());
                $data['Issues'] = Issues::getUserIssues();
                //$data['assignedIssues'] = Issues::getAssignedIssues(Auth::id());
                return view('admin.dash', ['data' => $data] );
                
            case 2:
                // Client
                $data['team'] = User::getTeam(Auth::id());
                $data['Issues'] = Issues::getUserIssues(Auth::id());
                return view('client.dash', ['data' => $data] );
            
            case 3:
                // User
                $data['team'] = [];
                $data['Issues'] = Issues::getUserIssues(Auth::id());
                return view('user.dash', ['data' => $data] );
            
            Default:
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
        return view('admin.index')->with($openIssues);
    }

    
}
