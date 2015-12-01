<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        {!! Html::image('http://placehold.it/160x160', 'User Image', ['class' => 'user-image']) !!}
        <span class="hidden-xs">Alexander Pierce</span>
    </a>
    <ul class="dropdown-menu">
        {{-- User image --}}
        <li class="user-header">
            {!! Html::image('http://placehold.it/160x160', 'User Image', ['class' => 'img-circle']) !!}
            <p>Alexander Pierce - Web Developer <small>Member since Nov. 2012</small></p>
        </li>
        {{-- Menu Body --}}
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                </div>
            </div>
        </li>
        {{-- Menu Footer --}}
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <a href="#" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>
    </ul>
</li>
