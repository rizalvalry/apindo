<?php

namespace App\Providers;

use App\Models\ProductQuery;
use Illuminate\Pagination\Paginator;
use App\Models\ContentDetails;
use App\Models\Fund;
use App\Models\Gateway;
use App\Models\Language;
use App\Models\PayoutLog;
use App\Models\Template;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $data['basic'] = (object) config('basic');
        $data['theme'] = template();
        $data['themeTrue'] = template(true);
        View::share($data);

        try {
            DB::connection()->getPdo();

            view()->composer(['admin.ticket.nav', 'dashboard'], function ($view) {
                $view->with('pending', Ticket::whereIn('status', [0, 2])->latest()->with('user')->limit(10)->with('lastReply')->get());
            });

            view()->composer([
                $data['theme'] . 'partials.footer',
                $data['theme'] . 'partials.topbar',
                $data['theme'] . 'partials.topbar-auth'
            ] , function ($view) {
                $languagesStr = '';
                Language::orderBy('name')->where('is_active', 1)->get()->map(function ($item) use (&$languagesStr){
                    $languagesStr .= '"'.strtoupper($item->short_name).'":"'. trim($item->name).'",';
                    return $languagesStr;
                });
                $view->with('languages', flagLanguage($languagesStr));

                $templateSection = ['contact-us'];
                $view->with('contactUs', Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name'));

                $templateNewsletter = ['news-letter'];
                $view->with('newsLetter', Template::templateMedia()->whereIn('section_name', $templateNewsletter)->get()->groupBy('section_name'));

                $contentSection = ['support','social'];
                $view->with('contentDetails', ContentDetails::select('id', 'content_id', 'description')
                    ->whereHas('content', function ($query) use ($contentSection) {
                        return $query->whereIn('name', $contentSection);
                    })
                    ->with(['content:id,name',
                        'content.contentMedia' => function ($q) {
                            $q->select(['content_id', 'description']);
                        }])
                    ->get()->groupBy('content.name'));
            });



            view()->composer($data['theme'] . 'sections.deposit-withdraw', function ($view) {
                $view->with('deposits', Fund::latest()->where('status', 1)->limit(5)->with('user','gateway')->get());
                $view->with('withdraws', PayoutLog::latest()->where('status', 2)->limit(5)->with('user','method')->get());
            });

            view()->composer($data['theme'] . 'sections.we-accept', function ($view) {
                $view->with('gateways', Gateway::where('status',1)->orderBy('sort_by')->get());
            });

            view()->composer([$data['theme'] . 'partials.cookie'], function ($view) {
                $view->with('cookie', Template::where('section_name', 'cookie-consent')->first());
            });

            view()->composer([$data['theme'] . 'partials.user.sidebar'], function ($view) {
                $view->with('customerEnquiry', ProductQuery::where('user_id', Auth::id())->where('customer_enquiry', 0)->count());
                $view->with('myEnquiry', ProductQuery::whereHas('unseenReplies')->where('client_id', Auth::id())->count());
            });

        } catch (\Exception $e) {
//            die("Could not connect to the database.  Please check your configuration according to documentation");
        }
    }
}
