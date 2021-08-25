@extends('parts.template')

@section('title', 'Schimbare parola - Nighters')

@section('content')
<div id="uitat_parola_page">
    <div class="container">
    <div class="big-title">Schimbare parola</div>
        <p>Ati solicitat schimbarea parolei pentru contul cu adresa de email <?php echo $email;?>.</p>

        <input type="password" id="parola_noua" class="my-account-input" placeholder="Parola noua" />

        <button class = "register-btn recuperare-parola" onclick="schimba_parola_mail();" type="button">schimba</button>
    </div>
</div>
<input type="hidden" id="uid" value="<?php echo $uid;?>"
@endsection