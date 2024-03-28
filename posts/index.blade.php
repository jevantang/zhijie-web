@extends('commons.fresns')

@section('title', fs_config('channel_post_seo')['title'] ?: fs_config('channel_post_name'))
@section('keywords', fs_config('channel_post_seo')['keywords'])
@section('description', fs_config('channel_post_seo')['description'])

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                {{-- Post List --}}
                <article class="clearfix" @if (fs_config('channel_post_query_state') != 1) id="fresns-list-container" @endif>
                    @foreach($posts as $post)
                        @component('components.post.list', compact('post'))@endcomponent
                    @endforeach
                </article>

                {{-- Pagination --}}
                @if (fs_config('channel_post_query_state') != 1)
                    <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                        {{ $posts->links() }}
                    </div>

                    {{-- Ajax Footer --}}
                    @include('commons.ajax-footer')
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div class="col-md-4 col-lg-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
