<article class="d-flex my-3">
    @if ($hashtag['cover'])
        <section class="flex-shrink-0">
            <img src="{{ $hashtag['cover'] }}" loading="lazy" alt="{{ $hashtag['name'] }}" class="rounded list-cover">
        </section>
    @endif
    <div class="flex-grow-1 ms-3">
        <header class="d-lg-flex">
            <section class="d-flex">
                {{ $hashtag['name'] }}
                <div class="badge-bg-info ms-2">
                    <span class="badge rounded-pill">{{ $hashtag['postCount'] }} {{ fs_config('post_name') }}</span>
                    <span class="badge rounded-pill">{{ $hashtag['postDigestCount'] }} {{ fs_lang('contentDigest') }}</span>
                </div>
            </section>

            <section class="list-btn ms-auto">
                {{-- Like --}}
                @if ($hashtag['interaction']['likeEnabled'])
                    @component('components.hashtags.mark.like', [
                        'htid' => $hashtag['htid'],
                        'interaction' => $hashtag['interaction'],
                        'count' => $hashtag['likeCount'],
                    ])@endcomponent
                @endif

                {{-- Dislike --}}
                @if ($hashtag['interaction']['dislikeEnabled'])
                    @component('components.hashtags.mark.dislike', [
                        'htid' => $hashtag['htid'],
                        'interaction' => $hashtag['interaction'],
                        'count' => $hashtag['dislikeCount'],
                    ])@endcomponent
                @endif

                {{-- Follow --}}
                @if ($hashtag['interaction']['followEnabled'])
                    @component('components.hashtags.mark.follow', [
                        'htid' => $hashtag['htid'],
                        'interaction' => $hashtag['interaction'],
                        'count' => $hashtag['followCount'],
                    ])@endcomponent
                @endif

                {{-- Block --}}
                @if ($hashtag['interaction']['blockEnabled'])
                    @component('components.hashtags.mark.block', [
                        'htid' => $hashtag['htid'],
                        'interaction' => $hashtag['interaction'],
                        'count' => $hashtag['blockCount'],
                    ])@endcomponent
                @endif
            </section>
        </header>

        @if ($hashtag['description'])
            <section class="fs-7 mt-1 text-secondary">{{ $hashtag['description'] }}</section>
        @endif
    </div>
</article>
