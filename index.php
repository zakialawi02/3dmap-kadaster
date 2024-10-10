<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< Updated upstream
  <title>3D Cadastre</title>
=======
  <title>3D Land Administration Prototype</title>
>>>>>>> Stashed changes
  <!-- Required meta tags -->

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <link href="https://cesium.com/downloads/cesiumjs/releases/1.111/Build/Cesium/Widgets/InfoBox/InfoBoxDescription.css" rel="stylesheet" type="text/css">
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
      height: 100%;
      margin-top: auto;
      padding: 0;
      bottom: 0;
      width: 100%;
    }

    .divider {
      border-right: 1px solid white;
      padding-right: 10px;
      margin-right: 10px;
    }
  </style>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>


<body>
  <header>
    <nav>
      <div class="nav-logo">
        <div class="name-logo">
          <h1>RRR Representation <br> in 3D Land Administration Prototype</h1>
        </div>
      </div>
      <div class="search">
        <form id="searchForm" class="d-flex">
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
<<<<<<< Updated upstream
            <a id="meassure" class="" href="#" title="Meassurement"><i class="bi bi-rulers"></i></a>
=======
            <a id="meassure" class="" href="#" title="Distance Measurement"><i class="bi bi-rulers"></i></a>
>>>>>>> Stashed changes
          </li>
          <li>
            <a id="minimap" class="" href="#" title="Minimap/Inset"><i class="bi bi-globe-asia-australia"></i></a>
          </li>
          <li>
            <a id="helpCesium" href="#" title="Help"><i class="bi bi-question-circle-fill"></i></a>
          </li>
          <span class="divider solid"></span>
          <?php if (isset($_SESSION['islogin'])) : ?>
            <li><a href="/dashboard" title="Dashboard"><i class="bi bi-grid-3x3-gap-fill"></i></a></li>
            <li><a href="/action/auth/process_logout.php" title="Logout"><i class="bi bi-box-arrow-right"></i></a></li>
          <?php else : ?>
            <li><a href="/auth/login.php" title="Login"><i class="bi bi-box-arrow-in-right"></i></a></li>
          <?php endif ?>
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


  <!-- Modal welcome -->
  <div class="modal fade" id="welcome" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="welcomeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header p-2">
<<<<<<< Updated upstream
          <h1 class="modal-title fs-5" id="welcomeLabel">Welcome</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Welcome to Cadastral 3D Geographic Information System</h4>
          <p>3D cadastral is an innovation in geographic information technology that allows visualization and management of cadastral data with the representation of real estate objects in three dimensions, allowing more accurate mapping of the available space, both above and below ground level. The system is designed to provide a clearer and more detailed picture of cadastral objects such as buildings, land, and other infrastructure, by displaying information on location, dimensions, and land rights and related limitations and responsibilities.</p>
          <p>Explore new dimensions in mapping and land management with our 3D GIS technology. Discover detailed property data, space analysis related to RRR (Right, Restriction, Resposibility), and visualizations that help you make better decisions and innovate planning. WebGIS 3D Cadastre, brings a new perspective in the understanding and management of your space.</p>
=======
          <h1 class="modal-title fs-5" id="welcomeLabel">Welcome to 3D Land Administration</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4 class="text-center mb-3">Prototype of 3D Land Administration Application</h4>
          <p class="text-center">This application is designed to facilitate the understanding and management of
            <br><b>rights, restrictions, and responsibilities</b> in the context of modern land administration.
            <br>Through 3D technology, you can explore detailed
            <br>land rights, property boundaries, and the associated responsibilities
            <br>in a more interactive and informative way.
          </p>
          <p class="text-center">This application provides the necessary tools to ensure compliance with
            <br>applicable land regulations, assist in the preparation of legal documents, and streamline decision-making processes related to property.
          </p>
          <p class="text-center">Let us embark on a journey towards more transparent and efficient land management.</p>

>>>>>>> Stashed changes
        </div>
      </div>
    </div>
  </div>


  <div class="cesiumContainer" style="display:inline-flex; position: absolute; bottom:10px; right:10px; z-index:100;">
<<<<<<< Updated upstream
    <!-- button kritik dan saran -->
    <div class="saran">
      <button type="button" class="cesium-button" id="btn-critics" data-bs-toggle="modal" data-bs-target="#critics">Critics & Suggestions</button>
