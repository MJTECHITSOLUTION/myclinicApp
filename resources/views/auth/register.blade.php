
@if (env('APP_NAME') == 'GEN')
    @includeFirst(['auth.custom.generalist_register', 'auth.specialty.generalist.register'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['auth.custom.pediatre_register', 'auth.specialty.pediatre.register'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['auth.custom.pediatre_register', 'auth.specialty.ophtamologie.register'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['auth.custom.dentiste_register', 'auth.specialty.dentiste.register'])
@endif
