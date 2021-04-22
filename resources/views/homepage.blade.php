@extends('app')

@section('content')
<div class="col-lg-3">

    <h1 class="my-4">Urua</h1>
    <a href="{{ route('categories.index') }}">
        <div class="list-group">
            @forelse ($categories as $category)
                <span href="#" class="list-group-item">{{ $category->name }}</span>
            @empty
                <span class="list-group-item">No Category Listed.</span>
            @endforelse
        </div>
    </a>

</div>
<!-- /.col-lg-3 -->

<div class="col-lg-9">

    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
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

    <div class="row">
        @forelse ($products as $product)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="{{ route('products.index') }}"><img height="200" class="card-img-top" src="{{ asset($product->image) }}" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                </h4>
                <h5>${{ $product->price }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                        </div>
            <div class="card-footer clear-fix">
                <small class="text-muted float-left">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                <p class="card-text float-right">
                    {{ $product->category->name }}
                </p>
                </div>
            </div>
            </div>
        @empty

        @endforelse
    </div>
    <!-- /.row -->

</div>
<!-- /.col-lg-9 -->
@endsection
