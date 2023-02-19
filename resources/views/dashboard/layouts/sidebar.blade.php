<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ route('dashboard') }}"><i class="la icon-graduation"></i><span class="menu-title" data-i18n="nav.dash.main">{{trans('dashboard.home') }}</span><span ></span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dashboard.clients') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Client::count() }}</span></a>
            <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('users.index') }}" data-i18n="nav.templates.horz.classic">{{trans('dashboard.all.clients') }}</a>
                    </li>
                    <li><a class="menu-item" href="{{ route('users.create') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('dashboard.add.clients') }}</a>
                    </li>

            </ul>
            </li>
          <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('admin.index') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\User::count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{ route('admins.index') }}" data-i18n="nav.templates.horz.classic">{{trans('admin.index') }}</a>
                  </li>
                  <li><a class="menu-item" href="{{ route('admins.create') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('admin.create') }}</a>
                  </li>

              </ul>
          </li>

            <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dash.scotter') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Scotter::count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{ route('scotters.index') }}" data-i18n="nav.templates.horz.classic">{{trans('dash.scotters') }}</a>
                  </li>
                  <li><a class="menu-item" href="{{ route('scotters.create') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('dash.create_scotter') }}</a>
                  </li>
              </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dash.settings') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Setting::count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{route('contact_us.index')}}" data-i18n="nav.templates.horz.classic">{{trans('dash.contact_us') }}</a>
                  </li>
                  <li><a class="menu-item" href="{{route('qa.index')}}" data-i18n="nav.templates.horz.top_icon"> {{trans('dash.qa') }}</a>
                  </li>
                  <li><a class="menu-item" href="{{route('about_us')}}" data-i18n="nav.templates.horz.top_icon"> {{trans('dash.about_us') }}</a>
                  </li>
              </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dash.trips') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Trip::count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{ route('finished.index') }}" data-i18n="nav.templates.horz.classic">{{trans('dash.finished') }}</a>
                  </li>
                  <li><a class="menu-item" href="{{ route('inTrip.index') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('dash.intrip') }}</a>
                  </li>
                  
                   <li><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Trip::where('trip_status','finished')->where('is_transfered','false')->count() }}</span><a class="menu-item" href="{{ route('paid.non') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('admin.finishnot') }}</a>
                  </li>
                  
                  
              </ul>
          </li>
          
          
          
          
          
            <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dash.payments') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Payment::where('pay_status','paid')->count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{ route('payment.all') }}" data-i18n="nav.templates.horz.classic">{{trans('dash.paid') }}</a>
                  </li>
                 
              </ul>
          </li>
          
          
          
          
          
          
          
          
          
             <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dashboard.banners') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Banner::count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{ route('banners.index') }}" data-i18n="nav.templates.horz.classic">{{trans('dashboard.all.banner') }}</a>
                  </li>
                  <li><a class="menu-item" href="{{ route('banners.create') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('dashboard.add.banner') }}</a>
                  </li>
              </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.templates.main">{{trans('dashboard.notification') }} </span><span class="badge badge badge-info badge-pill badge-warning float-right mr-2">{{ App\Models\Notification::where('status','0')->count() }}</span></a>
              <ul class="menu-content">
                  <li><a class="menu-item" href="{{ route('notification.index') }}" data-i18n="nav.templates.horz.top_icon"> {{trans('dashboard.notification') }}</a>
                  </li>
              </ul>
          </li>
        </ul>
    </div>
  </div>
