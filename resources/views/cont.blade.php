@extends('parts.template')
@section('title','Contul meu - Nighters')
@section('content')

@php
  if(Session::has('user')){
    $wishlist = \App\Models\Wishlist::where('uid', Session::get('user')['id'])->get();
    $wishlist_prod_ids = [];
    if(count($wishlist) > 0){
      foreach($wishlist as $wish){
        array_push($wishlist_prod_ids, $wish->pid);
      }
    }
  }
@endphp

<div class = "big-container" id="cont-container">
    <div class = "big-title">contul meu</div>
    <div class = "cont-container">
        <div class = "cont-menu">
            <div class = "cont-menu-item" id = "editeaza">
                <div class = "cont-menu-item-image">
                    <img src = "images/cont-editeaza.svg" class = "full-width neselectat">
                    <img src = "images/cont-editeaza-selected.svg" class = "full-width selectat">
                </div>
                <div class = "cont-menu-item-text">editeaza date cont</div>
            </div>
            <div class = "cont-menu-item" id = "istoric">
                <div class = "cont-menu-item-image">
                    <img src = "images/cont-istoric.svg" class = "full-width neselectat">
                    <img src = "images/cont-istoric-selected.svg" class = "full-width selectat">
                </div>
                <div class = "cont-menu-item-text">istoric comenzi</div>
            </div>
            <div class = "cont-menu-item" id = "livrare">
                <div class = "cont-menu-item-image">
                    <img src = "images/cont-livrare.svg" class = "full-width neselectat">
                    <img src = "images/cont-livrare-selected.svg" class = "full-width selectat">
                </div>
                <div class = "cont-menu-item-text">adresa de livrare</div>
            </div>
            <div class = "cont-menu-item" id = "facturare">
                <div class = "cont-menu-item-image">
                    <img src = "images/cont-facturare.svg" class = "full-width neselectat">
                    <img src = "images/cont-facturare-selected.svg" class = "full-width selectat">
                </div>
                <div class = "cont-menu-item-text">adresa de facturare</div>
            </div>
            <div class = "cont-menu-item" id = "wishlist">
                <div class = "cont-menu-item-image">
                    <img src = "images/cont-wishlist.svg" class = "full-width neselectat">
                    <img src = "images/cont-wishlist-selected.svg" class = "full-width selectat">
                </div>
                <div class = "cont-menu-item-text">Wishlist</div>
            </div>

            <div id = "logout" onclick="out();">
                <div class = "cont-menu-item-text">IESI DIN CONT</div>
            </div>
        </div>
        {{-- Editeaza date cont --}}
        <div class = "cont-left" id = "editeaza-menu">
            <div class = "cont-left-title">Salut, {{$account->name}}!</div>
            <div class = "cont-linie"></div>
            <div class = "cont-container-inside">
                <div class = "cont-input-linie">
                    <input type="text" class="cont-input" id="nume_user" value="{{$account->name}}" placeholder = "Nume prenume">
                    <input type="email" class="cont-input" id="email_user" value="{{$account->email}}" placeholder = "E-mail">
                    <input type="number" class="cont-input" id="telefon_user" value="{{$account->phone}}" placeholder = "Telefon">
                    <input type="password" class="cont-input" id="parola_user" value = "parola" placeholder="Parola noua">
                    @if(Session::get('user')['birthday'] != "")            
                    <input type="text" class="cont-input-date cont-input-date-disabled" id="birthday_user" value="{{\Carbon\Carbon::parse($account->birthday)->format('d.m.Y')}}" disabled placeholder = "Data nasterii">
                    @else
                    <input type="text" class="cont-input-date cont-birthday-edit" id="birthday_user" value="" placeholder = "Data nasterii">
                    @endif
                </div>
                <div class = "newsletter-container-checkbox">
                    <?php
                    if($account->newsletter == 0)
                        {
                            ?>
                                <div class="checkbox">
                                    <input type="checkbox" id="abonare_news" name="abonare_news" value="checkbox" class = "checkbox-input">
                                    <span></span>
                                </div>
                                <div class="terms-text">Aboare la Newsletter-ul Nighters</div>
                            <?php
                        }
                        else{
                            ?>
                                <div class="checkbox">
                                    <input type="checkbox" id="abonare_news" checked name="abonare_news" value="checkbox" class = "checkbox-input">
                                    <span></span>
                                </div>
                                <div class="terms-text">Sunteti abonat la Newsletter-ul Nighters</div>
                            <?php
                        }
                    ?>
                </div>
                <button class = "submit-btn cont-submit-button" type = "submit" onclick="modifica_date_user();">Salveaza datele</button>
            </div>
        </div>



        {{-- Istoric comenzi --}}
        <div class = "cont-left" id = "comenzi-menu">
            <div class = "cont-left-title">comenzile mele</div>
            <div class = "cont-linie"></div>
            <div class = "comenzi-container">
                <div class = "comenzi-row table-head">
                    <div class = "comenzi-text">nR. cOMANDA</div>
                    <div class = "comenzi-text">total</div>
                    <div class = "comenzi-text">dATA</div>
                    <div class = "comenzi-text">meTODA DE PLATA</div>
                    <div class = "comenzi-text">DETALII</div>
                </div>
                    
                <div id="istoric_comenzi_container"></div>

                <!-- <div class = "comenzi-row comanda">
                    <div class = "comenzi-text">587495</div>
                    <div class = "comenzi-text">789 lei</div>
                    <div class = "comenzi-text">23.03. 2020</div>
                    <div class = "comenzi-text">RAMBURS</div>
                    <div class = "detalii-imagine istoric-comenzi-btn"><img src = "images/view.svg" class = "full-width"></div>
                </div> -->
            </div>
        </div>

        {{-- Adresa de livrare --}}
        <div class = "cont-left" id = "livrare-menu">
            <div class = "cont-left-title">Adresa de livrare</div>
            <div class = "cont-linie"></div>
            <div class = "comenzi-container" id="comenzi-container">
               
            </div>  <!-- comenzi-container -->
        </div>  <!-- livrare-menu  -->


        {{-- adresa de facturare --}}
        <div class = "cont-left" id = "facturare-menu">
            <div class = "cont-left-title">Adresa de facturare</div>
            <div class = "cont-linie"></div>
            <div class = "comenzi-container" id="adrese_facturare_container">
                
            </div>  <!-- comenzi-container -->
        </div> <!-- facturare-menu -->

        {{-- Wishlist --}}
         <div class = "cont-left" id = "wishlist-menu">
            <div class = "cont-left-title">@if(count($wishlist_prods)) Produsele tale preferate @else Nu aveti niciun produs adaugat la favorite @endif</div>
            <div class = "cont-linie"></div>
            <div class = "cont-wishlist-container">
            <?php
            if(count($wishlist_prods)){
                ?>
                    <div class="swiper-container wishlist-swiper">
                        <div class="swiper-wrapper">
                        <?php
                        foreach($wishlist_prods as $produs){
                            ?>
                                <div class="swiper-slide">
                                    <a class="swiper-produs" href="/produs/<?php echo $produs->produs->link?>">
                                    <?php
                                        if($produs->produs->nou =='da'){
                                            ?><div class = "produs-nou">NOU</div><?php
                                        }
                                        $k = 0;
                                        foreach($produs->produs->poze as $poza){
                                            if($k == 0)
                                            {
                                                ?>
                                                    <img class = "full-width first-image" src = "{{ thumb('width:350', $poza) }}"  loading="lazy"/>
                                                <?php
                                            }
                                            if($k == 1)
                                                {
                                                    ?>
                                                        <img class = "full-width second-image" src = "{{ thumb('width:350', $poza) }}"  loading="lazy"/>
                                                    <?php
                                                }
                                            $k++;
                                        }
                                    ?>
                                    <div class="swiper-produs-descriere">{{$produs->produs->nume}}</div>
                                    <?php
                                        if($produs->produs->promotie == 'da')
                                        {
                                            ?>
                                            <div class = "reducere-pret-container">
                                                <div class = "swiper-produs-pret-container" style = "color:red;"><?php echo $produs->produs->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                                                <div class = "swiper-produs-pret-container pret-container-reducere"><?php echo $produs->produs->pretvechi;?> </div>
                                            </div>
                                            <?php
                                        }else{
                                            ?>
                                                <div class = "swiper-produs-pret-container"><?php echo $produs->produs->pret;?> <div class = "swiper-produs-lei">LEI</div></div>
                                            <?php
                                        }
                                    ?>
                                    </a>
                                </div>
                            <?php
                        }
                        ?>
                         
                            
                        </div> <!--wrapper -->
                    </div> <!--  wishlist-swiper -->
                <?php
            }
            ?>

            </div> <!-- cont-wishlist-container -->
            <!-- Add Arrows -->
            <div class="swiper-button-next wishlist-next"></div>
            <div class="swiper-button-prev wishlist-prev"></div>
        </div>  <!-- cont left -->
    </div>  <!-- cont-container -->
