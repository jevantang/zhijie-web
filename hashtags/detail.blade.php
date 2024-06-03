@extends('commons.fresns')

@section('title', $items['title'] ?? $hashtag['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $hashtag['description'])

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                <div class="card mb-3">
                    @component('components.hashtags.detail', compact('hashtag'))@endcomponent
                </div>

                {{-- List --}}
                <div class="clearfix" id="fresns-list-container">
                    @foreach($posts as $post)
                        @component('components.posts.list', compact('post'))@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>

                {{-- Pagination --}}
                {{-- Pagination --}}
                @if ($posts->isEmpty())
                    {{-- No Post --}}
                    <div class="text-center my-5 text-muted fs-7"><i class="bi bi-card-list"></i> {{ fs_lang('listEmpty') }}</div>
                @else
                    {{-- Pagination --}}
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
