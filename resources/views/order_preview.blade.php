@extends('parts.template') 

@section('title', 'Comanda finalizata - Nighters')

@section('content')
<div id="content">

    <div class="inner_content_little container">  
      <div class="confirmare-comanda-container">
        @if($order->payment_method == 'card')
          @if($order->status == 'card respins')
            <div class="titlu-confirmare-comanda big-title">Tranzactie esuata</div>
            <div class="text-simplu-confirmare">Din pacate plata cu cardul a fost respinsa. Va rugam sa contactati banca emitenta pentru mai multe detalii.</div>
          @else
          <div class="content-comanda-left">
            <div class="titlu-confirmare-comanda big-title">Confirmare comanda</div>
            @if($order->status == 'asteptare')
            <div class="text-simplu-confirmare">Multumim. Comanda dvs. a fost plasata dar plata comenzii este in asteptare. Veti primi un email imediat ce plata va fi procesata.</div>
            @else
              <div class="text-simplu-confirmare">Multumim. Comanda dvs. a fost plasata.</div>
            @endif
            <ul class="listare-statusuri-comanda">
              <li>ID comanda: {{$order->id_order}}</li>
              <li>Data: {{$order->data_comanda}}</li>
              <li>Total plata: {{number_format($order->total, 2, '.', ',')}} lei</li>
              <li>Livrare: {{$order->delivery_method}}</li>
              <li>Metoda de plata: {{$order->payment_method}}</li>
            </ul>
          </div>
          <div class="content-comanda-right">
            <div class="content-produse-right-comanda">
              <div class="titlu-confirmare-comanda titlu-right-comanda">Detaliu comanda</div>
              <div class="produse-cos-container-popup preview-produse-cos">
                @if($order->order_products)
                  @foreach($order->order_products as $product)
                    <div class="container-box-produs-cos container-produs-box-preview">
                      <div class="produs-popup-image"><img src="{{ thumb('width:120', $product->options['image'] ) }}"/></div>
                      <a href="produs/{{$product->options['link']}}" class="produs-cos-popup-box tooltip" title="Click pentru a vedea detaliile produsului">
                        <div class="produs-popup-title"><?php echo $product->product_name;?></div>
                        <div class="produs-popup-price">{{$product->qty}} x {{number_format($product->price, 2, '.', ',')}} Lei</div>
                        <div class="produs-popup-options">Marime: @if($product->options['dimensions'] != null) {{$product->options['dimensions']}} @endif</div>
                        @if($product->options['monograma'] != '0')
                        <div class="produs-popup-options">Monograma: {{$product->options['monograma']}}</div>
                        @endif
                        <div class="produs-popup-options">Inaltime: {{$product->options['inaltime']}}</div>
                      </a>
                    </div>
                  @endforeach
                @endif
              </div>
          <div class = "total-container">
           
            <?php
            if($order->voucher)
            {
                ?>
                 <div class = "total-row">
                    <div class = "total-left">Subtotal</div>
                    <div class = "total-right">{{number_format($order->total - $order->reducere - $order->delivery_price, 2, '.', ',')}} <span>LEI</span></div>
                </div>
                    <div class = "total-row">
                        <div class = "total-left"><?php echo $order->voucher;?></div>
                        <div class = "total-right red-voucher">-<?php echo $order->reducere;?><span>LEI</span></div>
                    </div>
                <?php
            }else{
              ?>
                <div class = "total-row">
                    <div class = "total-left">Subtotal</div>
                    <div class = "total-right">{{number_format($order->total - $order->delivery_price, 2, '.', ',')}} <span>LEI</span></div>
                </div>
              <?php
            }
            ?>
            <div class = "total-row">
                <div class = "total-left">livrare</div>
                <div class = "total-right">{{number_format($order->delivery_price, 2, '.', ',')}} <span>LEI</span></div>
            </div>
            <div class = "total-row-linie"></div>
 
            <div class = "total-row">
                <div class = "total-left">Total</div>
                <div class = "total-right">{{number_format($order->total, 2, '.', ',')}} <span>LEI</span></div>
            </div>
        </div>



            </div>
          </div>  
          @endif
        @else
          <div class="content-comanda-left">
            <div class="titlu-confirmare-comanda big-title">Confirmare comanda</div>
            @if($order->status == 'asteptare')
              <div class="text-simplu-confirmare">Multumim. Comanda dvs. a fost plasata. </div>
            @endif
            <ul class="listare-statusuri-comanda">
              <li>ID comanda: {{$order->id_order}}</li>
              <li>Data: {{$order->data_comanda}}</li>
              <li>Total plata: {{number_format($order->total, 2, '.', ',')}} lei</li>
              <li>Livrare: {{$order->delivery_method}}</li>
              <li>Metoda de plata: {{$order->payment_method}}</li>
            </ul>
          </div>
          <div class="content-comanda-right">
            <div class="content-produse-right-comanda">
              <div class="titlu-confirmare-comanda titlu-right-comanda">Detaliu comanda</div>
              <div class="produse-cos-container-popup preview-produse-cos">
                @if($order->order_products)
                  @foreach($order->order_products as $product)
                    <div class="container-box-produs-cos container-produs-box-preview">
                      <div class="produs-popup-image"><img src="{{ thumb('width:120', $product->options['image'] ) }}"/></div>
                      <a href="produs/{{$product->options['link']}}" class="produs-cos-popup-box tooltip" title="Click pentru a vedea detaliile produsului">
                        <div class="produs-popup-title"><?php echo $product->product_name ?></div>
                        <div class="produs-popup-price">{{$product->qty}} x {{number_format($product->price, 2, '.', ',')}} Lei</div>
                        <div class="produs-popup-options">Marime: @if($product->options['dimensions'] != null) {{$product->options['dimensions']}} @endif</div>
                        @if($product->options['monograma'] != '0')
                        <div class="produs-popup-options">Monograma: {{$product->options['monograma']}}</div>
                        @endif
                        <div class="produs-popup-options">Inaltime: {{$product->options['inaltime']}}</div>
                      </a>
                    </div>
                  @endforeach
                @endif
              </div>

        <div class = "total-container">
            <?php
             if($order->voucher == "")
             {
               ?>
                <div class = "total-row">
                    <div class = "total-left">Subtotal</div>
                    <div class = "total-right">{{number_format($order->total - $order->delivery_price, 2, '.', ',')}} <span>LEI</span></div>
                </div>
               <?php
             }else{
              ?>
                <div class = "total-row">
                  <div class = "total-left">Subtotal</div>
                  <div class = "total-right">{{number_format($order->total + $order->reducere - $order->delivery_price, 2, '.', ',')}} <span>LEI</span></div>
                </div>
                <div class = "total-row">
                    <div class = "total-left"><?php echo $order->voucher;?></div>
                    <div class = "total-right red-voucher">-<?php echo $order->reducere;?><span>LEI</span></div>
                </div>
            <?php
             }
            ?>
            <div class = "total-row">
                <div class = "total-left">livrare</div>
                <div class = "total-right">{{number_format($order->delivery_price, 2, '.', ',')}} <span>LEI</span></div>
            </div>
            <div class = "total-row-linie"></div>
 
            <div class = "total-row">
                <div class = "total-left">Total</div>
                <div class = "total-right">{{number_format($order->total, 2, '.', ',')}} <span>LEI</span></div>
            </div>
        </div>
            </div>
          </div>
        @endif
        
      </div>
    </div>

</div>
@endsection

@push('scripts')

@endpush
                