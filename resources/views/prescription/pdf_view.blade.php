@if (env('APP_NAME') == 'GEN')
    @includeFirst(['prescription.custom.generalist_edit', 'prescription.specialty.generalist.pdf_view'])
@elseif(env('APP_NAME') == 'PED')
    @includeFirst(['prescription.custom.pediatre_edit', 'prescription.specialty.pediatre.pdf_view'])
@elseif(env('APP_NAME') == 'OPH')
    @includeFirst(['prescription.custom.ophtamologie_edit', 'prescription.specialty.ophtamologie.pdf_view'])
@elseif(env('APP_NAME') == 'DENT')
    @includeFirst(['prescription.custom.dentiste_edit', 'prescription.specialty.dentiste.pdf_view'])
@endif
