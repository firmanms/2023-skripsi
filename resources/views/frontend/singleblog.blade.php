@extends('frontend.layouts.app')

@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="{{ url('') }}">Home</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
          <li>{{$artikel->judul  }}</li>
        </ol>
        <h2>Blog</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">


            <article class="entry">

              <div class="entry-img">
                <img src="{{ url('storage/'.$artikel->image .'') }}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.html">{{$artikel->judul  }}</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><a href="#"><i class="bi bi-folder"></i></a> {{$artikel->category->nama  }}</li>
                  <li class="d-flex align-items-center"><a href="#"><i class="bi bi-clock"></i></a> {{ \Carbon\Carbon::parse($artikel->publish)->format('d M Y') }}</li>
                  @if (Auth::check())
                  <li class="d-flex align-items-center">
                    <form action="{{ route(''.$linknya.'')}}" id="form1" method="POST" enctype="multipart/form-data">
                        {{-- <form action="{{ route('likedislike.update',$artikel->id) }}" method="POST" enctype="multipart/form-data"> --}}
                          @csrf
                          {{-- @method('PUT') --}}
                          <input type="hidden" name="id" value="{{ $artikel->id }}">
                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" name="like" value="1">
                          <input type="hidden" name="dislike" value="">
                    <a href="javascript:;" onclick="document.getElementById('form1').submit();"><i class="bi bi-hand-thumbs-up{{$fill_like}}"></i></a> {{$hitung_like  }}
                    </form>
                   </li>
                  <li class="d-flex align-items-center">
                    <form action="{{ route(''.$linknya.'')}}" id="form2" method="POST" enctype="multipart/form-data">
                        {{-- <form action="{{ route('likedislike.update',$artikel->id) }}" method="POST" enctype="multipart/form-data"> --}}
                          @csrf
                          {{-- @method('PUT') --}}
                          <input type="hidden" name="id" value="{{ $artikel->id }}">
                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" name="like" value="">
                          <input type="hidden" name="dislike" value="1">
                          <a href="javascript:;" onclick="document.getElementById('form2').submit();"><i class="bi bi-hand-thumbs-down{{$fill_dislike}}"></i></a> {{$hitung_dislike  }}
                        </form>
                    </li>
                  @else
                  <li class="d-flex align-items-center"><i class="bi bi-hand-thumbs-up"></i> {{$hitung_like  }}</li>
                  <li class="d-flex align-items-center"><i class="bi bi-hand-thumbs-down"></i> {{$hitung_dislike  }}</li>
                  @endif
                  <li class="d-flex align-items-center"><a href="{{ route('artikel.read',$artikel->slug) }}"><i class="bi bi-chat-dots"></i></a> {{ $hitung_komentar }} Komentar</li>
                </ul>
              </div>

              <div class="entry-content">
                {!! $artikel->description !!}
              </div>

            </article><!-- End blog entry -->
            <div class="blog-comments">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{ $message }}</p>
                </div>
              @endif
                @if (Route::has('login'))

                    @auth
                    <div class="reply-form">
                        <h4>Komentar</h4>
                        <p>Isian </p>
                        <form action="{{ url('/submitkomentar') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-lg" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $artikel->id }}" class="form-control">
                        <input type="hidden" name="parent_id" id="parent_id" class="form-control" >
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control" >

                          <div class="row">
                            <div class="col form-group">
                              <input type="text" readonly class="form-control"  id="replyComment">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col form-group">
                              <textarea name="komentar" class="form-control" placeholder="komentar kamu*"></textarea>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">Komentar</button>

                        </form>

                      </div>
                    @else

                    @endauth

                @endif
                <br>
                <h4 class="comments-count">{{ $hitung_komentar }} Comments</h4>

                @foreach ($artikel->komentars as $row)
                @php
                $iduser=$row->user_id;
                $nama_user= \App\Models\User::where('id',$iduser)->first();
                //  dd($nama_user);
                @endphp
                <div id="comment-2" class="comment">
                  <div class="d-flex">
                    {{-- <div class="comment-img"><img src="assets/img/blog/comments-2.jpg" alt=""></div> --}}
                    <div>
                      <h5>{{ $nama_user->name }} <a href="javascript:void(0)" onclick="balasKomentar({{ $row->id }}, '{{ $row->komentar }}')" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                      <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($row->updated_at)->format('d M Y') }}</time>
                      <p>
                        {{ $row->komentar }}
                      </p>
                    </div>
                  </div>
                  @foreach ($row->child as $val)
                    @php
                    $iduser2=$val->user_id;
                    $nama_user2= \App\Models\User::where('id',$iduser2)->first();
                    //  dd($nama_user);
                    @endphp
                  <div id="comment-reply-1" class="comment comment-reply">
                    <div class="d-flex">
                      {{-- <div class="comment-img"><img src="assets/img/blog/comments-3.jpg" alt=""></div> --}}
                      <div>
                        <h5>{{ $nama_user2->name }} </h5>
                        <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($val->updated_at)->format('d M Y') }}</time>
                        <p>
                            {{ $val->komentar }}
                        </p>
                      </div>
                    </div>

                  </div><!-- End comment reply #1-->
                  @endforeach
                </div><!-- End comment #2-->
                @endforeach



              </div><!-- End blog comments -->

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <!--<h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="">
                  <input type="text">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div> End sidebar search formn-->

              <!--<h3 class="sidebar-title">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <li><a href="#">General <span>(25)</span></a></li>
                  <li><a href="#">Lifestyle <span>(12)</span></a></li>
                  <li><a href="#">Travel <span>(5)</span></a></li>
                  <li><a href="#">Design <span>(22)</span></a></li>
                  <li><a href="#">Creative <span>(8)</span></a></li>
                  <li><a href="#">Educaion <span>(14)</span></a></li>
                </ul>
              </div> End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                @foreach ( $artikelrecents as $artikelrecent)
                <div class="post-item clearfix">
                  <img src="{{ url('storage/'.$artikelrecent->image .'') }}" alt="">
                  <h4><a href="{{ route('artikel.read',$artikelrecent->slug) }}">{{ $artikelrecent->judul }}</a></h4>
                  <time datetime="2020-01-01">{{ \Carbon\Carbon::parse($artikelrecent->publish)->format('d M Y') }}</time>
                </div>
                @endforeach

              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">F.A.Q</h3>
              <div class="container" data-aos="fade-up">

                <div class="row">
                  <div class="col-lg-12">
                    <!-- F.A.Q List 1-->
                    <div class="accordion accordion-flush" id="faqlist1">
                      @foreach($faqs as $faq)
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $faq->id }}">
                            {{ $faq->value }}
                          </button>
                        </h2>
                        @foreach ($faq->child as $val)
                        <div id="faq-content-{{ $val->parent_id }}" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                          <div class="accordion-body">
                            {{ $val->value }}
                          </div>
                        </div>
                        @endforeach
                      </div>
                      @endforeach



                    </div>
                  </div>
                </div>

              </div>
              <!-- End sidebar Faq-->

              <!--<h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div> End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        setting-name: setting-value
      });
    });
  </script>
    <script>
        function balasKomentar(id, title) {
            $('#formReplyComment').show();
            $('#parent_id').val(id)
            $('#replyComment').val(title)
        }
      </script>
      <script type="text/javascript">
        $(document).ready(function(){
          $('.your-class').slick({
            setting-name: setting-value
          });
        });
      </script>
@endsection
