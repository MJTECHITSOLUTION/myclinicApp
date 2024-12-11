@extends('layouts.master')

@section('title')
    {{ __('sentence.All Patients') }}
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row mb-3">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">Rapport patient</h6>
                </div>
                <div class="col-6 text-right">
                </div>
            </div>
            <div class="row">
                <div class="col-12 w-100">
                    <form class="form-inline navbar-search" action="{{ route('record.search') }}" method="post">
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
                        <button href="" class="d-sm-inline-block btn btn-sm btn-info shadow-sm print_patient">
                            <i class="fas fa-print fa-sm text-white-50"></i>
                            <span class="d-none d-md-inline-block">Imprimer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-right">

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                       id="dataTable" width="100%" cellspacing="0">
                    <thead class="">
                    <tr>
                        <th class="text-center">Nom et prénom</th>
                        <th class="text-center sm__screen">{{ __('sentence.Age') }}</th>
                        <th class="text-center xxs__screen">{{ __('sentence.Phone') }}</th>
                        <th class="text-center sm__screen">{{ __('sentence.Blood Group') }}</th>
                        <th class="text-center md__screen">{{ __('sentence.Date') }}</th>
                        <th class="text-center sm__screen">Genre</th>
                        <th class="text-center">Assurance</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td><a href="{{ url('patient/view/' . $patient->id) }}"> {{ $patient->user_name }} </a></td>
                            <td class="text-center sm__screen">
                                {{ @\Carbon\Carbon::parse($patient->birthday)->age }} </td>
                            <td class="text-center xxs__screen"> {{ @$patient->phone }} </td>
                            <td class="text-center sm__screen"> {{ @$patient->blood }} </td>
                            <td class="text-center  md__screen"><label
                                    class="badge badge-primary-soft ">{{ $patient->created_at->format('d M Y H:i') }}</label>
                            </td>


                            <td class="text-center sm__screen ">
                                @if ($patient->gender === 'Female')
                                    Femme
                                @elseif ($patient->gender === 'Male')
                                    Homme
                                @else
                                    {{ $patient->gender }}
                                @endif
                            </td>
                            <td class="text-center sm__screen">
                                @if (!empty($patient->assurance_id))
                                        <?php $assurance = DB::table('assurance')->where('id', $patient->assurance_id)->value('assurance_name'); ?>
                                    {{ $assurance ?? '' }}
                                @else
                                    {{ $patient->assurance }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" align="center"><img src="{{ asset('img/rest.png') }} "/> <br><br> <b
                                    class="text-muted">Aucun patient trouvé !</b>
                            </td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
                <div style="display: none" id="print_patient_div">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-5">
                                        <p><strong>Nom:</strong> {{ App\Setting::get_option('title') }}</p>
                                        <p><strong>Adresse:</strong> {{ App\Setting::get_option('address') }}</p>
                                        <p><strong>Téléphone:</strong>{{ App\Setting::get_option('phone') }} </p>
                                        <p><strong>Ville:</strong> {{ App\Setting::get_option('ville') }}</p>
                                    </div>
                                    <div class="col-md-7 text-right">
{{--                                        <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}" style="width: 300px; height: 200px;" >--}}
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <h3>
                            <div class="text-center">
                            <b>Nouveaux patients <br> du {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} ou {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }} </b>
                            </div><br></h3>
                            <table
                                class="table table-striped table-bordered table-striped table-responsive{-sm|-md|-lg|-xl|-xxl}"
                                id="dataTable" width="100%" cellspacing="0">
                                <thead class="">
                                <tr>

                                    <th class="text-center"> <b>Nome et prénom</b></th>
                                    <th class="text-center xxs__screen"><b>{{ __('sentence.Phone') }}</b></th>
                                    <th class="text-center md__screen"><b>{{ __('sentence.Date') }}</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($patients as $patient)
                                    <tr>
                                        <td class="text-center">
                                             {{ $patient->user_name }}
                                        </td>
                                        <td class="text-center xxs__screen"> {{ @$patient->phone }} </td>
                                        <td class="text-center  md__screen"><label
                                                >{{ $patient->created_at->format('d-m-Y') }}</label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
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
            $(document).on("click", '.print_patient',function () {
                PrintPreview('print_patient_div');
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
{{--@section('header')--}}
{{--@endsection--}}