=======
    <div class="saran">
      <button type="button" class="cesium-button" id="btn-usability" data-bs-toggle="modal" data-bs-target="#usability">Usability Test</button>
    </div>

    <!-- button kritik dan saran -->
    <div class="saran">
      <button type="button" class="cesium-button" id="btn-critics" data-bs-toggle="modal" data-bs-target="#critics">Critics and Suggestions</button>
>>>>>>> Stashed changes
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


  <!-- Modal -->
  <div class="modal fade welcomemodal" id="critics" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="criticsLabel" aria-hidden="true">
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
<<<<<<< Updated upstream
              <p><strong>What is a 3-dimensional cadastre?</strong></p>
              <p>A 3-dimensional cadastral is a land collection and registration system that includes three-dimensional space information. The system allows mapping and documentation of properties not only on two-dimensional flat planes, but also in three-dimensional spaces, including upper and underground floors.&nbsp;</p>
            </li>
            <li>
              <p><strong>What rights can be covered in a 3-dimensional cadastre?</strong></p>
              <p>In 3-dimensional cadastre, land rights are distinguished into layers or zones. For example, one zone is for ground level, another is for underground space, and another may be for air space above it. Each zone can have different owners with clearly defined rights. For example, a person can have an apartment on the 5th floor without owning the entire building.</p>
            </li>
            <li>
              <p><strong>What limitations exist in the 3-dimensional cadastral system?</strong></p>
              <p>The limitations in the 3-dimensional cadastral relate primarily to the use of upper and lower chambers. Each unit of property has clear vertical boundaries that must not be violated by other units without consent. For example, there should be no structural penetration interfering with other units above or below it.</p>
            </li>
            <li>
              <p><strong>How are responsibilities divided in 3-dimensional cadastre?</strong></p>
              <p>Responsibilities are generally divided based on the vertical and horizontal position of the property. For example, an apartment owner is responsible for maintenance and repairs within his unit, while a building owners association may be responsible for common areas and shared amenities such as roofs, elevators, and major utility systems.</p>
            </li>
            <li>
              <p><strong>What are the main benefits of a 3-dimensional cadastral system?</strong></p>
              <p>Key benefits include increased clarity in property ownership and boundaries, more effective dispute resolution, and increased efficiency in the management and construction of vertical spaces. It also supports innovation in real estate development and urban infrastructure.</p>
            </li>
            <li>
              <p><strong>How does the 3-dimensional cadastral affect multilevel development?</strong></p>
              <p>3-dimensional cadastre is very important in multi-storey development because it allows developers and property owners to separate ownership rights vertically. This makes it easier to sell and manage individual units within a multi-storey building, such as an apartment or office.</p>
            </li>
            <li>
              <p><strong>Does the 3-dimensional cadastral affect the value of the property?</strong></p>
              <p>Yes, a 3-dimensional cadastral can affect the value of a property because it provides greater legal clarity on what a person owns exactly. This increases legal security for owners and potential investors, which can increase the value of the property.</p>
