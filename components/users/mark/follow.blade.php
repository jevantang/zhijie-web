@if ($interaction['followMethod'] == 'api')
    <form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
        <input type="hidden" name="markType" value="follow"/>
        <input type="hidden" name="type" value="user"/>
        <input type="hidden" name="fsid" value="{{ $uid }}"/>
        @if ($interaction['followStatus'])
            <a class="btn btn-success btn-sm fs-mark" data-interaction-active="{{ $interaction['followStatus'] }}" data-bi="bi-person-check">
                <i class="bi bi-person-check-fill"></i>
                {{ fs_lang('modifierCompleted').$interaction['followName'] }}
            </a>
        @else
            <a class="btn btn-outline-success btn-sm fs-mark" data-bi="bi-person-check-fill" data-bs-toggle="tooltip" data-bs-placement="top">
                <i class="bi bi-person-check"></i>
                {{ $interaction['followName'] }}
            </a>
        @endif
    </form>
@elseif ($interaction['followMethod'] == 'page')
    <form class="float-start me-2">
        <button type="button" class="btn btn-sm {{ $interaction['followStatus'] ? 'btn-success' : 'btn-outline-success'}}" data-bs-toggle="modal" data-bs-target="#fresnsModal"
            data-title="{{ $interaction['followName'] }}: {{ $name }}"
            data-url="{{ $interaction['followAppUrl'] }}"
            data-uid="{{ $uid }}"
            data-post-message-key="fresnsFollow">
            @if ($interaction['followStatus'])
                <i class="bi bi-person-check-fill"></i>
            @else
                <i class="bi bi-person-check"></i>
            @endif
            {{ $interaction['followName'] }}
            @if ($interaction['followPublicCount'] && $count)
                <span class="badge rounded-pill bg-success">{{ $count }}</span>
            @endif
        </button>
    </form>
@endif
