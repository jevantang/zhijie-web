<!doctype html>
<html lang="{{ fs_theme('lang') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Fresns" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title') - {{ fs_config('site_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ fs_config('site_name') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ fs_config('site_icon') }}">
    <link rel="icon" href="{{ fs_config('site_icon') }}">
    @if (fs_config('language_status'))
        @foreach(fs_config('language_menus') as $lang)
            @if (! $lang['isEnabled'])
                @continue
            @endif
            <link rel="alternate" href="{{ request()->fullUrlWithQuery(['language' => $lang['langTag']]) }}" hreflang="{{ $lang['langTag'] }}"/>
        @endforeach
    @endif
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/atwho.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/prism.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ fs_theme('assets', 'css/fresns.css') }}">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.bundle.min.js"></script>
    @stack('style')
    @if (fs_config('website_stat_position') == 'head')
        {!! fs_config('website_stat_code') !!}
    @endif
</head>

<body>
    {{-- Header --}}
    @include('commons.header')

    {{-- Private mode user status handling --}}
    @if (fs_user()->check() && fs_user('detail.expired'))
        <div class="mt-5 pt-5">
            <div class="alert alert-warning mx-3" role="alert">
                <i class="bi bi-info-circle"></i>
                @if (fs_config('site_private_end_after') == 1)
                    {{ fs_lang('privateContentHide') }}
                @else
                    {{ fs_lang('privateContentShowOld') }}
                @endif

                <button class="btn btn-primary btn-sm ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-title="{{ fs_lang('renewal') }}"
                    data-url="{{ fs_config('site_public_service') }}"
                    data-post-message-key="fresnsRenewal">
                    {{ fs_lang('renewal') }}
                </button>
            </div>
        </div>
    @endif

    {{-- Main --}}
    @yield('content')

    {{-- Fresns Extensions Modal --}}
    <div class="modal fade" id="fresnsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fresnsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fresnsModalLabel">Fresns Title</h5>
                    <button type="button" class="btn-close btn-done-extensions" id="done-extensions" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding:0"></div>
            </div>
        </div>
    </div>

    {{-- Image Zoom Modal --}}
    <div class="modal fade image-zoom" id="imageZoom" tabindex="-1" aria-labelledby="imageZoomLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="mx-auto text-center">
                <img class="img-fluid" loading="lazy">
            </div>
        </div>
    </div>

    {{-- Quick Post Box --}}
    @if (fs_user()->check() && ! Route::is('fresns.editor.*'))
        @component('components.editor.quick-publish-post', [
            'group' => $group ?? null
        ])@endcomponent
    @endif

    {{-- Tip Toasts --}}
    <div class="fresns-tips">
        @include('commons.tips')
    </div>

    {{-- Footer --}}
    @include('commons.footer')

    {{-- Loading --}}
    @if (fs_config('zhijie_loading'))
        <div id="loading" class="position-fixed top-50 start-50 translate-middle bg-secondary bg-opacity-75 rounded p-4" style="z-index:2048;display:none;">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @endif

    {{-- Switching Languages Modal --}}
    @if (fs_config('language_status'))
        <div class="modal fade" id="translate" tabindex="-1" aria-labelledby="translateModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ fs_lang('switchLanguage') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush">
                            @foreach(fs_config('language_menus') as $lang)
                                @if (! $lang['isEnabled'])
                                    @continue
                                @endif
                                <a class="list-group-item list-group-item-action @if (fs_theme('lang') == $lang['langTag']) active @endif" href="{{ request()->fullUrlWithQuery(['language' => $lang['langTag']]) }}" hreflang="{{ $lang['langTag'] }}">
                                    {{ $lang['langName'] }}
                                    @if ($lang['areaName'])
                                        {{ '('.$lang['areaName'].')' }}
                                    @endif
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- User Auth --}}
    @include('commons.user-auth')

    {{-- Stat Code --}}
    @if (fs_config('website_stat_position') == 'body')
        <div style="display:none;">{!! fs_config('website_stat_code') !!}</div>
    @endif
    <script src="/static/js/js-cookie.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script src="/static/js/fresns-callback.js"></script>
    <script>
        window.ajaxGetList = true;
        window.siteName = "{{ fs_config('site_name') }}";
        window.siteIcon = "{{ fs_config('site_icon') }}";
        window.cookiePrefix = "{{ fs_config('website_cookie_prefix') }}";
        window.userIdentifier = "{{ fs_config('user_identifier') }}";
        window.mentionStatus = {{ fs_config('mention_status') ? 1 : 0 }};
        window.hashtagStatus = {{ fs_config('hashtag_status') ? 1 : 0 }};
        window.hashtagFormat = {{ fs_config('hashtag_format') }};

        if (is_wechat()) {
            $('#openApp').addClass('d-none');
            $('#downloadApp').addClass('btn-sm');
            $('#siteLogo').removeClass('pt-1');

            $(document).ready(function() {
                // Get current page url
                var currentUrl = window.location.href;

                // Send AJAX request
                $.ajax({
                    url: '/api/wechat-login/js-sdk/sign',
                    method: 'GET',
                    data: {
                        url: currentUrl,
                    },
                    dataType: 'json',
                    success: function(response) {
                        const config = response.data;

                        wx.config({
                            debug: false,
                            appId: config.appId,
                            timestamp: config.timestamp,
                            nonceStr: config.nonceStr,
                            signature: config.signature,
                            jsApiList: config.jsApiList,
                            openTagList: config.openTagList,
                        });
                    },
                    error: function(error) {
                        console.error("Error fetching configuration:", error);
                    }
                });
            });

            var launchAppBtn = document.getElementById('launch-app-btn');
            launchAppBtn.addEventListener('launch', function (e) {
                console.log('success');
            });
            launchAppBtn.addEventListener('error', function (e) {
                console.log('fail', e, e.detail);
            });
        }

        function is_wechat() {
            var ua = navigator.userAgent;

            return !!/MicroMessenger/i.test(ua);
        }
    </script>
    <script src="{{ fs_theme('assets', 'js/fresns-extensions.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/jquery.caret.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/atwho.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/prism.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/fancybox.umd.min.js') }}"></script>
    <script src="{{ fs_theme('assets', 'js/fresns.js') }}"></script>
    @stack('script')
</body>

</html>