</div> <!-- big-container -->

@push('scripts')
<script>



function select_juridica(){
    if($('#fizica_noua').is(':checked')){
        $('#fizica_noua').prop('checked', false);
        $('#juridica_noua').prop('checked', true);
        $('#cui_noua').fadeIn('fast').show();
        $('#reg_noua').fadeIn('fast').show();
    }
}
function select_fizica(){
    if($('#juridica_noua').is(':checked')){
        $('#juridica_noua').prop('checked', false);
        $('#fizica_noua').prop('checked', true);
        $('#cui_noua').fadeOut('fast').hide();
        $('#reg_noua').fadeOut('fast').hide();
    }
}
function select_juridica_edit(){
    if($('#fizica_edit').is(':checked')){
        $('#fizica_edit').prop('checked', false);
        $('#juridica_edit').prop('checked', true);
        $('#cui').fadeIn('fast').show();
        $('#reg').fadeIn('fast').show();
    }
}
function select_fizica_edit(){
    if($('#juridica_edit').is(':checked')){
        $('#juridica_edit').prop('checked', false);
        $('#fizica_edit').prop('checked', true);
        $('#cui').fadeOut('fast').hide();
        $('#reg').fadeOut('fast').hide();
    }
}
function add_new_adress(instance){
    $(instance).next('.edit-adresa').slideToggle();
}
function add_new_billing_adress(instance){
    $('#new_bill_adress').slideToggle();
}
function edit_adresa(instance, id)
{
    $.ajax({
          url: "/user/detalii_adresa_livrare",
          type: "POST",
          data: {
            idAdresa: id,
          },
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (resp) {
            $('#nume_adresa_edit').val(resp.adresa['nume']);
            $('#adresa_adresa_edit').val(resp.adresa['adresa']);
            $('#telefon_adresa_edit').val(resp.adresa['telefon']);
            $('#email_adresa_edit').val(resp.adresa['email']);
            $('#judet_adresa_edit option').removeAttr('selected');
            $('#judet_adresa_edit').find('option[value="' + resp.adresa['judet'] + '"]').attr('selected','selected');
            $('#oras_adresa_edit').empty().append($("<option />").val(resp.adresa['oras']).text(resp.adresa['oras']));
            $('#salveaza_modificarile').attr('onclick',"modifica_adresa_livrare("+ resp.adresa['id'] +")");
            
            $(instance).parent().parent().after($('.edit-adresa-livrare').slideToggle());

          },
          error: function (p1, p2) {
            alertify.error(p1.responseJSON.message);
          },
    });
}
function edit_adresa_fact(instance, id)
{
    $.ajax({
          url: "/user/detalii_adresa_facturare",
          type: "POST",
          data: {
            idAdresa: id,
          },
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
          success: function (resp) {
              if(resp.adresa['tip'] == 'fizica')
              {
                    $('#fizica_edit').prop('checked',true);
                    $('#juridica_edit').prop('checked',false);
                    $('#reg').fadeOut().hide();
                    $('#cui').fadeOut().hide();
              }else{
                    $('#fizica_edit').prop('checked',false);
                    $('#juridica_edit').prop('checked',true);
                    $('#reg').fadeIn().show();
                    $('#reg').val(resp.adresa['reg']);
                    $('#cui').fadeIn().show();
                    $('#cui').val(resp.adresa['cui']);
              }
            //   console.log('Judet selectat:' + resp.adresa['judet']);
            //   console.log('Oras selectat:' + resp.adresa['oras']);
            $('#nume_adresa_edit_fact').val(resp.adresa['nume']);
            $('#adresa_adresa_edit_fact').val(resp.adresa['adresa']);
            $('#judet_adresa_edit_fact').find('option[value="' + resp.adresa['judet'] + '"').attr('selected','selected');
            $('#oras_adresa_edit_fact').empty().append($("<option />").val(resp.adresa['oras']).text(resp.adresa['oras']));
            $('#salveaza_modificarile_fact').attr('onclick',"modifica_adresa_facturare("+ resp.adresa['id'] +")");
            
            $(instance).parent().parent().after($('.edit-adresa-facturare').slideToggle());

          },
          error: function (p1, p2) {
            alertify.error(p1.responseJSON.message);
          },
    });
}
function get_cities(instance, status)
{
    var selected_county = $(instance).val();
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
              if(status == 'noua')
              {
                var $dropdown = $("#oras_adresa_noua");
              }else
              {
                var $dropdown = $("#oras_adresa_edit");
              }

            $dropdown.empty();
            $dropdown.append('<option value="0" selected="selected">Selecteaza orasul</option>');
            for(var i = 0; i < resp.length; i++){
              $dropdown.append($("<option />").val(resp[i]).text(resp[i]));
            }
          },
          error: function (p1, p2) {
            alertify.error(p1.responseJSON.message);
          },
        });
}
function get_cities_fact(instance, status)
{
    var selected_county = $(instance).val();
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
              if(status == 'noua')
              {
                var $dropdown = $("#oras_adresa_noua_fact");
              }else
              {
                var $dropdown = $("#oras_adresa_edit_fact");
              }

            $dropdown.empty();
            $dropdown.append('<option value="0" selected="selected">Selecteaza orasul</option>');
            for(var i = 0; i < resp.length; i++){
              $dropdown.append($("<option />").val(resp[i]).text(resp[i]));
            }
          },
          error: function (p1, p2) {
            alertify.error(p1.responseJSON.message);
          },
        });
}

