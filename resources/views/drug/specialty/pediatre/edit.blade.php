@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Drug') }} "{{ $drug->trade_name }}"
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('drug.store_edit') }}">
                        <div class="form-group">
                            <label for="trade_name" class="my__label">Nom <span class="text-danger">*</span></label>
                            <input type="hidden" name="drug_id" value="{{ $drug->id }}">
                            <input type="text" class="form-control rounded-0 shadow-none" name="trade_name"
                                id="trade_name" aria-describedby="TradeName" value="{{ $drug->trade_name }}">
                            {{ csrf_field() }}
                        </div>
                        {{--               <div class="form-group"> --}}
                        {{--                  <label for="exampleInputPassword1">Nom Générique *</label> --}}
                        {{--                  <input type="text" class="form-control" name="generic_name" id="GenericName" value="{{ $drug->generic_name }}"> --}}
                        {{--                  <input type="hidden" name="drug_id" value="{{ $drug->id }}"> --}}
                        {{--               </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="my__label">Note</label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="note" id="Note">
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit"
                                class="btn btn-primary rounded-0 shadow-none">{{ __('sentence.Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
