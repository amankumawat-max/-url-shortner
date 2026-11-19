<?php 
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ShortUrl;

class DashboardController extends Controller
{
    public function index(){
    $title='Dashboard';
    $totalUrls = ShortUrl::count();
    $totalUsers = User::count();
        return view('website.dashboard.index',compact('title','totalUrls','totalUsers'));
    }
}
