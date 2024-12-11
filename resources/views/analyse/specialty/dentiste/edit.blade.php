

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.edit analyse') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('analyse.store_edit') }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.analyse Name') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="hidden" name="analyse_id" value="{{ $analyse->id }}">
                                <input type="text" class="form-control" id="analyse_name" name="analyse_name"
                                    value="{{ $analyse->analyse_name }}">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit"
                                    class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
                            </div>
                            <label for="inputEmail3" class="col-sm-3 col-form-label"
                                style="display: none">{{ __('sentence.Tests') }}<font color="red">*</font></label>
                            <div class="col-sm-9">
                                <select
                                    class="form-control rounded-0 shoadow-none shadow-none rounded-0 multiselect-doctorino"
                                    name="test_id" id="test_id" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <option value="">{{ __('sentence.Select Test') }}...</option>
                                    @foreach ($tests as $test)
                                        <option value="14"></option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
@endsection

@section('footer')
@endsection
