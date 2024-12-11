@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier service</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('payment.store_edit') }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nom<font color="red">*</font></label>
                            <div class="col-sm-12">
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                <input type="text" class="form-control" id="payment_name" name="name"
                                    value="{{ $payment->name }}">
                            </div>
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Prix<font color="red">*</font>
                                </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="price" name="price"
                                    value="{{ $payment->price }}">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
                            </div>
                            <label for="inputEmail3" class="col-sm-3 col-form-label"
                                style="display: none">{{ __('sentence.Tests') }}<font color="red">*</font></label>


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
