@extends('profile.profile')

@section('list')
    {{-- List --}}
    <article class="py-4" id="fresns-list-container">
        @foreach($posts as $post)
            @component('components.posts.list', compact('post'))@endcomponent
        @endforeach
    </article>

    {{-- Pagination --}}
    <div class="my-3 table-responsive d-none">
        {{ $posts->links() }}
    </div>

    {{-- Ajax Footer --}}
    @include('commons.ajax-footer')
@endsection
