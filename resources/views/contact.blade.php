@extends('parts.template')

@section('title', $meta->title)
@section('description', $meta->description)
@section('keywords', $meta->keywords)

@section('content')
<div class = 'container'>
    <div class = "big-title">Contact</div>
    <div class = "contact-container">
        <div class = "contact-container-left"><img src = "{{ thumb('width:600', $imagine->imagine) }}" class = "full-width"></div>
        <div class = "border-contact"></div>
        <div class = "contact-container-right">
            <div class = "contact-text">Hai sa ne cunoastem! Ne poti trimite un e-mail sau ne poti telefona folosind datele de mai jos.</div>
            <div class = "contact-title">Telefon</div>
            <div class = "contact-linie"></div>
            <a href = "tel:{{config('settings.contact_phone')}}" class = "contact-link">{{config('settings.contact_phone')}}</a>
            <div class = "contact-title">Adresa de email</div>
            <div class = "contact-linie"></div>
            <a href = "mailto:{{config('settings.email_primire')}}" class = "contact-link">{{config('settings.email_primire')}}</a>
        </div>
    </div>
    <div class = "form-contact">
        <div class = "form-contact-text">Foloseste formularul urmator pentru a ne trimite intrebarile sau sugestiile tale legat de Nighters.ro</div>
        <input type="text" class="contact-input" id="nume_contact" placeholder="Nume">
        <input type="number" class="contact-input" id="telefon_contact" placeholder="Telefon">
        <input type="email" class="contact-input" id="email_contact" placeholder="Adresa de e-mail">
        <textarea class = "contact-textarea"  id="mesaj_contact"  placeholder = "Mesaj"></textarea>
        <div class = "contact-terms-container">
            <label class="checkbox">
                <input type="checkbox" id="acord_contact" name="acord_contact" value="checkbox" class = "checkbox-input">
                <span></span>
            </label>
            <div class="terms-text">Sunt de acord cu <a class = "terms-text-link" href = "/politica">Politica de Confidentialitate</a> a datelor personale.</div>
        </div>
        <button class = "submit-btn"  onclick="mail_contact();">Trimite</button>
    </div>
</div>
@endsection