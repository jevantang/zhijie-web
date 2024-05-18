@extends('ThemeFunctions::layout')

@section('body')
    <header class="border-bottom mb-3 pt-5 ps-5 pb-3">
        <h3>Zhijie Web</h3>
        <p class="text-secondary"><i class="bi bi-palette"></i> 一款以信息流为体验形式的极简风格网站端，精简了大量功能，仅作为信息展示和 App 引流使用。</p>
    </header>

    <main class="my-5">
        <form action="{{ route('fresns.api.functions', ['fskey' => 'ZhijieWeb']) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- Slogan --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['sloganConfig'] }}</label>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#sloganModal">{{ $params['zhijie_slogan'][$defaultLanguage] ?? reset($params['zhijie_slogan']) ?: 'Slogan' }}</button>
                </div>
            </div>

            {{-- Company Name --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['companyNameConfig'] }}</label>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#companyNameModal">{{ $params['zhijie_company_name'][$defaultLanguage] ?? reset($params['zhijie_company_name']) ?: 'Company Name' }}</button>
                </div>
            </div>

            {{-- About --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['aboutConfig'] }}</label>
                <div class="col-lg-6">
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary form-control btn-modal text-start" data-bs-toggle="modal" data-bs-target="#aboutModal">{{ __('FsLang::panel.button_edit') }}</button>
                        <a class="btn btn-outline-secondary" href="{{ route('fresns.about') }}" target="_blank" role="button">{{ __('FsLang::panel.button_view') }}</a>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['sidebarConfig'] }}</label>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#sidebarModal">{{ __('FsLang::panel.button_edit') }}</button>
                </div>
            </div>

            {{-- Footer --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['footerConfig'] }}</label>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#footerModal">{{ __('FsLang::panel.button_edit') }}</button>
                </div>
            </div>

            {{-- App --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['appConfig'] }}</label>
                <div class="col-lg-6">
                    <div class="input-group mb-2">
                        <span class="input-group-text">App Scheme</span>
                        <input type="text" class="form-control" name="zhijie_app[scheme]" placeholder="zhijie" value="{{ $params['zhijie_app']['scheme'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">微信移动应用 App ID</span>
                        <input type="text" class="form-control" name="zhijie_app[wechat][appId]" value="{{ $params['zhijie_app']['wechat']['appId'] ?? '' }}">
                        <span class="input-group-text">在微信中打开 App</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">微信小程序 App ID</span>
                        <input type="text" class="form-control" name="zhijie_app[wechat][mpAppId]" value="{{ $params['zhijie_app']['wechat']['mpAppId'] ?? '' }}">
                        <span class="input-group-text">在微信中打开小程序</span>
                    </div>
                    <div>
                        <label class="form-label">{{ __('FsLang::panel.sidebar_paths') }}</label>
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.user') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][user]" placeholder="pages/users/index" value="{{ $params['zhijie_app']['path']['user'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.group') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][group]" placeholder="pages/groups/index" value="{{ $params['zhijie_app']['path']['group'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.hashtag') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][hashtag]" placeholder="pages/hashtags/index" value="{{ $params['zhijie_app']['path']['hashtag'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.geotag') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][geotag]" placeholder="pages/geotags/index" value="{{ $params['zhijie_app']['path']['geotag'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.post') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][post]" placeholder="pages/posts/index" value="{{ $params['zhijie_app']['path']['post'] ?? '' }}">
                    </div>
                    <div class="input-group mb-4">
                        <span class="input-group-text">{{ __('FsLang::panel.comment') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][comment]" placeholder="pages/comments/index" value="{{ $params['zhijie_app']['path']['comment'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.user_detail') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][userDetail]" placeholder="pages/profile/posts?fsid=" value="{{ $params['zhijie_app']['path']['userDetail'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.group_detail') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][groupDetail]" placeholder="pages/groups/detail?gid=" value="{{ $params['zhijie_app']['path']['groupDetail'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.hashtag_detail') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][hashtagDetail]" placeholder="pages/hashtags/detail?htid=" value="{{ $params['zhijie_app']['path']['hashtagDetail'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.geotag_detail') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][geotagDetail]" placeholder="pages/geotags/detail?gtid=" value="{{ $params['zhijie_app']['path']['geotagDetail'] ?? '' }}">
                    </div>
                    <div class="input-group mb-2">
                        <span class="input-group-text">{{ __('FsLang::panel.post_detail') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][postDetail]" placeholder="pages/posts/detail?pid=" value="{{ $params['zhijie_app']['path']['postDetail'] ?? '' }}">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">{{ __('FsLang::panel.comment_detail') }}</span>
                        <input type="text" class="form-control" name="zhijie_app[path][commentDetail]" placeholder="pages/comments/detail?cid=" value="{{ $params['zhijie_app']['path']['commentDetail'] ?? '' }}">
                    </div>
                </div>
            </div>

            {{-- Loading dynamic effects --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['loadingConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="zhijie_loading" id="loading_true" value="true" {{ $params['zhijie_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="zhijie_loading" id="loading_false" value="false" {{ ! $params['zhijie_loading'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- Quick publish post --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['quickPublishConfig'] }}</label>
                <div class="col-lg-6 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="zhijie_quick_publish" id="quick_publish_true" value="true" {{ $params['zhijie_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="zhijie_quick_publish" id="quick_publish_false" value="false" {{ ! $params['zhijie_quick_publish'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                    </div>
                </div>
            </div>

            {{-- Is the message page displayed --}}
            <div class="row mb-4">
                <label class="col-lg-2 col-form-label text-lg-end">{{ $lang['notificationConfig'] }}</label>
                <div class="col-lg-10 mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_systems" name="zhijie_notifications[]" value="systems" {{ in_array('systems', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_systems">{{ $lang['notification_systems'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_recommends" name="zhijie_notifications[]" value="recommends" {{ in_array('recommends', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_recommends">{{ $lang['notification_recommends'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_likes" name="zhijie_notifications[]" value="likes" {{ in_array('likes', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_likes">{{ $lang['notification_likes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_dislikes" name="zhijie_notifications[]" value="dislikes" {{ in_array('dislikes', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_dislikes">{{ $lang['notification_dislikes'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_follows" name="zhijie_notifications[]" value="follows" {{ in_array('follows', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_follows">{{ $lang['notification_follows'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_blocks" name="zhijie_notifications[]" value="blocks" {{ in_array('blocks', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_blocks">{{ $lang['notification_blocks'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_mentions" name="zhijie_notifications[]" value="mentions" {{ in_array('mentions', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_mentions">{{ $lang['notification_mentions'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_comments" name="zhijie_notifications[]" value="comments" {{ in_array('comments', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_comments">{{ $lang['notification_comments'] }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="notification_quotes" name="zhijie_notifications[]" value="quotes" {{ in_array('quotes', $params['zhijie_notifications']) ? 'checked' : '' }}>
                        <label class="form-check-label" for="notification_quotes">{{ $lang['notification_quotes'] }}</label>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ $lang['save'] }}</button></div>
            </div>
        </form>
    </main>

    <footer class="copyright text-center">
        <p class="my-5 text-muted">&copy; <span class="copyright-year"></span> Fresns</p>
    </footer>

    {{-- slogan modal --}}
    <div class="modal fade" id="sloganModal" tabindex="-1" aria-labelledby="sloganModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $lang['sloganConfig'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'ZhijieWeb']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col" class="w-25">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col" class="w-25">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-50">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td><input type="text" name="zhijie_slogan[{{ $langMenu['langTag'] }}]" class="form-control" value="{{ $params['zhijie_slogan'][$langMenu['langTag']] ?? '' }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- company name modal --}}
    <div class="modal fade" id="companyNameModal" tabindex="-1" aria-labelledby="companyNameModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $lang['companyNameConfig'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'ZhijieWeb']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col" class="w-25">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col" class="w-25">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-50">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td><input type="text" name="zhijie_company_name[{{ $langMenu['langTag'] }}]" class="form-control" value="{{ $params['zhijie_company_name'][$langMenu['langTag']] ?? '' }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- about modal --}}
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $lang['aboutConfig'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'ZhijieWeb']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-75">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="zhijie_about[{{ $langMenu['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['zhijie_about'][$langMenu['langTag']] ?? '' }}</textarea>
                                                    <label for="floatingTextarea2">HTML</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- sidebar modal --}}
    <div class="modal fade" id="sidebarModal" tabindex="-1" aria-labelledby="sidebarModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $lang['sidebarConfig'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'ZhijieWeb']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-75">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="zhijie_sidebar[{{ $langMenu['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['zhijie_sidebar'][$langMenu['langTag']] ?? '' }}</textarea>
                                                    <label for="floatingTextarea2">HTML</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- footer modal --}}
    <div class="modal fade" id="footerModal" tabindex="-1" aria-labelledby="footerModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $lang['footerConfig'] }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fresns.api.functions', ['fskey' => 'ZhijieWeb']) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">{{ __('FsLang::panel.table_lang_tag') }}</th>
                                        <th scope="col">{{ __('FsLang::panel.table_lang_name') }}</th>
                                        <th scope="col" class="w-75">{{ __('FsLang::panel.table_content') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($languageMenus as $langMenu)
                                        <tr>
                                            <td>
                                                {{ $langMenu['langTag'] }}
                                                @if ($langMenu['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $langMenu['langName'] }}
                                                @if ($langMenu['areaName'])
                                                    {{ '('.$langMenu['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="zhijie_footer[{{ $langMenu['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['zhijie_footer'][$langMenu['langTag']] ?? '' }}</textarea>
                                                    <label for="floatingTextarea2">HTML</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ $lang['save'] }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
