var offset = 100;

var duration = 800;

$(window).scroll(function () {
  if ($(this).scrollTop() > offset) {
    $(".go-top").fadeIn(duration);
  } else {
    $(".go-top").fadeOut(duration);
  }
});

$(".go-top").click(function (event) {
  event.preventDefault();
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    duration
  );
  return false;
});

function mail_contact() {
  if ($("#acord_contact").prop("checked") == true) {
    var nume = $("#nume_contact").val();
    var email = $("#email_contact").val();
    var telefon = $("#telefon_contact").val();
    var mesaj = $("#mesaj_contact").val();

    $.ajax({
      url: "/mail_contact",
      type: "POST",
      data: {
        nume: nume,
        email: email,
        telefon: telefon,
        mesaj: mesaj,
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: function (resp) {
        if (resp.code == 200) {
          $("#nume_contact").val("");
          $("#email_contact").val("");
          $("#telefon_contact").val("");
          $("#mesaj_contact").val("");
          $("#acord_contact").prop("checked", false);

          alertify.success(resp.msg);
        }
        if (resp.code == "300") {
          var messages = resp.msg;
          $.each(messages, function (key, value) {
            alertify.error(messages[key][0]);
          });
        }
      },
      error: function (p1, p2) {
        alertify.error(p1.responseJSON.message);
      },
    });
  } else {
    alertify.error(
      "Trebuie sa fii de acord cu Politica de confidentialitate site-ului!"
    );
  }
}

function register_new_user() {
  if ($("#acord_cont_nou").prop("checked") == true) {
    if ($("#parola_cont_nou").val() == $('#parola_rep_cont_nou').val()) {
      var nume = $("#nume_cont_nou").val();
      var telefon = $("#telefon_cont_nou").val();
      var data_nasterii = $("#data_cont_nou").val();
      var email = $("#email_cont_nou").val();
      var parola = $("#parola_cont_nou").val();
  
      $.ajax({
        url: "/inregistreaza_user",
        type: "POST",
        data: {
          nume: nume,
          email: email,
          data_nasterii: data_nasterii,
          telefon: telefon,
          parola: parola,
        },
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (resp) {
          if (resp.code == 200) {
            $("#nume_cont_nou").val("");
            $("#telefon_cont_nou").val("");
            $("#email_cont_nou").val("");
            $("#parola_cont_nou").val("");
            $("#data_cont_nou").val("");
            $("#acord_cont_nou").prop("checked", false);

            alertify.success(resp.msg);
            $('.new-account').removeClass('new-account-active');
            $('.my-account').addClass('my-account-active');
          }
          if (resp.code == "300") {
            var messages = resp.error_all;
            $.each(messages, function (key, value) {
              alertify.error(messages[key][0]);
            });
          }
          if (resp.code == "320") {
            alertify.error(resp.msg);
          }
        },
        error: function (p1, p2) {
          alertify.error(p1.responseJSON.message);
        },
      });
    } else {
      alertify.error(
        "Parolele nu coincid!"
      );
    }

  } else {
    alertify.error(
      "Trebuie sa fii de acord cu Termenii si conditiile site-ului!"
    );
  }
}
function login() {
      var email = $("#email_login").val();
      var parola = $("#parola_login").val();
  
      $.ajax({
        url: "/login",
        type: "POST",
        data: {
          user_email_log: email,
          user_pass_log: parola,
        },
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (resp) {
          if (resp.code == 200) {
            $("#email_login").val("");
            $("#parola_login").val("");
  
            var html = '<a href="/user/cont"><div class="header-social-item user"><img src="images/user-active.svg" class="full-width"></div></a>';
            $('#user_icon').empty().append(html);
            alertify.success(resp.msg);

            location.href = "/";
          }
          if (resp.code == "300") {
            var messages = resp.msg;
            $.each(messages, function (key, value) {
              alertify.error(messages[key][0]);
            });
          }
          if (resp.code == "500") {
            alertify.error(resp.msg);
          }
        },
        error: function (p1, p2) {
          alertify.error(p1.responseJSON.message);
        },
      });
}
function login_checkout() {
      var email = $("#nume_login_checkout").val();
      var parola = $("#parola_login_checkout").val();
  
      $.ajax({
        url: "/login",
        type: "POST",
        data: {
          user_email_log: email,
          user_pass_log: parola,
        },
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (resp) {
          if (resp.code == 200) {
            $("#nume_login_checkout").val("");
            $("#parola_login_checkout").val("");
  
            var html = '<a href="/user/cont"><div class="header-social-item user"><img src="images/user-active.svg" class="full-width"></div></a>';
            $('#user_icon').empty().append(html);
            alertify.success(resp.msg);

            location.href = "/checkout";
          }
          if (resp.code == "300") {
            var messages = resp.msg;
            $.each(messages, function (key, value) {
              alertify.error(messages[key][0]);
            });
          }
          if (resp.code == "500") {
            alertify.error(resp.msg);
          }
        },
        error: function (p1, p2) {
          alertify.error(p1.responseJSON.message);
        },
      });
}
function out() {
      $.ajax({
        url: "/out",
        type: "GET",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (resp) {
          if (resp.success == false) {
            alertify.error(resp.msg);
          } else {
            location.href = "/";
          }
        },
        error: function (p1, p2) {
          alertify.error(p1.responseJSON.message);
        },
      });
}

function forgot_pass() {
  var email = $("#forgot_pass_email").val();

  $.ajax({
    url: "/uitat_parola",
    type: "POST",
    data: {
      email: email,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        $("#forgot_pass_email").val("");

        alertify.success(resp.msg);
      }
      if (resp.code == "300") {
        var messages = resp.error_all;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function schimba_parola_mail() {
  var parola = $("#parola_noua").val();
  var uid    = $("#uid").val();

  $.ajax({
    url: "/schimba_parola_mail",
    type: "POST",
    data: {
      parola_noua: parola,
      uid : uid,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        $("#parola_noua").val("");
        $("#uid").val("");

        alertify.success(resp.msg);

        location.href = "/";
      }
      if (resp.code == "300") {
        var messages = resp.msg;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function modifica_date_user() {
  var nume = $("#nume_user").val();
  var telefon = $("#telefon_user").val();
  var email = $("#email_user").val();
  var parola = $("#parola_user").val();
  var birthday = $("#birthday_user").val();
  var newsletter = 0;

  if ($("#abonare_news").prop("checked") == true) {
     newsletter = 1;
  } 
  $.ajax({
    url: "/user/modifica_date_user",
    type: "POST",
    data: {
      nume: nume,
      telefon: telefon,
      email: email,
      parola: parola,
      newsletter: newsletter,
      birthday: birthday
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {


        alertify.success(resp.msg);
      }
      if (resp.code == "300") {
        var messages = resp.msg;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function detalii_cont() {
  $.ajax({
    url: "/detalii_cont",
    type: "GET",

    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        $("#nume_user").val(resp.nume);
        $("#email_user").val(resp.email);
        $("#telefon_user").val(resp.telefon);
        $("#parola_user").val(resp.parola);

        alertify.success(resp.msg);
      }
      if (resp.code == "300") {
        var messages = resp.error_all;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function show_submenu(id_categorie, slug)
{
    $.ajax({
        url: "/show_subcategories",
        type: "POST",
        data: {
            id_categorie: id_categorie,
        },
        headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (resp) {
        if (resp.code == 200) {
            var subcategorii = resp.subcategorii;

            if (!$('.header-menu-container').hasClass('header-menu-container-active')) {
              $('.header-menu-container').addClass('header-menu-container-active');
          }
            $('.header-menu-container-sub').css('display', 'flex');
            $('.header-menu-container-sub').fadeIn();

            var html = "";
            $.each(subcategorii, function (key, value) {
                html += '<a href="/produse/' + value.categorie + '/'+ value.link + '" class="header-menu-item promotii-item">' + value.name + '</a>';
            });
          
          if (subcategorii.length > 4)
          {
            $('.header-menu-container-content-inside').addClass('with-border');
          } else {
            $('.header-menu-container-content-inside').removeClass('with-border');
          }
          $('.header-menu-container-sub .header-menu-container-content-inside').empty().append(html);
          
          $('#noutati').attr('href', '/produse/' + slug + '?latest=nou');
        }
        if (resp.code == "300") {
            var messages = resp.msg;
            $.each(messages, function (key, value) {
                alertify.error(messages[key][0]);
            });
        }
        },
        error: function (p1, p2) {
        alertify.error(p1.responseJSON.message);
        },
    });
}
function sort_promotii_category(id_categorie) {
  $.ajax({
    url: "/sort_promotii_category",
    type: "POST",
    data: {
        id_categorie: id_categorie,
    },
    headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
    if (resp.code == 200) {
        var produse = resp.produse;

        var html = "";
      $.each(produse, function (key, value) {
        html += '<div class="swiper-slide swiper-produs">';
            html += '<a href="/produs/' + value.link + '">';
                if(value.nou == 'da')
                  {
                     html += '<div class = "produs-nou">NOU</div>';
                  }
            html += '<img class="full-width first-image" src=' + value.poze[0] + ' alt="Imagine" loading="lazy"/>';
            html += '<img class="full-width second-image" src=' +  value.poze[1] + ' alt="Imagine" loading="lazy"/>';
            html += ' <div class="swiper-produs-descriere">'+ value.nume +'</div>'
                if(value.promotie == 'da')
                  {
                  html += '<div class = "produs-nou"><img src = "images/percentage.svg"></div>';
                  html += '<div class = "reducere-pret-container">';
                  html += '<div class = "swiper-produs-pret-container" style = "color:red;">' + value.pret + '<div class = "swiper-produs-lei">LEI</div></div>'
                  html += ' <div class = "swiper-produs-pret-container pret-container-reducere">'+value.pretvechi+ '</div>'
                  html += '</div>';
                } else {
                  html += ' <div class = "swiper-produs-pret-container">' + value.pret +'<div class = "swiper-produs-lei">LEI</div></div>'
                  }
            html += '</a>';
            html += '</div>';
            });

           
      
      $('.loved .swiper-wrapper').empty().append(html);
      
      // var Loved = new Swiper('.loved', {
      //   slidesPerView: 1,
      //   spaceBetween: 20,
      //   slidesPerGroup: 1,
      //   loop: true,
      //   navigation: {
      //     nextEl: '.loved-next',
      //     prevEl: '.loved-prev',
      //   },
      //   breakpoints:{
      //       1025:{
      //           slidesPerView: 4,
      //           spaceBetween: 65,
      //       },
      //       770:{
      //           slidesPerView: 3,
      //           spaceBetween: 65,
      //       },
      //       481:{
      //           slidesPerView: 2,
      //           spaceBetween: 45,
      //       }
      //   }
      // });
     
    }
    if (resp.code == "300") {
        var messages = resp.msg;
        $.each(messages, function (key, value) {
            alertify.error(messages[key][0]);
        });
    }
    },
    error: function (p1, p2) {
    alertify.error(p1.responseJSON.message);
    },
});
}

function crud_wishlist(pid, type) {
  $.ajax({
    url: "/user/crud_wishlist",
    type: "POST",
    data: {
      pid: pid,
      type : type,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        alertify.success(resp.msg);

        if (resp.type == 'add')
        {
          $('.wishlist-contianer').attr('onclick', "crud_wishlist("+resp.pid +", 'add')");
          $('.wishlist-star img').attr('src', 'images/star.svg');
          $('.wishlist-text').html('Adauga in wishlist <div class = "wishlist-bar"></div>');
        
          fbq('track', 'AddToWishlist', {
            currency: 'RON' ,
            content_name: $('.produs-name').text(), 
            content_category: "product",
            content_ids: $('#cod_produs_pixel').val(),
            content_type: 'product',
            value: parseFloat($('.pret-produs-actual').text().slice(0,-3)).toFixed(2),
          });
          
        } else {
          $('.wishlist-contianer').attr('onclick', "crud_wishlist("+ resp.pid + ", 'remove')");
          $('.wishlist-star img').attr('src', 'images/star-full.svg');
          $('.wishlist-text').html('Adaugat in wishlist <div class = "wishlist-bar"></div>');

        }

      }
      if (resp.code == "300") {
        var messages = resp.error_all;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function add_product(id_produs) {
  if ($('#monograma').length > 0)
  {
    var monograma = $('#monograma').val();
  } else {
    var monograma = 0;
  }
 
  var inaltime = $('#inaltime').val();
  var marime = $('.marime-element-active').text();

  $.ajax({
    url: "/product/add-product",
    type: "POST",
    data: {
      id: id_produs,
      inaltime: inaltime,
      monograma: monograma,
      marime : marime,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        // alertify.success(resp.msg);
        fbq('track', 'AddToCart', {
          content_name: $('.produs-name').text(), 
          content_ids: $('#cod_produs_pixel').val(),
          content_type: 'product',
          value:parseFloat($('.pret-produs-actual').text().slice(0,-3)).toFixed(2),
          currency: 'RON' 
        });

        gtag('event', 'add_to_cart', {
          "items": [
            {
              "id": $('#cod_produs_pixel').val(),
              "name": $('.produs-name').text(),
              "brand": "Nighters",
              "category": $('.produs-breadcrumb a').text(),
              "quantity": 1,
              "price": parseFloat($('.pret-produs-actual').text().slice(0,-3)).toFixed(2)
            }
          ]
        });
        
        $('.checkout').append('<div class="avem-produse"></div>');
        $('#inaltime').val("");
        if ($('#monograma').length > 0)
        {
          $('#monograma').val("");
        }
        $('.marime-element').removeClass("marime-element-active");
        show_cart();
        $('.cos-cumparaturi').addClass('cos-cumparaturi-active');
        $('.overlay-cos').addClass('overlay-cos-active');
        $('html').css('overflow-y', 'hidden');
      }
      if (resp.code == "300") {
        var messages = resp.msg;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function show_cart() {
  $.ajax({
    url: "/show_cart",
    type: "GET",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {   
      $('#cos-content').empty().append(resp);
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function cart_content(){
  $.ajax({
      url: "/checkout_content",
      type: "GET",
      headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: function (resp) {   
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
      },
      error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
  },
});
}
function delete_product(id_produs) {
  $.ajax({
    url: "/product/delete-product",
    type: "POST",
    data: {
      product_id: id_produs,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        show_cart();
        cart_content();
        if (resp.total_items == 0)
        {
          $('.checkout').find('.avem-produse').remove();
        }
      }
      if (resp.code == 300) {
          alertify.error(resp.msg);
      }
      
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function decrease_qt_product(id_produs) {
  $.ajax({
    url: "/product/decrease-qt",
    type: "POST",
    data: {
      product_id: id_produs,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      show_cart();
      cart_content();
      // instance.nextSibling.nextSibling.innerHTML = resp.qty;

    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function increase_qt_product(id_produs) {
  $.ajax({
    url: "/product/increase-qt",
    type: "POST",
    data: {
      product_id: id_produs,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      show_cart();
      cart_content();
        // instance.previousSibling.previousSibling.innerHTML = resp.qty;
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function date_livrare() {
  $.ajax({
    url: "/user/date_livrare",
    type: "POST",

    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      $('#comenzi-container').empty().append(resp);
      // show_comenzi();
        // instance.previousSibling.previousSibling.innerHTML = resp.qty;
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function date_facturare() {
  $.ajax({
    url: "/user/date_facturare",
    type: "POST",

    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      $('#adrese_facturare_container').empty().append(resp);
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function adauga_adresa_livrare() {
  var nume = $("#nume_adresa_noua").val();
  var telefon = $("#telefon_adresa_noua").val();
  var adresa = $("#adresa_adresa_noua").val();
  var email = $("#email_adresa_noua").val();
  var judet = $("#judet_adresa_noua").val();
  var oras = $("#oras_adresa_noua").val();


  $.ajax({
    url: "/user/adauga_adresa_livrare",
    type: "POST",
    data: {
      nume: nume,
      telefon: telefon,
      adresa: adresa,
      email: email,
      judet: judet,
      oras: oras,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        $("#nume_adresa_noua").val("");
        $("#adresa_adresa_noua").val("");
        $("#email_adresa_noua").val("");
        $("#telefon_adresa_noua").val("");
        $('#judet_adresa_noua').find('option[value="0"').attr('selected','selected');
        $('#oras_adresa_noua').empty().append('<option value="0" selected="selected">Selecteaza orasul</option>');

        date_livrare();

        alertify.success(resp.msg);
      }
      if (resp.code == "300") {
        var messages = resp.error_all;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function sterge_adresa_livrare(id_adresa) {
  $.ajax({
    url: "/user/sterge_adresa_livrare",
    type: "POST",
    data: {
      idAdresa: id_adresa,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      date_livrare();

    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function modifica_adresa_livrare(id_adresa) {
  var nume = $("#nume_adresa_edit").val();
  var telefon = $("#telefon_adresa_edit").val();
  var adresa = $("#adresa_adresa_edit").val();
  var email = $("#email_adresa_edit").val();
  var judet = $("#judet_adresa_edit").val();
  var oras = $("#oras_adresa_edit").val();

  $.ajax({
    url: "/user/modifica_adresa_livrare",
    type: "POST",
    data: {
      idAdresa: id_adresa,
      nume: nume,
      telefon: telefon,
      adresa: adresa,
      email: email,
      judet: judet,
      oras: oras,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      date_livrare();
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function adauga_adresa_facturare() {
  if ($('#fizica_noua').prop("checked") == true) {
    var tip_firma = 'fizica';
    var cui = 0;
    var reg = 0;
  }
  if ($('#juridica_noua').prop("checked") == true) {
    var tip_firma = 'juridica';
    var cui = $('#cui_noua').val();
    var reg = $('#reg_noua').val();
  }
  var nume = $("#nume_adresa_noua").val();
  var adresa = $("#adresa_adresa_noua").val();
  var judet = $("#judet_adresa_noua").val();
  var oras = $("#oras_adresa_noua_fact").val();


  $.ajax({
    url: "/user/adauga_adresa_facturare",
    type: "POST",
    data: {
      nume: nume,
      adresa: adresa,
      judet: judet,
      oras: oras,
      tip_firma: tip_firma,
      cui: cui,
      reg:reg,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        $("#nume_adresa_noua").val("");
        $("#adresa_adresa_noua").val("");
        $('#cui_noua').val("");
        $('#reg_noua').val("");
        $('#judet_adresa_noua').find('option[value="0"').attr('selected','selected');
        $('#oras_adresa_noua_fact').empty().append('<option value="0" selected="selected">Selecteaza orasul</option>');

        date_facturare();

        alertify.success(resp.msg);
      }
      if (resp.code == "300") {
        var messages = resp.error_all;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function sterge_adresa_facturare(id_adresa) {
  $.ajax({
    url: "/user/sterge_adresa_facturare",
    type: "POST",
    data: {
      idAdresa: id_adresa,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      date_facturare();

    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function modifica_adresa_facturare(id_adresa) {
  var nume = $("#nume_adresa_edit_fact").val();
  var adresa = $("#adresa_adresa_edit_fact").val();
  var judet = $("#judet_adresa_edit_fact").val();
  var oras = $("#oras_adresa_edit_fact").val();
  if ($('#juridica_edit').prop('checked') == true)
  {
    var tip_firma = 'juridica';
    var cui = $('#cui').val();
    var reg = $('#reg').val();
  }
  if ($('#fizica_edit').prop('checked') == true) {
    var tip_firma = 'fizica';
    var cui = 0;
    var reg = 0;
  }
  $.ajax({
    url: "/user/modifica_adresa_facturare",
    type: "POST",
    data: {
      idAdresa: id_adresa,
      nume: nume,
      adresa: adresa,
      judet: judet,
      oras: oras,
      cui: cui,
      reg: reg,
      tip_firma : tip_firma,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      date_facturare();
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function ordoneaza_colectie(criteriu, slug)
{
  $.ajax({
    url: "/ordoneaza_colectie",
    type: "POST",
    data: {
      criteriu: criteriu,
      slug : slug,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      var products = resp;
      var $html = '';
        $.each(products, function(key, value)
        {
            $html += '<a href = "/produs/'+value.link+'" class = "produs">';
               if(value.nou == 'da'){
                   $html += '<div class = "produs-nou">NOU</div>';
               }
               var k = 0;
               $.each(value.poze, function(key, value2){
                    if(k == 0){
                       $html += '<img class="full-width first-image" src="/storage/thumb/width:350/' +value2 + '" alt="Imagine" loading="lazy"/>';
                    }
                    if(k == 1){
                        $html += '<img class="full-width second-image" src="/storage/thumb/width:350/' + value2 + '" alt="Imagine" loading="lazy"/>';
                    }
                    k++;
               });
               $html += '<div class = "swiper-produs-descriere">'+value.nume+'</div>';
               if(value.promotie == 'da')
                  {
                  $html += '<div class = "produs-nou"><img src = "images/percentage.svg"></div>';
                  $html += '<div class = "reducere-pret-container">';
                  $html += '<div class = "swiper-produs-pret-container" style = "color:red;">' + value.pret + '<div class = "swiper-produs-lei">LEI</div></div>'
                  $html += ' <div class = "swiper-produs-pret-container pret-container-reducere">'+value.pretvechi+ '</div>'
                  $html += '</div>';
                } else {
                  $html += ' <div class = "swiper-produs-pret-container">' + value.pret +'<div class = "swiper-produs-lei">LEI</div></div>'
                  }
            $html += '</a>';
        });
        $('.produse-container').empty().append($html);
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function get_colectie_by_color(culoare, slug)
{
  $.ajax({
    url: "/get_colectie_by_color",
    type: "POST",
    data: {
      culoare: culoare,
      slug : slug,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      var products = resp;
      var $html = '';
        $.each(products, function(key, value)
        {
            $html += '<a href = "/produs/'+value.link+'" class = "produs">';
               if(value.nou == 'da'){
                   $html += '<div class = "produs-nou">NOU</div>';
               }
               var k = 0;
               $.each(value.poze, function(key, value2){
                    if(k == 0){
                       $html += '<img class="full-width first-image" src="/storage/thumb/width:350/' +value2 + '" alt="Imagine" loading="lazy"/>';
                    }
                    if(k == 1){
                        $html += '<img class="full-width second-image" src="/storage/thumb/width:350/' + value2 + '" alt="Imagine" loading="lazy"/>';
                    }
                    k++;
               });
               $html += '<div class = "swiper-produs-descriere">'+value.nume+'</div>';
               if(value.promotie == 'da')
                  {
                  $html += '<div class = "produs-nou"><img src = "images/percentage.svg"></div>';
                  $html += '<div class = "reducere-pret-container">';
                  $html += '<div class = "swiper-produs-pret-container" style = "color:red;">' + value.pret + '<div class = "swiper-produs-lei">LEI</div></div>'
                  $html += ' <div class = "swiper-produs-pret-container pret-container-reducere">'+value.pretvechi+ '</div>'
                  $html += '</div>';
                } else {
                  $html += ' <div class = "swiper-produs-pret-container">' + value.pret +'<div class = "swiper-produs-lei">LEI</div></div>'
                  }
            $html += '</a>';
        });
        $('.produse-container').empty().append($html);
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function place_order() {
  var livrare_address = $('#adresa_livrare').val();
  var livrare_name = $('#nume_livrare').val();
  var livrare_phone = $('#telefon_livrare').val();
  var livrare_county = $('.livrare-judet').val();
  var livrare_city = $('.livrare-oras').val();
  var livrare_email = $('#email_livrare').val();

  var facturare_address = "";
  var facturare_name = "";
  var facturare_county = "";
  var facturare_city = "";
  var facturare_cui = "";
  var facturare_regcom = "";

  var metoda_facturare = '';
  var metoda_plata = '';
  var metoda_livrare = 'curier';

  var voucher = "";
  var reducere_aplicata = "";

  if ($('#voucher_saved').val() != "")
  {
    voucher = $('#voucher_saved').val();
    reducere_aplicata = $('#reducere_saved').val();
  }
  if ($('#fizica').prop("checked") == true) {
    metoda_facturare = 'fizica';
  }
  if ($('#juridica').prop("checked") == true) {
    metoda_facturare = 'juridica';
    facturare_cui = $('#facturare_cui').val();
    facturare_regcom = $('#facturare_reg_com').val();
    console.log(facturare_cui);
    console.log(facturare_regcom);
  }
  if ($('#cash').prop("checked") == true) {
    metoda_plata = 'cash';
  }
  if ($('#card').prop("checked") == true) {
    metoda_plata = 'card';
  }
  if ($('#diferite').prop("checked") == true || $('.select-billing-address').val() != "")
  {
    console.log('diferite');
    var facturare_address = $('#adresa_facturare').val();
    var facturare_name = $('#nume_facturare').val();
    var facturare_county = $('.facturare-judet').val();
    var facturare_city = $('.facturare-oras').val();
  }

  $.ajax({
    url: "/trimite-comanda",
    type: "POST",
    data: {
      livrare_address: livrare_address,
      livrare_name: livrare_name,
      livrare_phone: livrare_phone,
      livrare_county: livrare_county,
      livrare_city: livrare_city,
      livrare_email: livrare_email,
      facturare_address: facturare_address,
      facturare_name: facturare_name,
      facturare_county: facturare_county,
      facturare_city: facturare_city,
      facturare_cui: facturare_cui,
      facturare_regcom: facturare_regcom,
      metoda_facturare: metoda_facturare,
      metoda_plata: metoda_plata,
      metoda_livrare: metoda_livrare,
      voucher: voucher,
      reducere_aplicata:reducere_aplicata,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      console.log(resp);
      if (resp.status == 200)
      {
          alertify.success(resp.msg);
          var formular = JSON.parse(resp.formular);
          
          $('.mobilpay-redirect').attr('action', formular.postUrl);
          $('.mobilpay-redirect input[name="env_key"]').val(formular.env_key);
          $('.mobilpay-redirect input[name="data"]').val(formular.data);
          $('.mobilpay-redirect').trigger('submit');

          console.log(window.totalComanda);
          fbq('track', 'Purchase', {
            currency: 'RON', 
            value:window.totalComanda,
          });
          console.log('Total:' + window.totalComanda);
          gtag('event', 'conversion', {
            'send_to': 'AW-385818801/29_OCO6FkYECELHB_LcB',
            'value': parseFloat(window.totalComanda).toFixed(2),
            'currency': 'RON',
        });
      }
      if (resp.status == 250)
      {
        location.href='/return-order?&orderId=' + resp.order_id;

        console.log(window.totalComanda);
        fbq('track', 'Purchase', {
          currency: 'RON', 
          value: parseFloat(window.totalComanda).toFixed(2),
        });
        console.log('Total:' + resp.order_id);
        gtag('event', 'conversion', {
          'send_to': 'AW-385818801/29_OCO6FkYECELHB_LcB',
          'value': parseFloat(window.totalComanda).toFixed(2),
          'currency': 'RON',
          'transaction_id' : "142",
      });
      }
      if (resp.status == 300) {
        var messages = resp.error_all;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
      if (resp.status == 400) {
        alertify.error(resp.msge);
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function subscribe()
{
  var email_user = $('#newsletter_email').val();

  $.ajax({
    url: "/subscribe_user",
    type: "POST",
    data: {
      email_user: email_user,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        alertify.success(resp.msg);

        fbq('track', 'CompleteRegistration', {
          email: $('#newsletter_email').val(), 
        });

        $('#newsletter_email').val("")

        
      }
      if (resp.code == 300) {
        var messages = resp.error;
        $.each(messages, function (key, value) {
          alertify.error(messages[key][0]);
        });
      }
      
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function istoric_comenzi() {
  $.ajax({
    url: "/user/istoric_comenzi",
    type: "GET",
   
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        var comenzi = resp.comenzi;
        if (comenzi.length > 0)
        {
          var $html = '';
          $.each(comenzi, function (key, value) {
            if (key % 2 == 0) {
              $html += '<div class = "comenzi-row comenz-row-background comanda">'
                    
            } else {
              $html += '<div class = "comenzi-row comanda">'
            }

            $html += '<div class = "comenzi-text">' + value.id_order + '</div>'
            $html += '<div class = "comenzi-text">' + parseFloat(value.total) + '</div>'
            $html += '<div class = "comenzi-text">' + value.data + '</div>'
            $html += '<div class = "comenzi-text">' + value.payment_method + '</div>'
            $html += '<div class = "detalii-imagine istoric-comenzi-btn" onclick="open_comanda_detalii('+ value.id_order + ')"><img src = "images/view.svg" class = "full-width"></div>';
            $html += '</div>';
          });
            $('#istoric_comenzi_container').empty().append($html);
        }
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}
function open_comanda_detalii(id_order)
{
  $.ajax({
    url: "/user/order-content",
    type: "POST",
    data: {
      id_order: id_order,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        var comanda = resp.order_content;
        $('.istoric-comenzi-title').text('Comanda nr. ' + comanda.id_order);

        var produse = comanda.order_products;
        var html = '';

       $.each(produse, function(key, value) {
            html += '<div class = "istoric-comenzi-item">';
            html += '<div class = "istorc-comenzi-poza"><img src = "/storage/' + value.options['image'] + '" class = "full-width-cover"></div>';
            html += '<div class = "isoric-comenzi-descriere-container">';
            html += '<div class = "istoric-comenzi-produs">' + value.product_name + '</div>';
            html += '<div class = "istoric-comenzi-descriere-informatii"> Marime: ' + value.options['dimensions'] + '</div>';
            if(value.options['monograma'] !=0)
            {
              html += '<div class = "istoric-comenzi-descriere-informatii">Monograma: ' + value.options['monograma'] + '</div>';
            }
            html += '<div class = "istoric-comenzi-descriere-informatii">Inaltime: '+ value.options['inaltime']  +'</div>';
            html += '<div class = "istoric-comenzi-descriere-informatii">Cantitate: ' + value.qty + '</div>';
            html += '</div>';
            html += '<div class = "istoric-comenzi-descriere-dreapta">';
            html += '<div class = "istoric-comenzi-pret-linie">';
            html += '<div class = "istoric-comenzi-pret-da">' + value.price + '<span>Lei</span></div>';
            html += '<div class = "istoric-comenzi-pret-da">' + value.price * value.qty + '<span>Lei</span></div>';
            html += '</div>';
            if(value.options['old_price'] > 0)
            {
              html += '<div class = "istoric-comenzi-pret-custom"><div class = "pret-linie-taiat"></div>' +value.options['old_price'] +' <span>Lei</span></div>';
            }
            html += '</div>';
            html += '</div>';
       });

       if(comanda.voucher)
       {
        $('#subtotal_comanda').text(comanda.total - comanda.delivery_price + parseFloat(comanda.reducere));
        $('#livrare_comanda').text(comanda.delivery_price);
        $('#total_comanda').text(comanda.total);
        $('#voucher-comanda-total').css('display','flex');
        $('#cod_voucher').text(comanda.voucher);
        $('#reducere_voucher').text(- comanda.reducere);
       }
       else{
        $('#subtotal_comanda').text(comanda.total - comanda.delivery_price);
        $('#livrare_comanda').text(comanda.delivery_price);
        $('#total_comanda').text(comanda.total);
       }

       $('.istoric-comenzi-scroll').empty().append(html);

        if($('.overlay-page').hasClass('overlay-page-active')){
        }
        else
        {
            $('.overlay-page').addClass('overlay-page-active');
            $('.istoric-comenzi-container').addClass('istoric-comenzi-container-active');
        }
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function search(data) {
  var text = $("#search-input").val();
  $.ajax({
    url: "/cauta",
    type: "POST",
    data: {
      text: text,
    },
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        // $('#input-error').hide();
        var html = "";
        var produse = resp.produse;

        if (produse.length == 0) {
          html += ' Nu s-au gasit rezultate pentru cautarea: ' + text + '';
          $("#search_results").empty().append(html);
          $('.search-rezultate').empty();
          $('.vezi-mai-multe-search').css('display','none');
        } else {
          $('.search-rezultate').empty().append(produse.length + ' rezultate');
          
          $.each(produse, function (key, value) {
            
            html += '<a class = "search-produs-item" href="/produs/'+ value.link +'">';
              html += '<div class = "search-produs-image"><img src ='+ value.poze['1'] +' class = "full-width-cover"></div>';
              html += '<div class = "search-produs-descriere-container">';
                html += '<div class = "search-produs-descriere">' + value.nume +'</div>';
                html += ' <div class= "search-produs-pret">'+ value.pret+' <span>LEI</span></div>'
              html += '</div>';
            html += '</a>'
          
          });
          $('#search-second').css('display','flex');
          $("#search_results").empty().append(html);
          $('.vezi-mai-multe-search').css('display','flex');
          $('.vezi-mai-multe-search').attr('href','/search?search=' + text + '');
        }
      }
      if (resp.code == "300") {
        var messages = resp.msg;
        $.each(messages, function (key, value) {
          $("#search_results").empty().text(messages[key][0]);
          $('.search-rezultate').empty();
          $('.vezi-mai-multe-search').css('display','none');
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}

function see_all(text)
{
  console.log(text);
  $.ajax({
    url: "/search?search="+text,
    type: "POST",
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    success: function (resp) {
      if (resp.code == 200) {
        window.location.href = resp;
      }
      if (resp.code == "300") {
        var messages = resp.msg;
        $.each(messages, function (key, value) {
           alertify.error(messages[key][0]);
        });
      }
    },
    error: function (p1, p2) {
      alertify.error(p1.responseJSON.message);
    },
  });
}