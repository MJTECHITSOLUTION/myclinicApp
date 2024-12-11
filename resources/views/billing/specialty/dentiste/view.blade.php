
@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
        @can('print invoice')
            <button href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print_prescription"><i class="fas fa-print fa-sm text-white-50"></i> Print</button>
        @endcan
    </div>
    <div class="row justify-content-center" id="stylesheetd">
        <div class="col-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <!-- ROW : Doctor informations -->
                    <div class="row">
                        <div class="col" >
                            <img src="{{ asset('img/rmiliBlack.png') }}" style="width: 50%;"><br><br>
                            {!! clean(App\Setting::get_option('header_left')) !!}
                        </div>
                        <div class="col-4">
                            <p>
                                <b>{{ __('sentence.Date') }} :</b> <span id="billing-date">{{ $billing->created_at->format('d-m-Y') }}</span>
                                <i id="edit-icon" class="fa fa-edit" style="cursor: pointer; margin-left: 5px;"></i><br>
                                <b>{{ __('sentence.Reference') }} :</b> {{ $billing->reference }}<br>
                                <b>{{ __('sentence.Patient Name') }} :</b> {{ $billing->User->name }}
                            </p>
                        </div>
                    </div>
                    <!-- END ROW : Doctor informations -->
                    <!-- ROW : Drugs List -->
                    <div class="row justify-content-center">
                        <div class="col">
                            <h5 class="text-center mt-5" style="font-size: xx-large"><b>{{ __('sentence.Invoice') }}</b></h5>
                            <br><br>
                            <table class="table">
                                <tr style="background: #2e3f50; color: #fff;">
                                    <td>Act</td>
                                    <td>Prix</td>
                                    <td>Payé</td>
                                    <td>Rest à payer</td>
                                </tr>

                                @php
                                    $totalPayer = 0;
                                    $totalRest = 0;
                                    $totalbilling = 0;
                                    $total_rest = 0;
                                @endphp

                                @if(isset($actes))
                                    @foreach($actes as $acte)
                                        <tr>
                                                <?php
                                                // Get the sum of the payer column for the current consultation_act_idc
                                                $sumPayer = \App\Billing_item::where('consultation_act_id', $acte->consultation_act_idc)
                                                    ->sum('payer');
                                                ?>
                                            <td>{{$acte->name}}</td>
                                            <td>{{$acte->prix}}</td>
                                            <td>{{$sumPayer}}</td>

                                            @php
                                                $totalPayer += $sumPayer;
                                                $restAPayer = $acte->prix - $sumPayer;
                                                $totalRest += $restAPayer;
                                            @endphp

                                            <td>{{$restAPayer}}</td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if(isset($billing_items) && count($billing_items) > 0)
                                    @foreach($billing_items as $billing_item)

                                        <tr>
                                                <?php
                                                // Check if there are any records with the given ref
