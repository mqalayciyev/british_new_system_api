<div class="row">
    <div class="col-12 p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item {{ url()->current() === route('account') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('account') }}">Profil</a>
                </li>
                <li class="nav-item {{ url()->current() === route('payments') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('payments') }}">Ödənişlər</a>
                </li>
                <li class="nav-item {{ url()->current() === route('notifications') ? 'active' : '' }}">
                  <a class="nav-link"  href="{{ route('notifications') }}">Bildirişlər</a>
                </li>
              </ul>
            </div>
          </nav>

    </div>
</div>
