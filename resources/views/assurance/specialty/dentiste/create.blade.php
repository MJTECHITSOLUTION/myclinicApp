

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add assurance') }}</h6>
                </div>
                <div class="card-body">

                    <form method="post" action="{{ route('assurance.store') }}">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ __('sentence.assurance name') }} *</label>
                            <input type="text" class="form-control" name="assurance_name" id="assuranceName"
                                aria-describedby="assuranceName" required>
                            {{ csrf_field() }}
                        </div>
                        {{--               <div class="form-group"> --}}
                        {{--                  <label for="exampleInputPassword1">{{ __('sentence.Generic Name') }} *</label> --}}
                        {{--                  <input type="text" class="form-control" name="generic_name" id="GenericName"> --}}
                        {{--               </div> --}}
                        {{--               <div class="form-group"> --}}
                        {{--                  <label for="exampleInputPassword1">{{ __('sentence.Note') }}</label> --}}
                        {{--                  <input type="text" class="form-control" name="note" id="Note"> --}}
                        {{--               </div> --}}
                        <button type="submit" class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
