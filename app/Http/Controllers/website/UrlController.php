<?php 
namespace App\Http\Controllers\website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Models\User;
use App\Models\UrlHit;
use App\Traits\ExportTraits;
use Session;
use Str;

class UrlController extends Controller
{
    use ExportTraits;
    public function index(Request $request){ 
        $urlData = ShortUrl::with('user');

        if ($request->isMethod('post')) {
            Session::put('URL_FILTER', $request->all());
            Session::save();
        }

        $aryFilterSession = array();
        if (Session::has('URL_FILTER')) {
            $aryFilterSession = Session::get('URL_FILTER');
            $period = $aryFilterSession['period'];

            if(!$period){
                Session::forget('URL_FILTER');
                return redirect()->route('website.urls.index')->with('error', 'Please select any filter.');
            }

            if ($period == 'today') {
                $from = now()->startOfDay();
                $to = now()->endOfDay();
            } elseif ($period == 'last_week') {
                $from = now()->subDays(7)->startOfDay();
                $to = now()->endOfDay();
            } elseif ($period == 'last_month') {
                $from = now()->subMonth()->startOfDay();
                $to = now()->endOfDay();
            } else {
                $from = now()->startOfDay();
                $to = now()->endOfDay();
            }

            $urlData = $urlData->whereHas('urlHits', function($query) use ($from, $to) {
                $query->whereBetween('hit_at', [$from, $to]);
            })->withCount(['urlHits' => function($query) use ($from, $to) {
                $query->whereBetween('hit_at', [$from, $to]);
            }]);
        } else {
            $urlData = $urlData->withCount('urlHits');
        }

        // Role-based URL visibility filtering
        $loggedInUser = Session::get("CS_ADMIN");
        if ($loggedInUser && $loggedInUser->role == 'admin') {
            // Admin: see own URLs + URLs from child clients (users where client_id = admin's id)
            $urlData = $urlData->where(function($q) use ($loggedInUser) {
                $q->where('short_urls.user_id', $loggedInUser->id)
                  ->orWhereHas('user', function($q2) use ($loggedInUser) {
                      $q2->where('client_id', $loggedInUser->id);
                  });
            });
        } elseif ($loggedInUser && $loggedInUser->role == 'member') {
            // Member: see only own URLs
            $urlData = $urlData->where('short_urls.user_id', $loggedInUser->id);
        }
        // SuperAdmin: see ALL URLs (no filter)

        $urlData = $urlData->orderBy('url_hits_count', 'DESC')
            ->orderBy('short_urls.created_at', 'DESC')
            ->paginate(15);

        $title='URL List';
        return view('website.urls.index',compact('title','urlData','aryFilterSession'));
    }

    public function urllistexport(Request $request)
    {
        $loggedInUser = Session::get("CS_ADMIN");

        $urlData = ShortUrl::with('user');

        // Role-based URL visibility filtering
        if ($loggedInUser && $loggedInUser->role == 'admin') {
            // Admin: see own URLs + URLs from child clients (users where client_id = admin's id)
            $urlData = $urlData->where(function($q) use ($loggedInUser) {
                $q->where('short_urls.user_id', $loggedInUser->id)
                  ->orWhereHas('user', function($q2) use ($loggedInUser) {
                      $q2->where('client_id', $loggedInUser->id);
                  });
            });
        } elseif ($loggedInUser && $loggedInUser->role == 'member') {
            // Member: see only own URLs
            $urlData = $urlData->where('short_urls.user_id', $loggedInUser->id);
        }
        // SuperAdmin: see ALL URLs (no filter)

        // Apply session filter if exists
        if (Session::has('URL_FILTER')) {
            $aryFilterSession = Session::get('URL_FILTER');
            $period = $aryFilterSession['period'] ?? 'today';

            if ($period == 'today') {
                $from = now()->startOfDay();
                $to = now()->endOfDay();
            } elseif ($period == 'last_week') {
                $from = now()->subDays(7)->startOfDay();
                $to = now()->endOfDay();
            } elseif ($period == 'last_month') {
                $from = now()->subMonth()->startOfDay();
                $to = now()->endOfDay();
            } else {
                $from = now()->startOfDay();
                $to = now()->endOfDay();
            }

            $urlData = $urlData->whereHas('urlHits', function($query) use ($from, $to) {
                $query->whereBetween('hit_at', [$from, $to]);
            })->withCount(['urlHits' => function($query) use ($from, $to) {
                $query->whereBetween('hit_at', [$from, $to]);
            }]);
        } else {
            $urlData = $urlData->withCount('urlHits');
        }

        $urlData = $urlData->orderBy('url_hits_count', 'DESC')
            ->orderBy('short_urls.created_at', 'DESC')
            ->get();

        if ($urlData->isEmpty()) {
            return redirect()->back()->with('error', 'No Records Found');
        }

        $counter = 0;
        $records = $urlData->map(function ($url) use (&$counter) {
            $counter++;
            return [
                'S.No.' => $counter,
                'Short URL' => route('website.urls.redirect', $url->short_code),
                'Long URL' => $url->long_url,
                'User' => $url->user->name ?? '-',
                'Total Hits' => $url->url_hits_count,
                'Created At' => date('d-m-Y H:i:s', strtotime($url->created_at)),
            ];
        });

        $this->exportToExcel($records, 'urls_list.xls');
    }

    public function urllistfilterreset(Request $request)
    {
        Session::forget('URL_FILTER');
        return redirect()->back();
    }

    public function generate(Request $request)
    {
        $title = 'Generate URL';
        return view('website.urls.generate', compact('title'));
    }

    public function generateStore(Request $request)
    {
        $request->validate([
            'long_url' => 'required|url|max:2000',
        ]);

        do {
            $shortCode = Str::random(6);
        } while (ShortUrl::where('short_code', $shortCode)->exists());

        ShortUrl::insert([
            'user_id' => Session::get('CS_ADMIN')->id,
            'short_code' => $shortCode,
            'long_url' => $request->long_url,
            'hits' => 0,
            'created_at' => now(),
        ]);

        return redirect()->route('website.urls.index')->with('success', 'Short URL created successfully.');
    }

    public function redirectUrl($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->first();

        if (!$shortUrl) {
            abort(404);
        }

        $shortUrl->increment('hits');

        UrlHit::insert([
            'short_url_id' => $shortUrl->id,
            'hit_at' => now(),
        ]);

        return redirect($shortUrl->long_url);
    }
}