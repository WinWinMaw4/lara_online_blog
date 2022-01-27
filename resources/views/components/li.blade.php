<li class="nav-item">
    <a class="nav-link {{route($routeName) == request()->url()? 'active':''}}" aria-current="page" href="{{route($routeName)}}">{{$name}}</a>
</li>
