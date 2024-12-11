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
                            <label for="exampleInputEmail1" class="label">{{ __('sentence.assurance name') }} <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 shadow-none" name="assurance_name"
                                id="assuranceName" aria-describedby="assuranceName" required>
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
                        <div class="col-sm-12 d-flex justify-content-end">

                            <button type="submit" class="btn btn-primary rounded-0">{{ __('sentence.Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
