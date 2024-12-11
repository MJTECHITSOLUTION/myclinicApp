

@if (env('APP_NAME') == 'GEN')
    @includeFirst(['auth.custom.generalist_login', 'auth.specialty.generalist.login'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['auth.custom.pediatre_login', 'auth.specialty.pediatre.login'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['auth.custom.pediatre_login', 'auth.specialty.ophtamologie.login'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['auth.custom.dentiste_login', 'auth.specialty.dentiste.login'])
@endif