=======
              <p><strong>What is meant by Representation in the 3D land administration system?</strong></p>
              <p>Representation refers to visualizing physical and legal objects in the form of 3D spatial data and presenting textual information attached to those objects, based on the land administration system, to make it easier for users to understand.</p>
            </li>
            <li>
              <p><strong>What is meant by Physical Objects?</strong></p>
              <p>Physical objects refer to the physical reality of land or property in the field. These objects include all types of buildings, structures, and physical land boundaries that can be identified and measured.</p>
            </li>
            <li>
              <p><strong>What is meant by Legal Objects?</strong></p>
              <p>Legal objects refer to legal entities that regulate the rights, obligations, and boundaries related to ownership or use of a property. Legal objects often differ from physical boundaries because they govern the legal aspects of space use and utilization. Legal objects are often mapped in 3D to reflect ownership or usage rights in vertical space.</p>
            </li>
            <li>
              <p><strong>What is the relationship between Physical and Legal Objects in 3D land administration?</strong></p>
              <p>In 3D land administration, it is important to ensure that <strong>physical objects</strong> and <strong>legal objects</strong> are accurately mapped to avoid ownership or space-use conflicts. For example, the underground space beneath a building may belong to a different party than the surface landowner, and this must be legally regulated.</p>
              <p>The presentation of 3D spatial data aims to provide a more comprehensive representation of ownership and space usage in three dimensions, both physically and legally. This system is highly relevant in urban areas with complex building structures and overlapping space usage, allowing for more efficient and equitable land management.</p>
            </li>
            <li>
              <p><strong>What is meant by RRR?</strong></p>
              <p>RRR stands for Rights, Restrictions, and Responsibilities.</p>
            </li>
            <li>
              <p><strong>What is meant by Rights?</strong></p>
              <p>Rights refer to the legal authority held by an individual or entity (such as an owner, tenant, or manager) to use, manage, or control a property within limits set by law. In 3D land administration, these rights not only cover surface land (2D) but also rights over space above and below the surface (3D).</p>
            </li>
            <li>
              <p><strong>What is meant by Restrictions?</strong></p>
              <p>Restrictions are legal limitations or regulations that govern what cannot be done by the owner or user of a particular property. These restrictions are imposed by the government, planning authorities, or other legal regulations to protect public interest, safety, and environmental sustainability. In the context of 3D land administration, restrictions often relate to height limits on space utilization.</p>
            </li>
            <li>
              <p><strong>What is meant by Responsibilities?</strong></p>
              <p>Responsibilities refer to the obligations that fall upon the owner or user of land, buildings, or space to comply with applicable regulations. Responsibilities in 3D land administration include various aspects related to the management of physical space and relationships with other parties.</p>
            </li>
            <li>
              <p><strong>What is 3D Land Administration?</strong></p>
              <p>3D Land Administration is a concept of land data management that incorporates the third dimension, i.e., height or depth, to more comprehensively depict ownership, usage, and control of land. This is particularly relevant in areas with complex space usage, such as multi-story buildings, underground tunnels, or other infrastructure involving vertical elements.</p>
>>>>>>> Stashed changes
            </li>
          </ol>

        </div>
      </div>
    </div>
  </div>

  <main>
    <!-- Modal -->
    <div class="modal fade" id="detailRoom" tabindex="-1" aria-labelledby="detailRoomLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailRoomLabel">Room Detail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            ...
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailOrganizer" tabindex="-1" aria-labelledby="detailOrganizerLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailOrganizerLabel">Organizer Detail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            ...
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailTenant" tabindex="-1" aria-labelledby="detailTenantLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailTenantLabel">Tenant Detail</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            ...
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailRight" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="detailRightLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailRightLabel">Right</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            /
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailRestriction" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="detailRestrictionLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailRestrictionLabel">Restriction</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            / restriction
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailResponsibilities" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="detailResponsibilitiesLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h1 class="modal-title fs-5" id="detailResponsibilitiesLabel">Responsibilities</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body TARGETSCAN">
            / responsibilities
          </div>
        </div>
      </div>
    </div>

<<<<<<< Updated upstream
=======
    <!-- Panel Usability Test -->
    <div class="offcanvas offcanvas-start usab-test" data-bs-backdrop="static" tabindex="-1" id="usab" aria-labelledby="usabLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="usabLabel">Usability Test Guideline</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div>
          Here is the list of usability testing scenarios for your 3D Land Administration WebGIS:
          <ol>
            <li>Navigate to a specific building location (Siola Surabaya/Balai Pemuda Surabaya/Rusunawa Buring 2 Malang) on the 3D map</li>
            <li>Check layer management by hiding/showing layers</li>
            <li>Display information from one of the spatial/legal objects of a building</li>
            <!-- <li>Check the height of a planned building using the design simulation feature, sample 3D data can be used from the following link <a href="https://s.id/tHaq4" target="_blank">https://s.id/tHaq4</a></li> -->
            <li>View spatial planning zones and the height limits of existing building zones</li>
            <li>Explore all features/objects on the map</li>
            <li>Fill out the following usability testing form <a href="https://s.id/UjiKadaster3D" target="_blank">https://s.id/UjiKadaster3D</a></li>
          </ol>
        </div>

      </div>
      <button class="btn btn-warning" id="usab-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#usab" aria-controls="usab">Usability Test Guide ⬆️</button>
    </div>
>>>>>>> Stashed changes

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
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Physical Object</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Legal Object</button>
                  </div>
                </div>

                <div class="siola-building-layer-panel p-2 m-1">
                  <div class="mb-2">
