@extends('layouts.app')

@section('content')

<div class="container-fluid px-0" id="contact-form">
  <div class="row no-gutters">
    <div class="col-md-6 order-md-1">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Informações</h5>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sed fermentum orci. Aliquam at magna vel ante dignissim dapibus a ac risus.</p>
          <p class="card-text">Fusce varius maximus luctus. Etiam blandit ipsum ut congue eleifend. Aliquam tristique diam a commodo semper.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 order-md-2">
      <div class="contact-container">
        <h1 class="text-center">Entre em contato</h1>
        <form>
          <div class="form-group">
            <label for="nome">Nome completo</label>
            <input type="text" class="form-control" id="nome" placeholder="Seu nome">
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" placeholder="Seu e-mail">
          </div>
          <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" placeholder="Seu telefone">
          </div>
          <div class="form-group">
            <label for="assunto">Assunto</label>
            <input type="text" class="form-control" id="assunto" placeholder="Assunto">
          </div>
          <div class="form-group">
            <label for="mensagem">Mensagem</label>
            <textarea class="form-control" id="mensagem" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>
        <div class="contact-info">
          <p class="text-center"><i class="fa fa-map-marker"></i> Rua Tertuliano Francisco s., 0000 - Maetinga - Bahia</p>
          <p class="text-center"><i class="fa fa-phone"></i> (00) 0000-0000</p>
          <p class="text-center"><i class="fa fa-envelope"></i> contato.contato@gmail.com</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('css/contact.css')}}" rel="stylesheet">
@endsection