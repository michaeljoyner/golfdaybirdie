<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">GolfBallBranding</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                {{--<li @if(Request::path() === 'admin') class="active" @endif ><a href="/admin">Home</a></li>--}}
                <li @if(starts_with(Request::path(), 'admin/products')) class="active" @endif  class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/products">View all</a></li>
                        <li><a href="/admin/products/create">Add a Product</a></li>
                    </ul>
                </li>
                <li @if(starts_with(Request::path(), 'admin/quoterequests')) class="active" @endif  class="dropdown">
                    <a href="/admin/quoterequests" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quote Requests <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/quoterequests">Current Requests</a></li>
                        <li><a href="/admin/quoterequests/archives">Archived Requests</a></li>
                    </ul>
                </li>
                <li @if(starts_with(Request::path(), 'admin/users')) class="active" @endif><a href="/admin/users">Users</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/resetpassword">Reset Password</a></li>
                        <li><a href="/admin/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>