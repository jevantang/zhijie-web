<footer class="container d-none d-lg-block">
    <div class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">&copy; {{ fs_config('site_copyright_years') }} {{ fs_config('site_copyright_name') }} | Powered by <a href="https://fresns.org" target="_blank" class="text-decoration-none link-secondary">Fresns</a></p>

        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"><img src="{{ fs_config('site_icon') }}" height="32"></a>

        <ul class="nav col-md-4 justify-content-end">
            @if (fs_config('account_terms_status'))
                <li class="nav-item"><a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#terms-tab' }}" class="nav-link px-2 text-muted">{{ fs_lang('accountPoliciesTerms') }}</a></li>
            @endif
            @if (fs_config('account_privacy_status'))
                <li class="nav-item"><a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#privacy-tab' }}" class="nav-link px-2 text-muted">{{ fs_lang('accountPoliciesPrivacy') }}</a></li>
            @endif
            @if (fs_config('account_cookie_status'))
                <li class="nav-item"><a href="{{ route('fresns.custom.page', ['name' => 'policies']).'#cookies-tab' }}" class="nav-link px-2 text-muted">{{ fs_lang('accountPoliciesCookie') }}</a></li>
            @endif
        </ul>
    </div>
</footer>
