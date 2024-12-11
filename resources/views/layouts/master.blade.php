@if (env('APP_NAME') == 'GEN')
    @includeFirst(['layouts.custom.generalist_edit', 'layouts.specialty.generalist.master'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['layouts.custom.pediatre_edit', 'layouts.specialty.pediatre.master'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['layouts.custom.ophtamologie_edit', 'layouts.specialty.ophtamologie.master'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['layouts.custom.dentiste_edit', 'layouts.specialty.dentiste.master'])
@endif
