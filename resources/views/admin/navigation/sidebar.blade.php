<div class="app-header__logo">
    <div class="logo-src"></div>
    <div class="header__pane ml-auto">
        <div>
            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</div>
<div class="app-header__mobile-menu">
    <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
</div>
<div class="app-header__menu">
    <span>
        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
        </button>
    </span>
</div>    
<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        @auth
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">ユーザー</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="metismenu-icon fas fa-users"></i>
                        ユーザーリスト
                    </a>
                </li>
            </ul>

            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">設定</li>
                <li>
                    <a href="{{ route('admin.info') }}">
                        <i class="metismenu-icon fas fa-cogs"></i>
                        プロフィール
                    </a>
                </li>
            </ul>
        @endauth
    </div>
</div>