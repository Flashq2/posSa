<link href="{{ asset('assets/documents/maksingsing/a4.css') }}" rel="stylesheet" type="text/css" />
<?php
    use App\Services\service;
    $company = \App\Models\System\CompanyInformation::first();
    $app_setup = \Illuminate\Support\Facades\Auth::user()->app_setup;
    $document_notes = \App\Models\Administration\SystemSetup\DocumentNote::select('notes','description')->where('document_type','Sales Proforma Invoice')->first();
    $header = App\Models\Sales\Transaction\SaleHeader::where('no',$document_no)->first();
    $lines = App\Models\Sales\Transaction\SaleLine::where('document_no',$document_no)->get();
    $customer = App\Models\Financial\Setup\Customer::where('no', $header->customer_no)->where('inactived', '<>', 'Yes')->first();
    $approval_entry = App\Models\Financial\Transaction\ApprovalEntry::where('document_no',$header->no)->where('document_type', $header->document_type)->get();
    $approval_sequence = $app_setup->sales_order_approval_sequence;
    $approval_setting = $app_setup->sales_order_approval_setting;
    $currency = App\Models\Administration\ApplicationSetup\Currency::where('code', $header->currency_code)->where('inactived', '<>', 'Yes')->first(); 

    $margin_buttom_and_line = (isset($cls_margin_buttom_and_line)) ? $cls_margin_buttom_and_line : 'margin-buttom-and-line';
    $address = explode("<br/>", $companyinfo->address);
    $address_2 = explode("<br/>", $companyinfo->address_2);
    $phone_no = (isset($customer->phone_no)) ? $customer->phone_no : '&nbsp;';
    $phone_no_2 = (isset($customer->phone_no_2)) ? ','.$customer->phone_no_2 : '&nbsp;';
   
    $index = 0;
    $margin_top_noted = 0;
    $counter = 0;
    $margin_top_noted = 0;
    $count_record_item = $lines->count();
    $total_qty = 0; 

    $total = App\Services\service::totalAmount($header,$lines);
    $subTotal = $total[0];
    $discountTotal = $total[1];
    $vatTotal = $total[2];
    $amountDue = $total[3];

    $amountDueLcy = $lines->sum(function($r) use ($currency) {
        $r->currency = $currency;
        return service::toDouble($r->amount_including_vat_lcy);
    });
    $check_approval_entry= '';
    if($approval_setting != 'none'){
        if($header->status == 'Open' || $header->status == 'Pending Approval'){
            $preliminary = 'Yes';
        }
    }else{
        if(count($approval_entry) > 0){
            foreach ($approval_entry as $approval_entries){
                if($approval_entries->status != 'Approved'){
                    $check_approval_entry .= $approval_entries->status;
                }else{
                    $check_approval_entry = 'Approved';
                }
            }
            if($check_approval_entry != 'Approved'){
                $preliminary = 'Yes';
            }
        }
    }
?>
 
