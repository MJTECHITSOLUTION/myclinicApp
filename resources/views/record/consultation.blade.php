@extends('layouts.master')

@section('title')
    Rapport consultation
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport consultation</h6>
                </div>
                <div class="col-6 text-right">
{{--                    Total consultation {{$prescriptions->count()}}--}}
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="{{ route('record.consultation') }}" method="post">
                        <div class="input-group w-100 ">
                            <!-- Start Date Input -->
                            <label><b>Date début : </b></label>
                            <input type="date" name="start_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date début" value="{{ $startDate }}" aria-label="Date début"
                                   aria-describedby="basic-addon2" required>

                            <!-- End Date Input -->
                            <label style="margin-left: 40px;"><b>Date fin :</b></label>
                            <input type="date" name="end_date" class="form-control rounded-0 bg-light border-2 small"
                                   placeholder="Date fin" value="{{ $endDate }}" aria-label="Date fin"
                                   aria-describedby="basic-addon2" style="margin-left: 10px;" required>

                            @csrf
                            <div class="input-group-append" style="margin-left: 10px;">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="text-right">
                        <button href="" class="d-sm-inline-block btn btn-sm btn-info shadow-sm print">
                            <i class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table  class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                        id="dataTable" width="100%" cellspacing="0">
                    <thead class="">
                    <tr>
                        <th class="text-center">Nome et prénom</th>
                        <th class="text-center sm__screen">Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($prescriptions as $prescription)
                        <tr>
                            <td class="text-center">{{ $prescription->user_name }}</td>
                            <td class="text-center">{{ $prescription->created_at->format('d-m-Y') }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div id="container"></div>
                {{--                <span class="float-right mt-3">{{ $patients->links() }}</span>--}}

            </div>
        </div>
    </div>
    <div id="print_div" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Nom:</strong> {{ App\Setting::get_option('title') }}</p>
                    <p><strong>Adresse:</strong> {{ App\Setting::get_option('address') }}</p>
                    <p><strong>Téléphone:</strong>{{ App\Setting::get_option('phone') }} </p>
                    <p><strong>Ville:</strong> {{ App\Setting::get_option('ville') }}</p>
                </div>
                <div class="col-md-7 text-right">
{{--                    <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" style="width: 300px; height: 200px;" >--}}

                </div>
            </div>
        </div>
        <br><br>
        <h3>
        <div class="text-center">
        <b>List des consultation du {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} ou {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }} </b>
        </div><br></h3>
    <table  class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
            id="dataTable" width="100%" cellspacing="0">
        <thead class="">
        <tr>
            <th class="text-center"><b>Nome et prénom</b></th>
            <th class="text-center sm__screen"><b>Date</b></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($prescriptions as $prescription)
            <tr>

                <td class="text-center">{{ $prescription->user_name }}</td>
                <td class="text-center">{{ $prescription->created_at->format('d-m-Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection


@section('footer')
    <script type="text/javascript">
        function PrintPreview(divName) {

            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }


        $(function(){
            $(document).on("click", '.print',function () {
                PrintPreview('print_div');
                /*
                $('#print_area').printThis({
                 importCSS: true,
                        importStyle: true,//thrown in for extra measure
                 loadCSS: "{{ asset('dashboard/css/sb-admin-2.min.css') }}",
         pageTitle: "xxx",
         copyTagClasses: true,
          base: true,
          printContainer: true,
          removeInline: false,
        });
        */

            });
        });
    </script>
@endsection
