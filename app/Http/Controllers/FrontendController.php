<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\Content;
use App\Models\Follower;
use App\Models\Language;
use App\Models\Place;
use App\Models\Template;
use App\Models\Subscriber;
use App\Http\Traits\Notify;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogCategoryDetails;
use App\Models\User;
use App\Models\UserReview;
use App\Models\UserSocial;
use App\Models\Viewer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ContentDetails;
use App\Models\ListingCategory;
use App\Models\Package;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Validator;


class FrontendController extends Controller
{
    use Notify;

    public function __construct()
    {
        $this->theme = template();
    }

    public function index(Request $request)
    {

        $templateSection = ['banner-heading', 'popular-listing', 'hero', 'about-us', 'why-chose-us', 'how-it-work', 'how-we-work', 'know-more-us', 'deposit-withdraw', 'news-letter', 'news-letter-referral', 'testimonial', 'request-a-call', 'investor', 'blog', 'faq', 'we-accept', 'investment'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
        $contentSection = ['team-member', 'feature', 'why-chose-us', 'how-it-work', 'how-we-work', 'know-more-us', 'testimonial', 'investor', 'blog', 'faq'];

        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description', 'driver']);
                }])
            ->get()->groupBy('content.name');

        $data['popularBlogs'] = Blog::with(['details', 'blogCategory.details'])->where('status', 1)->take(3)->latest()->get();

        $data['allListingsAndCategory'] = ListingCategory::with(['details', 'get_listings'])->where('status', 1)->latest()->paginate(config('basic.paginate'));

        $data['all_places'] = Place::with('details')->where('status', 1)->latest()->get();
        $data['all_categories'] = ListingCategory::with('details')->where('status', 1)->latest()->get();

        $name = $request->name;
        $location = $request->location;
        $category = $request->category;
        $search = $request->all();

        if ($name == null && $location == null && $category == null) {
            $data['popularListings'] = Listing::with(['get_reviews', 'get_user', 'get_place.details'])->withCount('getFavourite')
                ->get()->sortByDesc(function ($item) {
                    return $item->avgRating;
                })->take(4);

            return view($this->theme . 'home', $data);

        } else {
            $data['all_listings'] = Listing::with(['get_reviews', 'get_place.details', 'get_category.details'])->latest()
                ->when(isset($search['name']), function ($query) use ($search) {
                    return $query->where('title', 'LIKE', "%{$search['name']}%");
                })
                ->when(isset($search['location']) && $search['location'] != 'all', function ($query2) use ($search) {
                    return $query2->whereHas('get_place', function ($q) use ($search) {
                        $q->where('id', $search['location']);
                    });
                })
                ->when(isset($search['category']), function ($query3) use ($search) {
                    return $query3->whereHas('get_category.details', function ($q) use ($search) {
                        $q->where('name', $search['category']);
                    });
                })
                ->paginate(config('basic.paginate'));

            $data['all_places'] = Place::with('details')->where('status', 1)->latest()->get();
            $data['all_categories'] = ListingCategory::with('details')->where('status', 1)->latest()->get();
            Session::put('data', $data);
            return redirect()->route('listing');
        }
    }

    public function about()
    {
        $templateSection = ['testimonial', 'about-us', 'investor', 'faq', 'we-accept', 'how-it-work', 'how-we-work', 'know-more-us'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

        $contentSection = ['testimonial', 'feature', 'why-chose-us', 'investor', 'faq', 'how-it-work', 'how-we-work', 'know-more-us'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description', 'driver']);
                }])
            ->get()->groupBy('content.name');
        return view($this->theme . 'about', $data);
    }

    public function pricing()
    {
        $templateSection = ['package'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
        $data['Packages'] = Package::with('details', 'purchasePackages')->where('status', 1)->orderBy('price', 'ASC')->get();
        return view($this->theme . 'pricing', $data);
    }

    public function listingSearch(Request $request, $type = null, $id = null)
    {

        $today = Carbon::now()->format('Y-m-d');
        $search = $request->all();
        $categoryIds = $request->category;
        $data['all_listings'] = Listing::with(['get_user', 'get_place', 'get_reviews','get_package','listingSeo'])
            ->when(isset($categoryIds), function ($query) use ($categoryIds) {
                if (implode('',$categoryIds) == 'all'){
                    $query->where('status', 1)->where('is_active', 1);
                }else{
                    foreach ($categoryIds as $key => $category_id) {
                        $query->whereJsonContains('category_id', $category_id);
                    }
                }
            })
            ->when(isset($id), function ($query) use ($id) {
                return $query->whereJsonContains('category_id', $id);
            })
            ->withCount(['getFavourite' , 'get_reviews as average_rating' => function($query) {
                $query->select(DB::raw('coalesce(avg(rating2),0)'));
            }])
            ->whereHas('get_package', function ($query5) use ($today) {
                return $query5->where('expire_date', '>=', $today)->orWhereNull('expire_date');
            })
            ->when(isset($search['name']), function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search['name']}%")
                    ->orWhere('description', 'LIKE', "%{$search['name']}%")
                    ->orWhereHas('listingSeo', function ($tQuery) use($search) {
                        $tQuery->where('meta_keywords', 'LIKE', "%{$search['name']}%");
                    });
            })
            ->when(isset($search['location']) && $search['location'] != 'all', function ($query2) use ($search) {
                return $query2->whereHas('get_place', function ($q) use ($search) {
                    $q->where('id', $search['location']);
                });
            })
            ->when(isset($search['user']) && $search['user'] != 'all', function ($query4) use ($search) {
                return $query4->where('user_id', $search['user']);
            })
            ->when(!empty($search['rating']), function ($query5) use ($search) {
                return $query5->whereHas('get_reviews', function ($q) use ($search) {
                    $q->whereIn('rating2', $search['rating']);
                });
            })
            ->where('status', 1)
            ->where('is_active', 1)
            ->when($request->exists('popular') == true, function ($query5) use ($search) {
                $query5->orderByDesc('average_rating');
            })
            ->when($request->exists('popular') == false, function ($query5) use ($search) {
                return $query5->orderBy('id','desc');
            })
            ->paginate(8);

            $data['distinctUser'] = User::where('status',1)->where('email_verification',1)->where('sms_verification',1)->whereHas('get_listing', function ($query){
                $query->where('status',1);
            })->select(['id', 'username','firstname', 'lastname'])->tobase()->get()->map(function ($item){
                $item->fullname = $item->firstname . ' ' . $item->lastname;
                return $item;
            });


            $data['all_places'] = Place::with('details:id,place_id,place')->where('status', 1)->latest()->get();

            $data['all_categories'] = ListingCategory::with('details:id,listing_category_id,name')->where('status', 1)->latest()->get();
            return view($this->theme . 'listing', $data);
    }

    public function category()
    {
        $data['title'] = "Category";
        $data['listingCategory'] = ListingCategory::with('details')->where('status', 1)->latest()->get();
        return view($this->theme . 'category', $data);
    }

    public function listing_details($title = null, $id = null)
    {
        session()->put('listing_id', $id);
        $single_listing_details = Listing::with(['get_package', 'get_user','get_user.get_social_links_user', 'get_listing_images', 'get_listing_amenities.get_amenity.details', 'get_products.get_product_image', 'get_business_hour', 'get_social_info','get_reviews', 'listingSeo'])
            ->where('status',1)
            ->findOrFail($id);


        $average_review = $single_listing_details->reviews()[0]->average;

        $data['single_listing_details'] = $single_listing_details;

        $user_id = $single_listing_details->user_id;
        $data['follower_count'] = collect(Follower::selectRaw("COUNT((CASE WHEN user_id = $user_id  THEN id END)) AS totalFollower")
            ->get()->toArray())->collapse();

        $data['total_listings_an_user'] = collect(Listing::selectRaw("COUNT((CASE WHEN user_id = $user_id  THEN id END)) AS totalListing")
            ->get()->makeHidden('avgRating')->toArray())->collapse();


        $data['category_wise_listing'] = Listing::with('get_user')
            ->where([
                'user_id'=> $single_listing_details->user_id,
                'category_id'=> $single_listing_details->category_id,
                'status'=>1
                ])
            ->where('id', '!=', $id)
            ->withCount('getFavourite')->limit(3)->latest()->get();

        $viewer_ip = $_SERVER['REMOTE_ADDR'];
        $viewer = new Viewer();
        $viewer->user_id = $user_id;
        $viewer->listing_id = $id;
        $viewer->viewer_ip = $viewer_ip;
        $viewer->save();
        $data['total_listing_view'] = Viewer::where('listing_id', $id)->count();
        if (Auth::check() == true) {
            $data['reviewDone'] = UserReview::where('listing_id', $id)->where('user_id', Auth::user()->id)->count();
        } else {
            $data['reviewDone'] = '0';
        }

        $browserInfo = json_decode(json_encode(getIpInfo($viewer_ip)), true);
        $listingAnalytics = new Analytics();
        $listingAnalytics->listing_owner_id = $data['single_listing_details']->user_id;
        $listingAnalytics->listing_id = $id;
        $listingAnalytics->visitor_ip = $viewer_ip;

        $listingAnalytics->country = (!empty($browserInfo['country'])) ? implode($browserInfo['country']):null;
        $listingAnalytics->city = (!empty($browserInfo['city'])) ? implode($browserInfo['city']):null;
        $listingAnalytics->code = (!empty($browserInfo['code'])) ? implode($browserInfo['code']):null;
        $listingAnalytics->lat = (!empty($browserInfo['lat'])) ? implode($browserInfo['lat']):null;
        $listingAnalytics->long = (!empty($browserInfo['long'])) ? implode($browserInfo['long']):null;
        $listingAnalytics->os_platform = $browserInfo['os_platform']??null;
        $listingAnalytics->browser = $browserInfo['browser']??null;

        $listingAnalytics->save();
        return view($this->theme . 'listing_details', $data, compact('id', 'title', 'average_review'));
    }

    public function getReview($id)
    {
        $data = UserReview::with('review_user_info')->where('listing_id', $id)->latest()->paginate(10);

        return response([
            'data' => $data
        ]);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function reviewPush(Request $request)
    {
        $review = new UserReview();
        $review->listing_id = $request->listingId;
        $review->user_id = auth()->id();
        $review->rating2 = $request->rating;
        $review->review = $request->feedback;
        $review->save();

        $data['review'] = $review->review;
        $data['review_user_info'] = $review->review_user_info;
        $data['rating2'] = $review->rating2;
        $data['date_formatted'] = dateTime($review->created_at, 'd M, Y h:i A');

        return response([
            'status' => 'success',
            'data' => $data
        ]);
    }


    public function profile($name = null, $user_id = null)
    {
        if (Auth::check() == true) {
            $data['check_follower'] = Follower::whereUser_id($user_id)->whereFollowing_id(Auth::user()->id)->get();
        } else {
            $data['check_follower'] = Follower::whereUser_id($user_id)->get();
        }

        $data['user_information'] = User::with(['get_listing', 'get_social_links_user', 'follower.get_follwer_user', 'following.get_following_user'])->withCount('totalViews')->findOrFail($user_id);

        $listing_id = session()->get('listing_id');

        if ($listing_id) {
            session()->forget('listing_id');
            $data['latest_listings'] = Listing::with('get_user', 'get_reviews')->where('id', '!=', $listing_id)->where('user_id', $user_id)->limit(3)->withCount('getFavourite')->where('status', 1)->where('is_active', 1)->latest()->paginate(config('basic.paginate'));
        } else {
            $data['latest_listings'] = Listing::with('get_user', 'get_reviews')->where('user_id', $user_id)->limit(3)->withCount('getFavourite')->where('status', 1)->where('is_active', 1)->latest()->paginate(config('basic.paginate'));
        }
        return view($this->theme . 'profile', $data, compact('user_id'));
    }

    public function blog()
    {
        $data['title'] = "Blog";
        $data['allBlogs'] = Blog::with(['details', 'blogCategory.details'])->where('status', 1)->latest()->paginate(3);
        $data['blogCategory'] = BlogCategory::with('details')->where('status', 1)->latest()->get();
        return view($this->theme . 'blog', $data);
    }

    public function blogSearch(Request $request)
    {

        $data['title'] = "Blog";
        $search = $request->search;

        $data['blogCategory'] = BlogCategory::with('details')->where('status', 1)->latest()->get();

        $data['allBlogs'] = Blog::with('details', 'blogCategory.details')
            ->whereHas('blogCategory.details', function ($qq) use ($search) {
                $qq->where('name', 'Like', '%' . $search . '%');
            })
            ->orWhereHas('details', function ($qq2) use ($search) {
                $qq2->where('title', 'Like', '%' . $search . '%');
                $qq2->orWhere('author', 'Like', '%' . $search . '%');
                $qq2->orWhere('details', 'Like', '%' . $search . '%');
            })
            ->where('status', 1)
            ->latest()->paginate(3);

        return view($this->theme . 'blog', $data);

    }

    public function categorySearch(Request $request)
    {
        $character = $request->character;

        if ($character != null) {

            $data['listingCategory'] = ListingCategory::with('details')->whereHas('details', function ($q) use ($character) {
                $q->where('name', 'LIKE', $character . '%');
            })->withCount('get_listings')->where('status', 1)->latest()->get();

        } else {
            $data['listingCategory'] = ListingCategory::with('details')->withCount('get_listings')->where('status', 1)->latest()->get();
        }

        $count = $data['listingCategory']->count();

        $view = view($this->theme . 'includes.listing.category', $data)->render();

        return response()->json(['data' => $view, 'count' => $count]);
    }


    public function blogDetails($slug = null, $id)
    {
        $data['title'] = "Blog Details";
        $data['singleBlog'] = Blog::with('details')->where('status', 1)->findOrFail($id);
        $data['blogCategory'] = BlogCategoryDetails::where('blog_category_id', $data['singleBlog']->blog_category_id)->first();
        $data['allBlogCategory'] = BlogCategory::with('details')->where('status', 1)->latest()->get();
        $data['relatedBlogs'] = Blog::with(['details', 'blogCategory.details'])->where('id', '!=', $id)->where('blog_category_id', $data['singleBlog']->blog_category_id)->where('status', 1)->latest()->paginate(3);
        return view($this->theme . 'blogDetails', $data);
    }

    public function CategoryWiseBlog($slug = null, $id)
    {
        $data['title'] = "Blog";

        $data['allBlogs'] = Blog::with(['details', 'blogCategory.details'])->where('blog_category_id', $id)->where('status', 1)->latest()->paginate(3);
        $data['blogCategory'] = BlogCategory::with('details')->where('status', 1)->latest()->get();

        return view($this->theme . 'blog', $data);
    }

    public function faq()
    {
        $templateSection = ['faq'];
        $data['templates'] = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');

        $contentSection = ['faq'];
        $data['contentDetails'] = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $data['increment'] = 1;
        return view($this->theme . 'faq', $data);
    }

    public function contact()
    {

        $templateSection = ['contact-us'];
        $templates = Template::templateMedia()->whereIn('section_name', $templateSection)->get()->groupBy('section_name');
        $title = 'Contact Us';
        $contact = @$templates['contact-us'][0]->description;
        return view($this->theme . 'contact', compact('title', 'contact'));
    }

    public function contactSend(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|max:91',
            'subject' => 'required|max:100',
            'message' => 'required|max:1000',
        ]);

        $requestData = Purify::clean($request->except('_token', '_method'));

        $basic = (object)config('basic');
        $basicEmail = $basic->sender_email;

        $name = $requestData['name'];
        $email_from = $requestData['email'];
        $subject = $requestData['subject'];
        $message = $requestData['message'] . "<br>Regards<br>" . $name;
        $from = $email_from;

        $headers = "From: <$from> \r\n";
        $headers .= "Reply-To: <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $to = $basicEmail;

        if (@mail($to, $subject, $message, $headers)) {
        } else {
        }

        return back()->with('success', __('Mail has been sent'));
    }

    public function getLink($getLink = null, $id)
    {
        $getData = Content::findOrFail($id);
        $contentSection = [$getData->name];
        $contentDetail = ContentDetails::select('id', 'content_id', 'description', 'created_at')
            ->where('content_id', $getData->id)
            ->whereHas('content', function ($query) use ($contentSection) {
                return $query->whereIn('name', $contentSection);
            })
            ->with(['content:id,name',
                'content.contentMedia' => function ($q) {
                    $q->select(['content_id', 'description']);
                }])
            ->get()->groupBy('content.name');

        $title = @$contentDetail[$getData->name][0]->description->title;
        $description = @$contentDetail[$getData->name][0]->description->description;

        return view($this->theme . 'getLink', compact('contentDetail', 'title', 'description'));
    }

    public function subscribe(Request $request)
    {
        $rules = [
            'email' => 'required|email|max:255|unique:subscribers'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(url()->previous() . '#subscribe')->withErrors($validator);
        }

        $data = new Subscriber();
        $data->email = $request->email;
        $data->save();
        return redirect(url()->previous() . '#subscribe')->with('success', __('Subscribed Successfully'));
    }

    public function language($code)
    {
        $language = Language::where('short_name', $code)->first();

        if (!$language) $code = 'US';
        session()->put('trans', $code);
        session()->put('rtl', $language ? $language->rtl : 0);

        return redirect()->back();
    }

    public function getTemplate($template = null)
    {
        $contentDetail = Template::where('section_name', $template)->firstOrFail();
        $title = @$contentDetail->description->title;
        $short_description = @$contentDetail->description->popup_short_description;
        $description = @$contentDetail->description->description;
        return view($this->theme . 'cookiePolicy', compact('contentDetail', 'title', 'short_description', 'description'));
    }
}
