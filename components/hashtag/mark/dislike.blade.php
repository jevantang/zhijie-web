<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
    <input type="hidden" name="markType" value="dislike"/>
    <input type="hidden" name="type" value="hashtag"/>
    <input type="hidden" name="fsid" value="{{ $htid }}"/>
    @if ($interaction['dislikeStatus'])
        <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['dislikeStatus'] }}" data-bi="bi-hand-thumbs-down">
            <i class="bi bi-hand-thumbs-down-fill"></i>
            @if ($interaction['dislikePublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @else
        <a class="btn btn-outline-success btn-sm fs-mark" data-bi="bi-hand-thumbs-down-fill" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $interaction['dislikeName'] }}">
            <i class="bi bi-hand-thumbs-down"></i>
            @if ($interaction['dislikePublicCount'] && $count)
                <span class="show-count">{{ $count }}</span>
            @endif
        </a>
    @endif
</form>
