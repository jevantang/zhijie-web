@extends('commons.fresns')

@section('title', fs_config('site_name'))

@section('content')
    <main class="container pt-5">
        {!! fs_config('zhijie_about') !!}
    </main>

    <footer class="container border-top pt-5 d-lg-none">
        <div class="mb-4 text-muted fs-8 text-center">
            <p class="mb-1">
                @if (fs_config('account_terms_status'))
                    <a href="{{ fs_route(route('fresns.custom.page', ['name' => 'policies'])).'#terms-tab' }}" class="link-secondary">{{ fs_lang('accountPoliciesTerms') }}</a>
                @endif
                @if (fs_config('account_privacy_status'))
                    <a href="{{ fs_route(route('fresns.custom.page', ['name' => 'policies'])).'#privacy-tab' }}" class="link-secondary ms-2">{{ fs_lang('accountPoliciesPrivacy') }}</a>
                @endif
                @if (fs_config('account_cookie_status'))
                    <a href="{{ fs_route(route('fresns.custom.page', ['name' => 'policies'])).'#cookies-tab' }}" class="link-secondary ms-2">{{ fs_lang('accountPoliciesCookie') }}</a>
                @endif
            </p>

            <p class="mb-3">&copy; {{ fs_config('site_copyright_years') }} {{ fs_config('site_copyright_name') }} | Powered by <a href="https://fresns.cn" target="_blank" class="link-secondary">Fresns</a></p>

            @if (fs_config('site_china_mode'))
                @if (fs_config('china_icp_filing'))
                    <p class="mb-0">{{ fs_config('zhijie_company_name') }}</p>
                    <p class="mb-0">{{ fs_config('china_icp_filing') }}</p>
                @endif

                @if (fs_config('china_mps_filing'))
                    <p class="mb-0">{{ fs_config('china_mps_filing') }}</p>
                @endif

                @if (fs_config('china_icp_license'))
                    <p class="mb-0">{{ fs_config('china_icp_license') }}</p>
                @endif
            @endif

            @if (fs_config('china_broadcasting_license'))
                <p class="mb-0">{{ fs_config('china_broadcasting_license') }}</p>
            @endif
        </div>
    </footer>
@endsection
