<article class="d-flex mt-3">
    @if ($group['cover'])
        <section class="flex-shrink-0">
            <img src="{{ $group['cover'] }}" loading="lazy" alt="{{ $group['gname'] }}" class="rounded list-cover">
        </section>
    @endif
    <div class="flex-grow-1 ms-3">
        <header class="d-lg-flex">
            <section class="d-flex">
                {{ $group['gname'] }}
                @if ($group['recommend'])
                    <img src="/assets/ZhijieWeb/images/icon-recommend.png" class="list-recommend" loading="lazy" alt="{{ fs_lang('contentRecommend') }}">
                @endif
            </section>

            <section class="list-btn ms-auto">
                {{-- Like --}}
                @if ($group['interaction']['likeSetting'])
                    @component('components.group.mark.like', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['likeCount'],
                    ])@endcomponent
                @endif

                {{-- Dislike --}}
                @if ($group['interaction']['dislikeSetting'])
                    @component('components.group.mark.dislike', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['dislikeCount'],
                    ])@endcomponent
                @endif

                {{-- Follow --}}
                @if ($group['interaction']['followSetting'])
                    @component('components.group.mark.follow', [
                        'gid' => $group['gid'],
                        'gname' => $group['gname'],
                        'followType' => $group['followType'],
                        'followUrl' => $group['followUrl'],
                        'interaction' => $group['interaction'],
                        'count' => $group['followCount'],
                    ])@endcomponent
                @endif

                {{-- Block --}}
                @if ($group['interaction']['blockSetting'])
                    @component('components.group.mark.block', [
                        'gid' => $group['gid'],
                        'interaction' => $group['interaction'],
                        'count' => $group['blockCount'],
                    ])@endcomponent
                @endif
            </section>
        </header>

        <section class="badge-bg-info">
            <span class="badge rounded-pill">{{ $group['postCount'] }} {{ fs_db_config('post_name') }}</span>
            <span class="badge rounded-pill">{{ $group['postDigestCount'] }} {{ fs_lang('contentDigest') }}</span>
        </section>

        @if ($group['admins'])
            <section class="fs-7 mt-2">
                {{ fs_lang('groupAdmin') }}:
                @foreach($group['admins'] as $admin)
                    <a href="{{ fs_route(route('fresns.profile.index', ['uidOrUsername' => $admin['fsid']])) }}" target="_blank" class="link-primary fs-7 me-3">{{ $admin['nickname'] }}</a>
                @endforeach
            </section>
        @endif
    </div>
</article>

<section class="fs-7 text-secondary lh-base mt-1 p-3">{!! nl2br($group['description']) !!}</section>