//                                                $hasRecords = \App\Billing_item::where('ref', $billing_item->id)->exists();
                                                $hasRecords = !is_null($billing_item->ref);

                                                // If records are found, proceed with calculation
                                                if ($hasRecords) {
                                                    // Get the sum of the payer column for the current consultation_act_idc
                                                    $sumPayer = \App\Billing_item::where('ref', $billing_item->ref)->sum('payer');
                                                    $totalbilling += $sumPayer;
                                                    $restbilling = $billing_item->invoice_amount - $sumPayer;
                                                    $total_rest += $restbilling + $totalRest;
                                                } else {
                                                    $sumPayer = $billing_item->invoice_amount;
                                                    $restbilling = 0;
                                                }
                                                ?>
                                            <td>{{ isset($billing_item->invoice_title) ? $billing_item->invoice_title : 'N/A' }}</td>
                                            <td>{{ isset($billing_item->invoice_amount) ? $billing_item->invoice_amount . ' ' : 'N/A' }}</td>
                                            <td>{{ $sumPayer }}</td>
                                            <td>{{ $restbilling }}</td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="4"></td>
                                    </tr>
                                @endif

                                <tr>
                                    <td style="font-weight: bold;">Total:</td>
                                    <td colspan="1" style="text-align: right; font-weight: bold;"></td>
                                    <td style="font-weight: bold;">{{$totalPayer + $totalbilling}} {{ App\Setting::get_option('currency') }}</td>
                                    <td style="font-weight: bold;">{{$total_rest + $totalRest}} {{ App\Setting::get_option('currency') }}</td>
                                </tr>



                                {{--                     @if(App\Setting::get_option('vat') > 0)--}}
                                {{--                     <tr>--}}
                                {{--                        <td colspan="2"><strong class="float-right">{{ __('sentence.Sub-Total') }}</strong></td>--}}
                                {{--                        <td align="center"><strong>{{ $billing_items->sum('invoice_amount') }}  {{ App\Setting::get_option('currency') }}</strong></td>--}}
                                {{--                     </tr>--}}
                                {{--                     <tr>--}}
                                {{--                        <td colspan="2"><strong class="float-right">{{ __('sentence.VAT') }}</strong></td>--}}
                                {{--                        <td align="center"><strong> {{ App\Setting::get_option('vat') }}%</strong></td>--}}
                                {{--                     </tr>--}}
                                {{--                     @endif--}}
                                {{--                     <tr>--}}
                                {{--                        <td colspan="2"><strong class="float-right">{{ __('sentence.Total') }}</strong></td>--}}
                                {{--                        <td align="center"><strong>{{ $billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * App\Setting::get_option('vat')/100) }}  {{ App\Setting::get_option('currency') }}</strong></td>--}}
                                {{--                     </tr>--}}
                            </table>

                        </div>
                    </div>
                    <div style="margin-bottom: 250px;"></div>

                    <!-- END ROW : Drugs List -->
                    <!-- ROW : Footer informations -->
                    <div class="row">
                        <div class="col">
                            <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                        </div>
                        <div class="col">
                            <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                        </div>
                    </div>
                    <!-- END ROW : Footer informations -->
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden invoice -->
    <div id="print_area" style="display: none;">
        @if( (App\Setting::get_option('use_entete') === 'yes'))
            <div style="text-align: center;">
                <img src="{{ asset("uploads/" . App\Setting::get_option("imagerapport")) }}" style="max-width: 100%;"><br><br><br><br>
            </div>
        @else
            <br><br><br>
            <br><br><br>
            <br><br><br>
        @endif
        <div class="row">
            {{--                                    <div class="col-9">--}}
            {{--                                       @if(!empty(App\Setting::get_option('logo')))--}}
            {{--                                       <img src="{{ asset('uploads/'.App\Setting::get_option('logo')) }}"><br><br>--}}
            {{--                                       @endif--}}
            {{--                                       {!! clean(App\Setting::get_option('header_left')) !!}--}}
            {{--                                    </div>--}}

            <div class="col-4" style="font-size: x-large">
                <p class="text-left" style="position: relative ;left: 800px;"><b>{{ App\Setting::get_option('ville') }} ,le :</b> {{ $billing->created_at->format('d-m-Y') }}
                </p>
                {{--                                          <b>{{ __('sentence.Reference') }} :</b> {{ $billing->reference }}<br>--}}
                <b style="position: relative; left: 50px;">{{ __('sentence.Patient Name') }} : {{ $billing->User->name }}</b>

            </div>
        </div>
        <!-- END ROW : Doctor informations -->
        <!-- ROW : Drugs List -->
        <div class="row justify-content-center">
            <div class="col">

                <h5 class="text-center mt-5" style="font-size: xxx-large"><b>{{ __('sentence.Invoice') }}</b></h5>
                <br><br>
                <table class="table" style="font-size: x-large; margin-left: 20px; margin-right: 20px;">
                    <tr style="background: #2e3f50; color: #fff;">
                        <td>Act</td>
                        <td>Prix</td>
                        <td>Payé</td>
                        <td>Rest à payer</td>
                    </tr>
                    @php
                        $totalPayer = 0;
                        $totalRest = 0;
                        $total_payer = 0;
                        $totalbilling = 0;
                    @endphp
                    @if(isset($actes))
                        @foreach($actes as $acte)
                            <tr>
                                    <?php
                                    // Get the sum of the payer column for the current consultation_act_idc
                                    $sumPayer = \App\Billing_item::where('consultation_act_id', $acte->consultation_act_idc)
                                        ->sum('payer');
                                    ?>
                                <td>{{$acte->name}}</td>
                                <td>{{$acte->prix}}</td>
                                <td>{{$sumPayer}}</td>

                                @php
                                    $totalPayer += $sumPayer;
                                    $restAPayer = $acte->prix - $sumPayer;
                                    $totalRest += $restAPayer;
                                @endphp

                                <td>{{$restAPayer}}</td>
                            </tr>
                        @endforeach
                    @endif
                    @if(isset($billing_items) && count($billing_items) > 0)
                        @foreach($billing_items as $billing_item)
                            <tr>
                                @php
                                    $totalbilling += $billing_item->invoice_amount;
                                @endphp
                                <td>{{ isset($billing_item->invoice_title) ? $billing_item->invoice_title : 'N/A' }}</td>
                                <td>{{ isset($billing_item->invoice_amount) ? $billing_item->invoice_amount . ' ' : 'N/A' }}</td>
                                <td>{{ isset($sumPayer) ? $sumPayer : 'N/A' }}</td>
                                <td>{{$restbilling}}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                    @endif

                    <tr>
                        <td style="font-weight: bold;">Total:</td>
                        <td colspan="1" style="text-align: right; font-weight: bold;"></td>
                        <td style="font-weight: bold;">{{$totalPayer + $totalbilling}} {{ App\Setting::get_option('currency') }}</td>
                        <td style="font-weight: bold;">{{$total_rest + $totalRest}} {{ App\Setting::get_option('currency') }}</td>
                    </tr>
                    {{--                                          @forelse ($billing_items as $key => $billing_item)--}}
                    {{--                                          <tr>--}}
                    {{--                                             <td>{{ $key+1 }}</td>--}}
                    {{--                                             <td>{{ $billing_item->invoice_title }}</td>--}}
                    {{--                                             <td align="center">{{ $billing_item->invoice_amount }} {{ App\Setting::get_option('currency') }}</td>--}}
                    {{--                                          </tr>--}}
                    {{--                                          @empty--}}
                    {{--                                          <tr>--}}
                    {{--                                             <td colspan="3">{{ __('sentence.Empty Invoice') }}</td>--}}
                    {{--                                          </tr>--}}
                    {{--                                          @endforelse--}}
                    {{--                                          @empty(!$billing_item)--}}
                    {{--                                          @if(App\Setting::get_option('vat') > 0)--}}
                    {{--                                          <tr>--}}
                    {{--                                             <td colspan="2"><strong class="float-right">{{ __('sentence.Sub-Total') }}</strong></td>--}}
                    {{--                                             <td align="center"><strong>{{ $billing_items->sum('invoice_amount') }}  {{ App\Setting::get_option('currency') }}</strong></td>--}}
                    {{--                                          </tr>--}}
                    {{--                                          <tr>--}}
                    {{--                                             <td colspan="2"><strong class="float-right">{{ __('sentence.VAT') }}</strong></td>--}}
                    {{--                                             <td align="center"><strong> {{ App\Setting::get_option('vat') }}%</strong></td>--}}
                    {{--                                          </tr>--}}
                    {{--                                          @endif--}}
                    {{--                                          <tr>--}}
                    {{--                                             <td colspan="2"><strong class="float-right">{{ __('sentence.Total') }}</strong></td>--}}
                    {{--                                             <td align="center"><strong>{{ $billing_items->sum('invoice_amount') + ($billing_items->sum('invoice_amount') * App\Setting::get_option('vat')/100) }}  {{ App\Setting::get_option('currency') }}</strong></td>--}}
                    {{--                                          </tr>--}}
                    {{--                                          @endempty--}}
                </table>
                <hr>
            </div>
        </div>
            <div>
                @if( (App\Setting::get_option('use_pied') === 'yes'))
                    <img src="{{ asset("uploads/" . App\Setting::get_option("piedrapport")) }}" style="position: fixed; bottom: 0; left: 0; right: 0; margin: auto;max-width: 100%;" />
                @endif
            </div>

        <!-- END ROW : Drugs List -->
        <!-- ROW : Footer informations -->
        <footer class="footer-nassim" style="position: absolute; bottom: 0;">
            <hr>
            <div class="row">
                <div class="col-6">
                    <p class="font-size-12">{!! clean(App\Setting::get_option('footer_left')) !!}</p>
                </div>
                <div class="col-6">
                    <p class="float-right font-size-12">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
                </div>
            </div>
            <!-- END ROW : Footer informations -->
        </footer>
    </div>

@endsection

@section('header')
    <link href="{{ asset('css/print.css') }}" rel="stylesheet"  media="all">

    <style type="text/css">
        p, u, li {
            color: #444444 !important;
        }

    </style>
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
            $(document).on("click", '.print_prescription',function () {
                PrintPreview('print_area');
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

<script>
    document.getElementById('edit-icon').addEventListener('click', function () {
        var dateSpan = document.getElementById('billing-date');
        var dateInput = document.createElement('input');
        dateInput.type = 'date';
        dateInput.value = '{{ $billing->created_at->format('Y-m-d') }}';
        dateInput.id = 'billing-date-input';

        dateSpan.replaceWith(dateInput);

        dateInput.addEventListener('blur', function () {
            var newDate = this.value;

            fetch("{{ route('billing.update.date', $billing->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    date: newDate
                })
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.success) {
                    var updatedDateSpan = document.createElement('span');
                    updatedDateSpan.id = 'billing-date';
                    updatedDateSpan.textContent = new Date(newDate).toLocaleDateString('en-GB');
                    dateInput.replaceWith(updatedDateSpan);
                } else {
                    alert('Error updating date');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Error updating date');
            });
        });

        dateInput.focus();
    });
</script>
@endsection