<<<<<<< Updated upstream
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllShow">Check all</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllHide">Uncheck all</button>
=======
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllShow">Show All</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="siolaLevelAllHide">Hide All</button>
>>>>>>> Stashed changes
                  </div>

                  <p class="mb-1">Upperrground object </p>
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
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="siolaLevel_0" id="siolaLevel_0"> Pile or building foundation</label>

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
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_BT" id="siolaLegal_BT"> Upperground space <a href="#" id="zoomToSiolaLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_BB" id="siolaLegal_BB"> Underground space <a href="#" id="zoomToSiolaLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="siolaLegal_GSB" id="siolaLegal_GSB"> Building boundary line <a href="#" id="zoomToSiolaLegal_bb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="siolaParcel" id="siolaParcel"> Parcel Siola <a href="#" id="zoomToSiolaParcel"><i class="bi bi-zoom-in"></i></a></label>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
<<<<<<< Updated upstream
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="ealla" id="ealla"> Building Plan S<a href="#" id="zoomToealla"><i class="bi bi-zoom-in"></i></a></label>
=======
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="ealla" id="ealla"> Building Plan S</label>
>>>>>>> Stashed changes

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e1" id="e1">
<<<<<<< Updated upstream
                            Building Plan S.1 <a href="#" id="zoomToe1"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.1 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e2" id="e2">
<<<<<<< Updated upstream
                            Building Plan S.2 <a href="#" id="zoomToe2"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.2 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e3" id="e3">
<<<<<<< Updated upstream
                            Building Plan S.3 <a href="#" id="zoomToe3"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.3 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e4" id="e4">
<<<<<<< Updated upstream
                            Building Plan S.4 <a href="#" id="zoomToe4"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.4 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e5" id="e5">
<<<<<<< Updated upstream
                            Building Plan S.5 <a href="#" id="zoomToe5"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.5 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e6" id="e6">
<<<<<<< Updated upstream
                            Building Plan S.6 <a href="#" id="zoomToe6"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.6 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e7" id="e7">
<<<<<<< Updated upstream
                            Building Plan S.7 <a href="#" id="zoomToe7"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.7 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e8" id="e8">
<<<<<<< Updated upstream
                            Building Plan S.8 <a href="#" id="zoomToe8"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.8 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e9" id="e9">
<<<<<<< Updated upstream
                            Building Plan S.9 <a href="#" id="zoomToe9"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.9 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e10" id="e10">
<<<<<<< Updated upstream
                            Building Plan S.10 <a href="#" id="zoomToe10"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.10 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e11" id="e11">
<<<<<<< Updated upstream
                            Building Plan S.11 <a href="#" id="zoomToe11"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.11 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e12" id="e12">
<<<<<<< Updated upstream
                            Building Plan S.12 <a href="#" id="zoomToe12"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.12 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e13" id="e13">
<<<<<<< Updated upstream
                            Building Plan S.13 <a href="#" id="zoomToe13"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.13 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e14" id="e14">
<<<<<<< Updated upstream
                            Building Plan S.14 <a href="#" id="zoomToe14"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.14 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e15" id="e15">
<<<<<<< Updated upstream
                            Building Plan S.15 <a href="#" id="zoomToe15"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.15 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e16" id="e16">
<<<<<<< Updated upstream
                            Building Plan S.16 <a href="#" id="zoomToe16"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.16 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e17" id="e17">
<<<<<<< Updated upstream
                            Building Plan S.17 <a href="#" id="zoomToe17"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.17 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e18" id="e18">
<<<<<<< Updated upstream
                            Building Plan S.18 <a href="#" id="zoomToe18"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.18 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e19" id="e19">
<<<<<<< Updated upstream
                            Building Plan S.19 <a href="#" id="zoomToe19"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.19 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e20" id="e20">
<<<<<<< Updated upstream
                            Building Plan S.20 <a href="#" id="zoomToe20"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.20 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e21" id="e21">
<<<<<<< Updated upstream
                            Building Plan S.21 <a href="#" id="zoomToe21"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.21 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e22" id="e22">
<<<<<<< Updated upstream
                            Building Plan S.22 <a href="#" id="zoomToe22"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.22 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e23" id="e23">
<<<<<<< Updated upstream
                            Building Plan S.23 <a href="#" id="zoomToe23"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.23 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e24" id="e24">
<<<<<<< Updated upstream
                            Building Plan S.24 <a href="#" id="zoomToe24"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.24 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e25" id="e25">
<<<<<<< Updated upstream
                            Building Plan S.25 <a href="#" id="zoomToe25"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.25 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e26" id="e26">
