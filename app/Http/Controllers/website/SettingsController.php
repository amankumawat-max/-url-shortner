<?php 
namespace App\Http\Controllers\website; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\CsThemeAdmin;

class SettingsController extends Controller
{
    public function edit(){
        $siteSettings = CsThemeAdmin::where('id', 1)->first();
        $title='Settings';
        return view('website.settings.edit',compact('title','siteSettings'));
    }

    public function update(Request $request){
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email',
            'admin_mobile' => 'required',
            'site_title' => 'required',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'white_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $siteSettings = CsThemeAdmin::where('id', 1)->first();
        if (!$siteSettings) {
            $siteSettings = new CsThemeAdmin;
            $siteSettings->id = 1;
        }

        $siteSettings->admin_name = $request->admin_name;
        $siteSettings->admin_email = $request->admin_email;
        $siteSettings->admin_mobile = $request->admin_mobile;
        $siteSettings->site_title = $request->site_title;

        if ($request->hasFile('favicon')) {
            $favicon = time().'.'.$request->favicon->extension();
            $request->favicon->move(public_path('img/uploads/settings/'), $favicon);
            $siteSettings->favicon = $favicon;
        }
        if ($request->hasFile('logo')) {
            $logo = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('img/uploads/settings/'), $logo);
            $siteSettings->logo = $logo;
        }
        if ($request->hasFile('white_logo')) {
            $whiteLogo = time().'.'.$request->white_logo->extension();
            $request->white_logo->move(public_path('img/uploads/settings/'), $whiteLogo);
            $siteSettings->white_logo = $whiteLogo;
        }

        if ($siteSettings->save()) {
            return redirect()->route('website.settings.edit')->with('success', 'Settings updated successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
