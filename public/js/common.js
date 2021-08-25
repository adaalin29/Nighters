$(document).ready(function(){
    $('.header-search').click(function(){
        if($('.search-container').hasClass('search-container-active')){
            $('.search-container').removeClass('search-container-active');
        }else{
            $('.search-container').addClass('search-container-active');
            $('.my-account').removeClass('my-account-active');
            $('.cos-cumparaturi').removeClass('cos-cumparaturi-active');

            $('.my-account').removeClass('my-account-active');
            $('.new-account').removeClass('new-account-active');
            $('.forgot-password-sidenav').removeClass('forgot-password-sidenav-active');
        }
    });

    $('.close-search').click(function(){
        if($('.search-container').hasClass('search-container-active')){
            $('.search-container').removeClass('search-container-active');
        }
        if($('.new-account').hasClass('new-account-active')){
            $('.new-account').removeClass('new-account-active');
        }
        if($('.my-account').hasClass('my-account-active')){
            $('.my-account').removeClass('my-account-active');
        }
        if($('.forgot-password-sidenav').hasClass('forgot-password-sidenav-active')){
            $('.forgot-password-sidenav').removeClass('forgot-password-sidenav-active');
        }
        if($('.cos-cumparaturi').hasClass('cos-cumparaturi-active')){
            $('.cos-cumparaturi').removeClass('cos-cumparaturi-active');
            $('.overlay-cos').removeClass('overlay-cos-active');
        }
    });

    $('.user_inactive').click(function(){
        if($('.my-account').hasClass('my-account-active')){
            $('.my-account').removeClass('my-account-active');
        }else{
            $('.my-account').addClass('my-account-active');
            $('.search-container').removeClass('search-container-active');
        }
        $('.forgot-password-sidenav').removeClass('forgot-password-sidenav-active');
        $('.new-account').removeClass('new-account-active');
        $('.cos-cumparaturi').removeClass('cos-cumparaturi-active');
    });

    $('.close-my-account').click(function(){
        if($('.my-account').hasClass('my-account-active')){
            $('.my-account').removeClass('my-account-active');
        }
        if($('.new-account').hasClass('new-account-active')){
            $('.new-account').removeClass('new-account-active');
        }
        if($('.forgot-password-sidenav').hasClass('forgot-password-sidenav-active')){
            $('.forgot-password-sidenav').removeClass('forgot-password-sidenav-active');
        }
        if($('.cos-cumparaturi').hasClass('cos-cumparaturi-active')){
            $('.cos-cumparaturi').removeClass('cos-cumparaturi-active');
            $('.overlay-cos').removeClass('overlay-cos-active');
            $('html').css('overflow-y', 'visible');
        }
    });

    $('.no-account-text').click(function(){
        if($('.new-account').hasClass('new-account-active')){
            $('.new-account').removeClass('new-account-active');
        }else{
            $('.new-account').addClass('new-account-active');
            $('.my-account').removeClass('my-account-active');
        }
    });

    $('.forgot-password-btn').click(function () {
        if($('.new-account').hasClass('new-account-active')){
            $('.new-account').removeClass('new-account-active');
        }
        $('.forgot-password-sidenav').addClass('forgot-password-sidenav-active');
        $('.my-account').removeClass('my-account-active');
    });

    $('.deja-cont').click(function(){
        $('.my-account').addClass('my-account-active');
        $('.forgot-password-sidenav').removeClass('forgot-password-sidenav-active');
    });

    $('.checkout').click(function(){
        if($('.cos-cumparaturi').hasClass('cos-cumparaturi-active')){
            $('.cos-cumparaturi').removeClass('cos-cumparaturi-active');
            $('.overlay-cos').removeClass('overlay-cos-active');
        }else{
            $('.cos-cumparaturi').addClass('cos-cumparaturi-active');
            $('.overlay-cos').addClass('overlay-cos-active');
          
            $('html').css('overflow-y', 'hidden');
        }
        
        $('.search-container').removeClass('search-container-active');
        $('.my-account').removeClass('my-account-active');
        $('.new-account').removeClass('new-account-active');
        $('.forgot-password-sidenav').removeClass('forgot-password-sidenav-active');
    });

    $('#ghid-masuri').click(function () {
        $('#ghid-masuri-table').fadeIn().show();
    });
    $('#close-ghid-masuri').click(function () {
        $('#ghid-masuri-table').fadeOut().hide();
    });



    //analytics codes



});


