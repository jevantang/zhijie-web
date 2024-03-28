@extends('commons.fresns')

@section('title', fs_config('channel_timeline_posts_name'))

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
                <article class="clearfix" id="fresns-list-container">
                    @foreach($posts as $post)
                        @component('components.post.list', compact('post'))@endcomponent
                    @endforeach
                </article>

                @if ($posts->isEmpty())
                    {{-- No Post --}}
                    <div class="text-center my-5 text-muted fs-7"><i class="bi bi-card-list"></i> {{ fs_lang('listEmpty') }}</div>
                @else
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