$(document).ready(function(){
    if(screen.width > 1024)
    {
        $('.cont-menu-item').click(function(){
            $('.selectat').fadeOut('fast').hide();
            $('.neselectat').fadeIn('fast').show();
            $('.cont-menu-item-text').removeClass('cont-menu-item-text-active');
            $(this).find('.cont-menu-item-text').addClass('cont-menu-item-text-active');
            $(this).find('.cont-menu-item-image').find('.selectat').fadeIn('fast').show();
            $(this).find('.cont-menu-item-image').find('.neselectat').fadeOut('fast').hide();
        }); 

        $('#comenzi-menu').addClass('comenzi-menu-active'); 
        $('#editeaza-menu').fadeIn('fast').show();
        $('#editeaza').find('.cont-menu-item-text').addClass('cont-menu-item-text-active');

        $('#editeaza').click(function(){
            $('.cont-left').fadeOut('fast').hide();
            $('#editeaza-menu').fadeIn('fast').show();
        });
        $('#istoric').click(function(){
            $('.cont-left').fadeOut('fast').hide();
            $('#comenzi-menu').fadeIn('fast').show();
            istoric_comenzi();
        });
        $('#livrare').click(function(){
            $('.cont-left').fadeOut('fast').hide();
            $('#livrare-menu').fadeIn('fast').show();
            date_livrare();
        });
        $('#facturare').click(function(){
            $('.cont-left').fadeOut('fast').hide();
            $('#facturare-menu').fadeIn('fast').show();
            date_facturare();
        });
        $('#wishlist').click(function(){
            $('.cont-left').fadeOut('fast').hide();
            $('#wishlist-menu').fadeIn('fast').show();
            var wishlist = new Swiper('.wishlist-swiper', {
                slidesPerView: 3,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.wishlist-next',
                    prevEl: '.wishlist-prev',
                },
            });
        });

        // $('.istoric-comenzi-btn').click(function(){
        //     if($('.overlay-page').hasClass('overlay-page-active')){
        //     }
        //     else
        //     {
        //         $('.overlay-page').addClass('overlay-page-active');
        //         $('.istoric-comenzi-container').addClass('istoric-comenzi-container-active');
        //     }
        // });
    }
    
    $('.inchide-overlay').click(function(){
        $('.istoric-comenzi-container').removeClass('istoric-comenzi-container-active');
        $('.overlay-page').removeClass('overlay-page-active');
    });

    if(screen.width < 1025)
    {
        $('#editeaza').after( $('#editeaza-menu'));
        $('#istoric').after( $('#comenzi-menu'));
        $('#livrare').after( $('#livrare-menu'));
        $('#facturare').after( $('#facturare-menu'));
        $('#wishlist').after( $('#wishlist-menu'));

        $('#editeaza').click(function(){
            $('#editeaza-menu').slideToggle();
        });

        $('#istoric').click(function(){
            $('#comenzi-menu').slideToggle();
            istoric_comenzi();
        });

        $('#livrare').click(function(){
            $('#livrare-menu').slideToggle();
            date_livrare();
        });

        $('#facturare').click(function(){
            $('#facturare-menu').slideToggle();
            date_facturare();
        });

        $('#wishlist').click(function(){
            $('#wishlist-menu').slideToggle();
            
            var wishlist = new Swiper('.wishlist-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.wishlist-next',
                    prevEl: '.wishlist-prev',
                },
                breakpoints:{
                    770:{
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    480:{
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                }
            });
        });

        $('.cont-menu-item').click(function(){
            // $('.cont-menu-item-text').removeClass('cont-menu-item-text-active');
            $(this).find('.cont-menu-item-text').toggleClass('cont-menu-item-text-active');
            if($(this).find('.cont-menu-item-text').hasClass('cont-menu-item-text-active')){
                $(this).find('.cont-menu-item-image .selectat').css('display','block');
                $(this).find('.cont-menu-item-image .neselectat').css('display','none');

            }else{
                $(this).find('.cont-menu-item-image .selectat').css('display','none');
                $(this).find('.cont-menu-item-image .neselectat').css('display','block');

            }
           
            // $(this).find('.cont-menu-item-image').find('.selectat').fadeIn('fast').show();
            // $(this).find('.cont-menu-item-image').find('.neselectat').fadeOut('fast').hide();
        }); 

        $('.comanda').click(function(){
            if($('.overlay-page').hasClass('overlay-page-active')){
            }
            else
            {
                $('.overlay-page').addClass('overlay-page-active');
                $('.istoric-comenzi-container').addClass('istoric-comenzi-container-active');
            }
        });
    }
    if(screen.width < 769)
    {
        $('.istoric-comenzi-item').each(function( i ) {
            here = $(this).find('.istoric-comenzi-pret-linie');
            $(this).find('.istoric-comenzi-pret-custom').appendTo(here);
        });
    }

    $('.cont-birthday-edit').mask('00.00.0000');
});

</script>
@endpush
@endsection