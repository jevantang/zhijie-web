@extends('commons.fresns')

@section('title', fs_lang('accountLoginOrRegister'))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            <div class="card mx-auto" style="max-width:800px;">
                <div class="card-body p-5">
                    <p>{{ fs_lang('contentLoginTip') }}</p>

                    <p class="mt-4">
                        {{-- Go to login --}}
                        <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                            data-modal-height="700px"
                            data-title="{{ fs_lang('accountLogin') }}"
                            data-url="{{ fs_config('account_login_service') }}"
                            data-redirect-url="{{ fs_theme('login', $redirectURL) }}"
                            data-post-message-key="fresnsAccountSign">
                            {{ fs_lang('accountLogin') }}
                        </button>

                        {{-- Join --}}
                        @if (fs_config('site_private_status') && fs_config('site_private_service'))
                            <button class="btn btn-success ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-title="{{ fs_lang('accountJoin') }}"
                                data-url="{{ fs_config('site_private_service') }}"
                                data-redirect-url="{{ fs_theme('login', $redirectURL) }}"
                                data-post-message-key="fresnsAccountSign">
                                {{ fs_lang('accountJoin') }}
                            </button>
                        @elseif (fs_config('account_register_status'))
                            <button class="btn btn-success ms-3" type="button" data-bs-toggle="modal" data-bs-target="#fresnsModal"
                                data-modal-height="700px"
                                data-title="{{ fs_lang('accountRegister') }}"
                                data-url="{{ fs_config('account_register_service') }}"
                                data-redirect-url="{{ fs_theme('login', $redirectURL) }}"
                                data-post-message-key="fresnsAccountSign">
                                {{ fs_lang('accountRegister') }}
                            </button>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
