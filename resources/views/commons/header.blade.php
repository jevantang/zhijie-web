@php
    $appScheme = fs_db_config('zhijie_app')['scheme'] ?? '';
    $appSchemeHome = $appScheme.'://'.(fs_db_config('zhijie_app')['path']['post'] ?? '');
    $appPath = '';

    if (Route::is('fresns.profile.*') && isset($profile)) {
        $appPath = (fs_db_config('zhijie_app')['path']['userDetail'] ?? '').$profile['fsid'];
    }

    if (Route::is('fresns.group.index')) {
        $appPath = fs_db_config('zhijie_app')['path']['group'] ?? '';
    }

    if (Route::is('fresns.group.detail') && isset($group)) {
        $appPath = (fs_db_config('zhijie_app')['path']['groupDetail'] ?? '').$group['gid'];
    }

    if (Route::is('fresns.hashtag.detail') && isset($hashtag)) {
        $appPath = (fs_db_config('zhijie_app')['path']['hashtagDetail'] ?? '').$hashtag['hid'];
    }

    if (Route::is('fresns.post.detail') && isset($post)) {
        $appPath = (fs_db_config('zhijie_app')['path']['postDetail'] ?? '').$post['pid'];
    }

    if (Route::is('fresns.comment.detail') && isset($comment)) {
        $appPath = (fs_db_config('zhijie_app')['path']['commentDetail'] ?? '').$comment['cid'];
    }
@endphp

