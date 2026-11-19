<?php 
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Session;
use Str;
use Mail;
use App\Mail\SendingEmail;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function index(Request $request){ 
        $loggedInUser = Session::get("CS_ADMIN");
        $isSuperAdmin = ($loggedInUser->role == 'super_admin');
        $cid = $loggedInUser->id;

        if ($isSuperAdmin) {
            $userData = User::where('role', 'admin')->whereNull('client_id')->orderBy('id', 'DESC')->paginate(15);
        } else {
            $userData = User::where(function($query) use ($cid) {
                $query->where('id', $cid)->orWhere('client_id', $cid);
            })->orderBy('id', 'DESC')->paginate(15);
        }

        $title='Client List';        
        return view('website.clients.index',compact('title','userData','isSuperAdmin','cid'));
    }

    public function invite(Request $request){ 
        $loggedInUser = Session::get("CS_ADMIN");
        if (!in_array($loggedInUser->role, ['super_admin', 'admin'])) {
            return redirect()->route('website.clients.index')->with('error', 'Access denied. Super Admin or Admin only.');
        }
        $title='Invite Client';        
        $isSuperAdmin = ($loggedInUser->role == 'super_admin');
        return view('website.clients.invite',compact('title','isSuperAdmin'));
    }

    public function inviteStore(Request $request){ 
        $loggedInUser = Session::get("CS_ADMIN");
        if (!in_array($loggedInUser->role, ['super_admin', 'admin'])) {
            return redirect()->route('website.clients.index')->with('error', 'Access denied. Super Admin or Admin only.');
        }

        $request->validate([
            'client_name' => 'required|string|max:150',
            'client_email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,member',
        ]);

        $inviteToken = hash('sha256', Str::random(64));

        User::insert([
            'client_id' => $loggedInUser->role == 'super_admin' ? null : $loggedInUser->client_id ?? $loggedInUser->id,
            'name' => $request->client_name,
            'email' => $request->client_email,
            'password_hash' => null,
            'role' => $request->role,
            'status' => 'invited',
            'invite_token' => $inviteToken,
            'created_at' => now(),
        ]);

        try {
            $details = [
                'subject' => 'Client Invitation - ' . env('APP_NAME'),
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'invite_token' => $inviteToken,
                'template' => 'website.emails.client-invite',
            ];

            Mail::to($request->client_email)->send(new SendingEmail($details));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Client invited but email failed: ' . $e->getMessage());
        }

        return redirect()->route('website.clients.index')->with('success', 'Client invitation sent successfully.');
    }

    public function accept(Request $request, $token)
    {
        $user = User::where('invite_token', $token)->where('status', 'invited')->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired invitation token.');
        }

        $title = 'Set Your Password';
        return view('website.clients.accept-invite', compact('title', 'user', 'token'));
    }

    public function acceptStore(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('invite_token', $token)->where('status', 'invited')->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired invitation token.');
        }

        $user->update([
            'password_hash' => Hash::make($request->password),
            'status' => 'active',
            'invite_token' => null,
        ]);

        return redirect()->route('login')->with('success', 'Password set successfully. You can now login.');
    }
}
