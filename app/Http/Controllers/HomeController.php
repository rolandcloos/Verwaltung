<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $userIssues = Issues::getUserIssues(Auth::id());
        return view('home', ['userIssues' => $userIssues] );
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
