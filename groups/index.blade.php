@extends('commons.fresns')

@section('title', fs_config('channel_group_seo')['title'] ?: fs_config('channel_group_name'))
@section('keywords', fs_config('channel_group_seo')['keywords'])
@section('description', fs_config('channel_group_seo')['description'])

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-sm-2 pb-4">
                @if (fs_config('channel_group_type') == 'tree')
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($groupTree ?? [] as $tree)
                            <button class="nav-link py-3 @if ($loop->first) active @endif" id="v-pills-{{ $tree['gid'] }}-tab" data-bs-toggle="pill" data-bs-target="#v-pills-{{ $tree['gid'] }}" type="button" role="tab" aria-controls="v-pills-{{ $tree['gid'] }}" aria-selected="false">
                                {{ $tree['name'] }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Middle --}}
            <div class="col-sm-7">
                @if (fs_config('channel_group_type') == 'tree')
                    <div class="tab-content" id="v-pills-tabContent">
                        @foreach($groupTree ?? [] as $tree)
                            <div class="tab-pane fade @if ($loop->first) show active @endif" id="v-pills-{{ $tree['gid'] }}" role="tabpanel" aria-labelledby="v-pills-{{ $tree['gid'] }}-tab" tabindex="0">
                                <div class="card mb-5 py-4">
                                    @foreach($tree['groups'] ?? [] as $group)
                                        @component('components.groups.list', compact('group'))@endcomponent
                                        @if (! $loop->last)
                                            <hr style="margin: 1.2rem 0">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Right Sidebar --}}
            <div class="col-md-4 col-lg-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