<<<<<<< Updated upstream
                            Building Plan S.26 <a href="#" id="zoomToe26"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan S.26 </label>
>>>>>>> Stashed changes
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
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Physical Object</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Legal Object</button>
                  </div>
                </div>

                <div class="balai-building-layer-panel p-2 m-1">
                  <div class="mb-2">
<<<<<<< Updated upstream
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllShow">Check all</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllHide">Uncheck all</button>
=======
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllShow">Show All</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="balaiLevelAllHide">Hide All</button>
>>>>>>> Stashed changes
                  </div>

                  <p class="mb-1">Upperrground object </p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_2" id="balaiLevel_2"> Roof</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_1" id="balaiLevel_1"> Level 1</label>

                  <p class="mt-2 mb-1">Underground object</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_0" id="balaiLevel_0"> Basement</label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="balaiLevel_00" id="balaiLevel_00"> Pile or building foundation</label>
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
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_BT" id="balaiLegal_BT"> Upperground space <a href="#" id="zoomToBalaiLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_BB" id="balaiLegal_BB"> Underground space <a href="#" id="zoomToBalaiLegal_bb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="balaiLegal_GSB" id="balaiLegal_GSB"> Building boundary line <a href="#" id="zoomToBalaiLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="balaiParcel" id="balaiParcel"> Parcel Balai Pemuda<a href="#" id="zoomToBalaiParcel"><i class="bi bi-zoom-in"></i></a></label>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
<<<<<<< Updated upstream
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="eallb" id="eallb"> Building Plan B<a href="#" id="zoomToeallb"><i class="bi bi-zoom-in"></i></a></label>
=======
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="eallb" id="eallb"> Building Plan B</label>
>>>>>>> Stashed changes

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e27" id="e27">
<<<<<<< Updated upstream
                            Building Plan B.1 <a href="#" id="zoomToe27"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.1 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e28" id="e28">
<<<<<<< Updated upstream
                            Building Plan B.2 <a href="#" id="zoomToe28"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.2 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e29" id="e29">
<<<<<<< Updated upstream
                            Building Plan B.3 <a href="#" id="zoomToe29"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.3 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e30" id="e30">
<<<<<<< Updated upstream
                            Building Plan B.4 <a href="#" id="zoomToe30"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.4 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e31" id="e31">
<<<<<<< Updated upstream
                            Building Plan B.5 <a href="#" id="zoomToe31"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.5 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e32" id="e32">
<<<<<<< Updated upstream
                            Building Plan B.6 <a href="#" id="zoomToe32"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.6 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e33" id="e33">
<<<<<<< Updated upstream
                            Building Plan B.7 <a href="#" id="zoomToe33"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.7 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e34" id="e34">
<<<<<<< Updated upstream
                            Building Plan B.8 <a href="#" id="zoomToe34"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.8 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e35" id="e35">
<<<<<<< Updated upstream
                            Building Plan B.9 <a href="#" id="zoomToe35"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.9 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e36" id="e36">
<<<<<<< Updated upstream
                            Building Plan B.10 <a href="#" id="zoomToe36"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.10 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e37" id="e37">
<<<<<<< Updated upstream
                            Building Plan B.11 <a href="#" id="zoomToe37"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan B.11 </label>
>>>>>>> Stashed changes
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
                    <button type="button" class="btn xs-btn btn-primary building-segment active">Physical Object</button>
                    <button type="button" class="btn xs-btn btn-primary legal-segment">Legal Object</button>
                  </div>
                </div>

                <div class="rusunawa-building-layer-panel p-2 m-1">
                  <div class="mb-2">
<<<<<<< Updated upstream
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllShow">Check all</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllHide">Uncheck all</button>
                  </div>

                  <p class="mb-1">Upperground object </p>
=======
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllShow">Show All</button>
                    <button type="button" class="btn xs-btn btn-outline-primary" id="rusunawaLevelAllHide">Hide All</button>
                  </div>

                  <p class="mb-1">Upperrground object </p>
