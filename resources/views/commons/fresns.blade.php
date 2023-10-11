<!doctype html>
<html lang="{{ current_lang_tag() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Fresns" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title') - {{ fs_db_config('site_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ fs_db_config('site_name') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ fs_db_config('site_icon') }}">
    <link rel="icon" href="{{ fs_db_config('site_icon') }}">
    <link rel="stylesheet" href="/static/css/bootstrap.min.css?v={{ $fresnsVersion }}">
    <link rel="stylesheet" href="/static/css/bootstrap-icons.min.css?v={{ $fresnsVersion }}">
    <link rel="stylesheet" href="/static/css/select2.min.css?v={{ $fresnsVersion }}">
    <link rel="stylesheet" href="/assets/{{ $clientFskey }}/css/atwho.min.css?v={{ $clientVersion}}">
    <link rel="stylesheet" href="/assets/{{ $clientFskey }}/css/prism.min.css?v={{ $clientVersion}}">
    <link rel="stylesheet" href="/assets/{{ $clientFskey }}/css/fancybox.min.css?v={{ $clientVersion}}">
    <link rel="stylesheet" href="/assets/{{ $clientFskey }}/css/fresns.css?v={{ $clientVersion}}">
    <script src="/static/js/jquery.min.js?v={{ $fresnsVersion }}"></script>
    <script src="/static/js/bootstrap.bundle.min.js?v={{ $fresnsVersion }}"></script>
    @stack('style')
    @if (fs_db_config('website_stat_position') == 'head')
        {!! fs_db_config('website_stat_code') !!}
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
                @if (fs_api_config('site_private_end_after') == 1)
                    {{ fs_lang('privateContentHide') }}
                @else
                    {{ fs_lang('privateContentShowOld') }}
                @endif

                <button class="btn btn-primary btn-sm ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                    data-type="account"
                    data-scene="renewal"
                    data-post-message-key="fresnsRenewal"
                    data-title="{{ fs_lang('renewal') }}"
                    data-url="{{ fs_api_config('site_public_service') }}">
                    {{ fs_lang('renewal') }}
                </button>
            </div>
        </div>
    @endif

    {{-- Main --}}
    @yield('content')

    {{-- Fresns Extensions Modal --}}
    <div class="modal fade fresnsExtensions" id="fresnsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fresnsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fresnsModalLabel">Extensions title</h5>
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
    @if (fs_user()->check())
        @component('components.editor.post-box', [
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
    @if (fs_db_config('zhijie_loading'))
        <div id="loading" class="position-fixed top-50 start-50 translate-middle bg-secondary bg-opacity-75 rounded p-4" style="z-index:2048;display:none;">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @endif

    {{-- Switching Languages Modal --}}
    @if (fs_api_config('language_status'))
        <div class="modal fade" id="translate" tabindex="-1" aria-labelledby="translateModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ fs_lang('optionLanguage') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-flush">
                            @foreach(fs_api_config('language_menus') as $lang)
                                @if ($lang['isEnabled'])
                                    <a class="list-group-item list-group-item-action @if (current_lang_tag() == $lang['langTag']) active @endif" hreflang="{{ $lang['langTag'] }}" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang['langTag'], null, [], true) }}">
                                        {{ $lang['langName'] }}
                                        @if ($lang['areaName'])
                                            {{ '('.$lang['areaName'].')' }}
                                        @endif
                                    </a>
                                @endif
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
    @if (fs_db_config('website_stat_position') == 'body')
        <div style="display:none;">{!! fs_db_config('website_stat_code') !!}</div>
    @endif
    <script src="/static/js/base64.js?v={{ $fresnsVersion }}"></script>
    <script src="/static/js/select2.min.js?v={{ $fresnsVersion }}"></script>
    <script src="/static/js/masonry.pkgd.min.js?v={{ $fresnsVersion}}"></script>
    <script src="/static/js/iframeResizer.min.js?v={{ $fresnsVersion }}"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script>
        window.ajaxGetList = true;
        window.siteName = "{{ fs_db_config('site_name') }}";
        window.siteIcon = "{{ fs_db_config('site_icon') }}";
        window.langTag = "{{ current_lang_tag() }}";
        window.userIdentifier = "{{ fs_api_config('user_identifier') }}";
        window.mentionStatus = {{ fs_api_config('mention_status') ? 1 : 0 }};
        window.hashtagStatus = {{ fs_api_config('hashtag_status') ? 1 : 0 }};
        window.hashtagFormat = {{ fs_api_config('hashtag_format') }};

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
    <script src="/assets/{{ $clientFskey }}/js/fresns-iframe.js?v={{ $clientVersion }}"></script>
    <script src="/assets/{{ $clientFskey }}/js/jquery.caret.min.js?v={{ $clientVersion}}"></script>
    <script src="/assets/{{ $clientFskey }}/js/atwho.min.js?v={{ $clientVersion}}"></script>
    <script src="/assets/{{ $clientFskey }}/js/prism.min.js?v={{ $clientVersion}}"></script>
    <script src="/assets/{{ $clientFskey }}/js/fancybox.umd.min.js?v={{ $clientVersion}}"></script>
    <script src="/assets/{{ $clientFskey }}/js/fresns.js?v={{ $clientVersion}}"></script>
    @stack('script')
</body>

</html>
