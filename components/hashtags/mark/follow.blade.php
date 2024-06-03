<form action="{{ route('fresns.api.post', ['path' => '/api/fresns/v1/user/mark']) }}" method="post" class="float-start me-2">
    <input type="hidden" name="markType" value="follow"/>
    <input type="hidden" name="type" value="hashtag"/>
    <input type="hidden" name="fsid" value="{{ $htid }}"/>
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