>>>>>>> Stashed changes
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
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_level" name="rusunawaLevel_0" id="rusunawaLevel_0"> Pile or building foundation</label>
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
                      </ul>
                    </li>
                  </ul>

                  <p class="mt-2 mb-1">Restriction Space</p>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_BT" id="rusunawaLegal_BT"> Upperground space <a href="#" id="zoomToRusunawaLegal_gsb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_BB" id="rusunawaLegal_BB"> Underground space <a href="#" id="zoomToRusunawaLegal_bt"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="layer-item" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="virtual" name="rusunawaLegal_GSB" id="rusunawaLegal_GSB"> Building boundary line <a href="#" id="zoomToRusunawaLegal_bb"><i class="bi bi-zoom-in"></i></a></label>
                  <label class="" style="margin-left: 0px">
                    <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="rusunawa" id="rusunawa"> Parcel Rusunawa<a href="#" id="zoomToRusunawa"><i class="bi bi-zoom-in"></i></a></label>

                  <ul id="myUL">
                    <li>
                      <span class="caret"> </span>
                      <label class="" style="margin-left: 0px">
<<<<<<< Updated upstream
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="eallc" id="eallc"> Building Plan R<a href="#" id="zoomToeallc"><i class="bi bi-zoom-in"></i></a></label>
=======
                        <input type="checkbox" style="transform: scale(1.4); color: blue;" checked autocomplete="off" class="set_legal" name="eallc" id="eallc"> Building Plan R</label>
>>>>>>> Stashed changes

                      <ul class="nested">
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e38" id="e38">
<<<<<<< Updated upstream
                            Building Plan R.1 <a href="#" id="zoomToe38"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan R.1 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e39" id="e39">
<<<<<<< Updated upstream
                            Building Plan R.2 <a href="#" id="zoomToe39"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan R.2 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e40" id="e40">
<<<<<<< Updated upstream
                            Building Plan R.3 <a href="#" id="zoomToe40"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan R.3 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e41" id="e41">
<<<<<<< Updated upstream
                            Building Plan R.4 <a href="#" id="zoomToe41"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan R.4 </label>
>>>>>>> Stashed changes
                        </li>
                        <li>
                          <label class="layer-item" style="margin-left: 0px">
                            <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="set_legal" name="e42" id="e42">
<<<<<<< Updated upstream
                            Building Plan R.5 <a href="#" id="zoomToe42"><i class="bi bi-zoom-in"></i></a></label>
=======
                            Building Plan R.5 </label>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
                      <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="" name="ShowBasemap" id="ShowBasemap"> Show Basemap</label>
=======
                      <input type="checkbox" style="transform: scale(1.4); margin-right: 6px; color: blue;" checked autocomplete="off" class="" name="ShowBasemap" id="ShowBasemap"> Show basemap</label>
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
            <button type="button" class="btn xs-btn btn-outline-info" id="resetTransparent">Reset Transparency</button>
=======
            <button type="button" class="btn xs-btn btn-outline-info" id="resetTransparent">Reset Transparent</button>
>>>>>>> Stashed changes
          </div>
        </div>
      </div>
    </div>

<<<<<<< Updated upstream
=======
    <!-- Panel Cek Simulasi -->
    <div id="topRight" class="">
      <div id="simSection" class="position-relative">
        <div class="d-flex flex-row align-items-center gap-1">
          <div class="p-1">
            <span>Check design simulation</span>
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
                <input class="form-control form-control-sm" id="latitude" type="number" step="0.0001" min="-180" max="180" placeholder="-7,258300">
                <label for="longitude" class="form-label">Longitude</label>
                <input class="form-control form-control-sm" id="longitude" type="number" step="0.0001" min="-180" max="180" placeholder="112,73890">
                <label for="longitude" class="form-label">Heading</label>
                <input class="form-control form-control-sm" id="hdg" type="number" step="0.1" min="0" max="360" value="0" placeholder="330">
              </div>
              <div class="mt-2 d-flex justify-content-end">
                <button class="btn xs-btn btn-warning" id="cek3d" type="button">Check</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Panel Minimap -->
>>>>>>> Stashed changes
    <div class="minimap-panel card">
      <div id="map2d"></div>
    </div>

    <div class="property-panel card">
      <div class="card-header property-header d-flex justify-content-between align-items-center px-3 mx-1">
        <span class="card-title" id="card-title-property"></span>
        <button type="button" class="btn btn-sm" id="closeProperty" style="color:white;">X</button>
      </div>
      <div class="property-content cesium-infoBox-description" id="property-content">

      </div>
    </div>

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

  <script src="assets/js/cesium-measure-tool.js"></script>
  <script src="assets/js/script.js"></script>


  <script type="module" src="assets/js/cesiumScript.js"></script>

</body>

</html>