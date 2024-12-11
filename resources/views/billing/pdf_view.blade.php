@if (env('APP_NAME') == 'GEN')
    @includeFirst(['billing.custom.generalist_edit', 'billing.specialty.generalist.pdf_view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['billing.custom.pediatre_edit', 'billing.specialty.pediatre.pdf_view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['billing.custom.pediatre_create', 'billing.specialty.ophtamologie.pdf_view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['billing.custom.dentiste_create', 'billing.specialty.dentiste.pdf_view'])
@endif
