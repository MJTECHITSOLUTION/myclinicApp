

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit assurance') }}
                        {{ $assurance->trade_name }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('assurance.store_edit') }}">
                        <div class="form-group">
                            <label for="assurance_name">Nom de l'assurance *</label>
                            <input type="hidden" name="assurance_id" value="{{ $assurance->id }}">
                            <input type="text" class="form-control" name="assurance_name" id="assurance_name"
                                aria-describedby="TradeName" value="{{ $assurance->assurance_name }}">
                            {{ csrf_field() }}
                        </div>
                        {{--               <div class="form-group"> --}}
                        {{--                  <label for="exampleInputPassword1">Generic Name *</label> --}}
                        {{--                  <input type="text" class="form-control" name="generic_name" id="GenericName" value="{{ $assurance->generic_name }}"> --}}
                        {{--                  <input type="hidden" name="assurance_id" value="{{ $assurance->id }}"> --}}
                        {{--               </div> --}}
                        <div class="form-group">
                            <label for="exampleInputPassword1">Note</label>
                            <input type="text" class="form-control" name="note" id="Note">
                        </div>
                        <button type="submit" class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
