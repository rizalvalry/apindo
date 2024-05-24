<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload;
use App\Models\ClaimBusiness;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\Listing;
use App\Models\Package;
use App\Models\PurchasePackage;
use App\Models\Subscriber;
use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Purify\Facades\Purify;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    use Upload;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function forbidden()
    {
        return view('admin.errors.403');
    }


    public function dashboard()
    {

        $data['funding'] = collect(Fund::selectRaw('SUM(CASE WHEN status = 1 THEN amount END) AS totalAmountReceived')
            ->selectRaw('SUM(CASE WHEN status = 1 THEN charge END) AS totalChargeReceived')
            ->selectRaw('SUM((CASE WHEN created_at = CURDATE() AND status = 1 THEN amount END)) AS todayDeposit')
            ->get()->toArray())->collapse();

        $data['userRecord'] = collect(User::selectRaw('COUNT(id) AS totalUser')
            ->selectRaw('count(CASE WHEN status = 1  THEN id END) AS activeUser')
            ->selectRaw('COUNT((CASE WHEN created_at >= CURDATE() THEN id END)) AS todayJoin')
            ->get()->makeHidden(['fullname', 'mobile'])->toArray())->collapse();


        $data['tickets'] = collect(Ticket::where('created_at', '>', Carbon::now()->subDays(30))
            ->selectRaw('count(CASE WHEN status = 3  THEN status END) AS closed')
            ->selectRaw('count(CASE WHEN status = 2  THEN status END) AS replied')
            ->selectRaw('count(CASE WHEN status = 1  THEN status END) AS answered')
            ->selectRaw('count(CASE WHEN status = 0  THEN status END) AS pending')
            ->get()->toArray())->collapse();

        $dailyPackage = $this->dayList();
        PurchasePackage::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('count(id) as totalPurchasePackage'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->where('status', 1)
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyPackage) {
                $dailyPackage->put($item['date'], round($item['totalPurchasePackage'], 2));
            });
        $statistics['purchasedPackage'] = $dailyPackage;


        $dailyListings = $this->dayList();
        ClaimBusiness::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('count(id) as totalListings'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyListings) {
                $dailyListings->put($item['date'], round($item['totalListings'], 2));
            });
        $statistics['totalCreatedListings'] = $dailyListings;


        $dailyListingClaim = $this->dayList();
        Listing::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('count(id) as totalListingClaim'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyListingClaim) {
                $dailyListingClaim->put($item['date'], round($item['totalListingClaim'], 2));
            });
        $statistics['totalClaimListings'] = $dailyListings;


        $dailyDeposit = $this->dayList();
        Fund::whereMonth('created_at', Carbon::now()->month)
            ->select(
                DB::raw('sum(amount) as totalAmount'),
                DB::raw('DATE_FORMAT(created_at,"Day %d") as date')
            )
            ->where('status', 1)
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyDeposit) {
                $dailyDeposit->put($item['date'], round($item['totalAmount'], 2));
            });
        $statistics['deposit'] = $dailyDeposit;


        $dailyGaveProfit = $this->dayList();
        Transaction::whereMonth('created_at', Carbon::now()->month)
            ->selectRaw('SUM((CASE WHEN remarks LIKE "%Interest From%" THEN amount  END)) AS totalAmount')
            ->selectRaw('DATE_FORMAT(created_at,"Day %d") as date')
            ->groupBy(DB::raw("DATE(created_at)"))
            ->get()->map(function ($item) use ($dailyGaveProfit) {
                $dailyGaveProfit->put($item['date'], round($item['totalAmount'], 2));
            });
        $statistics['gaveProfit'] = $dailyGaveProfit;


        $statistics['schedule'] = $this->dayList();


        $data['latestUser'] = User::latest()->limit(5)->get();

        $data['listings'] = collect(Listing::selectRaw('COUNT(id) AS totalListing')
            ->selectRaw('COUNT(CASE WHEN status = 1 AND is_active = 1  THEN id END) AS activeListing')
            ->selectRaw('COUNT(CASE WHEN status = 0  THEN id END) AS pendingListing')
            ->selectRaw('COUNT((CASE WHEN created_at = CURDATE()  THEN id END)) AS todayCreatedListings')
            ->get()->makeHidden(['avgRating'])->toArray())->collapse();


        $data['totalSubscriber'] = Subscriber::get()->count();
        $data['totalPendingPackage'] = Fund::where('status', 2)->count();

        $data['totalPackage'] = Package::get()->count();
        $data['gateways'] = Gateway::count();


        $data['sellPackage'] = collect(PurchasePackage::selectRaw('COUNT((CASE WHEN  status = 1 THEN id END)) AS totalPurchasePackage')
            ->selectRaw('COUNT((CASE WHEN created_at = CURDATE() AND status = 1 THEN id END)) AS todayPurchasePackage')
            ->get()->toArray())->collapse();

        $packages = PurchasePackage::select('purchase_date')->latest()->first();
        $data['handover'] = $packages ? Carbon::parse($packages->purchase_date)->format('Y-m-d') : today()->format('Y-m-d');

        return view('admin.dashboard', $data, compact('statistics', 'statistics', 'packages'));
    }

    public function calender()
    {
        $packages = PurchasePackage::latest()->get();
        $data = [];
        foreach ($packages as $pacakge) {
            $data[] = [
                'title' => $pacakge->get_package->title,
                'url' => route('user.myPackages', $pacakge->id),
                'start' => $pacakge->purchase_date->format('Y-m-d')
            ];
        }
        return response()->json($data);
    }

    public function dayList()
    {
        $totalDays = Carbon::now()->endOfMonth()->format('d');

        $daysByMonth = [];
        for ($i = 1; $i <= $totalDays; $i++) {
            array_push($daysByMonth, ['Day ' . sprintf("%02d", $i) => 0]);
        }

        return collect($daysByMonth)->collapse();
    }

    public function profile()
    {
        $admin = $this->user;
        return view('admin.profile', compact('admin'));
    }


    public function profileUpdate(Request $request)
    {
        $req = Purify::clean($request->except('_token', '_method'));
        $rules = [
            'name' => 'sometimes|required',
            'username' => 'sometimes|required|unique:admins,username,' . $this->user->id,
            'email' => 'sometimes|required|email|unique:admins,email,' . $this->user->id,
            'phone' => 'sometimes|required',
            'address' => 'sometimes|required',
            'image' => ['nullable', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])]
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = $this->user;
        if ($request->hasFile('image')) {
            try {
                $old = $user->image ?: null;
                $image = $this->fileUpload($request->image, config('location.admin.path'), $user->driver, null, $old);

                if ($image) {
                    $user->image = $image['path'];
                    $user->driver = $image['driver'];
                }
            } catch (\Exception $exp) {
                return back()->with('error', 'Image could not be uploaded.');
            }
        }
        $user->name = $req['name'];
        $user->username = $req['username'];
        $user->email = $req['email'];
        $user->phone = $req['phone'];
        $user->address = $req['address'];
        $user->save();

        return back()->with('success', __('Updated Successfully.'));
    }


    public function password()
    {
        return view('admin.password');
    }

    public function passwordUpdate(Request $request)
    {
        $req = Purify::clean($request->all());

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ]);

        $request = (object)$req;
        $user = $this->user;
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', __("Password didn't match"));
        }
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        return back()->with('success', __('Password has been Changed'));
    }
}
