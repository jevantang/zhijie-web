@php
    $iconLike = null;
    $iconDislike = null;
    $iconFollow = null;
    $iconBlock = null;
    $iconComment = null;
    $iconShare = null;
    $iconMore = null;

    $title = null;
    $decorate = null;
@endphp

@if ($comment['operations']['buttonIcons'])
    @php
        $iconLike = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'like',
            'asArray' => false,
        ]);
        $iconDislike = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'dislike',
            'asArray' => false,
        ]);
        $iconFollow = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'follow',
            'asArray' => false,
        ]);
        $iconBlock = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'block',
            'asArray' => false,
        ]);
        $iconComment = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'comment',
            'asArray' => false,
        ]);
        $iconShare = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'share',
            'asArray' => false,
        ]);
        $iconMore = fs_helpers('Arr', 'pull', $comment['operations']['buttonIcons'], [
            'key' => 'code',
            'values' => 'more',
            'asArray' => false,
        ]);
    @endphp
@endif

@if ($comment['operations']['diversifyImages'])
    @php
        $title = fs_helpers('Arr', 'pull', $comment['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'title',
            'asArray' => false,
        ]);
        $decorate = fs_helpers('Arr', 'pull', $comment['operations']['diversifyImages'], [
            'key' => 'code',
            'values' => 'decorate',
            'asArray' => false,
        ]);
    @endphp
@endif

