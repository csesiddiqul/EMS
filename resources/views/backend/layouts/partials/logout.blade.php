<div class="user-profile pull-right">
{{--    @php--}}
{{--        $user = Auth::guard('admin')->user();--}}
{{--        $user->roles[0]->name;--}}
{{--    @endphp--}}



{{--    @if($user->roles[0]->name == 'employee')--}}
{{--        <img class="avatar user-thumb" src="{{$emd->img}}" alt="avatar">--}}
{{--    @endif--}}




    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
    {{ Auth::guard('admin')->user()->name }}
    <i class="fa fa-angle-down"></i></h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
        onclick="event.preventDefault();
                      document.getElementById('admin-logout-form').submit();">Log Out</a>
    </div>

    <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
