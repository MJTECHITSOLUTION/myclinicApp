@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajoute radio</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('radio.create') }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nom radio<font color="red">*</font>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control rounded-0 shadow-none " id="inputEmail3"
                                    name="radio_name" required>
                                {{ csrf_field() }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit"
                                    class="btn rounded-0  btn-primary ">{{ __('sentence.Save') }}</button>
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
