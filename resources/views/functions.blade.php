@extends('WebEngine::layout')

@section('body')
    <form action="{{ route('zhijie-web.admin.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        {{-- Slogan --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.sloganConfig') }}</label>
            <div class="col-lg-6">
                <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#sloganModal">{{ $params['zhijie_slogan']['value'] ?? 'Slogan' }}</button>
            </div>
        </div>

        {{-- Company Name --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.companyNameConfig') }}</label>
            <div class="col-lg-6">
                <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#companyNameModal">{{ $params['zhijie_company_name']['value'] ?? 'Company Name' }}</button>
            </div>
        </div>

        {{-- About --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.aboutConfig') }}</label>
            <div class="col-lg-6">
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary form-control btn-modal text-start" data-bs-toggle="modal" data-bs-target="#aboutModal">{{ __('FsLang::panel.button_edit') }}</button>
                    <a class="btn btn-outline-secondary" href="/portal/about" target="_blank" role="button">{{ __('FsLang::panel.button_view') }}</a>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.sidebarConfig') }}</label>
            <div class="col-lg-6">
                <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#sidebarModal">{{ __('FsLang::panel.button_edit') }}</button>
            </div>
        </div>

        {{-- Footer --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.footerConfig') }}</label>
            <div class="col-lg-6">
                <button type="button" class="btn btn-outline-secondary btn-modal w-100 text-start" data-bs-toggle="modal" data-bs-target="#footerModal">{{ __('FsLang::panel.button_edit') }}</button>
            </div>
        </div>

        {{-- App --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.appConfig') }}</label>
            <div class="col-lg-6">
                <div class="input-group mb-2">
                    <span class="input-group-text">App Scheme</span>
                    <input type="text" class="form-control" name="zhijie_app[scheme]" placeholder="zhijie" value="{{ $params['zhijie_app']['value']['scheme'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">微信移动应用 App ID</span>
                    <input type="text" class="form-control" name="zhijie_app[wechat][appId]" value="{{ $params['zhijie_app']['value']['wechat']['appId'] ?? '' }}">
                    <span class="input-group-text">在微信中打开 App</span>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">微信小程序 App ID</span>
                    <input type="text" class="form-control" name="zhijie_app[wechat][mpAppId]" value="{{ $params['zhijie_app']['value']['wechat']['mpAppId'] ?? '' }}">
                    <span class="input-group-text">在微信中打开小程序</span>
                </div>
                <div>
                    <label class="form-label">{{ __('FsLang::panel.sidebar_paths') }}</label>
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.user') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][user]" placeholder="pages/users/index" value="{{ $params['zhijie_app']['value']['path']['user'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.group') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][group]" placeholder="pages/groups/index" value="{{ $params['zhijie_app']['value']['path']['group'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.hashtag') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][hashtag]" placeholder="pages/hashtags/index" value="{{ $params['zhijie_app']['value']['path']['hashtag'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.post') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][post]" placeholder="pages/posts/index" value="{{ $params['zhijie_app']['value']['path']['post'] ?? '' }}">
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-text">{{ __('FsLang::panel.comment') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][comment]" placeholder="pages/comments/index" value="{{ $params['zhijie_app']['value']['path']['comment'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.user_detail') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][userDetail]" placeholder="pages/profile/posts?fsid=" value="{{ $params['zhijie_app']['value']['path']['userDetail'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.group_detail') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][groupDetail]" placeholder="pages/groups/detail?gid=" value="{{ $params['zhijie_app']['value']['path']['groupDetail'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.hashtag_detail') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][hashtagDetail]" placeholder="pages/hashtags/detail?hid=" value="{{ $params['zhijie_app']['value']['path']['hashtagDetail'] ?? '' }}">
                </div>
                <div class="input-group mb-2">
                    <span class="input-group-text">{{ __('FsLang::panel.post_detail') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][postDetail]" placeholder="pages/posts/detail?pid=" value="{{ $params['zhijie_app']['value']['path']['postDetail'] ?? '' }}">
                </div>
                <div class="input-group">
                    <span class="input-group-text">{{ __('FsLang::panel.comment_detail') }}</span>
                    <input type="text" class="form-control" name="zhijie_app[path][commentDetail]" placeholder="pages/comments/detail?cid=" value="{{ $params['zhijie_app']['value']['path']['commentDetail'] ?? '' }}">
                </div>
            </div>
        </div>

        {{-- Loading dynamic effects --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.loadingConfig') }}</label>
            <div class="col-lg-6 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="zhijie_loading" id="loading_true" value="true" {{ ($params['zhijie_loading']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="loading_true">{{ __('FsLang::panel.option_activate') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="zhijie_loading" id="loading_false" value="false" {{ ! ($params['zhijie_loading']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="loading_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                </div>
            </div>
        </div>

        {{-- Quick publish post --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.quickPublishConfig') }}</label>
            <div class="col-lg-6 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="zhijie_quick_publish" id="quick_publish_true" value="true" {{ ($params['zhijie_quick_publish']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="quick_publish_true">{{ __('FsLang::panel.option_activate') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="zhijie_quick_publish" id="quick_publish_false" value="false" {{ ! ($params['zhijie_quick_publish']['value'] ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="quick_publish_false">{{ __('FsLang::panel.option_deactivate') }}</label>
                </div>
            </div>
        </div>

        {{-- Is the message page displayed --}}
        <div class="row mb-4">
            <label class="col-lg-2 col-form-label text-lg-end">{{ __('ZhijieWeb::fresns.notificationConfig') }}</label>
            <div class="col-lg-10 mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_systems" name="zhijie_notifications[]" value="systems" {{ in_array('systems', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_systems">{{ __('ZhijieWeb::fresns.notification_systems') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_recommends" name="zhijie_notifications[]" value="recommends" {{ in_array('recommends', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_recommends">{{ __('ZhijieWeb::fresns.notification_recommends') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_likes" name="zhijie_notifications[]" value="likes" {{ in_array('likes', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_likes">{{ __('ZhijieWeb::fresns.notification_likes') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_dislikes" name="zhijie_notifications[]" value="dislikes" {{ in_array('dislikes', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_dislikes">{{ __('ZhijieWeb::fresns.notification_dislikes') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_follows" name="zhijie_notifications[]" value="follows" {{ in_array('follows', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_follows">{{ __('ZhijieWeb::fresns.notification_follows') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_blocks" name="zhijie_notifications[]" value="blocks" {{ in_array('blocks', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_blocks">{{ __('ZhijieWeb::fresns.notification_blocks') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_mentions" name="zhijie_notifications[]" value="mentions" {{ in_array('mentions', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_mentions">{{ __('ZhijieWeb::fresns.notification_mentions') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_comments" name="zhijie_notifications[]" value="comments" {{ in_array('comments', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_comments">{{ __('ZhijieWeb::fresns.notification_comments') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="notification_quotes" name="zhijie_notifications[]" value="quotes" {{ in_array('quotes', $params['zhijie_notifications']['value'] ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification_quotes">{{ __('ZhijieWeb::fresns.notification_quotes') }}</label>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-2"></div>
            <div class="col-lg-10"><button type="submit" class="btn btn-primary">{{ __('FsLang::panel.button_save') }}</button></div>
        </div>
    </form>

    {{-- slogan modal --}}
    <div class="modal fade" id="sloganModal" tabindex="-1" aria-labelledby="sloganModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('FsLang::panel.button_setting') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('zhijie-web.admin.update.languages') }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" name="itemKey" value="zhijie_slogan">

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
                                    @foreach ($optionalLanguages as $lang)
                                        <tr>
                                            <td>
                                                {{ $lang['langTag'] }}
                                                @if ($lang['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td><input type="text" name="languages[{{ $lang['langTag'] }}]" class="form-control" value="{{ $params['zhijie_slogan']['language_values'][$lang['langTag']] ?? '' }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ __('FsLang::panel.button_save') }}</button>
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
                    <h5 class="modal-title">{{ __('FsLang::panel.button_setting') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('zhijie-web.admin.update.languages') }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" name="itemKey" value="zhijie_company_name">

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
                                    @foreach ($optionalLanguages as $lang)
                                        <tr>
                                            <td>
                                                {{ $lang['langTag'] }}
                                                @if ($lang['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td><input type="text" name="languages[{{ $lang['langTag'] }}]" class="form-control" value="{{ $params['zhijie_company_name']['language_values'][$lang['langTag']] ?? '' }}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--button_save-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ __('FsLang::panel.button_save') }}</button>
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
                    <h5 class="modal-title">{{ __('FsLang::panel.button_setting') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('zhijie-web.admin.update.languages') }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" name="itemKey" value="zhijie_about">

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
                                    @foreach ($optionalLanguages as $lang)
                                        <tr>
                                            <td>
                                                {{ $lang['langTag'] }}
                                                @if ($lang['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="languages[{{ $lang['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['zhijie_about']['language_values'][$lang['langTag']] ?? '' }}</textarea>
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
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ __('FsLang::panel.button_save') }}</button>
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
                    <h5 class="modal-title">{{ __('FsLang::panel.button_setting') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('zhijie-web.admin.update.languages') }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" name="itemKey" value="zhijie_sidebar">

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
                                    @foreach ($optionalLanguages as $lang)
                                        <tr>
                                            <td>
                                                {{ $lang['langTag'] }}
                                                @if ($lang['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="languages[{{ $lang['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['zhijie_sidebar']['language_values'][$lang['langTag']] ?? '' }}</textarea>
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
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ __('FsLang::panel.button_save') }}</button>
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
                    <h5 class="modal-title">{{ __('FsLang::panel.button_setting') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('zhijie-web.admin.update.languages') }}" method="post">
                        @csrf
                        @method('put')

                        <input type="hidden" name="itemKey" value="zhijie_footer">

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
                                    @foreach ($optionalLanguages as $lang)
                                        <tr>
                                            <td>
                                                {{ $lang['langTag'] }}
                                                @if ($lang['langTag'] == $defaultLanguage)
                                                    <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('FsLang::panel.default_language') }}" data-bs-original-title="{{ __('FsLang::panel.default_language') }}" aria-label="{{ __('FsLang::panel.default_language') }}"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $lang['langName'] }}
                                                @if ($lang['areaName'])
                                                    {{ '('.$lang['areaName'].')' }}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="languages[{{ $lang['langTag'] }}]" placeholder="HTML" style="height:300px">{{ $params['zhijie_footer']['language_values'][$lang['langTag']] ?? '' }}</textarea>
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
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">{{ __('FsLang::panel.button_save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="/assets/ZhijieWeb/js/functions.js"></script>
@endpush
