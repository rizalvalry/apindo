<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Analytics;
use Illuminate\Http\Request;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    use Notify, Upload;

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();
            return $next($request);
        });
        $this->theme = template();
    }

    public function analytics(Request $request, $id = null, $title = null)
    {

        $search = $request->all();
        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date)->addDay();

        $data['allAnalytics'] = Analytics::with(['getListing','lastVisited:listing_id,created_at'])->withCount('listCount')
            ->when(isset($id), function ($query) use ($id) {
                return $query->where('listing_id', $id);
            })
            ->when(isset($search['listing']), function ($query) use ($search) {
                return $query->whereHas('getListing', function ($query) use ($search) {
                    $query->where('title', 'LIKE', "%{$search['listing']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate,$toDate) {
                return $q2->whereBetween('created_at', [$fromDate,$toDate]);
            })
            ->where('listing_owner_id', $this->user->id)
            ->latest()->groupBy('listing_id')->paginate(config('basic.paginate'));

        return view($this->theme . 'user.analytics', $data);
    }

    public function showListingAnalytics($id)
    {
        $data['allSingleListingAnalytics'] = Analytics::with(['getListing'])->where('listing_owner_id', $this->user->id)->where('listing_id', $id)->latest()->paginate(config('basic.paginate'));
        return view($this->theme . 'user.showSingleAnalytics', $data);
    }

}

