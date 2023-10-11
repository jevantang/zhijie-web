@php
    use \App\Utilities\ArrUtility;

    $title = null;
    $decorate = null;
@endphp

@if ($sticky['operations']['diversifyImages'])
    @php
        $title = ArrUtility::pull($sticky['operations']['diversifyImages'], 'code', 'title');
        $decorate = ArrUtility::pull($sticky['operations']['diversifyImages'], 'code', 'decorate');
    @endphp
@endif

<a href="{{ fs_route(route('fresns.post.detail', ['pid' => $sticky['pid']])) }}" class="list-group-item list-group-item-action text-break">
    <i class="bi bi-arrow-up-square-fill me-1" style="color: #F40;"></i>
    @if ($title)
        <img src="{{ $title['imageUrl'] }}" loading="lazy" alt="{{ $title['name'] }}" style="height: 24px">
    @endif
    {{ $sticky['title'] ?? Str::limit(strip_tags($sticky['content']), 80) }}
</a>