<header class="fixed-top bg-body shadow-sm">
    <div class="d-none d-lg-block">
        <div class="row">
            {{-- logo --}}
            <div class="col-4">
                <div class="d-flex align-items-center">
                    <a class="ms-3" href="{{ fs_route(route('fresns.home')) }}"><img src="{{ fs_db_config('site_logo') }}" height="32" style="margin-top: 12px"></a>
                    <span class="fw-normal text-secondary fs-7 ms-3" style="margin-top: 12px;">{{ fs_db_config('zhijie_slogan') }}</span>
                </div>
            </div>

            {{-- navbar --}}
            <div class="col-4">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-underline">
                        {{-- post --}}
                        @if (fs_db_config('menu_post_status'))
                            <li class="nav-item">
                                <a class="nav-link py-3 px-2 px-lg-3 {{ Route::is(['fresns.home', 'fresns.post.*', 'fresns.follow.all.posts']) ? 'active' : '' }}" href="{{ fs_route(route('fresns.post.index')) }}">
                                    {{ fs_db_config('menu_post_name') }}
                                </a>
                            </li>
                        @endif

                        {{-- group --}}
                        @if (fs_db_config('menu_group_status'))
                            <li class="nav-item">
                                <a class="nav-link py-3 px-2 px-lg-3 {{ Route::is(['fresns.group.*']) ? 'active' : '' }}" href="{{ fs_route(route('fresns.group.index')) }}">
                                    {{ fs_db_config('menu_group_name') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- user --}}
            <div class="col-4">
                <div class="d-flex justify-content-end mt-2 me-4">
                    @if (fs_user()->check())
                        {{-- Logged In --}}
                        <a class="btn" href="{{ fs_route(route('fresns.account.index')) }}" role="button"><img src="{{ fs_user('detail.avatar') }}" loading="lazy" class="nav-avatar rounded-circle"> {{ fs_user('detail.nickname') }}</a>

                        <a href="{{ fs_route(route('fresns.notifications.index')) }}"role="button" class="btn btn-outline-secondary btn-nav ms-2 rounded-circle position-relative">
                            <i class="bi bi-bell"></i>
                            @if (fs_user_panel('unreadNotifications.all') > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ fs_user_panel('unreadNotifications.all') }}</span>
                            @endif
                        </a>

                        @if (fs_api_config('conversation_status'))
                            <a href="{{ fs_route(route('fresns.messages.index')) }}"role="button" class="btn btn-outline-secondary btn-nav ms-2 rounded-circle position-relative">
                                <i class="bi bi-envelope"></i>
                                @if (fs_user_panel('conversations.unreadMessages') > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ fs_user_panel('conversations.unreadMessages') }}</span>
                                @endif
                            </a>
                        @endif

                        {{-- User Menus --}}
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-nav ms-2 rounded-circle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-caret-down-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- Notifications --}}
                                <li>
                                    <a class="dropdown-item" href="{{ fs_route(route('fresns.notifications.index')) }}">
                                        <i class="bi bi-bell"></i>
                                        {{ fs_db_config('menu_notifications') }}

                                        @if (fs_user_panel('unreadNotifications.all') > 0)
                                            <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.all') }}</span>
                                        @endif
                                    </a>
                                </li>

                                {{-- Conversations --}}
                                @if (fs_api_config('conversation_status'))
                                    <li>
                                        <a class="dropdown-item" href="{{ fs_route(route('fresns.messages.index')) }}">
                                            <i class="bi bi-envelope"></i>
                                            {{ fs_db_config('menu_conversations') }}

                                            @if (fs_user_panel('conversations.unreadMessages') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('conversations.unreadMessages') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- Drafts --}}
                                <li>
                                    <a class="dropdown-item" href="{{ fs_route(route('fresns.editor.drafts', ['type' => 'posts'])) }}">
                                        <i class="bi bi-file-earmark-text"></i>
                                        {{ fs_db_config('menu_editor_drafts') }}

                                        @if (array_sum(fs_user_panel('draftCount')) > 0)
                                            <span class="badge bg-primary">{{ array_sum(fs_user_panel('draftCount')) }}</span>
                                        @endif
                                    </a>
                                </li>

                                {{-- Wallet --}}
                                @if (fs_api_config('wallet_status'))
                                    <li><a class="dropdown-item" href="{{ fs_route(route('fresns.account.wallet')) }}"><i class="bi bi-wallet"></i> {{ fs_db_config('menu_account_wallet') }}</a></li>
                                @endif

                                {{-- Users of this account --}}
                                @if (fs_user_panel('multiUser.status') || count(fs_account('detail.users')) > 1)
                                    <li><a class="dropdown-item" href="{{ fs_route(route('fresns.account.users')) }}"><i class="bi bi-people"></i> {{ fs_db_config('menu_account_users') }}</a></li>
                                @endif

                                {{-- Settings --}}
                                <li><a class="dropdown-item" href="{{ fs_route(route('fresns.account.settings')) }}"><i class="bi bi-gear"></i> {{ fs_db_config('menu_account_settings') }}</a></li>
                                <li><hr class="dropdown-divider"></li>

                                {{-- Switch Languages --}}
                                @if (fs_api_config('language_status'))
                                    <li><a class="dropdown-item" href="#translate" data-bs-toggle="modal"><i class="bi bi-translate"></i> {{ fs_lang('optionLanguage') }}</a></li>
                                @endif

                                {{-- Switch Users --}}
                                @if (count(fs_account('detail.users')) > 1)
                                    <li><a class="dropdown-item" href="#userAuth" id="switch-user" data-bs-toggle="modal"><i class="bi bi-people"></i> {{ fs_lang('optionUser') }}</a></li>
                                @endif

                                {{-- Logout --}}
                                <li><a class="dropdown-item" href="{{ fs_route(route('fresns.account.logout')) }}"><i class="bi bi-power"></i> {{ fs_lang('accountLogout') }}</a></li>
                            </ul>
                        </div>
                    @else
                        {{-- Not Logged In --}}
                        <a class="btn btn-outline-success me-3" href="{{ fs_route(route('fresns.account.login', ['redirectURL' => request()->fullUrl()])) }}" role="button">{{ fs_lang('accountLogin') }}</a>

                        @if (fs_api_config('site_public_status'))
                            @if (fs_api_config('site_public_service'))
                                <button class="btn btn-success me-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                    data-type="account"
                                    data-scene="join"
                                    data-post-message-key="fresnsJoin"
                                    data-title="{{ fs_lang('accountRegister') }}"
                                    data-url="{{ fs_api_config('site_public_service') }}">
                                    {{ fs_lang('accountRegister') }}
                                </button>
                            @else
                                <a class="btn btn-success me-3" href="{{ fs_route(route('fresns.account.register', ['redirectURL' => request()->fullUrl()])) }}" role="button">{{ fs_lang('accountRegister') }}</a>
                            @endif
                        @endif

                        @if (fs_api_config('language_status'))
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="language" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-translate"></i>
                                    @foreach(fs_api_config('language_menus') as $lang)
                                        @if (current_lang_tag() == $lang['langTag']) {{ $lang['langName'] }} @endif
                                    @endforeach
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    @foreach(fs_api_config('language_menus') as $lang)
                                        @if ($lang['isEnabled'])
                                            <li>
                                                <a class="dropdown-item @if (current_lang_tag() == $lang['langTag']) active @endif" hreflang="{{ $lang['langTag'] }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang['langTag'], null, [], true) }}">
                                                    {{ $lang['langName'] }}
                                                    @if ($lang['areaName'])
                                                        {{ '('.$lang['areaName'].')' }}
                                                    @endif
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="d-block d-lg-none bg-body-tertiary py-1 text-center fw-normal text-secondary fs-7">{{ fs_db_config('zhijie_slogan') }}</div>

    <div class="d-block d-lg-none d-flex py-2">
        <div class="ms-3 pt-1" id="siteLogo">
            <a href="{{ fs_route(route('fresns.home')) }}"><img src="{{ fs_db_config('site_logo') }}" height="28"></a>
        </div>

        <div class="ms-auto pe-2">
            <a class="btn btn-outline-secondary me-1" href="{{ fs_route(route('fresns.portal')) }}" id="downloadApp" role="button">{{ fs_lang('downloadApp') }}</a>

            @if ($appScheme)
                <a href="{{ $appPath ? $appScheme.'://'.$appPath : $appSchemeHome }}" id="openApp" class="btn btn-warning me-1" role="button">{{ fs_lang('openApp') }}</a>
            @endif

            @if (fs_db_config('zhijie_app')['wechat']['appId'])
                <wx-open-launch-app id="launch-app-btn" appid="{{ fs_db_config('zhijie_app')['wechat']['appId'] ?? '' }}" extinfo="{{ $appPath ? '/'.$appPath : (fs_db_config('zhijie_app')['path']['post'] ?? '') }}">
                    <script type="text/wxtag-template">
                        <style>
                            .we-launch-app {
                                display: inline-block;
                                padding: 0.25rem 0.5rem;
                                font-size: 0.875rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #000;
                                text-align: center;
                                text-decoration: none;
                                vertical-align: middle;
                                cursor: pointer;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                user-select: none;
                                border: 1px solid #ffc107;
                                border-radius: 0.25rem;
                                background-color: #ffc107;
                                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                            }
                        </style>
                        <button class="we-launch-app">{{ fs_lang('openApp') }}</button>
                    </script>
                </wx-open-launch-app>
            @endif

            @if (fs_db_config('zhijie_app')['wechat']['mpAppId'] ?? '')
                <wx-open-launch-weapp id="launch-weapp-btn" appid="{{ fs_db_config('zhijie_app')['wechat']['mpAppId'] ?? '' }}" path="{{ $appPath ? '/'.$appPath : (fs_db_config('zhijie_app')['path']['post'] ?? '') }}">
                    <script type="text/wxtag-template">
                        <style>
                            .we-launch-app {
                                display: inline-block;
                                padding: 0.25rem 0.5rem;
                                font-size: 0.875rem;
                                font-weight: 400;
                                line-height: 1.5;
                                color: #fff;
                                text-align: center;
                                text-decoration: none;
                                vertical-align: middle;
                                cursor: pointer;
                                -webkit-user-select: none;
                                -moz-user-select: none;
                                user-select: none;
                                border: 1px solid #198754;
                                border-radius: 0.25rem;
                                background-color: #198754;
                                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                            }
                        </style>
                        <button class="we-launch-app">小程序</button>
                    </script>
                </wx-open-launch-weapp>
            @endif
        </div>
    </div>
</header>