<div class="position-relative pb-2" id="{{ $comment['cid'] }}">
    {{-- Post Preview --}}
    @component('components.comments.sections.post', [
        'post' => $comment['replyToPost'],
    ])@endcomponent

    {{-- Comment Author --}}
    <section class="content-author order-0">
        @component('components.comments.sections.author', [
            'cid' => $comment['cid'],
            'author' => $comment['author'],
            'isAnonymous' => $comment['isAnonymous'],
            'createdDatetime' => $comment['createdDatetime'],
            'createdTimeAgo' => $comment['createdTimeAgo'],
            'editedDatetime' => $comment['editedDatetime'],
            'editedTimeAgo' => $comment['editedTimeAgo'],
            'geotag' => $comment['geotag'],
            'moreInfo' => $comment['moreInfo'],
            'replyToComment' => $comment['replyToComment'],
        ])@endcomponent
    </section>

    {{-- Comment Main --}}
    <section class="content-main order-2 mx-3 position-relative">
        {{-- Title --}}
        <div class="content-title d-flex flex-row bd-highlight">
            {{-- Title Icon --}}
            @if ($title)
                <img src="{{ $title['image'] }}" loading="lazy" alt="{{ $title['name'] }}" class="me-2">
            @endif

            {{-- Sticky --}}
            @if ($comment['isSticky'])
                <img src="{{ fs_theme('assets') }}images/icon-sticky.png" loading="lazy" alt="Sticky" class="ms-2">
            @endif

            {{-- Digest --}}
            @if ($comment['digestState'] == 2)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="General Digest" class="ms-2">
            @elseif ($comment['digestState'] == 3)
                <img src="{{ fs_theme('assets') }}images/icon-digest.png" loading="lazy" alt="Senior Digest" class="ms-2">
            @endif
        </div>

        {{-- Content --}}
        <div class="content-article text-break">
            @if ($comment['privacy'] == 'private')
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-info-circle"></i> {{ fs_lang('editorCommentPrivate') }}
                </div>
            @else
                @if ($comment['isMarkdown'])
                    @php
                        $searchArr = [
                            '&lt;audio class=&quot;fresns_file_audio&quot; controls preload=&quot;metadata&quot; controlsList=&quot;nodownload&quot; src=&quot;',
                            '&quot;&gt;</audio>',
                        ];
                        $replaceArr = [
                            '<audio class="fresns_file_audio" controls preload="metadata" controlsList="nodownload" src="',
                            '"></audio>',
                        ];
                    @endphp
                    {!! str_replace($searchArr, $replaceArr, Str::markdown($comment['content'])) !!}
                @else
                    {!! nl2br($comment['content']) !!}
                @endif
            @endif
        </div>
    </section>

    {{-- Comment Decorate --}}
    @if ($decorate)
        <div class="position-absolute top-0 end-0">
            <img src="{{ $decorate['image'] }}" loading="lazy" alt="{{ $decorate['name'] }}" height="88rem">
        </div>
    @endif

    {{-- Files --}}
    <section class="content-files order-3 mx-3 mt-2 d-flex align-content-start flex-wrap file-image-{{ count($comment['files']['images']) }}">
        @component('components.comments.sections.files', [
            'cid' => $comment['cid'],
            'createdDatetime' => $comment['createdDatetime'],
            'author' => $comment['author'],
            'files' => $comment['files'],
        ])@endcomponent
    </section>

    {{-- Content Extends --}}
    @if ($comment['extends'])
        <section class="content-extends order-3 mx-3">
            @component('components.comments.sections.extends', [
                'cid' => $comment['cid'],
                'createdDatetime' => $comment['createdDatetime'],
                'author' => $comment['author'],
                'extends' => $comment['extends']
            ])@endcomponent
        </section>
    @endif

    {{-- Comment Interaction --}}
    <section class="interaction order-5 mt-3 mx-3">
        <div class="d-flex">
            {{-- Like --}}
            @if ($comment['interaction']['likeEnabled'])
                <div class="interaction-box">
                    @component('components.comments.mark.like', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['likeCount'],
                        'icon' => $iconLike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Dislike --}}
            @if ($comment['interaction']['dislikeEnabled'])
                <div class="interaction-box">
                    @component('components.comments.mark.dislike', [
                        'cid' => $comment['cid'],
                        'interaction' => $comment['interaction'],
                        'count' => $comment['dislikeCount'],
                        'icon' => $iconDislike,
                    ])@endcomponent
                </div>
            @endif

            {{-- Comment --}}
            <div class="interaction-box fresns-trigger-reply">
                <a class="btn btn-inter" href="javascript:;" role="button">
                    @if ($iconComment)
                        <img src="{{ $iconComment['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-comment.png" loading="lazy">
                    @endif
                    {{ $comment['commentCount'] }}
                </a>
            </div>

            {{-- Share --}}
            <div class="interaction-box dropup">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($iconShare)
                        <img src="{{ $iconShare['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-share.png" loading="lazy">
                    @endif
                </button>
                @component('components.comments.mark.share', [
                    'cid' => $comment['cid'],
                    'url' => $comment['url'],
                ])@endcomponent
            </div>

            {{-- More --}}
            <div class="ms-auto dropup text-end">
                <button class="btn btn-inter" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    @if ($iconMore)
                        <img src="{{ $iconMore['image'] }}" loading="lazy">
                    @else
                        <img src="{{ fs_theme('assets') }}images/icon-more.png" loading="lazy">
                    @endif
                </button>
                @component('components.comments.mark.more', [
                    'cid' => $comment['cid'],
                    'uid' => $comment['author']['uid'],
                    'controls' => $comment['controls'],
                    'interaction' => $comment['interaction'],
                    'followCount' => $comment['followCount'],
                    'blockCount' => $comment['blockCount'],
                    'manages' => $comment['manages'],
                    'viewType' => 'detail',
                ])@endcomponent
            </div>
        </div>

        {{-- Post Author Like Status --}}
        @if ($comment['interaction']['postAuthorLikeStatus'])
            <div class="post-author-liked order-5 mt-2">
                <span class="author-badge p-1">{{ fs_lang('contentAuthorLiked') }}</span>
            </div>
        @endif

        {{-- Comment Box --}}
        @component('components.editor.quick-publish-comment', [
            'nickname' => $comment['author']['nickname'],
            'pid' => $comment['replyToPost']['pid'] ?? null,
            'cid' => $comment['cid'],
            'show' => true,
        ])@endcomponent
    </section>
</div>
