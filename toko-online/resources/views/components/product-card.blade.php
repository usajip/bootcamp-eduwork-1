<div class="card">
  <div style="background-image: url('{{$image}}');width: 100%;height: 200px;background-size: cover;background-position: center;background-repeat: no-repeat;"></div>
    {{-- <img class="card-img-top" src="{{ $image }}" alt="Card image cap"> --}}
    <div class="card-body">
      <h5 class="card-title">{{ $category }}</h5>
      <h5 class="card-title">{{ $name }}</h5>
      <p class="card-text">{{ $description }}</p>
      <p>Rp{{number_format($price, 0, ",", ".")}}</p>
      <a href="{{ $buttonRoute }}" class="btn btn-primary">{{$buttonText}}</a>
    </div>
</div>