<!DOCTYPE html>
<html lang="en">

<head>
  <title>Purwarupa Kadaster 3 Dimensi</title>
  <!-- Required meta tags -->

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap & Jquery -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- mapSystem -->
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Widgets/InfoBox/InfoBoxDescription.css" rel="stylesheet" type="text/css">
  <script src=" https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.js "></script>
  <link href=" https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.css " rel="stylesheet">
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Cesium.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Widgets/widgets.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdn.rawgit.com/mrdoob/three.js/r128/examples/js/loaders/GLTFLoader.js"></script>
  <script src="https://cdn.rawgit.com/mrdoob/three.js/r128/examples/js/loaders/OBJLoader.js"></script>

  <link rel="stylesheet" href="assets/css/style.css" />

  <style>
    #cesiumMap {
      position: absolute;
      height: 100%;
      margin-top: auto;
      padding: 0;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>


<body>
  <header>
    <nav>
      <div class="nav-logo">
        <div class="name-logo">
          <h1>Purwarupa Representasi RRR <br> Administrasi Pertanahan 3D</h1>
        </div>
      </div>
      <div class="search">
        <form id="searchForm" class="d-flex">
          <input class="form-control me-2" type="search" id="searchInput" placeholder="Cari" aria-label="Cari" autocomplete="off">
          <button class="asbn btn btn-secondary" type="button" role="button" id="searchButton">Cari</button>
        </form>
        <div id="autocompleteResults"></div>
      </div>
      <div class="nav-menu">
        <ul class="nav-menu-group">
          <li>
            <a href="#" id="layer-toggle" title="Show layer panel"><i class="bi bi-stack"></i> Layer</a>
          </li>
          <li><a href="#" id="clip-toggle" title="klip">klip</a></li>
          <li>
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-camera-video-fill"></i> Kamera</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li class="dropdown-li" id="first-camera"><a class="dropdown-item" href="#">Siola</a></li>
              <li class="dropdown-li" id="second-camera"><a class="dropdown-item" href="#">Balai pemuda</a></li>
              <li class="dropdown-li" id="third-camera"><a class="dropdown-item" href="#">Rusunawa</a></li>
            </ul>
          </li>
          <li>
            <a id="meassure" class="" href="#" title="Ukur Jarak"><i class="bi bi-rulers"></i></a>
          </li>
          <li>
            <a id="minimap" class="" href="#" title="Minimap/Inset"><i class="bi bi-globe-asia-australia"></i></a>
          </li>
          <li>
            <a id="helpCesium" href="#" title="Bantuan Penggunaan"><i class="bi bi-question-circle-fill"></i></a>
          </li>
          <span class="divider solid"></span>
          <?php if (isset($_SESSION['islogin'])) : ?>
            <li><a href="/dashboard" title="Dashboard"><i class="bi bi-grid-3x3-gap-fill"></i></a></li>
            <li><a href="/action/auth/process_logout.php" title="Logout"><i class="bi bi-box-arrow-right"></i></a></li>
          <?php else : ?>
            <li><a href="/auth/login.php" title="Masuk"><i class="bi bi-box-arrow-in-right"></i></a></li>
          <?php endif ?>
        </ul>
        <div id="hamb"><i class="bi bi-list"></i></div>
      </div>
    </nav>
  </header>

  <!-- Preload -->
  <div class="preload">
    <div class="bg-loading">
      <img src="assets/img/load.gif">
      <p>Mengambil data dan merender konten.</p>
    </div>
  </div>

  <div class="loader-container d-none">
    <div class="loader"></div>
  </div>


  <!-- Modal welcome -->
  <div class="modal fade" id="welcome" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="welcomeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header p-2">
          <h1 class="modal-title fs-5" id="welcomeLabel">Selamat Datang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4 class="text-center mb-3">Purwarupa Aplikasi Administrasi Pertanahan 3 Dimensi</h4>
          <p class="text-center">Aplikasi ini dirancang untuk memfasilitasi pemahaman dan pengelolaan
            <br><b>representasi hak, batasan, dan tanggung jawab</b> dalam konteks pertanahan modern.
            <br>Melalui teknologi 3D, Anda dapat menjelajahi detail
            <br>hak atas tanah, batas properti, dan tanggung jawab yang menyertainya
            <br>dengan cara yang lebih interaktif dan informatif.
          </p>
          <p class="text-center">Aplikasi ini menyediakan alat yang diperlukan untuk memastikan kepatuhan terhadap
            <br>peraturan pertanahan yang berlaku, membantu dalam penyusunan dokumen legal, dan mempermudah proses pengambilan keputusan terkait properti.
          </p>
          <p class="text-center">Mari kita mulai perjalanan menuju pengelolaan tanah yang lebih transparan dan efisien</p>
        </div>
      </div>
    </div>
  </div>


  <div class="cesiumContainer" style="display:inline-flex; position: absolute; bottom:10px; right:10px; z-index:100;">
    <div class="saran">
      <button type="button" class="cesium-button" id="btn-usability" data-bs-toggle="modal" data-bs-target="#usability">Lakukan Tes</button>
    </div>

    <!-- button kritik dan saran -->
    <div class="saran">
      <button type="button" class="cesium-button" id="btn-critics" data-bs-toggle="modal" data-bs-target="#critics">Kritik & Saran</button>
    </div>

    <!-- button F&Q -->
    <div class="faq">
      <button type="button" class="cesium-button" id="btn-faq" data-bs-toggle="modal" data-bs-target="#faq">FAQ</button>
    </div>

    <!-- button welcome (hidden) -->
    <div class="d-none welcome">
      <button type="button" class="cesium-button" id="btn-welcome" data-bs-toggle="modal" data-bs-target="#welcome">Welcome</button>
    </div>
  </div>

  <!-- Modal critics and suggestions -->
  <div class="modal fade" id="critics" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="criticsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header p-2">
          <h1 class="modal-title fs-5" id="criticsLabel">critics and suggestions</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="mycritics" action="/critics/_critics.php" method="post" target="_blank">
            <div class="mb-3 p-1">
              <textarea name="critics" rows="10" placeholder="Typing Here..." style="width: 100%;" autofocus required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal F&Q -->
  <div class="modal fade" id="faq" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="faqLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header p-2">
          <h1 class="modal-title fs-5" id="faqLabel">Frequently Asked Questions (FAQ)</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modal-dialog-scrollable">
          <ol>
            <li>
              <p><strong>Apa itu kadaster 3 dimensi?</strong></p>
              <p>Kadaster 3 dimensi adalah sistem pendataan dan pendaftaran tanah yang mencakup informasi ruang tiga dimensi. Sistem ini memungkinkan pemetaan dan dokumentasi properti tidak hanya pada bidang datar dua dimensi, tetapi juga dalam ruang tiga dimensi, termasuk lantai atas dan bawah tanah.&nbsp;</p>
            </li>
            <li>
              <p><strong>Hak apa saja yang dapat tercakup dalam kadaster 3 dimensi?</strong></p>
              <p>Dalam kadaster 3 dimensi, hak atas tanah dibedakan menjadi beberapa lapisan atau zona. Misalnya, satu zona untuk permukaan tanah, satu lagi untuk ruang di bawah tanah, dan satu lagi mungkin untuk ruang udara di atasnya. Setiap zona dapat memiliki pemilik yang berbeda dengan hak yang terdefinisi dengan jelas. Misalnya, seseorang dapat memiliki apartemen di lantai 5 tanpa memiliki seluruh gedung.</p>
            </li>
            <li>
              <p><strong>Apa batasan yang ada dalam sistem kadaster 3 dimensi?</strong></p>
              <p>Batasan dalam kadaster 3 dimensi terutama berkaitan dengan penggunaan ruang atas dan bawah. Setiap unit properti memiliki batas vertikal yang jelas yang tidak boleh dilanggar oleh unit lain tanpa persetujuan. Misalnya, tidak boleh ada penetrasi struktural yang mengganggu unit lain di atas atau di bawahnya.</p>
            </li>
            <li>
              <p><strong>Bagaimana tanggung jawab dibagi dalam kadaster 3 dimensi?</strong></p>
              <p>Tanggung jawab umumnya dibagi berdasarkan posisi vertikal dan horizontal properti. Misalnya, pemilik apartemen bertanggung jawab atas perawatan dan perbaikan dalam unitnya, sementara asosiasi pemilik gedung mungkin bertanggung jawab untuk area umum dan fasilitas bersama seperti atap, lift, dan sistem utilitas utama.</p>
            </li>
            <li>
              <p><strong>Apa manfaat utama dari sistem kadaster 3 dimensi?</strong></p>
              <p>Manfaat utama termasuk peningkatan kejelasan dalam kepemilikan dan batasan properti, penyelesaian sengketa yang lebih efektif, dan peningkatan efisiensi dalam pengelolaan dan pembangunan ruang vertikal. Ini juga mendukung inovasi dalam pengembangan real estat dan infrastruktur perkotaan.</p>
            </li>
            <li>
              <p><strong>Bagaimana kadaster 3 dimensi mempengaruhi pembangunan bertingkat?</strong></p>
              <p>Kadaster 3 dimensi sangat penting dalam pembangunan bertingkat karena memungkinkan pengembang dan pemilik properti untuk memisahkan hak kepemilikan secara vertikal. Ini memudahkan penjualan dan pengelolaan unit individu dalam gedung bertingkat, seperti apartemen atau kantor.</p>
            </li>
            <li>
              <p><strong>Apakah kadaster 3 dimensi mempengaruhi nilai properti?</strong></p>
              <p>Ya, kadaster 3 dimensi dapat mempengaruhi nilai properti karena memberikan kejelasan hukum yang lebih besar tentang apa yang dimiliki seseorang secara tepat. Ini meningkatkan keamanan hukum bagi pemilik dan potensial investor, yang bisa meningkatkan nilai properti tersebut.</p>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <main>
    <!-- Modal Room -->
    <div class="modal fade" id="detailRoom" tabindex="-1" aria-labelledby="detailRoomLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailRoomLabel">Rincian Ruangan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            detail room
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Organizer -->
    <div class="modal fade" id="detailOrganizer" tabindex="-1" aria-labelledby="detailOrganizerLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailOrganizerLabel">Rincian Pengelola</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            detail organizer
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Tenant -->
    <div class="modal fade" id="detailTenant" tabindex="-1" aria-labelledby="detailTenantLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailTenantLabel">Detail Penyewa/Pengguna</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            detail tenant
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Right -->
    <div class="modal fade" id="detailRight" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="detailRightLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailRightLabel">Hak</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            / right
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Restriction -->
    <div class="modal fade" id="detailRestriction" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="detailRestrictionLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailRestrictionLabel">Batasan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            / restriction
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Responsibilities -->
    <div class="modal fade" id="detailResponsibilities" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="detailResponsibilitiesLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailResponsibilitiesLabel">Tanggung Jawab</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            / responsibilities
          </div>
        </div>
      </div>
    </div>

    <!-- Panel Usability Test -->
    <div class="offcanvas offcanvas-start usab-test" data-bs-backdrop="static" tabindex="-1" id="usab" aria-labelledby="usabLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="usabLabel">Usability Test Guide</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, numquam maiores. Voluptatibus, culpa non. Iusto perspiciatis fugiat quidem magnam perferendis:
          <ol>
            <li>Petunjuk 1</li>
            <li>Perintah 2</li>
            <li>Penjelasan 3</li>
            <li>Contoh 4</li>
            <li>Tugas 5</li>
          </ol>
        </div>
      </div>
      <button class="btn btn-warning" id="usab-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#usab" aria-controls="usab">Usability Test Guide ⬆️</button>
    </div>

    <!-- Panel Layer Data -->
    <div class="layer-panel card">
      <div class="card-body p-2">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Siola
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2" role="group" aria-label="First group">
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Objek Fisik</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Objek Yuridis</button>
                  </div>
                </div>

                <div class="siola-building-layer-panel p-2 m-1">
                  <div class="mb-2">
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllShow">Tampilkan semua</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllHide">Sembunyikan semua</button>
                  </div>

                  <p class="mb-1">Objek atas tanah </p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_5" id="siolaLevel_5"> Lantai 5</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_4" id="siolaLevel_4"> Lantai 4</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_3" id="siolaLevel_3"> Lantai 3</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_2" id="siolaLevel_2"> Lantai 2</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_1" id="siolaLevel_1"> Lantai 1</label>

                  <p class="mt-2 mb-1">Objek bawah tanah</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_0" id="siolaLevel_0"> Tiang pancang atau pondasi bangunan</label>

                </div>

                <div class="siola-legal-layer-panel p-2 m-1 d-none">
                  <p class="mb-1">Unit Hak</p>
                  <ul id="myUL">
                    <li>
                      <span class="caret caret-down"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1all" id="siolaLegal_1all"> Lantai 1 <a href="#" id="zoomToSiolaLegal_1all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested active">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a1" id="siolaLegal_1a1">
                            L1.1 <a href="#" id="zoomToSiolaLegal_1a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a2" id="siolaLegal_1a2">
                            L1.2 <a href="#" id="zoomToSiolaLegal_1a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a3" id="siolaLegal_1a3">
                            L1.3 <a href="#" id="zoomToSiolaLegal_1a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a4" id="siolaLegal_1a4">
                            L1.4 <a href="#" id="zoomToSiolaLegal_1a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a5" id="siolaLegal_1a5">
                            L1.5 <a href="#" id="zoomToSiolaLegal_1a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a6" id="siolaLegal_1a6">
                            L1.6 <a href="#" id="zoomToSiolaLegal_1a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a7" id="siolaLegal_1a7">
                            L1.7 <a href="#" id="zoomToSiolaLegal_1a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a8" id="siolaLegal_1a8">
                            L1.8 <a href="#" id="zoomToSiolaLegal_1a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a9" id="siolaLegal_1a9">
                            L1.9 <a href="#" id="zoomToSiolaLegal_1a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1a10" id="siolaLegal_1a10">
                            L1.10 <a href="#" id="zoomToSiolaLegal_1a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2all" id="siolaLegal_2all"> Lantai 2 <a href="#" id="zoomToSiolaLegal_2all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a1" id="siolaLegal_2a1">
                            L2.1 <a href="#" id="zoomToSiolaLegal_2a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a2" id="siolaLegal_2a2">
                            L2.2 <a href="#" id="zoomToSiolaLegal_2a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a3" id="siolaLegal_2a3">
                            L2.3 <a href="#" id="zoomToSiolaLegal_2a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a4" id="siolaLegal_2a4">
                            L2.4 <a href="#" id="zoomToSiolaLegal_2a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a5" id="siolaLegal_2a5">
                            L2.5 <a href="#" id="zoomToSiolaLegal_2a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a6" id="siolaLegal_2a6">
                            L2.6 <a href="#" id="zoomToSiolaLegal_2a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2a7" id="siolaLegal_2a7">
                            L2.7 <a href="#" id="zoomToSiolaLegal_2a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3all" id="siolaLegal_3all"> Lantai 3 <a href="#" id="zoomToSiolaLegal_3all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a1" id="siolaLegal_3a1">
                            L3.1 <a href="#" id="zoomToSiolaLegal_3a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a2" id="siolaLegal_3a2">
                            L3.2 <a href="#" id="zoomToSiolaLegal_3a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a3" id="siolaLegal_3a3">
                            L3.3 <a href="#" id="zoomToSiolaLegal_3a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a4" id="siolaLegal_3a4">
                            L3.4 <a href="#" id="zoomToSiolaLegal_3a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a5" id="siolaLegal_3a5">
                            L3.5 <a href="#" id="zoomToSiolaLegal_3a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a6" id="siolaLegal_3a6">
                            L3.6 <a href="#" id="zoomToSiolaLegal_3a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3a7" id="siolaLegal_3a7">
                            L3.7 <a href="#" id="zoomToSiolaLegal_3a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_4all" id="siolaLegal_4all"> Lantai 4 <a href="#" id="zoomToSiolaLegal_4all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_4a1" id="siolaLegal_4a1">
                            L4.1 <a href="#" id="zoomToSiolaLegal_4a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_4a2" id="siolaLegal_4a2">
                            L4.2 <a href="#" id="zoomToSiolaLegal_4a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_4a3" id="siolaLegal_4a3">
                            L4.3 <a href="#" id="zoomToSiolaLegal_4a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_5all" id="siolaLegal_5all"> Lantai 5 <a href="#" id="zoomToSiolaLegal_5all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_5a1" id="siolaLegal_5a1">
                            L5.1 <a href="#" id="zoomToSiolaLegal_5a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <p class="mt-2 mb-1">Batas Ruang</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_BT" id="siolaLegal_BT"> Ruang atas tanah <a href="#" id="zoomToSiolaLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_BB" id="siolaLegal_BB"> Underground
                    space <a href="#" id="zoomToSiolaLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_GSB" id="siolaLegal_GSB"> Garis Sempadan Bangunan <a href="#" id="zoomToSiolaLegal_bb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaParcel" id="siolaParcel"> Parcel Siola </label>
                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="ealla" id="ealla"> Tata Bangunan S</label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e1" id="e1">
                            Tata Bangunan S.1 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e2" id="e2">
                            Tata Bangunan S.2 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e3" id="e3">
                            Tata Bangunan S.3 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e4" id="e4">
                            Tata Bangunan S.4 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e5" id="e5">
                            Tata Bangunan S.5 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e6" id="e6">
                            Tata Bangunan S.6 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e7" id="e7">
                            Tata Bangunan S.7 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e8" id="e8">
                            Tata Bangunan S.8 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e9" id="e9">
                            Tata Bangunan S.9 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e10" id="e10">
                            Tata Bangunan S.10 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e11" id="e11">
                            Tata Bangunan S.11 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e12" id="e12">
                            Tata Bangunan S.12 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e13" id="e13">
                            Tata Bangunan S.13 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e14" id="e14">
                            Tata Bangunan S.14 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e15" id="e15">
                            Tata Bangunan S.15 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e16" id="e16">
                            Tata Bangunan S.16 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e17" id="e17">
                            Tata Bangunan S.17 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e18" id="e18">
                            Tata Bangunan S.18 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e19" id="e19">
                            Tata Bangunan S.19 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e20" id="e20">
                            Tata Bangunan S.20 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e21" id="e21">
                            Tata Bangunan S.21 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e22" id="e22">
                            Tata Bangunan S.22 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e23" id="e23">
                            Tata Bangunan S.23 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e24" id="e24">
                            Tata Bangunan S.24 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e25" id="e25">
                            Tata Bangunan S.25 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e26" id="e26">
                            Tata Bangunan S.26 </label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Balai Pemuda
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2" role="group" aria-label="First group">
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Objek Fisik</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Objek Yuridis</button>
                  </div>
                </div>

                <div class="balai-building-layer-panel p-2 m-1">
                  <div class="mb-2">
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllShow">Tampilkan semua</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllHide">Sembunyikan semua</button>
                  </div>

                  <p class="mb-1">Objek atas tanah </p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_2" id="balaiLevel_2"> Atap</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_1" id="balaiLevel_1"> Lantai 1</label>

                  <p class="mt-2 mb-1">Objek bawah tanah</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_0" id="balaiLevel_0"> Basement</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_00" id="balaiLevel_00"> Tiang pancang atau pondasi bangunan</label>
                </div>

                <div class="balai-legal-layer-panel p-2 m-1 d-none">
                  <p class="mb-1">Unit Hak</p>
                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0all" id="balaiLegal_0all"> Lantai 0 <a href="#" id="zoomToBalaiLegal_0all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a1" id="balaiLegal_0a1">
                            L0.1 <a href="#" id="zoomToBalaiLegal_0a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a2" id="balaiLegal_0a2">
                            L0.2 <a href="#" id="zoomToBalaiLegal_0a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a3" id="balaiLegal_0a3">
                            L0.3 <a href="#" id="zoomToBalaiLegal_0a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a4" id="balaiLegal_0a4">
                            L0.4 <a href="#" id="zoomToBalaiLegal_0a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a5" id="balaiLegal_0a5">
                            L0.5 <a href="#" id="zoomToBalaiLegal_0a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a6" id="balaiLegal_0a6">
                            L0.6 <a href="#" id="zoomToBalaiLegal_0a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a7" id="balaiLegal_0a7">
                            L0.7 <a href="#" id="zoomToBalaiLegal_0a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a8" id="balaiLegal_0a8">
                            L0.8 <a href="#" id="zoomToBalaiLegal_0a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0a9" id="balaiLegal_0a9">
                            L0.9 <a href="#" id="zoomToBalaiLegal_0a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret caret-down"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1all" id="balaiLegal_1all"> Lantai 1 <a href="#" id="zoomToBalaiLegal_1all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested active">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a1" id="balaiLegal_1a1">
                            L1.1 <a href="#" id="zoomToBalaiLegal_1a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a2" id="balaiLegal_1a2">
                            L1.2 <a href="#" id="zoomToBalaiLegal_1a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a3" id="balaiLegal_1a3">
                            L1.3 <a href="#" id="zoomToBalaiLegal_1a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a4" id="balaiLegal_1a4">
                            L1.4 <a href="#" id="zoomToBalaiLegal_1a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a5" id="balaiLegal_1a5">
                            L1.5 <a href="#" id="zoomToBalaiLegal_1a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a6" id="balaiLegal_1a6">
                            L1.6 <a href="#" id="zoomToBalaiLegal_1a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a7" id="balaiLegal_1a7">
                            L1.7 <a href="#" id="zoomToBalaiLegal_1a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a8" id="balaiLegal_1a8">
                            L1.8 <a href="#" id="zoomToBalaiLegal_1a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a9" id="balaiLegal_1a9">
                            L1.9 <a href="#" id="zoomToBalaiLegal_1a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a10" id="balaiLegal_1a10">
                            L1.10 <a href="#" id="zoomToBalaiLegal_1a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a11" id="balaiLegal_1a11">
                            L1.11 <a href="#" id="zoomToBalaiLegal_1a11"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a12" id="balaiLegal_1a12">
                            L1.12 <a href="#" id="zoomToBalaiLegal_1a12"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1a13" id="balaiLegal_1a13">
                            L1.13 <a href="#" id="zoomToBalaiLegal_1a13"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <p class="mt-2 mb-1">Batas Ruang</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_BT" id="balaiLegal_BT"> Ruang atas tanah <a href="#" id="zoomToBalaiLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_BB" id="balaiLegal_BB"> Ruang bawah tanah <a href="#" id="zoomToBalaiLegal_bb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_GSB" id="balaiLegal_GSB"> Garis Sempadan Bangunan <a href="#" id="zoomToBalaiLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="balaiParcel" id="balaiParcel"> Parcel Balai Pemuda</label>
                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="eallb" id="eallb"> Tata Bangunan B</label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e27" id="e27">
                            Tata Bangunan B.1 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e28" id="e28">
                            Tata Bangunan B.2 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e29" id="e29">
                            Tata Bangunan B.3 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e30" id="e30">
                            Tata Bangunan B.4 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e31" id="e31">
                            Tata Bangunan B.5 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e32" id="e32">
                            Tata Bangunan B.6 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e33" id="e33">
                            Tata Bangunan B.7 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e34" id="e34">
                            Tata Bangunan B.8 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e35" id="e35">
                            Tata Bangunan B.9 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e36" id="e36">
                            Tata Bangunan B.10 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e37" id="e37">
                            Tata Bangunan B.11 </label>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Rusunawa
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                  <div class="btn-group me-2" role="group" aria-label="First group">
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Objek Fisik</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Objek Yuridis</button>
                  </div>
                </div>

                <div class="rusunawa-building-layer-panel p-2 m-1">
                  <div class="mb-2">
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllShow">Tampilkan semua</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllHide">Sembunyikan semua</button>
                  </div>

                  <p class="mb-1">Objek atas tanah </p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_r" id="rusunawaLevel_r"> Atap</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_5" id="rusunawaLevel_5"> Lantai 5</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_4" id="rusunawaLevel_4"> Lantai 4</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_3" id="rusunawaLevel_3"> Lantai 3</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_2" id="rusunawaLevel_2"> Lantai 2</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_1" id="rusunawaLevel_1"> Lantai 1</label>

                  <p class="mt-2 mb-1">Objek bawah tanah</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_0" id="rusunawaLevel_0"> Tiang pancang atau pondasi bangunan</label>
                </div>

                <div class="rusunawa-legal-layer-panel p-2 m-1 d-none">
                  <p class="mb-1">Unit Hak</p>

                  <ul id="myUL">
                    <li>
                      <span class="caret caret-down"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1all" id="rusunawaLegal_1all"> Lantai 1 <a href="#" id="zoomToRusunawaLegal_1all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested active">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a1" id="rusunawaLegal_1a1">
                            L1.1 <a href="#" id="zoomToRusunawaLegal_1a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a2" id="rusunawaLegal_1a2">
                            L1.2 <a href="#" id="zoomToRusunawaLegal_1a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a3" id="rusunawaLegal_1a3">
                            L1.3 <a href="#" id="zoomToRusunawaLegal_1a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a4" id="rusunawaLegal_1a4">
                            L1.4 <a href="#" id="zoomToRusunawaLegal_1a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a5" id="rusunawaLegal_1a5">
                            L1.5 <a href="#" id="zoomToRusunawaLegal_1a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a6" id="rusunawaLegal_1a6">
                            L1.6 <a href="#" id="zoomToRusunawaLegal_1a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a7" id="rusunawaLegal_1a7">
                            L1.7 <a href="#" id="zoomToRusunawaLegal_1a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a8" id="rusunawaLegal_1a8">
                            L1.8 <a href="#" id="zoomToRusunawaLegal_1a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a9" id="rusunawaLegal_1a9">
                            L1.9 <a href="#" id="zoomToRusunawaLegal_1a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a10" id="rusunawaLegal_1a10">
                            L1.10 <a href="#" id="zoomToRusunawaLegal_1a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a11" id="rusunawaLegal_1a11">
                            L1.11 <a href="#" id="zoomToRusunawaLegal_1a11"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a12" id="rusunawaLegal_1a12">
                            L1.12 <a href="#" id="zoomToRusunawaLegal_1a12"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a13" id="rusunawaLegal_1a13">
                            L1.13 <a href="#" id="zoomToRusunawaLegal_1a13"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a14" id="rusunawaLegal_1a14">
                            L1.14 <a href="#" id="zoomToRusunawaLegal_1a14"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a15" id="rusunawaLegal_1a15">
                            L1.15 <a href="#" id="zoomToRusunawaLegal_1a15"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a16" id="rusunawaLegal_1a16">
                            L1.16 <a href="#" id="zoomToRusunawaLegal_1a16"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a17" id="rusunawaLegal_1a17">
                            L1.17 <a href="#" id="zoomToRusunawaLegal_1a17"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2all" id="rusunawaLegal_2all"> Lantai 2 <a href="#" id="zoomToRusunawaLegal_2all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a1" id="rusunawaLegal_2a1">
                            L2.1 <a href="#" id="zoomToRusunawaLegal_2a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a2" id="rusunawaLegal_2a2">
                            L2.2 <a href="#" id="zoomToRusunawaLegal_2a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a3" id="rusunawaLegal_2a3">
                            L2.3 <a href="#" id="zoomToRusunawaLegal_2a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a4" id="rusunawaLegal_2a4">
                            L2.4 <a href="#" id="zoomToRusunawaLegal_2a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a5" id="rusunawaLegal_2a5">
                            L2.5 <a href="#" id="zoomToRusunawaLegal_2a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a6" id="rusunawaLegal_2a6">
                            L2.6 <a href="#" id="zoomToRusunawaLegal_2a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a7" id="rusunawaLegal_2a7">
                            L2.7 <a href="#" id="zoomToRusunawaLegal_2a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a8" id="rusunawaLegal_2a8">
                            L2.8 <a href="#" id="zoomToRusunawaLegal_2a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a9" id="rusunawaLegal_2a9">
                            L2.9 <a href="#" id="zoomToRusunawaLegal_2a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a10" id="rusunawaLegal_2a10">
                            L2.10 <a href="#" id="zoomToRusunawaLegal_2a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a11" id="rusunawaLegal_2a11">
                            L2.11 <a href="#" id="zoomToRusunawaLegal_2a11"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a12" id="rusunawaLegal_2a12">
                            L2.12 <a href="#" id="zoomToRusunawaLegal_2a12"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a13" id="rusunawaLegal_2a13">
                            L2.13 <a href="#" id="zoomToRusunawaLegal_2a13"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a14" id="rusunawaLegal_2a14">
                            L2.14 <a href="#" id="zoomToRusunawaLegal_2a14"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a15" id="rusunawaLegal_2a15">
                            L2.15 <a href="#" id="zoomToRusunawaLegal_2a15"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a16" id="rusunawaLegal_2a16">
                            L2.16 <a href="#" id="zoomToRusunawaLegal_2a16"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a17" id="rusunawaLegal_2a17">
                            L2.17 <a href="#" id="zoomToRusunawaLegal_2a17"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a18" id="rusunawaLegal_2a18">
                            L2.18 <a href="#" id="zoomToRusunawaLegal_2a18"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a19" id="rusunawaLegal_2a19">
                            L2.19 <a href="#" id="zoomToRusunawaLegal_2a19"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a20" id="rusunawaLegal_2a20">
                            L2.20 <a href="#" id="zoomToRusunawaLegal_2a20"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a21" id="rusunawaLegal_2a21">
                            L2.21 <a href="#" id="zoomToRusunawaLegal_2a21"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a22" id="rusunawaLegal_2a22">
                            L2.22 <a href="#" id="zoomToRusunawaLegal_2a22"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a23" id="rusunawaLegal_2a23">
                            L2.23 <a href="#" id="zoomToRusunawaLegal_2a23"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a24" id="rusunawaLegal_2a24">
                            L2.24 <a href="#" id="zoomToRusunawaLegal_2a24"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a25" id="rusunawaLegal_2a25">
                            L2.25 <a href="#" id="zoomToRusunawaLegal_2a25"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a26" id="rusunawaLegal_2a26">
                            L2.26 <a href="#" id="zoomToRusunawaLegal_2a26"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3all" id="rusunawaLegal_3all"> Lantai 3 <a href="#" id="zoomToRusunawaLegal_3all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a1" id="rusunawaLegal_3a1">
                            L3.1 <a href="#" id="zoomToRusunawaLegal_3a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a2" id="rusunawaLegal_3a2">
                            L3.2 <a href="#" id="zoomToRusunawaLegal_3a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a3" id="rusunawaLegal_3a3">
                            L3.3 <a href="#" id="zoomToRusunawaLegal_3a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a4" id="rusunawaLegal_3a4">
                            L3.4 <a href="#" id="zoomToRusunawaLegal_3a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a5" id="rusunawaLegal_3a5">
                            L3.5 <a href="#" id="zoomToRusunawaLegal_3a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a6" id="rusunawaLegal_3a6">
                            L3.6 <a href="#" id="zoomToRusunawaLegal_3a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a7" id="rusunawaLegal_3a7">
                            L3.7 <a href="#" id="zoomToRusunawaLegal_3a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a8" id="rusunawaLegal_3a8">
                            L3.8 <a href="#" id="zoomToRusunawaLegal_3a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a9" id="rusunawaLegal_3a9">
                            L3.9 <a href="#" id="zoomToRusunawaLegal_3a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a10" id="rusunawaLegal_3a10">
                            L3.10 <a href="#" id="zoomToRusunawaLegal_3a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a11" id="rusunawaLegal_3a11">
                            L3.11 <a href="#" id="zoomToRusunawaLegal_3a11"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a12" id="rusunawaLegal_3a12">
                            L3.12 <a href="#" id="zoomToRusunawaLegal_3a12"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a13" id="rusunawaLegal_3a13">
                            L3.13 <a href="#" id="zoomToRusunawaLegal_3a13"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a14" id="rusunawaLegal_3a14">
                            L3.14 <a href="#" id="zoomToRusunawaLegal_3a14"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a15" id="rusunawaLegal_3a15">
                            L3.15 <a href="#" id="zoomToRusunawaLegal_3a15"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a16" id="rusunawaLegal_3a16">
                            L3.16 <a href="#" id="zoomToRusunawaLegal_3a16"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a17" id="rusunawaLegal_3a17">
                            L3.17 <a href="#" id="zoomToRusunawaLegal_3a17"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a18" id="rusunawaLegal_3a18">
                            L3.18 <a href="#" id="zoomToRusunawaLegal_3a18"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a19" id="rusunawaLegal_3a19">
                            L3.19 <a href="#" id="zoomToRusunawaLegal_3a19"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a20" id="rusunawaLegal_3a20">
                            L3.20 <a href="#" id="zoomToRusunawaLegal_3a20"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a21" id="rusunawaLegal_3a21">
                            L3.21 <a href="#" id="zoomToRusunawaLegal_3a21"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a22" id="rusunawaLegal_3a22">
                            L3.22 <a href="#" id="zoomToRusunawaLegal_3a22"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a23" id="rusunawaLegal_3a23">
                            L3.23 <a href="#" id="zoomToRusunawaLegal_3a23"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a24" id="rusunawaLegal_3a24">
                            L3.24 <a href="#" id="zoomToRusunawaLegal_3a24"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a25" id="rusunawaLegal_3a25">
                            L3.25 <a href="#" id="zoomToRusunawaLegal_3a25"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a26" id="rusunawaLegal_3a26">
                            L3.26 <a href="#" id="zoomToRusunawaLegal_3a26"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4all" id="rusunawaLegal_4all"> Lantai 4 <a href="#" id="zoomToRusunawaLegal_4all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a1" id="rusunawaLegal_4a1">
                            L4.1 <a href="#" id="zoomToRusunawaLegal_4a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a2" id="rusunawaLegal_4a2">
                            L4.2 <a href="#" id="zoomToRusunawaLegal_4a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a3" id="rusunawaLegal_4a3">
                            L4.3 <a href="#" id="zoomToRusunawaLegal_4a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a4" id="rusunawaLegal_4a4">
                            L4.4 <a href="#" id="zoomToRusunawaLegal_4a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a5" id="rusunawaLegal_4a5">
                            L4.5 <a href="#" id="zoomToRusunawaLegal_4a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a6" id="rusunawaLegal_4a6">
                            L4.6 <a href="#" id="zoomToRusunawaLegal_4a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a7" id="rusunawaLegal_4a7">
                            L4.7 <a href="#" id="zoomToRusunawaLegal_4a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a8" id="rusunawaLegal_4a8">
                            L4.8 <a href="#" id="zoomToRusunawaLegal_4a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a9" id="rusunawaLegal_4a9">
                            L4.9 <a href="#" id="zoomToRusunawaLegal_4a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a10" id="rusunawaLegal_4a10">
                            L4.10 <a href="#" id="zoomToRusunawaLegal_4a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a11" id="rusunawaLegal_4a11">
                            L4.11 <a href="#" id="zoomToRusunawaLegal_4a11"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a12" id="rusunawaLegal_4a12">
                            L4.12 <a href="#" id="zoomToRusunawaLegal_4a12"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a13" id="rusunawaLegal_4a13">
                            L4.13 <a href="#" id="zoomToRusunawaLegal_4a13"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a14" id="rusunawaLegal_4a14">
                            L4.14 <a href="#" id="zoomToRusunawaLegal_4a14"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a15" id="rusunawaLegal_4a15">
                            L4.15 <a href="#" id="zoomToRusunawaLegal_4a15"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a16" id="rusunawaLegal_4a16">
                            L4.16 <a href="#" id="zoomToRusunawaLegal_4a16"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a17" id="rusunawaLegal_4a17">
                            L4.17 <a href="#" id="zoomToRusunawaLegal_4a17"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a18" id="rusunawaLegal_4a18">
                            L4.18 <a href="#" id="zoomToRusunawaLegal_4a18"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a19" id="rusunawaLegal_4a19">
                            L4.19 <a href="#" id="zoomToRusunawaLegal_4a19"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a20" id="rusunawaLegal_4a20">
                            L4.20 <a href="#" id="zoomToRusunawaLegal_4a20"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a21" id="rusunawaLegal_4a21">
                            L4.21 <a href="#" id="zoomToRusunawaLegal_4a21"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a22" id="rusunawaLegal_4a22">
                            L4.22 <a href="#" id="zoomToRusunawaLegal_4a22"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a23" id="rusunawaLegal_4a23">
                            L4.23 <a href="#" id="zoomToRusunawaLegal_4a23"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a24" id="rusunawaLegal_4a24">
                            L4.24 <a href="#" id="zoomToRusunawaLegal_4a24"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a25" id="rusunawaLegal_4a25">
                            L4.25 <a href="#" id="zoomToRusunawaLegal_4a25"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a26" id="rusunawaLegal_4a26">
                            L4.26 <a href="#" id="zoomToRusunawaLegal_4a26"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5all" id="rusunawaLegal_5all"> Lantai 5 <a href="#" id="zoomToRusunawaLegal_5all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a1" id="rusunawaLegal_5a1">
                            L5.1 <a href="#" id="zoomToRusunawaLegal_5a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a2" id="rusunawaLegal_5a2">
                            L5.2 <a href="#" id="zoomToRusunawaLegal_5a2"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a3" id="rusunawaLegal_5a3">
                            L5.3 <a href="#" id="zoomToRusunawaLegal_5a3"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a4" id="rusunawaLegal_5a4">
                            L5.4 <a href="#" id="zoomToRusunawaLegal_5a4"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a5" id="rusunawaLegal_5a5">
                            L5.5 <a href="#" id="zoomToRusunawaLegal_5a5"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a6" id="rusunawaLegal_5a6">
                            L5.6 <a href="#" id="zoomToRusunawaLegal_5a6"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a7" id="rusunawaLegal_5a7">
                            L5.7 <a href="#" id="zoomToRusunawaLegal_5a7"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a8" id="rusunawaLegal_5a8">
                            L5.8 <a href="#" id="zoomToRusunawaLegal_5a8"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a9" id="rusunawaLegal_5a9">
                            L5.9 <a href="#" id="zoomToRusunawaLegal_5a9"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a10" id="rusunawaLegal_5a10">
                            L5.10 <a href="#" id="zoomToRusunawaLegal_5a10"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a11" id="rusunawaLegal_5a11">
                            L5.11 <a href="#" id="zoomToRusunawaLegal_5a11"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a12" id="rusunawaLegal_5a12">
                            L5.12 <a href="#" id="zoomToRusunawaLegal_5a12"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a13" id="rusunawaLegal_5a13">
                            L5.13 <a href="#" id="zoomToRusunawaLegal_5a13"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a14" id="rusunawaLegal_5a14">
                            L5.14 <a href="#" id="zoomToRusunawaLegal_5a14"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a15" id="rusunawaLegal_5a15">
                            L5.15 <a href="#" id="zoomToRusunawaLegal_5a15"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a16" id="rusunawaLegal_5a16">
                            L5.16 <a href="#" id="zoomToRusunawaLegal_5a16"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a17" id="rusunawaLegal_5a17">
                            L5.17 <a href="#" id="zoomToRusunawaLegal_5a17"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a18" id="rusunawaLegal_5a18">
                            L5.18 <a href="#" id="zoomToRusunawaLegal_5a18"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a19" id="rusunawaLegal_5a19">
                            L5.19 <a href="#" id="zoomToRusunawaLegal_5a19"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a20" id="rusunawaLegal_5a20">
                            L5.20 <a href="#" id="zoomToRusunawaLegal_5a20"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a21" id="rusunawaLegal_5a21">
                            L5.21 <a href="#" id="zoomToRusunawaLegal_5a21"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a22" id="rusunawaLegal_5a22">
                            L5.22 <a href="#" id="zoomToRusunawaLegal_5a22"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a23" id="rusunawaLegal_5a23">
                            L5.23 <a href="#" id="zoomToRusunawaLegal_5a23"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a24" id="rusunawaLegal_5a24">
                            L5.24 <a href="#" id="zoomToRusunawaLegal_5a24"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a25" id="rusunawaLegal_5a25">
                            L5.25 <a href="#" id="zoomToRusunawaLegal_5a25"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a26" id="rusunawaLegal_5a26">
                            L5.26 <a href="#" id="zoomToRusunawaLegal_5a26"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <p class="mt-2 mb-1">Batas Ruang</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_BT" id="rusunawaLegal_BT"> Ruang atas tanah <a href="#" id="zoomToRusunawaLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_BB" id="rusunawaLegal_BB"> Ruang bawah tanah <a href="#" id="zoomToRusunawaLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_GSB" id="rusunawaLegal_GSB"> Garis Sempadan Bangunan <a href="#" id="zoomToRusunawaLegal_bb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawa" id="rusunawa"> Parcel Rusunawa</label>
                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="eallc" id="eallc"> Tata Bangunan R</label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e38" id="e38">
                            Tata Bangunan R.1 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e39" id="e39">
                            Tata Bangunan R.2 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e40" id="e40">
                            Tata Bangunan R.3 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e41" id="e41">
                            Tata Bangunan R.4 </label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e42" id="e42">
                            Tata Bangunan R.5 </label>
                        </li>
                      </ul>
                    </li>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Peta dasar
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">

                <div class="p-2 m-1">
                  <select id="basemapSelector" class="form-select" size="3" aria-label="size 3 select example">
                    <option value="BingMapsAerial" selected>Bing Maps Aerial</option>
                    <option value="OpenStreetMap">OpenStreetMap</option>
                  </select>
                  <div class="pt-3">
                    <label class="layer-item" style="margin-left: 0px">
                      <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="" name="ShowBasemap" id="ShowBasemap"> Tampilkan Peta dasar</label>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="other-layer-panel p-2 m-1">
          <label class="layer-item" style="margin-left: 0px">
            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" autocomplete="off" class="underground" name="underground_1" id="underground_1"> Tampilan bawah tanah</label>
          <div>
            <button type="button" class="btn xs-btn btn-outline-info" id="resetTransparent">Setel Ulang Transparansi</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Panel Cek Simulasi -->
    <div id="topRight" class="">
      <div id="simSection" class="position-relative">
        <div class="d-flex flex-row align-items-center gap-1">
          <div class="p-1">
            <span>Cek simulasi desain</span>
          </div>
          <div id="menuToggleBtn" class="border-0 border-start">
            <i class="bi bi-list"></i>
          </div>
        </div>
      </div>

      <div id="menuSection" class="d-none">
        <div class="m-1 p-2">
          <div id="menuItem" class="d-flex flex-column">
            <div class="mb-0">
              <label for="formFileSm" class="form-label">File input</label>
              <div class="input-group">
                <input class="form-control form-control-sm" id="formFileSm" type="file">
              </div>
              <div id="buildingHeight" class="py-1"></div>
              <div id="coordinateInputs" class="my-2" style="display: none;">
                <label for="latitude" class="form-label">Latitude</label>
                <input class="form-control form-control-sm" id="latitude" type="number" step="any" min="-180" max="180" placeholder="-7,258300">
                <label for="longitude" class="form-label">Longitude</label>
                <input class="form-control form-control-sm" id="longitude" type="number" step="any" min="-180" max="180" placeholder="112,73890">
                <label for="longitude" class="form-label">Heading</label>
                <input class="form-control form-control-sm" id="hdg" type="number" step="any" min="0" max="360" value="0" placeholder="330">
              </div>
              <div class="mt-2 d-flex justify-content-end">
                <button class="btn xs-btn btn-warning" id="cek3d" type="button">Cek</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Panel Minimap -->
    <div class="minimap-panel card">
      <div id="map2d"></div>
    </div>

    <!-- Panel properti data -->
    <div class="property-panel card">
      <div class="card-header property-header d-flex justify-content-between align-items-center px-3 mx-1">
        <span class="card-title" id="card-title-property"></span>
        <button type="button" class="btn btn-sm" id="closeProperty" style="color:white;">X</button>
      </div>
      <div class="property-content cesium-infoBox-description" id="property-content">
      </div>
    </div>

    <!-- Panel Meassurement -->
    <div class="measure-panel card">
      <div class="card-body p-2">
        <button id="mdistance" type="button" class="asbn cesium-button">distance (horizontal)</button>
        <button id="marea" type="button" class="asbn cesium-button">area (horizontal)</button>
        <button id="mclear" type="button" class="asbn cesium-button">clear</button>
        <div class="">
          <span>Left-click to measure.</span><br>
          <span>Right-click to stop measuring.</span>
        </div>
      </div>
    </div>

    <!-- Panel Clipping -->
    <div class="clip-panel card">
      <div class="card-body p-2">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="clsiola" checked>
        <label class="form-check-label" for="flexRadioDefault2">Siola</label>
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="clbalai">
        <label class="form-check-label" for="flexRadioDefault3">Balai Pemuda</label>
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" value="clrusunawa">
        <label class="form-check-label" for="flexRadioDefault4">Rusunawa Buring</label>
        <div class="clip-item m-1 p-1">
          <div class="slider-group clsiola">
            <div>
              <label for="sliderX">Slider X:</label>
              <input type="range" class="sliderX" min="-90" max="90" step="0.05" value="90">
            </div>
            <div>
              <label for="sliderY">Slider Y:</label>
              <input type="range" class="sliderY" min="-90" max="90" step="0.05" value="-90">
            </div>
            <div>
              <label for="sliderZ">Slider Z:</label>
              <input type="range" class="sliderZ" min="-90" max="90" step="0.05" value="-90">
            </div>
          </div>
          <div class="slider-group clbalai" style="display:none;">
            <div>
              <label for="sliderX">Slider X:</label>
              <input type="range" class="sliderX" min="-90" max="90" step="0.05" value="90">
            </div>
            <div>
              <label for="sliderY">Slider Y:</label>
              <input type="range" class="sliderY" min="-90" max="90" step="0.05" value="-90">
            </div>
            <div>
              <label for="sliderZ">Slider Z:</label>
              <input type="range" class="sliderZ" min="-120" max="90" step="0.05" value="-90">
            </div>
          </div>
          <div class="slider-group clrusunawa" style="display:none;">
            <div>
              <label for="sliderX">Slider X:</label>
              <input type="range" class="sliderX" min="-90" max="90" step="0.05" value="90">
            </div>
            <div>
              <label for="sliderY">Slider Y:</label>
              <input type="range" class="sliderY" min="-90" max="90" step="0.05" value="-90">
            </div>
            <div>
              <label for="sliderZ">Slider Z:</label>
              <input type="range" class="sliderZ" min="-90" max="90" step="0.05" value="-90">
            </div>
          </div>
          <button id="reset-clip">Reset</button>
        </div>
      </div>
    </div>

    <div class="map" id="cesiumMap"></div>
    <div id="helpingCesium"></div>
  </main>

  <footer>
    <!-- place footer here -->
  </footer>

  <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
  <?php $base_url = base_url(); ?>
  <script>
    const baseUrl = "<?php echo $base_url; ?>";
  </script>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@turf/turf@7.0.0/turf.min.js"></script>


  <script src="assets/js/cesium-measure-tool.js"></script>
  <script src="assets/js/script.js"></script>


  <script src="assets/js/Cesium3DTileLocationEditor.js"></script>
  <script type="module" src="assets/js/cesiumScript.js"></script>

</body>

</html>