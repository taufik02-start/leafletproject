<!---Start Corousel Section-->
<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= base_url('asset/dist/img/kelapa.jpg')?>" class="d-block w-100 " alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('asset/dist/img/mesinvco.jpg')?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('asset/dist/img/vco.jpg')?>" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!---End Corousel Section-->

<!---Start Description Section-->
<div id="description" class="offset">
  <div class="col-12 narrow text-center">
    <h1>VCO Kab Padang Pariaman</h1>
    <p class="lead">Sistem Pendukung Keputusan Cerdas dalam Pengembangan Agroindustri Kelapa-VCO</p>
      <a class="btn btn-success btn-md" href="authentikasi">Masuk</a>
  </div>
</div>
<!--End Description Section-->

<!---Start Artikel Section-->
<div class="jumbotron">
  <div class="container">
    <div class="col-md-12">
      <h3 class="heading">Artikel</h3>
      <div class="heading-underline"></div>
    </div>
    <div class="row">
      <div class="card-deck">
        <div class="card">
          <img class="card-img-top" src="<?=base_url('asset/dist/img/artikel.png')?>" style="height:13rem" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Pengenalan Website</h5>
            <h6 class="card-subtitle mb-2 text-muted">Senin, 19 Agustus 2019</h6>
            <p class="card-text">Sistem pendukung keputusan cerdas dalam pengembangan agroindustri kelapa-VCO dibuat melalui pendekatan sistem.</p>
            <a href="<?=base_url('home/loadArtikel') ?>" class="btn btn-success">Baca Selengkapnya</a>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="<?= base_url('asset/dist/img/kelapa.jpg')?>" style="height:13rem" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Panduan Penggunaan</h5>
            <h6 class="card-subtitle mb-2 text-muted">Senin, 19 Agustus 2019</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-success">Baca Selengkapnya</a>
          </div>
        </div>
        <div class="card">
          <img class="card-img-top" src="<?= base_url('asset/dist/img/kelapa.jpg')?>" style="" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Cara Daftar</h5>
            <h6 class="card-subtitle mb-2 text-muted">Senin, 19 Agustus 2019</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-success">Baca Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!---End Description Section-->

<!---Start Short Message Section-->
<div class="col-12 narrow text-center">
  <p class="lead">Masih belum punya akun? Ayo buruan daftar gratis</p>
  <a class="btn btn-success btn-md" href="<?= base_url('authentikasi/register') ?>" target="">Daftar</a>
</div>
<!---End Short Message Section-->
