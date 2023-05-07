@extends('frontend.layouts.app')

@section('content')
<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">

        <div class="container aos-init aos-animate" data-aos="fade-up">
          <div class="row gx-0">

            <div class="col-lg-6 d-flex flex-column justify-content-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="content">
                <h3>About {{ $profils->nama_kantor }}</h3>
                <h2>{{ $profils->nama_kantor }}</h2>
                <p>
                    {!! $profils->selayang_pandang !!}
                </p>
                {{-- <div class="text-center text-lg-start">
                  <a href="#" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                    <span>Read More</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div> --}}
              </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center aos-init aos-animate" data-aos="zoom-out" data-aos-delay="200">
                <img src="{{ url('storage/'.$profils->foto_kepala .'') }}" class="img-fluid" alt="">
            </div>

          </div>
        </div>

      </section>
      <!-- ======= End About Section ======= -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">

        <div class="container aos-init aos-animate" data-aos="fade-up">

          <header class="section-header">
            <h2>Services</h2>
            <p>Mudah, Akurat dan Terpercaya</p>
          </header>

          <div class="row gy-4">

            <div class="col-lg-6 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <div class="service-box blue">
                <i class="ri-discuss-line icon"></i>
                <h3>SWAB</h3>
                <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
                {{-- <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a> --}}
              </div>
            </div>

            <div class="col-lg-6 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
              <div class="service-box orange">
                <i class="ri-discuss-line icon"></i>
                <h3>Consultation</h3>
                <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                {{-- <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a> --}}
              </div>
            </div>

          </div>

        </div>

      </section>
      <!-- =======End Services Section ======= -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2></h2>
          <p>Hubungi Kami</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Alamat</h3>
                  <p>{{ $profils->alamat_kantor }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Telp / WhatsApp</h3>
                  <p>{{ $profils->telp_kantor }}<br>{{ $profils->hotline_wa }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Kami</h3>
                  <p>{{ $profils->email_kantor }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Jam Operasi</h3>
                  {!! $profils->jam_layanan !!}
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <iframe src="{!! $profils->url_map !!}" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            {{-- <form action="forms/contact.php" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Nama" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Judul" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Terimakasih</div>

                  <button type="submit">Kirim Pesan</button>
                </div>

              </div>
            </form> --}}

          </div>

        </div>

      </div>

    </section>
    <!-- End Contact Section -->

  </main><!-- End #main -->
  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        setting-name: setting-value
      });
    });
  </script>
@endsection
