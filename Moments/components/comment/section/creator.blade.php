<div class="d-flex">
    <div class="flex-shrink-0">
        @if (! $creator['status'])
            {{-- Deactivate --}}
            <img src="{{ fs_db_config('deactivate_avatar') }}" loading="lazy" alt="{{ fs_lang('contentCreatorDeactivate') }}" class="user-avatar rounded-circle">
        @elseif ($isAnonymous)
            {{-- Anonymous --}}
            <img src="{{ $creator['avatar'] }}" loading="lazy" alt="{{ fs_lang('contentCreatorAnonymous') }}" class="user-avatar rounded-circle">
        @else
            {{-- Creator --}}
            <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $creator['fsid']])) }}">
                @if ($creator['decorate'])
                    <img src="{{ $creator['decorate'] }}" loading="lazy" alt="Avatar Decorate" class="user-decorate">
                @endif
                <img src="{{ $creator['avatar'] }}" loading="lazy" alt="{{ $creator['username'] }}" class="user-avatar rounded-circle">
            </a>
        @endif
    </div>

    <div class="flex-grow-1">
        <div class="user-primary d-lg-flex">
            @if (! $creator['status'])
                {{-- Deactivate --}}
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <div class="text-muted">{{ fs_lang('contentCreatorDeactivate') }}</div>
                </div>
            @elseif ($isAnonymous)
                {{-- Anonymous --}}
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <div class="text-muted">{{ fs_lang('contentCreatorAnonymous') }}</div>
                </div>
            @else
                {{-- Creator --}}
                <div class="user-info d-flex text-nowrap overflow-hidden">
                    <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $creator['fsid']])) }}" class="user-link d-flex">
                        <div class="user-nickname text-nowrap overflow-hidden" style="color:{{ $creator['nicknameColor'] }};">{{ $creator['nickname'] }}</div>
                        @if ($creator['verifiedStatus'])
                            <div class="user-verified">
                                @if ($creator['verifiedIcon'])
                                    <img src="{{ $creator['verifiedIcon'] }}" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $creator['verifiedDesc'] }}">
                                @else
                                    <img src="/assets/themes/Moments/images/icon-verified.png" loading="lazy" alt="Verified" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $creator['verifiedDesc'] }}">
                                @endif
                            </div>
                        @endif
                        <div class="user-name text-secondary">{{ '@' . $creator['username'] }}</div>
                    </a>
                    <div class="user-role d-flex">
                        @if ($creator['roleIconDisplay'])
                            <div class="user-role-icon"><img src="{{ $creator['roleIcon'] }}" loading="lazy" alt="{{ $creator['roleName'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $creator['roleName'] }}"></div>
                        @endif
                        @if ($creator['roleNameDisplay'])
                            <div class="user-role-name"><span class="badge rounded-pill">{{ $creator['roleName'] }}</span></div>
                        @endif
                    </div>
                </div>

                {{-- User Affiliate Icons --}}
                @if ($creator['operations']['diversifyImages'])
                    <div class="user-icon d-flex flex-wrap flex-lg-nowrap overflow-hidden my-2 my-lg-0">
                        @foreach($creator['operations']['diversifyImages'] as $icon)
                            <img src="{{ $icon['imageUrl'] }}" loading="lazy" alt="{{ $icon['name'] }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $icon['name'] }}">
                        @endforeach
                    </div>
                @endif
            @endif
        </div>

        <div class="user-secondary d-flex flex-wrap">
            {{-- Post Creator --}}
            @if ($creator['isPostCreator'])
                <span class="author-badge me-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ fs_db_config('post_name').': '.fs_lang('contentCreator') }}">
                    {{ fs_lang('contentCreator') }}
                </span>
            @endif

            {{-- Create Time --}}
            <time class="text-secondary" datetime="{{ $createdDatetime }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $createdDatetime }}">{{ $createdTimeAgo }}</time>

            {{-- Edit Time --}}
            @if ($editedDatetime)
                <div class="text-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $editedDatetime }}">({{ fs_lang('contentEditedOn') }} {{ $editedTimeAgo }})</div>
            @endif

            {{-- Reply To Comment --}}
            {{-- @if ($replyToComment)
                <div class="text-success ms-2">
                    {{ fs_db_config('publish_comment_name') }}

                    @if (! $replyToComment['creator']['status'])
                        <span class="text-muted">{{ fs_lang('contentCreatorDeactivate') }}</span>
                    @elseif (! $replyToComment['creator']['fsid'])
                        <span class="text-muted">{{ fs_lang('contentCreatorAnonymous') }}</span>
                    @else
                        <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $replyToComment['creator']['fsid']])) }}">{{ $replyToComment['creator']['nickname'] }}</a>
                    @endif
                </div>
            @endif --}}

            {{-- IP Location --}}
            @if (fs_db_config('account_ip_location_status') && current_lang_tag() == 'zh-Hans')
                <span class="text-secondary ms-3">
                    <i class="fa-solid fa-location-dot"></i>
                    @if ($moreJson['ipLocation'] ?? null)
                        {{ fs_lang('ipLocation').$moreJson['ipLocation'] }}
                    @else
                        {{ fs_lang('errorIp') }}
                    @endif
                </span>
            @endif

            {{-- Comment Location --}}
            @if ($location['isLbs'])
                <a href="{{ fs_route(route('fresns.comment.location', $location['encode'])) }}" class="link-secondary ms-3"><i class="fa-solid fa-map-location-dot"></i> {{ $location['poi'] }}</a>
            @endif
        </div>
    </div>
</div>
