<!DOCTYPE html>
<html lang="en">

<head>
  <title>3D Cadastre</title>
  <!-- Required meta tags -->

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- mapSystem -->
  <script src=" https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.js "></script>
  <link href=" https://cdn.jsdelivr.net/npm/openlayers@4.6.5/dist/ol.min.css " rel="stylesheet">
  <script src="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Cesium.js"></script>
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Widgets/widgets.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/style.css" />

  <style>
    #cesiumMap {
      position: absolute;
      height: 91vh;
      margin-top: auto;
      padding: 0;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<?php include_once 'action/get-parcel.php' ?>
<?php include_once 'action/get-uri.php' ?>

<body>
  <header>
    <nav>
      <div class="nav-logo">
        <div class="name-logo">
          <h1>RRR Representation <br> in 3D Land Administration Prototype</h1>
        </div>
      </div>
      <div class="search">
        <form class="d-flex">
          <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search" autocomplete="off">
          <button class="asbn btn btn-secondary" type="button" role="button" id="searchButton">Search</button>
        </form>
        <div id="autocompleteResults"></div>
      </div>
      <div class="nav-menu">
        <ul class="nav-menu-group">
          <li>
            <a href="#" id="layer-toggle" title="Show layer panel"><i class="bi bi-stack"></i> Layer</a>
          </li>
          <li><a href="#" title="">A</a></li>
          <li><a href="#" id="clip-toggle" title="Clip">Clip</a></li>
          <li>
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-camera-video-fill"></i> Camera</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li class="dropdown-li" id="first-camera"><a class="dropdown-item" href="#">Siola</a></li>
              <li class="dropdown-li" id="second-camera"><a class="dropdown-item" href="#">Balai pemuda</a></li>
              <li class="dropdown-li" id="third-camera"><a class="dropdown-item" href="#">Rusunawa</a></li>
            </ul>
          </li>
          <li>
            <a id="meassure" class="" href="#" title="Meassurement"><i class="bi bi-rulers"></i></a>
          </li>
          <li>
            <a id="minimap" class="" href="#" title="Minimap/Inset"><i class="bi bi-globe-asia-australia"></i></a>
          </li>
          <li>
            <a id="helpCesium" href="#" title="Help"><i class="bi bi-question-circle-fill"></i></a>
          </li>
          <li><a href="/dashboard" title="">Log in/out</a></li>
        </ul>
        <div id="hamb"><i class="bi bi-list"></i></div>
      </div>
    </nav>
  </header>

  <div class="preload">
    <div class="bg-loading">
      <img src="assets/img/load.gif">
      <p>Fetching data and rendering content.</p>
    </div>
  </div>

  <div class="loader-container d-none">
    <div class="loader"></div>
  </div>

  <main>
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
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Physical
                      Object</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Legal Object</button>
                  </div>
                </div>

                <div class="siola-building-layer-panel p-2 m-1">
                  <div class="mb-2">
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllShow">Check
                      all</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllHide">Uncheck
                      all</button>
                  </div>

                  <p class="mb-1">Upperground object</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_5" id="siolaLevel_5"> Level 5</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_4" id="siolaLevel_4"> Level 4</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_3" id="siolaLevel_3"> Level 3</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_2" id="siolaLevel_2"> Level 2</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_1" id="siolaLevel_1"> Level 1</label>

                  <p class="mt-2 mb-1">Underground object</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_0" id="siolaLevel_0"> Pile or building
                    foundation</label>

                </div>

                <div class="siola-legal-layer-panel p-2 m-1 d-none">
                  <p class="mb-1">Rights Unit</p>
                  <ul id="myUL">
                    <li>
                      <span class="caret caret-down"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_1all" id="siolaLegal_1all"> Level 1 <a href="#" id="zoomToSiolaLegal_1all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_2all" id="siolaLegal_2all"> Level 2 <a href="#" id="zoomToSiolaLegal_2all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_3all" id="siolaLegal_3all"> Level 3 <a href="#" id="zoomToSiolaLegal_3all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_4all" id="siolaLegal_4all"> Level 4 <a href="#" id="zoomToSiolaLegal_4all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_5all" id="siolaLegal_5all"> Level 5 <a href="#" id="zoomToSiolaLegal_5all"><i class="bi bi-zoom-in"></i></a></label>

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="siolaLegal_5a1" id="siolaLegal_5a1">
                            L5.1 <a href="#" id="zoomToSiolaLegal_5a1"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <p class="mt-2 mb-1">Restriction Space</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_BT" id="siolaLegal_BT"> Upperground
                    space <a href="#" id="zoomToSiolaLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_BB" id="siolaLegal_BB"> Underground
                    space <a href="#" id="zoomToSiolaLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_GSB" id="siolaLegal_GSB"> Building
                    boundary line <a href="#" id="zoomToSiolaLegal_bb"><i class="bi bi-zoom-in"></i></a></label>

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
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Physical
                      Object</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Legal Object</button>
                  </div>
                </div>

                <div class="balai-building-layer-panel p-2 m-1">
                  <div class="mb-2">
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllShow">Check
                      all</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllHide">Uncheck
                      all</button>
                  </div>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_2" id="balaiLevel_2"> Roof</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_1" id="balaiLevel_1"> Level 1</label>

                  <p class="mt-2 mb-1">Underground object</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_0" id="balaiLevel_0"> Basement</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_00" id="balaiLevel_00"> Pile or building
                    foundation</label>
                </div>

                <div class="balai-legal-layer-panel p-2 m-1 d-none">
                  <p class="mb-1">Rights Unit</p>
                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_0all" id="balaiLegal_0all"> Level 0 <a href="#" id="zoomToBalaiLegal_0all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="balaiLegal_1all" id="balaiLegal_1all"> Level 1 <a href="#" id="zoomToBalaiLegal_1all"><i class="bi bi-zoom-in"></i></a></label>

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

                  <p class="mt-2 mb-1">Restriction Space</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_BT" id="balaiLegal_BT"> Upperground
                    space <a href="#" id="zoomToBalaiLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_BB" id="balaiLegal_BB"> Underground
                    space <a href="#" id="zoomToBalaiLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_GSB" id="balaiLegal_GSB"> Building
                    boundary line <a href="#" id="zoomToBalaiLegal_bb"><i class="bi bi-zoom-in"></i></a></label>


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
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Physical
                      Object</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Legal Object</button>
                  </div>
                </div>

                <div class="rusunawa-building-layer-panel p-2 m-1">
                  <div class="mb-2">
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllShow">Check
                      all</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllHide">Uncheck
                      all</button>
                  </div>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_r" id="rusunawaLevel_r"> Roof</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_5" id="rusunawaLevel_5"> Level 5</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_4" id="rusunawaLevel_4"> Level 4</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_3" id="rusunawaLevel_3"> Level 3</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_2" id="rusunawaLevel_2"> Level 2</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_1" id="rusunawaLevel_1"> Level 1</label>

                  <p class="mt-2 mb-1">Underground object</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_0" id="rusunawaLevel_0"> Pile or building
                    foundation</label>
                </div>

                <div class="rusunawa-legal-layer-panel p-2 m-1 d-none">
                  <p class="mb-1">Rights Unit</p>

                  <ul id="myUL">
                    <li>
                      <span class="caret caret-down"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1all" id="rusunawaLegal_1all"> Level 1 <a href="#" id="zoomToRusunawaLegal_1all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a18" id="rusunawaLegal_1a18">
                            L1.18 <a href="#" id="zoomToRusunawaLegal_1a18"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a19" id="rusunawaLegal_1a19">
                            L1.19 <a href="#" id="zoomToRusunawaLegal_1a19"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a20" id="rusunawaLegal_1a20">
                            L1.20 <a href="#" id="zoomToRusunawaLegal_1a20"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_1a21" id="rusunawaLegal_1a21">
                            L1.21 <a href="#" id="zoomToRusunawaLegal_1a21"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2all" id="rusunawaLegal_2all"> Level 2 <a href="#" id="zoomToRusunawaLegal_2all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_2a27" id="rusunawaLegal_2a27">
                            L2.27 <a href="#" id="zoomToRusunawaLegal_2a27"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3all" id="rusunawaLegal_3all"> Level 3 <a href="#" id="zoomToRusunawaLegal_3all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_3a27" id="rusunawaLegal_3a27">
                            L3.27 <a href="#" id="zoomToRusunawaLegal_3a27"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4all" id="rusunawaLegal_4all"> Level 4 <a href="#" id="zoomToRusunawaLegal_4all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_4a27" id="rusunawaLegal_4a27">
                            L4.27 <a href="#" id="zoomToRusunawaLegal_4a27"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5all" id="rusunawaLegal_5all"> Level 5 <a href="#" id="zoomToRusunawaLegal_5all"><i class="bi bi-zoom-in"></i></a></label>

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
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="rusunawaLegal_5a27" id="rusunawaLegal_5a27">
                            L5.27 <a href="#" id="zoomToRusunawaLegal_5a27"><i class="bi bi-zoom-in"></i></a></label>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <p class="mt-2 mb-1">Restriction Space</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_BT" id="rusunawaLegal_BT"> Upperground
                    space <a href="#" id="zoomToRusunawaLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_BB" id="rusunawaLegal_BB"> Underground
                    space <a href="#" id="zoomToRusunawaLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_GSB" id="rusunawaLegal_GSB"> Building
                    boundary line <a href="#" id="zoomToRusunawaLegal_bb"><i class="bi bi-zoom-in"></i></a></label>


                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Basemap
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
                      <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="" name="ShowBasemap" id="ShowBasemap"> Show Basemap</label>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <hr>

        <div class="other-layer-panel p-2 m-1">
          <label class="layer-item" style="margin-left: 0px">
            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" autocomplete="off" class="underground" name="underground_1" id="underground_1"> Underground view</label>
          <div>
            <button type="button" class="btn xs-btn btn-outline-info" id="resetTransparent">Reset Transparency</button>
          </div>
        </div>
      </div>
    </div>

    <div class="minimap-panel card">
      <div id="map2d"></div>
    </div>

    <div class="property-panel card">
      <div class="card-body p-2">
        <div class="property-content" id="property-content">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, nesciunt.</p>
          <p>Lorem ipsum dolor sit amet consectetur.</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
      </div>
    </div>

    <div class="clip-panel card">
      <div class="card-body p-2">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
        <label class="form-check-label" for="flexRadioDefault2">Siola</label>
        <div class="clip-item m-1 p-1">
          <div>
            <label for="sliderX">Slider X:</label>
            <input type="range" id="sliderX" min="-90" max="90" step="0.01" value="90">
          </div>
          <div>
            <label for="sliderY">Slider Y:</label>
            <input type="range" id="sliderY" min="-90" max="90" step="0.01" value="90">
          </div>
          <div>
            <label for="sliderZ">Slider Z:</label>
            <input type="range" id="sliderZ" min="-90" max="90" step="0.01" value="90">
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

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script src="assets/js/script.js"></script>
  <script src="assets/js/propertiesData.js"></script>

  <!-- <script type="module" src="assets/js/cesiumScript_.js"></script> -->
  <!-- <script type="module" src="assets/js/cesiumScript_2.js"></script> -->

  <script type="module" src="assets/js/cesiumScript.js"></script>

  <script>
    const parcel_data = <?= json_encode($parcel_table) ?>;
    const uri_data = <?= json_encode($uri_table) ?>;
    console.log(parcel_data);
    console.log(uri_data);
  </script>

</body>

</html>