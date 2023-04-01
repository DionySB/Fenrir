<H5>Página de Contatos</H5><br>

<p> {{$name}} </p>

@if ($name == 'Diony') {
  <p> O nome é {{$name}}!</p>
  <a href='/contact/product'> <p> Confira os produtos vinculados ao usuário {{$name}}</p> </a>
  @else
  <p> O nome não é Diony </p>

@endif
}