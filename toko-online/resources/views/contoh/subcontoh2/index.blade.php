@foreach($fruits as $fruit)
<h1>Name: {{ $fruit['name'] }}</h1>
<p>Stock: {{$fruit['stock']}}</p>
@endforeach