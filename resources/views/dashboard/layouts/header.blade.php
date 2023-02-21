<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="#">
              <h3 class="brand-text">{{trans('Ghazala') }}</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link  ft-user " href="#" data-toggle="dropdown"   aria-haspopup="true" aria-expanded="false">
              </a>
              <div class="dropdown-menu dropdown-menu-right">



                    @if(auth('client')->check())
                    <form method="GET" action="{{ route('logout','client') }} ">
                        @else
                            <form method="GET" action="{{ route('logout','web') }}">@endif
                                @csrf
                                <a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"> <i class="ft-power"></i>{{trans('dashboard.logout')}}</a>
                            </form>

              </div>
              <div>
            </li>
            <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
                    @if(LaravelLocalization::getCurrentLocaleNative() == "English")
                        <i class="flag-icon flag-icon-gb"></i>
                      @elseif( LaravelLocalization::getCurrentLocaleNative() == "العربية")
                        <i class="flag-icon flag-icon-eg "></i>
                      @endif
<span class="selected-language"></span></a>
              <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a  class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    @if($properties['native'] == "English")
                        <i class="flag-icon flag-icon-gb"></i>
                      @elseif($properties['native'] == "العربية")
                        <i class="flag-icon flag-icon-eg"></i>
                      @endif
                            {{ $properties['native'] }}
                        </a>
                        @endforeach

              </div>
            </li>
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{ App\Models\Notification::where('status',0)->count() }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">{{ trans('dash.notify') }}</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-danger float-right m-0">
                      {{ App\Models\Notification::where('status',0)->count() }}
                  </span>
                </li>
                <li class="scrollable-container media-list w-100">
                     @foreach(\App\Models\Notification::orderBy('id', 'DESC')->where('status',0)->get() as $notify)
{{--                       <p> {{$notify->body}} {{$notify->name}}</p> <a href="{{route('make.read',$notify->id)}}">Mark Read</a>--}}
                        <div class="alert alert-light">{{$notify->body}} {{$notify->name}} <a href="{{route('make.read',$notify->id)}}" class="text-bold-700 text-dark"><u>{{ trans('dash.mark') }}</u></a></div>
                    @endforeach
                    <a href="javascript:void(0)">
                      <div class="media">
                        <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                        <div class="media-body">
                          <h6 class="media-heading"></h6>
                          <p class="notification-text font-small-3 text-muted"></p>
                          <small>
                            <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00"></time>
                          </small>
                        </div>
                      </div>
                    </a>




                </li>
                <!--<li class="dropdown-menu-footer"><a id="mark-all" data-guard="admin" class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>-->
                <li class="dropdown-menu-footer"><a id="mark-all" data-guard="admin" class="dropdown-item text-muted text-center" href="{{route('notification.index')}}">{{ trans('dash.all') }}</a></li>
                
              </ul>
            </li>








              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
