<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use View;
use App\Models\CsThemeAdmin;
use App\Models\User;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $site_settings;
    public function __construct()
    {
        $this->site_settings = CsThemeAdmin::where('id', 1)->first();
        View::share(['site_settings' => $this->site_settings]);

        //Multiple Login
        $this->middleware(function ($request, $next) {
            if (Session::get("CS_ADMIN") != null) {
                $user = Session::get("CS_ADMIN");
                $id = $user->id;
                $resuserData = User::where('id', $id)->first();
                if($resuserData){
                    if ($resuserData->role == 'super_admin') {
                        $user_type_label = 'super_admin';
                    } else if ($resuserData->role == 'admin') {
                        $user_type_label = 'admin';
                    } else {
                        $user_type_label = 'member';
                    }
                
                    $name = $resuserData->name;
                    $canGenerateShortUrl = $resuserData->role != 'super_admin';
                    $canSeeSettings = $resuserData->role == 'super_admin';
                    
                    // Route-level access enforcement
                    $currentRoute = $request->route() ? $request->route()->getName() : null;
                    if ($currentRoute && str_starts_with($currentRoute, 'website.settings.') && !$canSeeSettings) {
                        return redirect()->route('website.dashboard.index')->with('error', 'Access denied. Settings section is only for Super Admin.');
                    }
                    // Only block URL generation for super_admin; allow viewing URL list for all roles
                    if ($currentRoute == 'website.urls.generate.store' && !$canGenerateShortUrl) {
                        return redirect()->route('website.dashboard.index')->with('error', 'Access denied. Super Admin cannot generate short URLs.');
                    }
                    
                    View::share(compact('resuserData', 'name', 'user', 'user_type_label', 'canGenerateShortUrl', 'canSeeSettings'));
                }else{
                    Session::forget("CS_ADMIN");
                }
                
            }
            return $next($request);
        });
    }
}
