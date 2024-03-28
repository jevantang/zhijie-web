@extends('commons.fresns')

@section('title', $items['title'] ?? $post['title'] ?? Str::limit(strip_tags($post['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($post['content']), 140))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                <div class="card shadow-sm mb-4">
                    @component('components.post.detail', compact('post'))@endcomponent
                </div>

                <div class="card clearfix" id="commentList" name="commentList">
                    <div class="card-header">
                        <h5 class="mb-0">{{ fs_config('comment_name') }}</h5>
                    </div>

                    {{-- Sticky Comments --}}
                    @if (fs_sticky_comments($post['pid']))
                        <div class="card-body bg-primary bg-opacity-10 mb-4">
                            @foreach(fs_sticky_comments($post['pid']) as $sticky)
                                @component('components.comment.sticky', [
                                    'sticky' => $sticky,
                                    'detailLink' => true,
                                    'sectionAuthorLiked' => true,
                                ])@endcomponent
                            @endforeach
                        </div>
                    @endif

                    {{-- Comment List --}}
                    <article class="clearfix" id="fresns-list-container">
                        @foreach($comments as $comment)
                            @component('components.comment.list', [
                                'comment' => $comment,
                                'detailLink' => true,
                                'sectionAuthorLiked' => true,
                            ])@endcomponent

                            <hr>
                        @endforeach
                    </article>

                    {{-- Comment Pagination --}}
                    @if ($comments->isEmpty())
                        {{-- No Comments --}}
                        <div class="text-center my-5 text-muted fs-7"><i class="bi bi-chat-square-dots"></i> {{ fs_lang('listEmpty') }}</div>
                    @else
                        {{-- Comment Pagination --}}
                        <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                            {{ $comments->links() }}
                        </div>

                        {{-- Ajax Footer --}}
                        @include('commons.ajax-footer')
                    @endif
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-md-4 col-lg-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
