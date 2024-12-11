
@section('content')

<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ajoute service</h6>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('payment.create') }}">
               <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Nom<font color="red">*</font></label>
                  <div class="col-sm-12">
                     <input type="text" class="form-control" id="inputEmail3" name="name" required>
                  </div>
                      <label for="inputEmail4" class="col-sm-3 col-form-label">Prix<font color="red">*</font></label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="inputEmail4" name="price" required>
                     {{ csrf_field() }}
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-9">
                     <button type="submit" class="btn btn-success">{{ __('sentence.Save') }}</button>
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
