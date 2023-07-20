<li class="nav-item dropdown ">
    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
        aria-expanded="false">
        <i class="ti-bell"></i>
        @if ($newCount)
        <span class="badge badge-danger notification-status" > 
            {{ $newCount }} 
        </span>
        @endif
        
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
        <div class="dropdown-header notifications">
            <strong>{{ trans('backend/dashboard_trans.Notifications') }}</strong>
            <span class="badge badge-pill badge-warning">{{ $newCount }}</span>
        </div>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
            <a href="{{$notification->data['url']}}?notification_id={{$notification->id}}" class="dropdown-item @if($notification->unread()) text-danger @endif">
                {{$notification->data['body']}}
                <small class="float-right text-muted time">{{$notification->created_at->diffForHumans()}}</small> </a>
        @endforeach



    </div>
</li>
