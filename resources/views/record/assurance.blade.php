@extends('layouts.master')

@section('title')
    Rapport assurance
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport assurance</h6>
                </div>
                <div class="col-6 text-right">
{{--                    Total : {{$assurances->count()}}--}}
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="{{ route('record.assurance') }}" method="post">
                        <div class="input-group w-100 ">
                            <select class="form-control rounded-0 shadow-none" multiple="multiple" name="assurance[]" id="example-multiple-selected" required >
                                @foreach ($assurance as $assuranc)
                                    <option value="{{ $assuranc->assurance_name }}">
                                        {{ $assuranc->assurance_name }}</option>
                                @endforeach
                            </select>
                            @csrf
                            <div class="input-group-append">
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
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center">Nome et prénom</th>
                        <th class="sm__screen text-center">Date de naissance</th>
                        <th class="text-center sm__screen">Assurance</th>
                        <th class="text-center xxs__screen">Mode paiement</th>
                        <th class="text-center sm__screen">Statu</th>
                        <th class="text-center sm__screen">Paie</th>
                        <th class="text-center sm__screen">Total</th>                        
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($assurances as $assurance)
                        @php
                            $birthday = new DateTime($assurance->birthday);
                            $currentDate = new DateTime();
                            $age = $currentDate->diff($birthday)->y;
                        @endphp
                        <tr>
            
                            <td class="text-center">{{ $assurance->name }}</td>
                            <td class="text-center">{{$assurance->birthday}} ({{$age}} ans) </td>
                            <td class="text-center"> {{ $assurance->assurance }} </td>
                            <td class="text-center">{{$assurance->payment_mode}}</td>
                            <td class="text-center">
                                @if($assurance->payment_status == 'Paid')
                        Payé
                        @endif
                        @if ($assurance->payment_status == 'Unpaid')
                        Non payé
                        @endif
                        @if ($assurance->payment_status == 'Partially Paid')
                        Partiellement payé
                        @endif</td>
                            @php
                            $billingId = $assurance->billingid; 
                            $sumPayment = DB::table('billing_reglement')
                                ->select(DB::raw('SUM(payment) as total_payment'))
                                ->where('billing_id', $billingId)
                                ->groupBy('billing_id')
                                ->first();

                            $totalPaymentValue = optional($sumPayment)->total_payment ?? 0;
                        @endphp
                            <td class="text-center">{{$totalPaymentValue}}</td>

                            <td class="text-center">{{$assurance->total_without_tax}}</td>
                            
                        </tr>
                    </tbody>
                    @endforeach
                </table>

                <div id="container"></div>

            </div>
        </div>
    </div>
    <div style="display: none" id="print_div">
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
        <div class="text-center" >
            <b>List des assurances du
                @foreach ($assuranceRequests as $assuranceRequest)
                    {{ htmlspecialchars($assuranceRequest) }}
                @endforeach
            </b>
        </div>
        </h3><br>
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th class="text-center">Nome et prénom</th>
                <th class="sm__screen text-center">Date de naissance</th>
                <th class="text-center sm__screen">Assurance</th>
                <th class="text-center xxs__screen">Mode paiement</th>
                <th class="text-center sm__screen">Statu</th>
                <th class="text-center sm__screen">Paie</th>
                <th class="text-center sm__screen">Total</th>                        
            </tr>
            </thead>
            <tbody>

            @foreach ($assurances as $assurance)
                @php
                    $birthday = new DateTime($assurance->birthday);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthday)->y;
                @endphp
                <tr>
    
                    <td class="text-center">{{ $assurance->name }}</td>
                    <td class="text-center">{{$assurance->birthday}} ({{$age}} ans) </td>
                    <td class="text-center"> {{ $assurance->assurance }} </td>
                    <td class="text-center">{{$assurance->payment_mode}}</td>
                    <td class="text-center">
                        @if($assurance->payment_status == 'Paid')
                        Payé
                        @endif
                        @if ($assurance->payment_status == 'Unpaid')
                        Non payé
                        @endif
                        @if ($assurance->payment_status == 'Partially Paid')
                        Partiellement payé
                        @endif
            </td>
                    @php
                    $billingId = $assurance->billingid; 
                    $sumPayment = DB::table('billing_reglement')
                        ->select(DB::raw('SUM(payment) as total_payment'))
                        ->where('billing_id', $billingId)
                        ->groupBy('billing_id')
                        ->first();

                    $totalPaymentValue = optional($sumPayment)->total_payment ?? 0;
                @endphp
                    <td class="text-center">{{$totalPaymentValue}}</td>

                    <td class="text-center">{{$assurance->total_without_tax}}</td>
                    
                </tr>
            </tbody>
            @endforeach
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
    <script type="text/javascript"
            src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#example-multiple-selected').multiselect();
    </script>
@endsection
<link rel="stylesheet" type="text/css"
      href="https://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
