@extends('main.main')

@section('content')


<section class="slider_section">
  <div class="slider_container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" id="first">
        <div class="carousel-item active">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-7">
                <div class="detail-box">
                  <h1>
                    Welcome To Our <br>
                    Gift Shop
                  </h1>
                  <p>
                    Welcome to Our Gift Shop! Explore our curated selection for every occasion.
                  </p>
                  <a href="register.html">
                    Register now!
                  </a>
                </div>
              </div>
              <div class="col-md-5 ">
                <div class="img-box">
                  <img src="images/slider-img.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>
      <div class="carousel_btn-box">
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
          <span class="sr-only">Previous</span>
        </a>
        <img src="images/line.png" alt="" />
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- end slider section -->
</div>
<!-- end hero area -->

<!-- shop section -->

<section class="shop_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Latest Products
      </h2>
    </div>
    <div class="row" id="productbox">
      @foreach ($items as $newitem)
      <div class="col-sm-6 col-md-4 col-lg-3">
      <div class="box">
        <a href="{{url('detail/'.$newitem->id)}}">
        <div class="img-box">
          <img src="{{$newitem->image}}" alt="">
        </div>
        <div class="detail-box">
          <h6>
          {{$newitem->name}}
          </h6>
          <h6>
          <b>
            <!-- Price -->
            Rp
            <span>
            {{ number_format($newitem->price, 0, ',', '.') }}
            </span>
          </b>

          </h6>
        </div>
        <!-- <div class="new">
        <span>
        New
        </span>
        </div> -->
        </a>
      </div>
      </div>
    @endforeach




    </div>

    <div class="d-flex justify-content-between align-items-center mt-5" >

      <div class="text-left px-6">
        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} of {{ $items->total() }} results
      </div>
      <nav aria-label="Page navigation">
        <ul class="pagination px-6">

          @if ($items->onFirstPage())
        <li class="page-item disabled" >
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
        </li>
      @else
      <li class="page-item">
      <a class="page-link" href="{{ $items->previousPageUrl() }}" tabindex="-1">&laquo;</a>
      </li>
    @endif


          @foreach ($items->links()->elements[0] as $page => $url)
        @if ($page == $items->currentPage())
      <li class="page-item active" aria-current="page">
      <a class="page-link" href="#">{{ $page }}</a>
      </li>
    @else
    <li class="page-item">
    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
    </li>
  @endif
      @endforeach


          @if ($items->hasMorePages())
        <li class="page-item">
        <a class="page-link" href="{{ $items->nextPageUrl() }}">&raquo;</a>
        </li>
      @else
      <li class="page-item disabled">
      <a class="page-link" href="#" aria-disabled="true">&raquo;</a>
      </li>
    @endif
        </ul>
      </nav>
    </div>

</section>
<!-- end client section -->


@endsection