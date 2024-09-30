<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container" id="navcontainer">
        <a class="navbar-brand mx-2" href="#">
            <span class="logo">@lang('certificate.system')</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="container d-flex justify-content-between">
                @if (Auth::check())
                    <div class="d-flex">
                        <a href="{{ route('excel.index') }}" id="btn-enter" class="btn my-2 my-sm-0 ml-1"
                            style="color: #003366;">
                            <i class="fas fa-plus"></i>
                        </a>

                        <a href="{{ route('registindex') }}" id="btn-enter" class="btn my-2 my-sm-0 ml-1"
                            style="color: #003366;">
                            <i class="fas fa-user"></i>
                        </a>
                        <a href="{{ route('logout') }}" id="btn-enter" class="btn my-2 my-sm-0 ml-1"
                            style="color: #003366;">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                @endif

                <div class="d-flex ml-auto align-items-center">
                    <a href="{{ url('/lang/en') }}" class="nav-link text-dark">@lang('certificate.english')</a>
                    <span class="mx-2">|</span>
                    <a href="{{ url('/lang/ar') }}" class="nav-link text-dark">@lang('certificate.arabic')</a>
                </div>
            </div>
        </div>

    </div>
</nav>
