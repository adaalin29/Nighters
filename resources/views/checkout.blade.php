@extends('parts.template')

@section('title', 'Checkout - Nighters')
@section('content')

<div class = "container">
    <a href="/" class="checkout-logo"><img src="images/logo.svg"></a>
    <div class = "big-title">Checkout</div>
    @if(Cart::count() > 0)
   <div id="checkout_content"></div>


    <div class = "finalizare-container">
        <div class = "finalizare-title">Finalizare comanda</div>
        <div class = "finalizare-bar"></div>
    
       
        {{--  Textul asta apare doar daca esti logat  --}}
        <?php
            if(Session::has('user'))
            {
                ?>
                    <div class = "deja-cont-logat">Salut, <?php echo Session::get('user')['name'] ?>! <br> Selecteaza adresele de livrare si facturare salvate in contul tau sau introdu adrese noi in campurile de mai jos.</div> 
                 <?php
            }
            else
            {
                ?>
                    <div class = "deja-cont-title">Ai deja cont?</div>
                    <div class = "deja-cont-bar"></div>
                    <div class = "deja-cont-checkout-container">
                        <div class = "login-button-checkout">Logheaza-te</div>
                        <div class = "login-checkout-container">
                            <div class = "login-checkout">
                                <input type="email" class="login-checkout-input" placeholder="E-mail*" id="nume_login_checkout">
                                <input type="password" class="login-checkout-input" placeholder="Parola*" id="parola_login_checkout">
                                <button class = "checkout-login-btn" onclick="login_checkout();">intra In cont<button>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>
        <div class = "finalizare-title">Adresa de livrare</div>
        <div class = "finalizare-bar"></div>
        <div class = "livrare">
            <?php
            if($adrese_livrare)
            {
                if(count($adrese_livrare) > 0)
                {
                    ?>
                        <select name="judet" class = "select-delivery-address select-livrare-address" onchange="populeaza_cu_adrese();">
                                <option value="">Selecteaza adresa de livrare</option>
                                @foreach($adrese_livrare as $adresa)
                                <option value="{{$adresa}}"><?php echo $adresa->adresa ?> , <?php echo $adresa->oras ?> , <?php echo $adresa->judet ?> , <?php echo $adresa->nume ?> , <?php echo $adresa->telefon ?> , <?php echo $adresa->email ?></option>
                                @endforeach
                        </select>
                    <?php
                }
               
            }
            ?>
           
            <div class = "livrare-row">
                <input type="text" class="login-checkout-delivery" placeholder="Nume si Prenume*" id="nume_livrare">
                <input type="number" class="login-checkout-delivery" placeholder="Telefon*" id="telefon_livrare">
                <input type="email" class="login-checkout-delivery" placeholder="Adresa de e-mail*" id="email_livrare">
                <input type="text" class="login-checkout-delivery" placeholder="Adresa*" id="adresa_livrare">
                <select name="judet" class = "select-delivery livrare-judet">
                    <option value="">Judet</option>
                    @if(count($counties) > 0)
                        @foreach($counties as $key => $county)
                        <option value="{{$key}}">{{$key}}</option>
                        @endforeach
                    @endif
                </select>
                <select name="oras" class = "select-delivery livrare-oras">
                    <option value="">Oras</option>
                </select>
            </div>

            <div class = "finalizare-title">Adresa de facturare</div>
            <div class = "finalizare-bar"></div>
            <?php
            if($date_facturare)
            {
                if(count($date_facturare) > 0)
                {
                ?>
                    <select name="judet" class = "select-delivery-address select-billing-address" onchange="populeaza_cu_adrese_facturare();">
                            <option value="">Selecteaza adresa de facturare</option>
                            @foreach($date_facturare as $adresa)
                            @if($adresa->tip == 'juridica')
                                <option value="<?php echo $adresa->nume ." " . $adresa->adresa . " " . $adresa->judet . " " . $adresa->oras ?>"><?php echo $adresa->nume ?> , <?php echo $adresa->adresa ?> , <?php echo $adresa->oras ?> , <?php echo $adresa->judet ?> , <?php echo $adresa->cui ?> , <?php echo $adresa->reg ?></option>
                            @else
                                <option value="<?php echo $adresa->nume ." " . $adresa->adresa . " " . $adresa->judet . " " . $adresa->oras ?>"><?php echo $adresa->nume ?> , <?php echo $adresa->adresa ?> , <?php echo $adresa->oras ?> , <?php echo $adresa->judet ?></option>
                            @endif
                            @endforeach
                    </select>
                <?php
                }
                
            }
            ?>

            <div class = "facturare-container">
                <div class = "facturare-row">
                    <div class = "facturare-checkbox-container">
                        <label class="checkbox">
                            <input type="checkbox" id="aceleasi" name="aceleasi" value="checkbox" class = "checkbox-input">
                            <span></span>
                        </label>
                        <label class = "facturare-checkbox-container-text" for="aceleasi">Datele de facturare sunt aceleasi cu cele de livrare</label>
                    </div>
                    <div class = "facturare-checkbox-container">
                        <label class="checkbox">
                            <input type="checkbox" id="diferite" name="diferite" value="checkbox" class = "checkbox-input">
                            <span></span>
                        </label>
                        <label for="diferite" class = "facturare-checkbox-container-text">Datele de facturare sunt diferite fata de cele de livrare</label>
                    </div>
                </div>
                <div class = "facturare-row">
                    <div class = "facturare-checkbox-container">
                        <label class="checkbox">
                            <input type="checkbox" id="fizica" name="fizica" value="checkbox" class = "checkbox-input">
                            <span></span>
                        </label>
                        <label for="fizica" class = "facturare-checkbox-container-text">Persoana fizica</label>
                    </div>
                    <div class = "facturare-checkbox-container">
                        <label class="checkbox">
                            <input type="checkbox" id="juridica" name="juridica" value="checkbox" class = "checkbox-input">
                            <span></span>
                        </label>
                        <label for="juridica" class = "facturare-checkbox-container-text">Persoana juridica</label>
                    </div>
                </div>
            </div>
            <div class= "facturare-inputuri">
                <div class = "livrare-row">
                    <input type="text" class="login-checkout-delivery" placeholder="Nume si Prenume*" id="nume_facturare">
                    <input type="text" class="login-checkout-delivery" placeholder="Adresa*" id="adresa_facturare">
                    <select name="judet" class = "select-delivery facturare-judet">
                        <option value="">Judet</option>
                        @if(count($counties) > 0)
                            @foreach($counties as $key => $county)
                            <option value="{{$key}}">{{$key}}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="oras" class = "select-delivery facturare-oras">
                        <option value="">Oras</option>
                    </select>
                    <!-- <div class= "facturare-inputuri-juridica"> -->
                        <!-- <div class = "livrare-row-flex-start facturare-inputuri-juridica"> -->
                            <input type="text" class="login-checkout-delivery no-margin-bottom" placeholder="Nr. Reg. Comert*" id="facturare_reg_com">
                            <input type="text" class="login-checkout-delivery no-margin-bottom" placeholder="CUI" id="facturare_cui">
                        <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
          
            <div class = "livrare">
                <div class = "finalizare-title">Optiuni de livrare</div>
                <div class = "finalizare-bar"></div>
                <div class = "facturare-checkbox-container">
                    <label class="checkbox">
                        <input type="checkbox" id="curier" name="curier" value="checkbox" class = "checkbox-input" checked onclick="return false;">
                        <span></span>
                    </label>
                    <label for="curier" class = "facturare-checkbox-container-text">Livrare prin CURIER DPD (Oriunde in tara)</label>
                </div>
            </div>

            <div class = "plata">
                <div class = "finalizare-title">metoda de plata</div>
                <div class = "finalizare-bar"></div>
                <div class = "facturare-checkbox-container">
                    <label class="checkbox">
                        <input type="checkbox" id="cash" name="cash" value="checkbox" class = "checkbox-input" checked>
                        <span></span>
                    </label>
                    <label for="cash" class = "facturare-checkbox-container-text">Cash la livrare</label>
                </div>
                <div class = "facturare-checkbox-container">
                    <label class="checkbox">
                        <input type="checkbox" id="card" name="card" value="checkbox" class = "checkbox-input">
                        <span></span>
                    </label>
                    <label for="card" class = "facturare-checkbox-container-text">Online cu cardul</label>
                </div>
            </div>
            <div class = "butoane-checkout">
                <a href = "" class = "continua-cumparaturi">Continua cumparaturile</a>
                <button class = "trimite" onclick="place_order();">Trimite comanda</button>
            </div>
        </div>
    </div>

    @else
        <div id="empty_cart">
        <div id="empty_message">
            Momentan cosul dvs este gol.
        </div>
           
            <div class = "big-title big-title-margin-top no-bottom-bar">PRODUSE RECOMANDATE</div>
            <div id="empty_cart_swiper">
            <div class="swiper-container loved">
                <div class="swiper-wrapper">
                    <?php
                    foreach($produse_recomandate as $produs_recomandat)
                    {
                        ?>
                        <div class="swiper-slide">
                            <a class = "swiper-produs" href = "/produs/<?php echo $produs_recomandat->link;?>">
                                <?php
                                    if($produs_recomandat->nou =='da'){
                                    ?>
                                        <div class = "produs-nou">NOU</div>
                                    <?php
                                    }
                                    $k = 0;
                                    foreach($produs_recomandat->poze as $poza){
                                    
                                    if($k == 0)
                                    {
                                        ?>
                                            <img class = "full-width first-image" src = "{{ thumb('width:350', $poza) }}" />
                                    <?php
                                    }
                                    if($k == 1)
                                    {
                                        ?>
                                            <img class = "full-width second-image" src = "{{ thumb('width:350', $poza) }}" />
                                        <?php
                                    }
                                    $k++;
                                    }
                                ?>
                                
                                
                                <div class = "swiper-produs-descriere"><?php echo $produs_recomandat->nume;?></div>
                                <?php
                                if($produs_recomandat->promotie =='da' && $produs_recomandat->pretvechi > 0)
                                {
                                    ?>
                                    <div class = "produs-nou">-<?php echo round(($produs_recomandat->pretvechi - $produs_recomandat->pret)*100/$produs_recomandat->pretvechi);?>%</div>
                                    <div class = "reducere-pret-container">
                                        <div class = "swiper-produs-pret-container" style = "color:red;"><?php echo $produs_recomandat->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                                        <div class = "swiper-produs-pret-container pret-container-reducere"><?php echo $produs_recomandat->pretvechi;?> </div>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                        <div class = "swiper-produs-pret-container"><?php echo $produs_recomandat->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <!-- Add Arrows -->
            </div>
            <div class="swiper-button-next loved-next"></div>
            <div class="swiper-button-prev loved-prev"></div>
            </div>
        </div>
    @endif
</div>
<input type="hidden" id="voucher_saved">

<form class="mobilpay-redirect" action="" method="post">
    <input type="hidden" name="env_key" value="" />
    <input type="hidden" name="data" value="" />
</form>


@endsection
@push('scripts')
<script>
    $('document').ready(function(){
        cart_content();

       
    });
    $('.login-button-checkout').click(function(){
        if($('.login-checkout-container').hasClass('login-checkout-container-visible')){
            $(this).fadeIn().show();
            $('.login-checkout-container').fadeOut().hide();
            $('.login-checkout-container').removeClass('login-checkout-container-visible');
        }else{
            $('.login-checkout-container').addClass('login-checkout-container-visible');
            $(this).fadeOut().hide();
            $('.login-checkout-container').fadeIn().show();
        }
    });

    $('#fizica').click(function(){
        if($(this).is(':checked')){
            $('#juridica').prop('checked', false);
            // $('.facturare-inputuri-juridica').fadeOut().hide();
            $('#facturare_reg_com').fadeOut().hide();
            $('#facturare_cui').fadeOut().hide();
        }
    });
    
    $('#juridica').click(function(){
        if($(this).is(':checked')){
            $('#fizica').prop('checked', false);
            // $('.facturare-inputuri-juridica').fadeIn().show();
             $('#facturare_reg_com').fadeIn().show();
             $('#facturare_cui').fadeIn().show();
        }
    });

    $('#aceleasi').prop('checked', true);
    $('#fizica').prop('checked', true);

    $('#aceleasi').click(function(){
        if($(this).is(':checked')){
            $('#diferite').prop('checked', false);
            // $('#fizica').prop('checked', false);
            $('#juridica').prop('checked', false);
            $('.facturare-inputuri').fadeOut().hide();
            $('.facturare-inputuri-juridica').fadeOut().hide();

        }
    });

    $('#diferite').click(function(){
        if($(this).is(':checked')){
            $('#aceleasi').prop('checked', false);
            $('.facturare-inputuri').fadeIn().show();
            // $('#fizica').prop('checked', true);
            $('#juridica').prop('checked', false);
            $('#nume_facturare').val("");
            $('#adresa_facturare').val("");
            $('#adresa_facturare').val("");
            $('.facturare-judet').val("");
            $('.facturare-oras').val("");
            $('#facturare_reg_com').val("").fadeOut().hide();
            $('#facturare_cui').val("").fadeOut().hide();
        }
    });

    $('#cash').click(function(){
        if($(this).is(':checked')){
            $('#card').prop('checked', false);
        }
    });

    $('#card').click(function(){
        if($(this).is(':checked')){
            $('#cash').prop('checked', false);
        }
    });
    

    var Loved = new Swiper('.loved', {
      slidesPerView: 1,
      spaceBetween: 65,
      slidesPerGroup: 1,
      loop: true,
      loopFillGroupWithBlank: true,
      navigation: {
        nextEl: '.loved-next',
        prevEl: '.loved-prev',
      },
      breakpoints:{
         1025:{
            slidesPerView: 4,
            spaceBetween: 65,
            slidesPerGroup: 1,
         },
         770:{
            slidesPerView: 3,
            spaceBetween: 65,
         },
         481:{
            slidesPerView: 2,
            spaceBetween: 35,
         }

      }
    });


          // Get all cities by county
    $(".livrare-judet").change(function(){
        var selected_county = $(this).val();
        $.ajax({
          url: "/cities",
          type: "POST",
          data: {
            county: selected_county,
          },
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (resp) {
            var $dropdown = $(".livrare-oras");
            $dropdown.empty();
            for(var i = 0; i < resp.length; i++){
              $dropdown.append($("<option />").val(resp[i]).text(resp[i]));
            }
          },
          error: function (p1, p2) {
            alertify.error(p1.responseJSON.message);
          },
        });
      });
    $(".facturare-judet").change(function(){
        var selected_county = $(this).val();
        $.ajax({
          url: "/cities",
          type: "POST",
          data: {
            county: selected_county,
          },
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (resp) {
            var $dropdown = $(".facturare-oras");
            $dropdown.empty();
            for(var i = 0; i < resp.length; i++){
              $dropdown.append($("<option />").val(resp[i]).text(resp[i]));
            }
          },
          error: function (p1, p2) {
            alertify.error(p1.responseJSON.message);
          },
        });
      });

      //user-ul selecteaza o adresa salvata in contul lui, din dropdown
      function populeaza_cu_adrese(){
          
            var selected = $('.select-livrare-address option:selected').text();
            var split = selected.split(' , ');
            $('#adresa_livrare').val(split[0]);
            $('.livrare-judet').removeAttr('selected');
            $('.livrare-judet').find('option[value="' + split[2] + '"]').attr('selected','selected');
            var selected_county =  $('.livrare-judet').val();
            // $.ajax({
            //     url: "/cities",
            //     type: "POST",
            //     data: {
            //         county: selected_county,
                    
            //     },
                
            //     headers: {
            //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            //     },
            //     success: function (resp) {
            //         var $dropdown = $(".livrare-oras");
            //         $dropdown.empty();
            //         for(var i = 0; i < resp.length; i++){
            //             if(resp[i] == split[1]){
            //                 $dropdown.append($("<option />").val(resp[i]).text(resp[i]));
            //             }
            //         }
            //     },
            //     error: function (p1, p2) {
            //         alertify.error(p1.responseJSON.message);
            //     },
            // });
            // $('.livrare-oras').find('option[value="' + split[2] + '"').attr('selected','selected');
            $('.livrare-oras').empty().append($("<option />").val(split[1]).text(split[1]));
            $('#nume_livrare').val(split[3]);
            $('#telefon_livrare').val(split[4]);
            $('#email_livrare').val(split[5]);
      }
      function populeaza_cu_adrese_facturare(){
            $('.facturare-inputuri').fadeIn().show();
            $('#fizica').prop('checked', true);
            $('#juridica').prop('checked', false);
            $('#diferite').prop('checked',true);
            $('#aceleasi').prop('checked',false);
            $('#facturare_reg_com').fadeOut().hide();
            $('#facturare_cui').fadeOut().hide();
            var selected = $('.select-billing-address option:selected').text();
            var split = selected.split(' , ');
            $('#adresa_facturare').val(split[1]);
            $('.facturare-judet option').removeAttr('selected');
            $('.facturare-judet').find('option[value="' + split[3] + '"]').attr('selected','selected');
            $('.facturare-oras').empty().append($("<option />").val(split[2]).text(split[2]));
            $('#nume_facturare').val(split[0]);
            if(split.length > 4)
            {
                $('#facturare_reg_com').fadeIn().show();
                $('#facturare_cui').fadeIn().show();
                $('#facturare_reg_com').val(split[4]);
                $('#facturare_cui').val(split[5]);
                $('#juridica').prop('checked', true);
                $('#fizica').prop('checked', false);
            }
      }
       
      function toggleVoucher(){
        $('#voucher-details').toggleClass('voucher-details-visible');
      }

      function aplica_voucher(){
        if($('#voucher_comanda').val() != "")
        {
        var cod = $('#voucher_comanda').val();
        $('#voucher_saved').val(cod);
        
        $.ajax({
            url: "/aplica_voucher",
            type: "POST",
            data: {
                cod: cod,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (resp) {
                if (resp.code == "300") {
                    var messages = resp.msg;
                    $.each(messages, function (key, value) {
                        alertify.error(messages[key][0]);
                    });
                }
                else if(resp.code == "400")
                {
                    alertify.error(resp.msg);
                }
                else{
                    // cart_content();
                    $('#checkout_content').empty().append(resp);
                    if (screen.width < 1025) {
                        $('.checkout-produs-container').each(function (i) {
                            if (i == 0) {
                            $(this).attr('id', 'first-produs-container');
                            }
                            bottom_container_left = $(this).find('.checkout-bottom-container .checkout-left');
                            bottom_container_right = $(this).find('.checkout-bottom-container .checkout-right');
                            $(this).find('.produs-checkout-detalii-right-detalii').appendTo(bottom_container_right);
                            $(this).find('.checkout-produs-container-sterge').appendTo(bottom_container_right);
                            $(this).find('.sterge-image').html('STERGE');
                            $(this).find('.checkout-produs-container-unitar').appendTo(bottom_container_left);
                            $(this).find('.checkout-produs-container-cantitate-container').appendTo(bottom_container_left);
                        });
                    }
                    
                }
            },
            error: function (p1, p2) {
                alertify.error(p1.responseJSON.message);
            },
        });
        } else {
            alertify.error("Nu ati introdus niciun voucher!");
        }
    }
   
    document.addEventListener("DOMContentLoaded", function() {
		window.totalComanda = <?= $cart_total + $val_transport ?>,
        window.num_items = <?= $cart_count ?>,

        fbq('track', 'AddToCart', {
            currency: 'RON', 
            value:parseFloat(window.totalComanda).toFixed(2),
            num_items: num_items,
        });
	});

</script>
@endpush