
@if (env('APP_NAME') == 'GEN')
    @includeFirst(['auth.custom.generalist_verify', 'auth.specialty.generalist.verify'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['auth.custom.pediatre_verify', 'auth.specialty.pediatre.verify'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['auth.custom.pediatre_verify', 'auth.specialty.ophtamologie.verify'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['auth.custom.dentiste_verify', 'auth.specialty.dentiste.verify'])
@endif
