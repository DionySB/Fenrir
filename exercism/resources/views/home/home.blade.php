@extends('layouts.app')
@section('content')

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Abrir Modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal de Exemplo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Este é um exemplo de modal do Bootstrap.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>

<section class="hero-section">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/img-icon-png-clipart-green.png" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/img-icon-png-clipart.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/img-icon-png-clipart-green.png" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</section>

<section class="search-section">
  <div class="container">
    <h2>Encontre a melhor opção para você</h2>
    <form action="{{ route('search') }}" method="GET" class="search-form">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Digite sua busca">
        <button class="btn btn-primary" type="submit">Buscar</button>
      </div>
    </form>
  </div>
</section>

<section class="classes-section">
  <div class="container">
    <h2>Aulas e treinos</h2>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <img src="img/img-icon-png-clipart-green.png" class="card-img-top" alt="Aula 1">
          <div class="card-body">
            <h5 class="card-title">Aula 1</h5>
            <p class="card-text">Descrição da aula 1.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="img/img-icon-png-clipart-green.png" class="card-img-top" alt="Aula 2">
          <div class="card-body">
            <h5 class="card-title">Aula 2</h5>
            <p class="card-text">Descrição da aula 2.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img src="img/img-icon-png-clipart-green.png" class="card-img-top" alt="Aula 3">
          <div class="card-body">
            <h5 class="card-title">Aula 3</h5>
            <p class="card-text">Descrição da aula 3.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="plans-section">
  <div class="container">
    <h2>Escolha o plano ideal para você</h2>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Plano</th>
            <th>Benefícios</th>
            <th>Preço</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Plano Básico</td>
            <td>Benefícios do Plano Básico</td>
            <td>R$ 99,90</td>
            <td><a href="#" class="btn btn-primary">Contratar</a></td>
          </tr>
          <tr>
            <td>Plano Intermediário</td>
            <td>Benefícios do Plano Intermediário</td>
            <td>R$ 149,90</td>
            <td><a href="#" class="btn btn-primary">Contratar</a></td>
          </tr>
          <tr>
            <td>Plano Avançado</td>
            <td>Benefícios do Plano Avançado</td>
            <td>R$ 199,90</td>
            <td><a href="#" class="btn btn-primary">Contratar</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section class="contact-section">
  <div class="container">
    <h2>Entre em contato</h2>
    <p>Preencha o formulário abaixo para entrar em contato conosco.</p>
    <form action="{{ route('contact') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Mensagem</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>
</section>

<section class="newsletter-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Receba nossas novidades</h2>
        <p>Inscreva-se para receber as últimas atualizações e ofertas exclusivas por email.</p>
      </div>
      <div class="col-md-6">
        <form action="{{ route('newsletter') }}" method="POST" class="newsletter-form">
          @csrf
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Digite seu email" required>
            <button class="btn btn-primary" type="submit">Inscrever-se</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('styles')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

@endsection


