<!-- sidebar -->
<div id="sidebar" class="">
    <div class="sidebar-top">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{ getFile(config('basic.default_file_driver'),config('basic.logo_image')) }}" alt="{{config('basic.site_title')}}"/>
        </a>
        <button
            class="sidebar-toggler d-lg-none"
            onclick="toggleSideMenu()">
            <i class="fal fa-times"></i>
        </button>
    </div>
    <ul class="main tabScroll">
        <li>
            <a class="{{(lastUriSegment() == 'dashboard') ? 'active' : ''}}" href="{{ route('user.home') }}"
            ><i class="fal fa-th-large text-success"></i>@lang('Dashboard')</a>
        </li>


        <li>
            <a href="{{ route('user.myPackages') }}" class="{{(lastUriSegment() == 'packages') ? 'active' : ''}}">
                <i class="fal fa-box-full text-primary"></i>@lang('My Packages')
            </a>
        </li>

        <li>
            @php
                $id = '';
            @endphp
            <a href="{{ route('user.allListing') }}"
               class="{{(lastUriSegment() == 'listings' || lastUriSegment() == 'pending' || lastUriSegment() == 'approved' || lastUriSegment() == 'rejected') ? 'active' : ''}}">
                <i class="fal fa-list-ol text-orange"></i>@lang('My Listings')
            </a>
        </li>

        <li>
            <a href="{{ route('user.wishList') }}" class="{{(lastUriSegment() == 'wish-list') ? 'active' : ''}}">
                <i class="fal fa-heart text-cyan"></i> @lang('WishList')
            </a>
        </li>

        <li>
            <a href="{{ route('user.productQuery', 'customer-enquiry') }}"
               class="{{(lastUriSegment() == 'customer-enquiry' || lastUriSegment() == 'my-enquiry') ? 'active' : ''}}">
                <i class="fal fa-question text-orange"></i> @lang('Product Enquiry')
                @if($customerEnquiry > 0 || $myEnquiry > 0)

                    <sup class="text-danger custom__queiry_count"> <span
                            class="badge bg-primary rounded-circle">{{ $customerEnquiry + $myEnquiry }}</span> </sup>
                @endif
            </a>
        </li>

        <li>
            <a href="{{ route('user.transaction') }}" class="{{(lastUriSegment() == 'transaction') ? 'active' : ''}}">
                <i class="fal fa-sack-dollar text-pink"></i>@lang('Transaction')
            </a>
        </li>

        <li>
            <a href="{{ route('user.analytics') }}" class="{{(lastUriSegment() == 'analytics') ? 'active' : ''}}">

                <i class="fal fa-analytics text-green"></i>@lang('Analytics')
            </a>
        </li>

        <li>
            <a href="{{route('user.profile')}}" class="{{(lastUriSegment() == 'profile') ? 'active' : ''}}">
                <i class="fal fa-users-cog text-indigo"></i> @lang('Profile Settings')
            </a>
        </li>

        <li>
            <a href="{{route('user.ticket.list')}}" class="{{(lastUriSegment() == 'ticket') ? 'active' : ''}}">
                <i class="fal fa-user-headset text-success"></i> @lang('support ticket')
            </a>
        </li>

        <li class="">
            <a href="{{route('user.twostep.security')}}">
                <i class="fal fa-lock text-orange"></i> @lang('2FA Security')
            </a>
        </li>

        <li class="">
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fal fa-sign-out-alt text-purple"></i> @lang('Sign Out')
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>

    </ul>
</div>