<div class="A4">
    <section>
        @if($company)
            @if(isset($document_letter_head) && $document_letter_head == 'Yes')
            {{-- ================== Latter head ============== --}}
                <div class="row">
                    <div class="col-xs-6">
                        <div class="captioninfo-khmer">
                            {{ $companyinfo->name_2 }}
                            <span class="captioninfo2"></span><br/>
                        </div>
                        <div class="captioninfo2-en">
                            {{ $companyinfo->name }}
                        </div>
                        <div class="llineheight-25">
                            @if(count($address) > 1)
                                @for($i=0;$i<count($address);$i++)
                                    {{ $address[$i] }}
                                    @if($i == count($address)-2)
                                        <br/>
                                    @endif
                                @endfor
                            @else
                                {{ $companyinfo->address }}
                            @endif
                            <br/>
                            @if(count($address_2) > 1)

 
                         @for($i=0;$i<count($address_2);$i++)
                                    {{ $address_2[$i] }}
                                    @if($i == count($address_2)-2)
                                        <br/>
                                    @endif
                                @endfor
                            @else
                                {{ $companyinfo->address_2 }}<br/>
                            @endif
                            
                            <span >Tel : {{ $companyinfo->phone_no }}</span>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        @if($companyinfo->logo && $companyinfo->logo != "")
                            <?php
                                $logo_type = '';
                                if (isset($_SERVER['HTTPS'])) {
                                    $link = 'https://';
                                } else {
                                    $link = 'http://';
                                }
                                $http_host = $link . \Request::server('HTTP_HOST');
                                $logo = str_replace($http_host, '', $companyinfo->logo);
                                list($width, $height) = getimagesize(public_path($logo));
                                if ($width > $height) {
                                    $logo_type = 'document-logo-Landscape';
                                } else {
                                    $logo_type = 'document-logo-Portrait';
                                }    
                            ?>
                            <img src="{{ $companyinfo->logo }}" class="img-responsive {{ $logo_type }} " alt=""/>
                        @endif
                        
                    </div>
                </div>
            {{-- ================== End Latter head ============== --}}
            @endif
            {{-- ================== Title ============== --}}
            <div class="row">
                <div class="col-xs-5">
                </div>
                <div class="col-xs-7 text-right document-title">
                {{ trans('greetings.Sales Proforma Invoice') }}{{ (isset($preliminary) == 'Yes')? '(Preliminary)' : '' }}
                </div>
            </div>
            {{-- ================== End Title ============== --}}
            <div class="row">
                <div class="col-xs-12">
                    <div class="hr-line-100">&nbsp;</div>
                </div>
            </div>
            {{-- ================== Header ============== --}}
            <div class="row" style="margin-top:5px !important;">
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-xs-4" >{{ trans('greetings.Sell To') }}</div>
                        <div class="col-xs-8 line-dotted">{{ ($header->customer_name)? $header->customer_name : '&nbsp;' }}</div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="col-xs-6 ">{{ trans('greetings.Document No') }}</div>
                    <div class="col-xs-6 line-dotted">{{ ($header->no)? $header->no : '&nbsp;' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-xs-4" >{{ trans('greetings.Attend') }}</div>
                        <div class="col-xs-8 line-dotted">{{ ($header->contact_name)? $header->contact_name : '&nbsp;' }}</div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="col-xs-6 ">{{ trans('greetings.Location Code') }}</div>
                    <div class="col-xs-6 line-dotted">{{ ($header->location_code)?$header->location_code:'&nbsp;' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="row">
 
                  <div class="col-xs-4" >{{ trans('greetings.Address') }}</div>
                        <div class="col-xs-8 line-dotted">{{ ($header->address)? $header->address : '&nbsp;' }}</div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="col-xs-6 ">{{ trans('greetings.Document Date') }}</div>
                    <div class="col-xs-6 line-dotted">{{ ($header->document_date)? $header->document_date : '&nbsp;' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-xs-4" >{{ trans('greetings.Tel') }}</div>
                        <div class="col-xs-8 line-dotted">{{ ($header->ship_to_phone_no)? $header->ship_to_phone_no : '&nbsp;' }}</div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="col-xs-6 ">{{ trans('greetings.Salesperson') }}</div>
                    <div class="col-xs-6 line-dotted">{{ ($header->salesperson_code)? $header->salesperson_code : '&nbsp;' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-xs-4" >{{ trans('greetings.Email') }}</div>
                        <div class="col-xs-8 line-dotted">{{ ($header->email)? $header->email : '&nbsp;' }}</div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="col-xs-6 ">{{ trans('greetings.Currency Code') }}</div>
                    <div class="col-xs-6 line-dotted">{{ ($header->currency_code)? $header->currency_code : '&nbsp;' }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7">
                    <div class="row">
                        <div class="col-xs-4" >{{ trans('greetings.External document') }}</div>
                        <div class="col-xs-8 line-dotted">{{  ($header->external_document_no)? $header->external_document_no : '&nbsp;' }}</div>
                    </div>
                </div>
                <div class="col-xs-5"> </div>
            </div>
            {{-- ================ Line ================== --}}
            <div class="row">
                <div class="col-xs-12">
                    <table>
                        <thead>
                            <tr class="general-data">
                                <th width="50px"><div>{{ trans('greetings.No') }}</div></th>
                                <th width="80px"><div class="">{{ trans('greetings.Code') }}</div></th>
                                <th width="300px"><div class="">{{ trans('greetings.Description') }}</div></th>
                                <th width="80px"><div class="text-left">{{ trans('greetings.UOM') }}</div></th>
                                <th width="80px"><div class="text-right">{{ trans('greetings.Quantity') }}</div></th>
                                @if(isset($document_show_cost) && $document_show_cost == 'Yes')
                                <th width="100px"><div class="text-right">{{ trans('greetings.Unit Price') }}</div></th>
                                <th width="100px"><div class="text-right">{{ trans('greetings.Amount') }}</div></th>
                                @endif 
                            </tr>
                        </thead>
                        <tbody>
                        @if($lines)
                            {{-- ================ Line ================== --}}
                            @foreach($lines as $line)
                                 <?php
                                    $counter += 1;
                                    if($line->no){
                                        $index += 1;
                                    }
                                    if($line->type == 'Text'){

 
                                $class_name = 'bd-left bd-right';
                                    }else{
                                        $class_name = 'bd-left bd-right bd-top';
                                    }

                                    $boder_bottom = '';
                                    if($counter == $count_record_item){
                                        $boder_bottom = 'last-bd-bottom';
                                    }
                                    $line->currency = $currency; 
                                    if($line->quantity) $total_qty += App\Services\service::toDouble($line->quantity); 
                                 ?>
                                <tr class="general-data">
                                    <td class="{{ $class_name }} {{ $boder_bottom }}">{{ ($line->no) ? $index : '' }}</td>
                                    <td class="{{ $class_name }} {{ $boder_bottom }}">{{ ($line->no) ? $line->no : '' }}</td>
                                    <td class="{{ $class_name }} {{ $boder_bottom }}">
                                        {{ ($line->description) ? $line->description : '' }} {{ ($line->description_2) ? $line->description_2 : '' }}<br/>
                                        @if($app_setup->ctrl_item_tracking != 'No')
                                            @if($line->type == 'Item' && $line->no)
                                                @if($line->isItemTracking() == true)
                                                    <?php
                                                        $item_trackings = null;
                                                        $item = App\Models\Administration\ApplicationSetup\Item::select('item_tracking_code')->where('no',$line->no)->first();
                                                        if($header->status != 'Posted'){
                                                            $item_trackings = \App\Models\Financial\Transaction\ItemTrackingBuffer::where('document_line_no',$line->line_no)
                                                                ->where('item_no',$line->no)->where('document_no',$header->no)->get();
                                                        }else{
                                                            $invoice = \App\Models\Sales\Transaction\SalesInvoiceLine::select('order_no','order_line_no','no','shipment_line_no','shipment_no')
                                                                        ->where('order_no',$line->document_no)->where('no',$line->no)->where('order_line_no',$line->line_no)->first();
                                                            $item_trackings = \App\Models\Financial\Transaction\ItemTrackingSpecification::where('document_line_no',$invoice->shipment_line_no)
                                                                ->where('document_no',$invoice->shipment_no)
                                                                ->where('item_no',$line->no)->get();
                                                        }
                                                        $j = 0;
                                                        $count_item_tracking = count($item_trackings);
                                                    ?>
                                                    @foreach($item_trackings as $item_tracking)
                                                        <?php $j ++; ?>
                                                        @if($item->item_tracking_code == 'LOTALL')
                                                            @if($j == 1) Lot: @endif
                                                            <b>{{ $item_tracking->lot_no }}</b> ({{ $item_tracking->expiration_date }}) {{ ($item_tracking->quantity_to_handle_base > 0) ? '('.$item_tracking->quantity_to_handle_base.')' : ''  }}<br/>
                                                        @else

 
                                               @if($j == 1) Serial : @endif<b>{{ $item_tracking->serial_no }}</b>
                                                        @endif
                                                        @if($j < $count_item_tracking),@endif
                                                    @endforeach
                                                @endif
                                            @endif    
                                        @endif  
                                    </td>
                                    <td class="text-left {{ $class_name }} {{ $boder_bottom }}">{{ ($line->unit_of_measure) ? $line->unit_of_measure : '' }}</td>
                                    <td class="text-right {{ $class_name }} {{ $boder_bottom }}">{{ ($line->quantity) ? $line->quantity : '' }}</td>
                                    @if(isset($document_show_cost) && $document_show_cost == 'Yes')
                                    <td class="text-right {{ $class_name }} {{ $boder_bottom }}">{{ ($line->unit_price) ? $line->unit_price : '' }}</td>
                                    <td class="text-right {{ $class_name }} {{ $boder_bottom }}">
                                        {{ ($line->amount) ? $line->amount : '' }}
                                    </td>
                                    @endif 
                                </tr>
                            @endforeach
                            {{-- ================ End Line ================== --}}
                            {{-- ================ Total ================== --}}
                            @if($amountDue != $subTotal) 
                                <?php $margin_top_noted += 1; ?>
                                <tr class="total">
                                    <td colspan="5"></td>
                                    <td class="bd-left bd-bottom bd-right text-left">{{ trans('greetings.Sub Total') }}</td>
                                    <td class="bd-bottom bd-right text-right">{{ App\Services\service::number_formattor($subTotal, 'amount',$currency) }}</td>
                                </tr> 
                            @endif       
                            @if(isset($document_show_cost) && $document_show_cost == 'Yes')
                                @if($discountTotal > 0)
                                    <?php $margin_top_noted += 1; ?>
                                    <tr class="total">
                                        <td colspan="5"></td>
                                        <td class="bd-left bd-bottom bd-right text-left">{{ trans('greetings.Discount') }}</td>
                                        <td class="bd-bottom bd-right text-right">{{ App\Services\service::number_formattor($discountTotal, 'amount',$currency) }}</td>
                                    </tr>    
                                @endif    
                                @if($vatTotal > 0)
                                    <?php $margin_top_noted += 1; ?>
                                    <tr class="total">
                                        <td colspan="5"></td>
                                        <td class="bd-left bd-bottom bd-right text-left">{{ trans('greetings.VAT Amount') }}</td>
                                        <td class="bd-bottom bd-right text-right">{{ App\Services\service::number_formattor($vatTotal, 'amount',$currency) }}</td>
                                    </tr>    
                                @endif    
                                <tr class="total">
                                    <td colspan="5"></td>
                                    <td class="bd-left bd-bottom bd-right text-left">{{ trans('greetings.Amount Due') }}</td>
                                    <td class="bd-bottom bd-right text-right">{{ App\Services\service::number_formattor($amountDue, 'amount',$currency) }}</td>
                                </tr>   
                            @else 
                                <tr class="total">

 
<td colspan="3"></td>
                                    <td class="bd-left bd-bottom bd-right text-right">{{ trans('greetings.Total Qty') }}</td>
                                    <td class="bd-bottom bd-right text-right">{{ App\Services\service::number_formattor($total_qty, 'quantity',$currency) }}</td>
                                </tr>  
                            @endif  
                            {{-- ================ End Total ================== --}}
                        @endif        
                        <tbody>
                    </table>
                </div>
            </div>
            <br>
            {{--================== Document Note  ==================--}}
            <div class="row">
                <?php
                    if($margin_top_noted == 0){
                        $document_note_row = 'document-note-row1';
                    }else if($margin_top_noted == 1){
                        $document_note_row = 'document-note-row2';
                    }else if($margin_top_noted == 2){
                        $document_note_row = 'document-note-row3';
                    }else{
                        $document_note_row = 'document-note-row4';
                    }    
                ?>
                <div class="col-xs-8 {{ $document_note_row }}"> 
                    @if(isset($header['remark']) && $header['remark'])
                        <div class=""><b>{{ (isset($document_notes->description)) ? $document_notes->description : 'Noted' }}</b></div>
                        <div class="term_of_conditions">
                            {!! $header['remark'] !!}
                        </div>
                    @else
                        @if(isset($document_notes->description))
                            <div ><b>{{ $document_notes->description }}</b></div>
                            <div class="term_of_conditions">
                                @if($document_notes->notes)
                                    {!! $document_notes->notes !!}
                                @endif
                            </div>
                        @endif    
                    @endif 
                </div>
                <div class="col-xs-4"></div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="col-xs-12 text-center">{{ trans('greetings.Prepared by') }}</div>
                            <div class="row  signature-content"></div>
                            <div class="col-xs-12 text-center">{{ trans('greetings.Name/Date') }}</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-12 text-center">{{ trans('greetings.Verified Signature') }}</div>
                            <div class="row  signature-content"></div>
                            <div class="col-xs-12 text-center">{{ trans('greetings.Name/Date') }}</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-12 text-center">{{ trans('greetings.Customer Signature') }}</div>
                            <div class="row  signature-content"></div>
                            <div class="col-xs-12 text-center">{{ trans('greetings.Name/Date') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
</div>