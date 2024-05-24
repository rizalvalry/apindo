<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClaimBusiness;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\Notify;
use App\Http\Traits\Upload;

class ClaimBusinessController extends Controller
{
    use Upload, Notify;

    public function claimBusiness(Request $request)
    {
        $search = $request->all();

        $fromDate =   Carbon::parse($request->from_date);
        $toDate =   Carbon::parse($request->to_date)->addDay();

        $data['allClaims'] = ClaimBusiness::with(['get_client', 'get_listing.get_user'])
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->whereHas('get_listing', function ($q1) use ($search) {
                    $q1->where('title', "%{$search['name']}%");
                });
            })
            ->when(isset($search['from_date']), function ($q2) use ($fromDate) {
                return $q2->whereDate('created_at', '>=', $fromDate);
            })
            ->when(isset($search['to_date']), function ($q2) use ($fromDate,$toDate) {
                return $q2->whereBetween('created_at', [$fromDate,$toDate]);
            })
            ->latest()->paginate(config('basic.paginate'));

        return view('admin.claim.claimList', $data);
    }

    public function claimMessageDelete($id)
    {
        ClaimBusiness::findOrFail($id)->delete();
        return back()->with('success', __('Message Delete Successfully!'));
    }
}
