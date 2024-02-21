// inisiasi cesium token
Cesium.Ion.defaultAccessToken =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxODQyMzk1MS1iNWUxLTRhNGQtYTI1OS02OTUzNzI1ZDcwN2MiLCJpZCI6MTcxMjA2LCJpYXQiOjE2OTcwMTI5Mjh9.qk3jXULVR5DGxNlgFOR0aHWgT-1xmz50zY4gE63tXMY";
// Cesium.Ion.defaultAccessToken =
//   "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJjYzM3MWVhMC05NTVmLTQwZDQtYjVlYS04MGY2NjFhZWJjZTIiLCJpZCI6MTc0NTY5LCJpYXQiOjE2OTg1MDA4NDd9.CJSLBba2oVAnchzPeMZpazEs2EdocRFKSdoRYXy7gBg";

// Initialize the Cesium Viewer in the HTML element with the `cesiumMap` ID.
const viewer = new Cesium.Viewer("cesiumMap", {
  // terrain: Cesium.Terrain.fromWorldTerrain(),
  animation: false,
  timeline: false,
  homeButton: false,
  geocoder: false,
  sceneModePicker: false,
  baseLayerPicker: false,
  fullscreenButton: false,
});


viewer.clock.currentTime = new Cesium.JulianDate(9107651.04167);
viewer.scene.globe.enableLighting = true;
viewer.scene.highDynamicRange = true;
// viewer.scene.globe.atmosphereLightIntensity = 5.0;
viewer.scene.postProcessStages.fxaa.enabled = true;
viewer.scene.globe.baseColor = Cesium.Color.ALICEBLUE;
viewer.scene.globe.undergroundColor = Cesium.Color.TRANSPARENT;
viewer.scene.globe.depthTestAgainstTerrain = true;
viewer.scene.screenSpaceCameraController.enableCollisionDetection = true;
viewer.scene.globe.translucency.frontFaceAlphaByDistance = new Cesium.NearFarScalar(
  400.0,
  0.0,
  800.0,
  1.0
);


viewer.camera.flyTo({
  destination: Cesium.Cartesian3.fromDegrees(
    112.73677426629814, -7.259593062440535, 20000
  ),
  orientation: {
    heading: Cesium.Math.toRadians(0.0),
    pitch: Cesium.Math.toRadians(-90.0),
  },
});


// Initialize OpenLayers map
const miniMap = new ol.Map({
  target: 'map2d',
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM(),
    }),
  ],
  view: new ol.View({
    center: ol.proj.fromLonLat([0, 0]),
    zoom: 15,
  }),
  controls: ol.control.defaults({
    zoom: false,
    rotate: false,
  }),
});
// add marker building object in openlayers
const markerSiola = new ol.Feature({
  geometry: new ol.geom.Point(
    ol.proj.fromLonLat([112.73775781677266, -7.256371890525727])
  ),
});
const markerBalai = new ol.Feature({
  geometry: new ol.geom.Point(
    ol.proj.fromLonLat([112.74531573749071, -7.264032458811419])
  ),
});
const markerRusunawa = new ol.Feature({
  geometry: new ol.geom.Point(
    ol.proj.fromLonLat([112.64459980831899, -8.010094631402152])
  ),
});
const vectorSource = new ol.source.Vector({
  features: [markerSiola, markerBalai, markerRusunawa],
});
const vectorLayer = new ol.layer.Vector({
  source: vectorSource,
});
miniMap.addLayer(vectorLayer);
// get center view from cesium
const getCenterView = function () {
  // Get the current camera position
  const centerCartographic = Cesium.Cartographic.fromCartesian(viewer.camera.positionWC);
  // Get latitude, longitude, and height, heading, picth, roll
  const longitude = Cesium.Math.toDegrees(centerCartographic.longitude);
  const latitude = Cesium.Math.toDegrees(centerCartographic.latitude);
  const height = centerCartographic.height;
  const heading = Cesium.Math.toDegrees(viewer.camera.heading);
  const pitch = Cesium.Math.toDegrees(viewer.camera.pitch);
  const roll = Cesium.Math.toDegrees(viewer.camera.roll);
  return {
    longitude,
    latitude,
    height,
    heading,
    pitch,
    roll,
  }
}
// Adjust OpenLayers zoom based on height
const getZoom = function (currentView) {
  let zoomLevel;
  if (currentView.height < 450) {
    zoomLevel = 15;
  } else if (currentView.height < 1200) {
    zoomLevel = 13;
  } else if (currentView.height < 2300) {
    zoomLevel = 12;
  } else if (currentView.height < 4300) {
    zoomLevel = 10;
  } else if (currentView.height < 8300) {
    zoomLevel = 9;
  } else if (currentView.height < 18000) {
    zoomLevel = 8;
  } else if (currentView.height < 40000) {
    zoomLevel = 7;
  } else if (currentView.height < 80000) {
    zoomLevel = 6;
  } else if (currentView.height < 200000) {
    zoomLevel = 5;
  } else {
    zoomLevel = 4;
  }
  return zoomLevel;
};
// Add an event listener for camera move end
viewer.camera.moveEnd.addEventListener(function () {
  const currentView = getCenterView();
  console.log(currentView);
  const zoomLevel = getZoom(currentView);
  // Update OpenLayers view
  miniMap.getView().setCenter(ol.proj.fromLonLat([currentView.longitude, currentView.latitude]));
  miniMap.getView().setZoom(zoomLevel);
  miniMap.getView().setRotation(Cesium.Math.toRadians((-currentView.heading)));
});


const layers = viewer.imageryLayers;
const openStreetMapBasemap = layers.addImageryProvider(new Cesium.OpenStreetMapImageryProvider({
  url: "https://a.tile.openstreetmap.org/",
  show: false,
}));

function changeBasemapLayer(selectedBasemap) {
  // console.log(layers);
  if ($("#ShowBasemap").prop("checked") === true) {
    const basemap = viewer.imageryLayers;
    const bingMapsAerial = basemap.get(0);
    const openstreetmap = basemap.get(1);
    switch (selectedBasemap) {
      case "OpenStreetMap":
        openstreetmap.show = true;
        bingMapsAerial.show = false;
        break;
      case "BingMapsAerial":
        bingMapsAerial.show = true;
        openstreetmap.show = false;
        break;
      default:
        bingMapsAerial.show = true;
        openstreetmap.show = false;
        break;
    }
  }
}

// Set the initial basemap layer
changeBasemapLayer($("#basemapSelector").val());

// Handle basemap selector change event
$("#basemapSelector, #ShowBasemap").change(function () {
  if ($("#ShowBasemap").prop("checked")) {
    changeBasemapLayer($("#basemapSelector").val());
    $("#underground_1").prop("checked", !$("#ShowBasemap").prop("checked"));
  } else {
    const basemap = viewer.imageryLayers;
    const bingMapsAerial = basemap.get(0);
    const openstreetmap = basemap.get(1);
    bingMapsAerial.show = false;
    openstreetmap.show = false;
    $("#underground_1").prop("checked", !$("#ShowBasemap").prop("checked"));
  }
  viewer.scene.globe.depthTestAgainstTerrain = !$("#underground_1").prop("checked");
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !$("#underground_1").prop("checked");
});

// Set first camera the given longitude, latitude, and height.
function firstCamera() {
  viewer.camera.flyTo({
    destination: Cesium.Cartesian3.fromDegrees(
      112.73761619035064, -7.26164124554183,
      600
    ),
    orientation: {
      heading: Cesium.Math.toRadians(0.0),
      pitch: Cesium.Math.toRadians(-45.0),
    },
  });
}

function secondCamera() {
  viewer.camera.flyTo({
    destination: Cesium.Cartesian3.fromDegrees(
      112.7455751403341, -7.265563821748533,
      200
    ),
    orientation: {
      heading: Cesium.Math.toRadians(0.0),
      pitch: Cesium.Math.toRadians(-45.0),
    },
  });
}

function thirdCamera() {
  viewer.camera.flyTo({
    destination: Cesium.Cartesian3.fromDegrees(
      112.64490147028183, -8.012749056273925,
      200
    ),
    orientation: {
      heading: Cesium.Math.toRadians(0.0),
      pitch: Cesium.Math.toRadians(-45.0),
    },
  });
}

function zoomToTileset(tileset, pitchDegrees = -25, headingDegrees = 0, zoomDistance = 300) {
  // Zoom to the tileset
  const heading = Cesium.Math.toRadians(headingDegrees);
  const pitch = Cesium.Math.toRadians(pitchDegrees);
  viewer.flyTo(tileset, {
    offset: new Cesium.HeadingPitchRange(heading, pitch, zoomDistance),
    orientation: {
      heading: heading,
      pitch: pitch,
    },
    duration: 1,
  });
}

function zoomToLocation(headingDegrees, height = 20, longitude, latitude, pitchDegrees = -25, roll = 0) {
  // Zoom to position
  const heading = Cesium.Math.toRadians(headingDegrees);
  const pitch = Cesium.Math.toRadians(pitchDegrees);
  const position = Cesium.Cartesian3.fromDegrees(longitude, latitude, height);
  // Zoom to position
  viewer.camera.flyTo({
    destination: position,
    orientation: {
      heading: heading,
      pitch: pitch,
      roll: roll,
    },
    duration: 1,
  });
}

function createTransparentStyle(alphaValue) {
  return new Cesium.Cesium3DTileStyle({
    color: {
      conditions: [
        ["true", `rgba(255, 255, 255, ${alphaValue})`],
      ],
    },
  });
}

$("#first-camera").click(function (e) {
  firstCamera();
});
$("#second-camera").click(function (e) {
  secondCamera();
});
$("#third-camera").click(function (e) {
  thirdCamera();
});

// Tambahkan overlay HTML untuk menampilkan informasi fitur
const nameOverlay = document.createElement("div");
viewer.container.appendChild(nameOverlay);
nameOverlay.className = "backdrop";
nameOverlay.style.display = "none";
nameOverlay.style.position = "absolute";
nameOverlay.style.bottom = "0";
nameOverlay.style.left = "0";
nameOverlay.style["pointer-events"] = "none";
nameOverlay.style.padding = "4px";
nameOverlay.style.backgroundColor = "black";

// Informasi fitur terpilih
const selected = {
  feature: undefined,
  originalColor: new Cesium.Color(),
};

// Entitas yang menyimpan info tentang fitur terpilih
const selectedEntity = new Cesium.Entity();

// Penanganan klik kiri default
const clickHandler = viewer.screenSpaceEventHandler.getInputAction(
  Cesium.ScreenSpaceEventType.LEFT_CLICK
);

// Fungsi untuk membuat deskripsi HTML fitur terpilih
function createPickedFeatureDescription(pickedFeature) {
  const description =
    `<table class="cesium-infoBox-defaultTable"><tbody>` +
    `<tr><th>ObjectID</th><td>${pickedFeature.getProperty("Tag")}</td></tr>` +
    `<tr><th>GlobalId</th><td>${pickedFeature.getProperty("GlobalId")}</td></tr>` +
    `<tr><th>parcel_id</th><td>${pickedFeature.getProperty("parcel_id")}</td></tr>` +
    `<tr><th>Name</th><td>${pickedFeature.getProperty("Name")}</td></tr>` +
    `<tr><th><a href="/data/uri/view.php?uri=longitude" target="_blank">Longitude <i class="bi bi-box-arrow-up-right"></i></a></th><td>${pickedFeature.getProperty("Longitude")}</td></tr>` +
    `<tr><th><a href="/data/uri/view.php?uri=latitude" target="_blank">Latitude <i class="bi bi-box-arrow-up-right"></i></a></th><td>${pickedFeature.getProperty("Latitude")}</td></tr>` +
    `<tr><th>Height</th><td>${pickedFeature.getProperty("Height")}</td></tr>` +
    `<tr><th>Occupant</th><td>${pickedFeature.getProperty("Occupant")}</td></tr>` +
    `<tr><th>Area</th><td>${pickedFeature.getProperty("area")} m²</td></tr>` +
    `<tr><th>Volume</th><td>${pickedFeature.getProperty("volume")} m³</td></tr>` +
    `</tbody></table>`;
  return description;
}

// Cek apakah siluet didukung
if (Cesium.PostProcessStageLibrary.isSilhouetteSupported(viewer.scene)) {
  // Jika siluet didukung, atur warna siluet
  const silhouetteBlue = Cesium.PostProcessStageLibrary.createEdgeDetectionStage();
  silhouetteBlue.uniforms.color = Cesium.Color.BLUE;
  silhouetteBlue.uniforms.length = 0.01;
  silhouetteBlue.selected = [];

  const silhouetteGreen = Cesium.PostProcessStageLibrary.createEdgeDetectionStage();
  silhouetteGreen.uniforms.color = Cesium.Color.LIME;
  silhouetteGreen.uniforms.length = 0.01;
  silhouetteGreen.selected = [];

  viewer.scene.postProcessStages.add(
    Cesium.PostProcessStageLibrary.createSilhouetteStage([
      silhouetteBlue,
      silhouetteGreen,
    ])
  );

  // Saat mouse bergerak, siluetkan fitur berwarna biru
  viewer.screenSpaceEventHandler.setInputAction(function onMouseMove(movement) {
    silhouetteBlue.selected = [];

    const pickedFeature = viewer.scene.pick(movement.endPosition);

    if (!Cesium.defined(pickedFeature)) {
      return;
    }

    if (pickedFeature !== selected.feature) {
      silhouetteBlue.selected = [pickedFeature];
    }
  }, Cesium.ScreenSpaceEventType.MOUSE_MOVE);

  // Saat mouse diklik, siluetkan fitur berwarna hijau dan tampilkan metadata di InfoBox
  viewer.screenSpaceEventHandler.setInputAction(function onLeftClick(movement) {
    silhouetteGreen.selected = [];

    const pickedFeature = viewer.scene.pick(movement.position);
    if (!Cesium.defined(pickedFeature)) {
      clickHandler(movement);
      $(".property-panel").removeClass("property-panel-show");
      return;
    }

    if (typeof pickedFeature.getPropertyIds !== 'function') {
      console.error("Error: pickedFeature doesn't have a getPropertyIds function.");
      return;
    }
    $(".property-panel").addClass("property-panel-show");
    $("#property-content").html(createPickedFeatureDescription(pickedFeature));
    if (silhouetteGreen.selected[0] === pickedFeature) {
      return;
    }

    const highlightedFeature = silhouetteBlue.selected[0];
    if (pickedFeature === highlightedFeature) {
      silhouetteBlue.selected = [];
    }
    silhouetteGreen.selected = [pickedFeature];
    // viewer.selectedEntity = selectedEntity;
    // selectedEntity.description = createPickedFeatureDescription(pickedFeature);

    // const propertyIds = pickedFeature.getPropertyIds();
    // const length = propertyIds.length;
    // for (let i = 0; i < length; ++i) {
    //   const propertyId = propertyIds[i];
    //   console.log(`  ${propertyId}: ${pickedFeature.getProperty(propertyId)}`);
    // }


    const objectId = pickedFeature.getProperty("Tag");
    // console.log(objectId);
    // ajax request with sucses and error
    $.ajax({
      type: "Get",
      url: `../../action/get-parcel.php`,
      data: {
        objectId
      },
      dataType: "json",
      success: function (response) {
        const data = response;
        // console.log(data);
        const tags = JSON.parse(data.tag);
        // console.log("DATA TAG");
        // console.log(tags);

        $("#card-title-property").html(`${data.id}`);
        const updatedParcelID = $('th:contains("parcel_id") + td');
        updatedParcelID.text(`${data.parcel_id}`);

        // Update parcel_occupant & name dengan nilai yang baru
        if (data.parcel_occupant != undefined && data.parcel_occupant != null && data.parcel_occupant != "") {
          const updatedOccupant = $('th:contains("Occupant") + td');
          updatedOccupant.html(`${data.resident_name} <button type="button" id="btnDetailOccupant" class="btn asbn cesium-button" data-occupant="${data.parcel_occupant}" data-parcel="${data.parcel_id}" data-bs-toggle="modal" data-bs-target="#detailOccupant">View <i class="bi bi-zoom-in"></i></button>`);
        } else {
          const updatedOccupant = $('th:contains("Occupant") + td');
          updatedOccupant.closest('tr').remove();
        }
        if (data.parcel_name != undefined && data.parcel_name != null && data.parcel_name != "") {
          const updatedName = $('th:contains("Name") + td');
          updatedName.text(`${data.parcel_name}`);
        }
        // add URI
        if (Array.isArray(tags)) {
          let tagsHtml = `<div class="mt-2"><span>Related Link/URI tag:</span>`;
          // Loop through the array and create links
          tags.forEach(tag => {
            // Check if tag.id_keyword is not null or empty
            if (tag.id_keyword !== null) {
              tagsHtml += `<div><a href="/data/uri/view.php?uri=${tag.slug}" target="_blank">${tag.word_name} <i class="bi bi-box-arrow-up-right"></i></a></div>`;
            }
          });
          tagsHtml += "</div>";
          // Append the tags to the existing description
          $(".cesium-infoBox-defaultTable").after(tagsHtml);
        }
      },
      error: function (error) {
        console.log("error");
        console.log(error);
      }
    });

  }, Cesium.ScreenSpaceEventType.LEFT_CLICK);
} else {
  // Jika siluet tidak didukung, atur warna fitur
  const highlighted = {
    feature: undefined,
    originalColor: new Cesium.Color(),
  };

  viewer.screenSpaceEventHandler.setInputAction(function onMouseMove(movement) {
    if (Cesium.defined(highlighted.feature)) {
      highlighted.feature.color = highlighted.originalColor;
      highlighted.feature = undefined;
    }

    const pickedFeature = viewer.scene.pick(movement.endPosition);

    if (!Cesium.defined(pickedFeature)) {
      return;
    }

    if (pickedFeature !== selected.feature) {
      highlighted.feature = pickedFeature;
      Cesium.Color.clone(pickedFeature.color, highlighted.originalColor);
      pickedFeature.color = Cesium.Color.YELLOW;
    }
  }, Cesium.ScreenSpaceEventType.MOUSE_MOVE);

  viewer.screenSpaceEventHandler.setInputAction(function onLeftClick(movement) {
    if (Cesium.defined(selected.feature)) {
      selected.feature.color = selected.originalColor;
      selected.feature = undefined;
    }

    const pickedFeature = viewer.scene.pick(movement.position);
    if (!Cesium.defined(pickedFeature)) {
      clickHandler(movement);
      return;
    }

    if (selected.feature === pickedFeature) {
      return;
    }

    selected.feature = pickedFeature;

    if (pickedFeature === highlighted.feature) {
      Cesium.Color.clone(highlighted.originalColor, selected.originalColor);
      highlighted.feature = undefined;
    } else {
      Cesium.Color.clone(pickedFeature.color, selected.originalColor);
    }

    pickedFeature.color = Cesium.Color.LIME;

    viewer.selectedEntity = selectedEntity;
    selectedEntity.description = createPickedFeatureDescription(pickedFeature);
  }, Cesium.ScreenSpaceEventType.LEFT_CLICK);
}

// Menangani klik pada tombol "View (occupant)"
$(document).on('click', '#btnDetailOccupant', function (e) {
  // loader animation
  const loader = `<div class="loader" style=" margin: 0 auto; "></div>`;
  $('#detailOccupant .modal-body').html(loader);
  // Mendapatkan nilai ID dari atribut data
  const occupant = $(this).data('occupant');
  const parcel_id = $(this).data('parcel');

  // Lakukan AJAX GET request dengan menggunakan ID
  $.ajax({
    url: `../../action/get-residents.php?idr=${occupant}&parcel_id=${parcel_id}`,
    type: 'GET',
    dataType: "json",
    success: function (data) {
      console.log(data);
      const address = JSON.parse(data.resident_address);
      const city = address ? (address.city ? address.city : '-') : '-';
      const district = address ? (address.district ? address.district : '-') : '-';
      const province = address ? (address.province ? address.province : '-') : '-';
      const table =
        `<table class="table"><tbody>` +
        `<tr> <th>${data.resident_type == "Individual" ? "Individual" : data.resident_type == "Entity" ? "Institution/Group" : ''}</th> </tr>` +
        `${data.resident_type === "Entity" ? `<tr><th>Name of Group/Institution</th><td style="width: 1%;">:</td><td>${data.resident_entity ?? "-"}</td></tr>` : ''}` +
        `<tr><th>Name of Person</th><td style="width: 1%;">:</td><td>${data.resident_name}</td></tr>` +
        `<tr><th>Identicifation Number (NIK)</th><td style="width: 1%;">:</td><td>${data.resident_code}</td></tr>` +
        `<tr><th>Job</th><td style="width: 1%;">:</td><td>${data.resident_job ? data.resident_job : '-'}</td></tr>` +
        `${data.resident_type === "Entity" ? `<tr><th>Job Title</th><td style="width: 1%;">:</td><td>${data.job_title ? data.job_title : '-'}</td></tr>` : ''}` +
        `<tr><th>Phone Number</th><td style="width: 1%;">:</td><td>${data.phone_number ?? "-"}</td></tr>` +
        `<tr><th>Address</th><td style="width: 1%;">:</td><td>${city ?? "-"}, ${district ?? "-"}, ${province ?? "-"}</td></tr>` +
        `<tr><th>started</th><td style="width: 1%;">:</td><td>${formatCustomDate(data.started) ?? "-"}</td></tr>` +
        `<tr><th>finished</th><td style="width: 1%;">:</td><td>${formatCustomDate(data.finished) ?? "-"}</td></tr>` +
        `</tbody></table>`;
      $('#detailOccupant .modal-body').html(table);
      const detailOccupantPDF = $(`<button type="button" id="detailOccupantPDF" class="btn asbn btn-primary" data-occupant="${data.id_resident}" data-parcel="${data.parcel_id}">PDF file <i class="bi bi-file-earmark-person-fill"></i></button>`);
      // $('#detailOccupant .modal-body').append(detailOccupantPDF);
    },
    error: function (error) {
      $('#detailOccupant .modal-body').html("Error!!");
      console.error('Error:', error);
    }
  });
});

$(document).on('click', '#detailOccupantPDF', function (e) {
  // Mendapatkan nilai ID dari atribut data
  const occupant = $(this).data('occupant');
  const parcel_id = $(this).data('parcel');
  const url = `/action/sertifikat_occupant.php?idr=${occupant}&objectId=${parcel_id}`;
  window.open(url, '_blank').focus();
});

// Layering button Siola  ################################################################################
$("#siolaLevel_0").change(function () {
  siolaBuildingL0.show = $(this).prop("checked");
});
$("#siolaLevel_1").change(function () {
  siolaBuildingL1.show = $(this).prop("checked");
});
$("#siolaLevel_2").change(function () {
  siolaBuildingL2.show = $(this).prop("checked");
});
$("#siolaLevel_3").change(function () {
  siolaBuildingL3.show = $(this).prop("checked");
});
$("#siolaLevel_4").change(function () {
  siolaBuildingL4.show = $(this).prop("checked");
});
$("#siolaLevel_5").change(function () {
  siolaBuildingL5.show = $(this).prop("checked");
});

$("#siolaLegal_GSB").change(function () {
  setVisibilityByobject_id(siolaLegal, "921704", $(this).prop("checked"));
});
$("#siolaLegal_BT").change(function () {
  setVisibilityByobject_id(siolaLegal, "910222", $(this).prop("checked"));
});
$("#siolaLegal_BB").change(function () {
  setVisibilityByobject_id(siolaLegal, "915961", $(this).prop("checked"));
});

$("#siolaLegal_1a1").change(function () {
  setVisibilityByobject_id(siolaLegal, "817240", $(this).prop("checked"));
});
$("#siolaLegal_1a2").change(function () {
  setVisibilityByobject_id(siolaLegal, "825386", $(this).prop("checked"));
});
$("#siolaLegal_1a3").change(function () {
  setVisibilityByobject_id(siolaLegal, "820896", $(this).prop("checked"));
});
$("#siolaLegal_1a4").change(function () {
  setVisibilityByobject_id(siolaLegal, "820815", $(this).prop("checked"));
});
$("#siolaLegal_1a5").change(function () {
  setVisibilityByobject_id(siolaLegal, "919493", $(this).prop("checked"));
});
$("#siolaLegal_1a6").change(function () {
  setVisibilityByobject_id(siolaLegal, "820143", $(this).prop("checked"));
});
$("#siolaLegal_1a7").change(function () {
  setVisibilityByobject_id(siolaLegal, "821077", $(this).prop("checked"));
});
$("#siolaLegal_1a8").change(function () {
  setVisibilityByobject_id(siolaLegal, "823865", $(this).prop("checked"));
});
$("#siolaLegal_1a9").change(function () {
  setVisibilityByobject_id(siolaLegal, "821964", $(this).prop("checked"));
});
$("#siolaLegal_1a10").change(function () {
  setVisibilityByobject_id(siolaLegal, "826868", $(this).prop("checked"));
});

$("#siolaLegal_2a1").change(function () {
  setVisibilityByobject_id(siolaLegal, "841116", $(this).prop("checked"));
});
$("#siolaLegal_2a2").change(function () {
  setVisibilityByobject_id(siolaLegal, "838147", $(this).prop("checked"));
});
$("#siolaLegal_2a3").change(function () {
  setVisibilityByobject_id(siolaLegal, "840850", $(this).prop("checked"));
});
$("#siolaLegal_2a4").change(function () {
  setVisibilityByobject_id(siolaLegal, "829358", $(this).prop("checked"));
});
$("#siolaLegal_2a5").change(function () {
  setVisibilityByobject_id(siolaLegal, "829098", $(this).prop("checked"));
});
$("#siolaLegal_2a6").change(function () {
  setVisibilityByobject_id(siolaLegal, "839609", $(this).prop("checked"));
});
$("#siolaLegal_2a7").change(function () {
  setVisibilityByobject_id(siolaLegal, "913870", $(this).prop("checked"));
});

$("#siolaLegal_3a1").change(function () {
  setVisibilityByobject_id(siolaLegal, "914699", $(this).prop("checked"));
});
$("#siolaLegal_3a2").change(function () {
  setVisibilityByobject_id(siolaLegal, "831440", $(this).prop("checked"));
});
$("#siolaLegal_3a3").change(function () {
  setVisibilityByobject_id(siolaLegal, "843868", $(this).prop("checked"));
});
$("#siolaLegal_3a4").change(function () {
  setVisibilityByobject_id(siolaLegal, "830288", $(this).prop("checked"));
});
$("#siolaLegal_3a5").change(function () {
  setVisibilityByobject_id(siolaLegal, "831096", $(this).prop("checked"));
});
$("#siolaLegal_3a6").change(function () {
  setVisibilityByobject_id(siolaLegal, "848368", $(this).prop("checked"));
});
$("#siolaLegal_3a7").change(function () {
  setVisibilityByobject_id(siolaLegal, "847875", $(this).prop("checked"));
});

$("#siolaLegal_4a1").change(function () {
  setVisibilityByobject_id(siolaLegal, "849039", $(this).prop("checked"));
});
$("#siolaLegal_4a2").change(function () {
  setVisibilityByobject_id(siolaLegal, "886033", $(this).prop("checked"));
});
$("#siolaLegal_4a3").change(function () {
  setVisibilityByobject_id(siolaLegal, "849276", $(this).prop("checked"));
});

$("#siolaLegal_5a1").change(function () {
  setVisibilityByobject_id(siolaLegal, "850924", $(this).prop("checked"));
});

$("#zoomToSiolaLegal_1all").on('click', function () {
  setTransparentByobject_id(siolaLegal, [
    "817240",
    "825386",
    "820896",
    "820815",
    "919493",
    "820143",
    "821077",
    "823865",
    "821964",
    "826868"
  ]);
  zoomToTileset(siolaBuildingL1, -5, 90, 150);
});
$("#zoomToSiolaLegal_2all").on('click', function () {
  setTransparentByobject_id(siolaLegal, [
    "841116",
    "838147",
    "840850",
    "829358",
    "829098",
    "839609",
    "913870"
  ]);
  zoomToTileset(siolaBuildingL2, -10, 90, 150);
});
$("#zoomToSiolaLegal_3all").on('click', function () {
  setTransparentByobject_id(siolaLegal, [
    "914699",
    "831440",
    "843868",
    "830288",
    "831096",
    "848368",
    "847875"
  ]);
  zoomToTileset(siolaBuildingL3, -15, 90, 150);
});
$("#zoomToSiolaLegal_4all").on('click', function () {
  setTransparentByobject_id(siolaLegal, [
    "849039",
    "886033",
    "849276"
  ]);
  zoomToTileset(siolaBuildingL4, -15, 90, 150);
});
$("#zoomToSiolaLegal_5all").on('click', function () {
  setTransparentByobject_id(siolaLegal, [
    "850924",
  ]);
  zoomToTileset(siolaBuildingL5, -20, 90, 150);
});

$("#zoomToSiolaLegal_gsb").on('click', function () {
  setTransparentByobject_id(siolaLegal, "921704");
  zoomToLocation(70, -26, 112.73628989849963, -7.25698919103089, 10, 0);
});
$("#zoomToSiolaLegal_bt").on('click', function () {
  setTransparentByobject_id(siolaLegal, "910222");
  zoomToLocation(60, 65, 112.7364636251925, -7.257092539825164, -20, 0);
});
$("#zoomToSiolaLegal_bb").on('click', function () {
  setTransparentByobject_id(siolaLegal, "915961");
  zoomToLocation(60, 200, 112.7343253773387, -7.258348227236101, -20, 0);
});

$("#zoomToSiolaLegal_1a1").on('click', function () {
  setTransparentByobject_id(siolaLegal, "817240");
  zoomToLocation(115, 20, 112.7364701048379, -7.255725655809104, -5, 0);
});
$("#zoomToSiolaLegal_1a2").on('click', function () {
  setTransparentByobject_id(siolaLegal, "825386");
  zoomToLocation(70, 20, 112.73614083014726, -7.256673453774129, -5, 0);
});
$("#zoomToSiolaLegal_1a3").on('click', function () {
  setTransparentByobject_id(siolaLegal, "820896");
  zoomToLocation(70, 25, 112.73614083014726, -7.256673453774129, -15, 0);
});
$("#zoomToSiolaLegal_1a4").on('click', function () {
  setTransparentByobject_id(siolaLegal, "820815");
  zoomToLocation(115, 15, 112.73703300890135, -7.256062486631589, -20, 0);
});
$("#zoomToSiolaLegal_1a5").on('click', function () {
  setTransparentByobject_id(siolaLegal, "919493");
  zoomToLocation(180, 20, 112.73775089782131, -7.255339612039106, -5, 0);
});
$("#zoomToSiolaLegal_1a6").on('click', function () {
  setTransparentByobject_id(siolaLegal, "820143");
  zoomToLocation(180, 20, 112.73774879316747, -7.255707084659419, -20, 0);
});
$("#zoomToSiolaLegal_1a7").on('click', function () {
  setTransparentByobject_id(siolaLegal, "821077");
  zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -10, 0);
});
$("#zoomToSiolaLegal_1a8").on('click', function () {
  setTransparentByobject_id(siolaLegal, "823865");
  zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -15, 0);
});
$("#zoomToSiolaLegal_1a9").on('click', function () {
  setTransparentByobject_id(siolaLegal, "821964");
  zoomToLocation(20, 20, 112.73725740076955, -7.257555590592433, -15, 0);
});
$("#zoomToSiolaLegal_1a10").on('click', function () {
  setTransparentByobject_id(siolaLegal, "826868");
  zoomToLocation(345, 20, 112.73810487457202, -7.257580246584778, -5, 0);
});

$("#zoomToSiolaLegal_2a1").on('click', function () {
  setTransparentByobject_id(siolaLegal, "841116");
  zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -10, 0);
});
$("#zoomToSiolaLegal_2a2").on('click', function () {
  setTransparentByobject_id(siolaLegal, "838147");
  zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -10, 0);
});
$("#zoomToSiolaLegal_2a3").on('click', function () {
  setTransparentByobject_id(siolaLegal, "840850");
  zoomToLocation(70, 35, 112.73667745777747, -7.2567879531324495, -15, 0);
});
$("#zoomToSiolaLegal_2a4").on('click', function () {
  setTransparentByobject_id(siolaLegal, "829358");
  zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
});
$("#zoomToSiolaLegal_2a5").on('click', function () {
  setTransparentByobject_id(siolaLegal, "829098");
  zoomToLocation(175, 45, 112.73776680239449, -7.255272479365819, -15, 0);
});
$("#zoomToSiolaLegal_2a6").on('click', function () {
  setTransparentByobject_id(siolaLegal, "839609");
  zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
});
$("#zoomToSiolaLegal_2a7").on('click', function () {
  setTransparentByobject_id(siolaLegal, "913870");
  zoomToLocation(265, 20, 112.7389374537573, -7.2564733527464185, -15, 0);
});

$("#zoomToSiolaLegal_3a1").on('click', function () {
  setTransparentByobject_id(siolaLegal, "914699");
  zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -15, 0);
});
$("#zoomToSiolaLegal_3a2").on('click', function () {
  setTransparentByobject_id(siolaLegal, "831440");
  zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -15, 0);
});
$("#zoomToSiolaLegal_3a3").on('click', function () {
  setTransparentByobject_id(siolaLegal, "843868");
  zoomToLocation(70, 40, 112.73667745777747, -7.2567879531324495, -15, 0);
});
$("#zoomToSiolaLegal_3a4").on('click', function () {
  setTransparentByobject_id(siolaLegal, "830288");
  zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
});
$("#zoomToSiolaLegal_3a5").on('click', function () {
  setTransparentByobject_id(siolaLegal, "831096");
  zoomToLocation(175, 50, 112.73780550486839, -7.255527145036425, -25, 0);
});
$("#zoomToSiolaLegal_3a6").on('click', function () {
  setTransparentByobject_id(siolaLegal, "848368");
  zoomToLocation(180, 35, 112.73779026382113, -7.255632571893392, -15, 0);
});
$("#zoomToSiolaLegal_3a7").on('click', function () {
  setTransparentByobject_id(siolaLegal, "847875");
  zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
});

$("#zoomToSiolaLegal_4a1").on('click', function () {
  setTransparentByobject_id(siolaLegal, "849039");
  zoomToLocation(65, 75, 112.73661741237805, -7.256992873425595, -25, 0);
});
$("#zoomToSiolaLegal_4a2").on('click', function () {
  setTransparentByobject_id(siolaLegal, "886033");
  zoomToLocation(345, 75, 112.73813421339062, -7.257867208348932, -20, 0);
});
$("#zoomToSiolaLegal_4a3").on('click', function () {
  setTransparentByobject_id(siolaLegal, "849276");
  zoomToLocation(180, 80, 112.73814898604392, -7.255089250207667, -25, 0);
});

$("#zoomToSiolaLegal_5a1").on('click', function () {
  setTransparentByobject_id(siolaLegal, "850924");
  zoomToTileset(siolaBuildingL5, -20, 90, 150);
});


// Layering button Balai pemuda   #########################################################################
$("#balaiLevel_00").on('click', function () {
  balaiBuildingL0.show = $(this).prop("checked");
});
$("#balaiLevel_0").on('click', function () {
  balaiBuildingBasement.show = $(this).prop("checked");
});
$("#balaiLevel_1").on('click', function () {
  balaiBuildingL1.show = $(this).prop("checked");
});
$("#balaiLevel_2").on('click', function () {
  balaiBuildingL2.show = $(this).prop("checked");
});

$("#balaiLegal_GSB").change(function () {
  setVisibilityByobject_id(balaiLegal, "701720", $(this).prop("checked"));
});
$("#balaiLegal_BB").change(function () {
  setVisibilityByobject_id(balaiLegal, "670768", $(this).prop("checked"));
});
$("#balaiLegal_BT").change(function () {
  setVisibilityByobject_id(balaiLegal, "671122", $(this).prop("checked"));
});

$("#balaiLegal_1a1").change(function () {
  setVisibilityByobject_id(balaiLegal, "550615", $(this).prop("checked"));
});
$("#balaiLegal_1a2").change(function () {
  setVisibilityByobject_id(balaiLegal, "558371", $(this).prop("checked"));
});
$("#balaiLegal_1a3").change(function () {
  setVisibilityByobject_id(balaiLegal, "559588", $(this).prop("checked"));
});
$("#balaiLegal_1a4").change(function () {
  setVisibilityByobject_id(balaiLegal, "600819", $(this).prop("checked"));
});
$("#balaiLegal_1a5").change(function () {
  setVisibilityByobject_id(balaiLegal, "560626", $(this).prop("checked"));
});
$("#balaiLegal_1a6").change(function () {
  setVisibilityByobject_id(balaiLegal, "592037", $(this).prop("checked"));
});
$("#balaiLegal_1a7").change(function () {
  setVisibilityByobject_id(balaiLegal, "639829", $(this).prop("checked"));
});
$("#balaiLegal_1a8").change(function () {
  setVisibilityByobject_id(balaiLegal, "595885", $(this).prop("checked"));
});
$("#balaiLegal_1a9").change(function () {
  setVisibilityByobject_id(balaiLegal, "596362", $(this).prop("checked"));
});
$("#balaiLegal_1a10").change(function () {
  setVisibilityByobject_id(balaiLegal, "596892", $(this).prop("checked"));
});
$("#balaiLegal_1a11").change(function () {
  setVisibilityByobject_id(balaiLegal, "598132", $(this).prop("checked"));
});
$("#balaiLegal_1a12").change(function () {
  setVisibilityByobject_id(balaiLegal, "599448", $(this).prop("checked"));
});
$("#balaiLegal_1a13").change(function () {
  setVisibilityByobject_id(balaiLegal, "601254", $(this).prop("checked"));
});

$("#balaiLegal_0a1").change(function () {
  setVisibilityByobject_id(balaiLegal, "612619", $(this).prop("checked"));
});
$("#balaiLegal_0a2").change(function () {
  setVisibilityByobject_id(balaiLegal, "612232", $(this).prop("checked"));
});
$("#balaiLegal_0a3").change(function () {
  setVisibilityByobject_id(balaiLegal, "613040", $(this).prop("checked"));
});
$("#balaiLegal_0a4").change(function () {
  setVisibilityByobject_id(balaiLegal, "613441", $(this).prop("checked"));
});
$("#balaiLegal_0a5").change(function () {
  setVisibilityByobject_id(balaiLegal, "610552", $(this).prop("checked"));
});
$("#balaiLegal_0a6").change(function () {
  setVisibilityByobject_id(balaiLegal, "611250", $(this).prop("checked"));
});
$("#balaiLegal_0a7").change(function () {
  setVisibilityByobject_id(balaiLegal, "611746", $(this).prop("checked"));
});
$("#balaiLegal_0a8").change(function () {
  setVisibilityByobject_id(balaiLegal, "610016", $(this).prop("checked"));
});
$("#balaiLegal_0a9").change(function () {
  setVisibilityByobject_id(balaiLegal, "609329", $(this).prop("checked"));
});

$("#zoomToBalaiLegal_0all").on('click', function () {
  setTransparentByobject_id(balaiLegal, [
    "612619",
    "612232",
    "613040",
    "613441",
    "610552",
    "611250",
    "611746",
    "610016",
    "609329"
  ]);
  zoomToTileset(balaiBuildingL1, -25, 355, 150);
});
$("#zoomToBalaiLegal_1all").on('click', function () {
  setTransparentByobject_id(balaiLegal, [
    "550615",
    "558371",
    "559588",
    "600819",
    "560626",
    "592037",
    "639829",
    "595885",
    "596362",
    "596892",
    "598132",
    "599448",
    "601254"
  ]);
  zoomToTileset(balaiBuildingL1, -25, 0, 100);
});

$("#zoomToBalaiLegal_gsb").on('click', function () {
  zoomToLocation(20, 120, 112.74437101987753, -7.265618497548999, -25, 0);
});
$("#zoomToBalaiLegal_bt").on('click', function () {
  zoomToLocation(20, 250, 112.7432787543901, -7.267368495006733, -25, 0);
});
$("#zoomToBalaiLegal_bb").on('click', function () {
  zoomToLocation(20, -35, 112.74455852005875, -7.266254249795577, 11, 0);
});

$("#zoomToBalaiLegal_1a1").on('click', function () {
  setTransparentByobject_id(balaiLegal, "550615");
  zoomToLocation(20, 25, 112.74508005165397, -7.2642500848764255, -25, 0);
});
$("#zoomToBalaiLegal_1a2").on('click', function () {
  setTransparentByobject_id(balaiLegal, "558371");
  zoomToLocation(20, 25, 112.74508005165397, -7.2642500848764255, -25, 0);
});
$("#zoomToBalaiLegal_1a3").on('click', function () {
  setTransparentByobject_id(balaiLegal, "559588");
  zoomToLocation(20, 25, 112.74514755642848, -7.2642758111076615, -25, 0);
});
$("#zoomToBalaiLegal_1a4").on('click', function () {
  setTransparentByobject_id(balaiLegal, "600819");
  zoomToLocation(20, 25, 112.74526629406043, -7.264316162622997, -25, 0);
});
$("#zoomToBalaiLegal_1a5").on('click', function () {
  setTransparentByobject_id(balaiLegal, "560626");
  zoomToLocation(20, 25, 112.74521826029621, -7.264175080955373, -25, 0);
});
$("#zoomToBalaiLegal_1a6").on('click', function () {
  setTransparentByobject_id(balaiLegal, "592037");
  zoomToLocation(20, 25, 112.74521802863246, -7.264175001191377, -25, 0);
});
$("#zoomToBalaiLegal_1a7").on('click', function () {
  setTransparentByobject_id(balaiLegal, "639829");
  zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
});
$("#zoomToBalaiLegal_1a8").on('click', function () {
  setTransparentByobject_id(balaiLegal, "595885");
  zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
});
$("#zoomToBalaiLegal_1a9").on('click', function () {
  setTransparentByobject_id(balaiLegal, "596362");
  zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
});
$("#zoomToBalaiLegal_1a10").on('click', function () {
  setTransparentByobject_id(balaiLegal, "596892");
  zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
});
$("#zoomToBalaiLegal_1a11").on('click', function () {
  setTransparentByobject_id(balaiLegal, "598132");
  zoomToLocation(20, 30, 112.74530959098915, -7.264052226780129, -45, 0);
});
$("#zoomToBalaiLegal_1a12").on('click', function () {
  setTransparentByobject_id(balaiLegal, "599448");
  zoomToLocation(20, 30, 112.74530959098915, -7.264052226780129, -45, 0);
});
$("#zoomToBalaiLegal_1a13").on('click', function () {
  setTransparentByobject_id(balaiLegal, "601254");
  zoomToLocation(20, 30, 112.74534520728557, -7.264096743894646, -45, 0);
});

$("#zoomToBalaiLegal_0a1").on('click', function () {
  setTransparentByobject_id(balaiLegal, "612619");
  zoomToLocation(11, 60, 112.7455540723557, -7.264151688578575, -60, 0);
});
$("#zoomToBalaiLegal_0a2").on('click', function () {
  setTransparentByobject_id(balaiLegal, "612232");
  zoomToLocation(11, 60, 112.7455540723557, -7.264151688578575, -60, 0);
});
$("#zoomToBalaiLegal_0a3").on('click', function () {
  setTransparentByobject_id(balaiLegal, "613040");
  zoomToLocation(11, 60, 112.74570068943898, -7.2641893323861195, -60, 0);
});
$("#zoomToBalaiLegal_0a4").on('click', function () {
  setTransparentByobject_id(balaiLegal, "613441");
  zoomToLocation(11, 60, 112.74570068943898, -7.2641893323861195, -60, 0);
});
$("#zoomToBalaiLegal_0a5").on('click', function () {
  setTransparentByobject_id(balaiLegal, "610552");
  zoomToLocation(20, 105, 112.74553493614476, -7.264522246696736, -60, 0);
});
$("#zoomToBalaiLegal_0a6").on('click', function () {
  setTransparentByobject_id(balaiLegal, "611250");
  zoomToLocation(20, 105, 112.74553493614476, -7.264522246696736, -60, 0);
});
$("#zoomToBalaiLegal_0a7").on('click', function () {
  setTransparentByobject_id(balaiLegal, "611746");
  zoomToLocation(20, 105, 112.74553493614476, -7.264522246696736, -60, 0);
});
$("#zoomToBalaiLegal_0a8").on('click', function () {
  setTransparentByobject_id(balaiLegal, "610016");
  zoomToLocation(20, 105, 112.74541372870215, -7.264674661924839, -60, 0);
});
$("#zoomToBalaiLegal_0a9").on('click', function () {
  setTransparentByobject_id(balaiLegal, "609329");
  zoomToLocation(11, 60, 112.74502607249624, -7.264704384970404, -60, 0);
});

// Layering button Rusunawa   #############################################################################
$("#rusunawaLevel_0").change(function () {
  rusunawaBuildingL0.show = $(this).prop("checked");
});
$("#rusunawaLevel_1").change(function () {
  rusunawaBuildingL1.show = $(this).prop("checked");
});
$("#rusunawaLevel_2").change(function () {
  rusunawaBuildingL2.show = $(this).prop("checked");
});
$("#rusunawaLevel_3").change(function () {
  rusunawaBuildingL3.show = $(this).prop("checked");
});
$("#rusunawaLevel_4").change(function () {
  rusunawaBuildingL4.show = $(this).prop("checked");
});
$("#rusunawaLevel_5").change(function () {
  rusunawaBuildingL5.show = $(this).prop("checked");
});
$("#rusunawaLevel_r").change(function () {
  rusunawaBuildingL6.show = $(this).prop("checked");
});

$("#rusunawaLegal_GSB").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "615229", $(this).prop("checked"));
});
$("#rusunawaLegal_BB").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "598698", $(this).prop("checked"));
});
$("#rusunawaLegal_BT").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "598583", $(this).prop("checked"));
});

$("#rusunawaLegal_1a1").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "599276", $(this).prop("checked"));
});
$("#rusunawaLegal_1a2").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "599642", $(this).prop("checked"));
});
$("#rusunawaLegal_1a3").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619195", $(this).prop("checked"));
});
$("#rusunawaLegal_1a4").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619194", $(this).prop("checked"));
});
$("#rusunawaLegal_1a5").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619196", $(this).prop("checked"));
});
$("#rusunawaLegal_1a6").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "601694", $(this).prop("checked"));
});
$("#rusunawaLegal_1a7").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "601835", $(this).prop("checked"));
});
$("#rusunawaLegal_1a8").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "601952", $(this).prop("checked"));
});
$("#rusunawaLegal_1a9").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "600414", $(this).prop("checked"));
});
$("#rusunawaLegal_1a10").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "600975", $(this).prop("checked"));
});
$("#rusunawaLegal_1a11").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "600292", $(this).prop("checked"));
});
$("#rusunawaLegal_1a12").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "600222", $(this).prop("checked"));
});
$("#rusunawaLegal_1a13").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "600145", $(this).prop("checked"));
});
$("#rusunawaLegal_1a14").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "600045", $(this).prop("checked"));
});
$("#rusunawaLegal_1a15").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "599963", $(this).prop("checked"));
});
$("#rusunawaLegal_1a16").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "599868", $(this).prop("checked"));
});
$("#rusunawaLegal_1a17").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "599584", $(this).prop("checked"));
});

$("#rusunawaLegal_2a1").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "602333", $(this).prop("checked"));
});
$("#rusunawaLegal_2a2").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619134", $(this).prop("checked"));
});
$("#rusunawaLegal_2a3").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619144", $(this).prop("checked"));
});
$("#rusunawaLegal_2a4").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619135", $(this).prop("checked"));
});
$("#rusunawaLegal_2a5").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619136", $(this).prop("checked"));
});
$("#rusunawaLegal_2a6").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619137", $(this).prop("checked"));
});
$("#rusunawaLegal_2a7").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619138", $(this).prop("checked"));
});
$("#rusunawaLegal_2a8").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619139", $(this).prop("checked"));
});
$("#rusunawaLegal_2a9").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619140", $(this).prop("checked"));
});
$("#rusunawaLegal_2a10").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619141", $(this).prop("checked"));
});
$("#rusunawaLegal_2a11").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619142", $(this).prop("checked"));
});
$("#rusunawaLegal_2a12").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619145", $(this).prop("checked"));
});
$("#rusunawaLegal_2a13").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "619143", $(this).prop("checked"));
});
$("#rusunawaLegal_2a14").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "602474", $(this).prop("checked"));
});
$("#rusunawaLegal_2a15").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618566", $(this).prop("checked"));
});
$("#rusunawaLegal_2a16").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618555", $(this).prop("checked"));
});
$("#rusunawaLegal_2a17").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618556", $(this).prop("checked"));
});
$("#rusunawaLegal_2a18").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618557", $(this).prop("checked"));
});
$("#rusunawaLegal_2a19").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618558", $(this).prop("checked"));
});
$("#rusunawaLegal_2a20").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618559", $(this).prop("checked"));
});
$("#rusunawaLegal_2a21").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618560", $(this).prop("checked"));
});
$("#rusunawaLegal_2a22").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618561", $(this).prop("checked"));
});
$("#rusunawaLegal_2a23").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618562", $(this).prop("checked"));
});
$("#rusunawaLegal_2a24").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618563", $(this).prop("checked"));
});
$("#rusunawaLegal_2a25").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618564", $(this).prop("checked"));
});
$("#rusunawaLegal_2a26").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618565", $(this).prop("checked"));
});

$("#rusunawaLegal_3a1").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "606558", $(this).prop("checked"));
});
$("#rusunawaLegal_3a2").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618912", $(this).prop("checked"));
});
$("#rusunawaLegal_3a3").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618922", $(this).prop("checked"));
});
$("#rusunawaLegal_3a4").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618913", $(this).prop("checked"));
});
$("#rusunawaLegal_3a5").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618914", $(this).prop("checked"));
});
$("#rusunawaLegal_3a6").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618915", $(this).prop("checked"));
});
$("#rusunawaLegal_3a7").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618916", $(this).prop("checked"));
});
$("#rusunawaLegal_3a8").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618917", $(this).prop("checked"));
});
$("#rusunawaLegal_3a9").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618918", $(this).prop("checked"));
});
$("#rusunawaLegal_3a10").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618919", $(this).prop("checked"));
});
$("#rusunawaLegal_3a11").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618920", $(this).prop("checked"));
});
$("#rusunawaLegal_3a12").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618923", $(this).prop("checked"));
});
$("#rusunawaLegal_3a13").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618921", $(this).prop("checked"));
});
$("#rusunawaLegal_3a14").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "606910", $(this).prop("checked"));
});
$("#rusunawaLegal_3a15").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618455", $(this).prop("checked"));
});
$("#rusunawaLegal_3a16").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618444", $(this).prop("checked"));
});
$("#rusunawaLegal_3a17").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618445", $(this).prop("checked"));
});
$("#rusunawaLegal_3a18").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618446", $(this).prop("checked"));
});
$("#rusunawaLegal_3a19").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618447", $(this).prop("checked"));
});
$("#rusunawaLegal_3a20").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618448", $(this).prop("checked"));
});
$("#rusunawaLegal_3a21").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618449", $(this).prop("checked"));
});
$("#rusunawaLegal_3a22").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618450", $(this).prop("checked"));
});
$("#rusunawaLegal_3a23").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618451", $(this).prop("checked"));
});
$("#rusunawaLegal_3a24").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618452", $(this).prop("checked"));
});
$("#rusunawaLegal_3a25").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618453", $(this).prop("checked"));
});
$("#rusunawaLegal_3a26").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618454", $(this).prop("checked"));
});

$("#rusunawaLegal_4a1").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "607296", $(this).prop("checked"));
});
$("#rusunawaLegal_4a2").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618801", $(this).prop("checked"));
});
$("#rusunawaLegal_4a3").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618811", $(this).prop("checked"));
});
$("#rusunawaLegal_4a4").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618802", $(this).prop("checked"));
});
$("#rusunawaLegal_4a5").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618803", $(this).prop("checked"));
});
$("#rusunawaLegal_4a6").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618804", $(this).prop("checked"));
});
$("#rusunawaLegal_4a7").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618805", $(this).prop("checked"));
});
$("#rusunawaLegal_4a8").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618806", $(this).prop("checked"));
});
$("#rusunawaLegal_4a9").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618807", $(this).prop("checked"));
});
$("#rusunawaLegal_4a10").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618808", $(this).prop("checked"));
});
$("#rusunawaLegal_4a11").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618809", $(this).prop("checked"));
});
$("#rusunawaLegal_4a12").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618812", $(this).prop("checked"));
});
$("#rusunawaLegal_4a13").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618810", $(this).prop("checked"));
});
$("#rusunawaLegal_4a14").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "606926", $(this).prop("checked"));
});
$("#rusunawaLegal_4a15").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618344", $(this).prop("checked"));
});
$("#rusunawaLegal_4a16").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618333", $(this).prop("checked"));
});
$("#rusunawaLegal_4a17").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618334", $(this).prop("checked"));
});
$("#rusunawaLegal_4a18").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618335", $(this).prop("checked"));
});
$("#rusunawaLegal_4a19").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618336", $(this).prop("checked"));
});
$("#rusunawaLegal_4a20").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618337", $(this).prop("checked"));
});
$("#rusunawaLegal_4a21").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618338", $(this).prop("checked"));
});
$("#rusunawaLegal_4a22").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618339", $(this).prop("checked"));
});
$("#rusunawaLegal_4a23").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618340", $(this).prop("checked"));
});
$("#rusunawaLegal_4a24").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618341", $(this).prop("checked"));
});
$("#rusunawaLegal_4a25").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618342", $(this).prop("checked"));
});
$("#rusunawaLegal_4a26").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618343", $(this).prop("checked"));
});

$("#rusunawaLegal_5a1").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "607326", $(this).prop("checked"));
});
$("#rusunawaLegal_5a2").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618690", $(this).prop("checked"));
});
$("#rusunawaLegal_5a3").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618700", $(this).prop("checked"));
});
$("#rusunawaLegal_5a4").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618691", $(this).prop("checked"));
});
$("#rusunawaLegal_5a5").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618692", $(this).prop("checked"));
});
$("#rusunawaLegal_5a6").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618693", $(this).prop("checked"));
});
$("#rusunawaLegal_5a7").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618694", $(this).prop("checked"));
});
$("#rusunawaLegal_5a8").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618695", $(this).prop("checked"));
});
$("#rusunawaLegal_5a9").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618696", $(this).prop("checked"));
});
$("#rusunawaLegal_5a10").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618697", $(this).prop("checked"));
});
$("#rusunawaLegal_5a11").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618698", $(this).prop("checked"));
});
$("#rusunawaLegal_5a12").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618701", $(this).prop("checked"));
});
$("#rusunawaLegal_5a13").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618699", $(this).prop("checked"));
});
$("#rusunawaLegal_5a14").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "606942", $(this).prop("checked"));
});
$("#rusunawaLegal_5a15").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618233", $(this).prop("checked"));
});
$("#rusunawaLegal_5a16").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618222", $(this).prop("checked"));
});
$("#rusunawaLegal_5a17").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618223", $(this).prop("checked"));
});
$("#rusunawaLegal_5a18").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618224", $(this).prop("checked"));
});
$("#rusunawaLegal_5a19").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618225", $(this).prop("checked"));
});
$("#rusunawaLegal_5a20").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618226", $(this).prop("checked"));
});
$("#rusunawaLegal_5a21").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618227", $(this).prop("checked"));
});
$("#rusunawaLegal_5a22").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618228", $(this).prop("checked"));
});
$("#rusunawaLegal_5a23").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618229", $(this).prop("checked"));
});
$("#rusunawaLegal_5a24").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618230", $(this).prop("checked"));
});
$("#rusunawaLegal_5a25").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618231", $(this).prop("checked"));
});
$("#rusunawaLegal_5a26").change(function () {
  setVisibilityByobject_id(rusunawaLegal, "618232", $(this).prop("checked"));
});


$("#zoomToRusunawaLegal_1all").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, [
    "599276",
    "599642",
    "619195",
    "619194",
    "619196",
    "601694",
    "601835",
    "601952",
    "600414",
    "600975",
    "600292",
    "600222",
    "600145",
    "600045",
    "599963",
    "599868",
    "599584",
  ]);
  zoomToTileset(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_2all").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, [
    "602333",
    "619134",
    "619144",
    "619135",
    "619136",
    "619137",
    "619138",
    "619139",
    "619140",
    "619141",
    "619142",
    "619145",
    "619143",
    "602474",
    "618566",
    "618555",
    "618556",
    "618557",
    "618558",
    "618559",
    "618560",
    "618561",
    "618562",
    "618563",
    "618564",
    "618565",
  ]);
  zoomToTileset(rusunawaBuildingL2, -25, 180, 100);
});
$("#zoomToRusunawaLegal_3all").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, [
    "606558",
    "618912",
    "618922",
    "618913",
    "618914",
    "618915",
    "618916",
    "618917",
    "618918",
    "618919",
    "618920",
    "618923",
    "618921",
    "606910",
    "618455",
    "618444",
    "618445",
    "618446",
    "618447",
    "618448",
    "618449",
    "618450",
    "618451",
    "618452",
    "618453",
    "618454",
  ]);
  zoomToTileset(rusunawaBuildingL3, -25, 180, 100);
});
$("#zoomToRusunawaLegal_4all").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, [
    "607296",
    "618801",
    "618811",
    "618802",
    "618803",
    "618804",
    "618805",
    "618806",
    "618807",
    "618808",
    "618809",
    "618812",
    "618810",
    "606926",
    "618344",
    "618333",
    "618334",
    "618335",
    "618336",
    "618337",
    "618338",
    "618339",
    "618340",
    "618341",
    "618342",
    "618343",
  ]);
  zoomToTileset(rusunawaBuildingL4, -25, 180, 100);
});
$("#zoomToRusunawaLegal_5all").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, [
    "607326",
    "618690",
    "618700",
    "618691",
    "618692",
    "618693",
    "618694",
    "618695",
    "618696",
    "618697",
    "618698",
    "618701",
    "618699",
    "606942",
    "618233",
    "618222",
    "618223",
    "618224",
    "618225",
    "618226",
    "618227",
    "618228",
    "618229",
    "618230",
    "618231",
    "618232",
  ]);
  zoomToTileset(rusunawaBuildingL5, -25, 180, 100);
});

$("#zoomToRusunawaLegal_gsb").on('click', function () {
  zoomToLocation(200, 55, 112.64532688605156, -8.0095746475103, -20, 0);
});
$("#zoomToRusunawaLegal_bt").on('click', function () {
  zoomToLocation(195, 80, 112.64557670743565, -8.009150136716535, -15, 0);
});
$("#zoomToRusunawaLegal_bb").on('click', function () {
  zoomToLocation(205, -15, 112.645600600889, -8.009171410209218, 2, 0);
});

$("#zoomToRusunawaLegal_1a1").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "599276");
  zoomToLocation(265, 50, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_1a2").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "599642");
  zoomToLocation(180, 15, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_1a3").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619195");
  zoomToLocation(180, 15, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_1a4").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619194");
  zoomToLocation(180, 15, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_1a5").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619196");
  zoomToLocation(180, 15, 112.64500479106304, -8.010318705620248, -15, 0);
});
$("#zoomToRusunawaLegal_1a6").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "601694");
  zoomToLocation(180, 15, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_1a7").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "601835");
  zoomToLocation(180, 15, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_1a8").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "601952");
  zoomToLocation(180, 15, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_1a9").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "600414");
  zoomToLocation(180, 15, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_1a10").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "600975");
  zoomToLocation(100, 10, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_1a11").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "600292");
  zoomToLocation(0, 15, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_1a12").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "600222");
  zoomToLocation(0, 15, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_1a13").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "600145");
  zoomToLocation(0, 15, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_1a14").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "600045");
  zoomToLocation(0, 15, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_1a15").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "599963");
  zoomToLocation(0, 15, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_1a16").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "599868");
  zoomToLocation(0, 15, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_1a17").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "599584");
  zoomToLocation(0, 15, 112.64503407814374, -8.011198707875575, -15, 0);
});

$("#zoomToRusunawaLegal_2a1").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "602333");
  zoomToLocation(265, 52, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_2a2").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619134");
  zoomToLocation(180, 17, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_2a3").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619144");
  zoomToLocation(180, 17, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_2a4").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619135");
  zoomToLocation(180, 17, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_2a5").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619136");
  zoomToLocation(180, 17, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_2a6").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619137");
  zoomToLocation(180, 17, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_2a7").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619138");
  zoomToLocation(180, 17, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_2a8").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619139");
  zoomToLocation(180, 17, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_2a9").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619140");
  zoomToLocation(180, 17, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_2a10").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619141");
  zoomToLocation(180, 17, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_2a11").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619142");
  zoomToLocation(180, 17, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_2a12").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619145");
  zoomToLocation(180, 17, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_2a13").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "619143");
  zoomToLocation(180, 17, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_2a14").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "602474");
  zoomToLocation(100, 10, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_2a15").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618566");
  zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_2a16").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618555");
  zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_2a17").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618556");
  zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_2a18").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618557");
  zoomToLocation(0, 17, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_2a19").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618558");
  zoomToLocation(0, 17, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_2a20").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618559");
  zoomToLocation(0, 17, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_2a21").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618560");
  zoomToLocation(0, 17, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_2a22").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618561");
  zoomToLocation(0, 17, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_2a23").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618562");
  zoomToLocation(0, 17, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_2a24").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618563");
  zoomToLocation(0, 17, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_2a25").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618564");
  zoomToLocation(0, 17, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_2a26").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618565");
  zoomToLocation(0, 17, 112.64510790597768, -8.011194667555896, -15, 0);
});

$("#zoomToRusunawaLegal_3a1").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "606558");
  zoomToLocation(265, 54, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_3a2").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618912");
  zoomToLocation(180, 19, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_3a3").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618922");
  zoomToLocation(180, 19, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_3a4").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618913");
  zoomToLocation(180, 19, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_3a5").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618914");
  zoomToLocation(180, 19, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_3a6").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618915");
  zoomToLocation(180, 19, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_3a7").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618916");
  zoomToLocation(180, 19, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_3a8").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618917");
  zoomToLocation(180, 19, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_3a9").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618918");
  zoomToLocation(180, 19, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_3a10").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618919");
  zoomToLocation(180, 19, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_3a11").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618920");
  zoomToLocation(180, 19, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_3a12").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618923");
  zoomToLocation(180, 19, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_3a13").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618921");
  zoomToLocation(180, 19, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_3a14").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "606910");
  zoomToLocation(100, 14, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_3a15").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618455");
  zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_3a16").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618444");
  zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_3a17").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618445");
  zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_3a18").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618446");
  zoomToLocation(0, 19, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_3a19").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618447");
  zoomToLocation(0, 19, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_3a20").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618448");
  zoomToLocation(0, 19, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_3a21").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618449");
  zoomToLocation(0, 19, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_3a22").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618450");
  zoomToLocation(0, 19, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_3a23").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618451");
  zoomToLocation(0, 19, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_3a24").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618452");
  zoomToLocation(0, 19, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_3a25").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618453");
  zoomToLocation(0, 19, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_3a26").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618454");
  zoomToLocation(0, 19, 112.64510790597768, -8.011194667555896, -15, 0);
});

$("#zoomToRusunawaLegal_4a1").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "607296");
  zoomToLocation(265, 56, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_4a2").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618801");
  zoomToLocation(180, 21, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_4a3").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618811");
  zoomToLocation(180, 21, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_4a4").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618802");
  zoomToLocation(180, 21, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_4a5").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618803");
  zoomToLocation(180, 21, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_4a6").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618804");
  zoomToLocation(180, 21, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_4a7").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618805");
  zoomToLocation(180, 21, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_4a8").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618806");
  zoomToLocation(180, 21, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_4a9").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618807");
  zoomToLocation(180, 21, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_4a10").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618808");
  zoomToLocation(180, 21, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_4a11").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618809");
  zoomToLocation(180, 21, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_4a12").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618812");
  zoomToLocation(180, 21, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_4a13").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618810");
  zoomToLocation(180, 21, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_4a14").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "606926");
  zoomToLocation(100, 16, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_4a15").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618344");
  zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_4a16").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618333");
  zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_4a17").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618334");
  zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_4a18").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618335");
  zoomToLocation(0, 21, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_4a19").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618336");
  zoomToLocation(0, 21, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_4a20").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618337");
  zoomToLocation(0, 21, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_4a21").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618338");
  zoomToLocation(0, 21, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_4a22").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618339");
  zoomToLocation(0, 21, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_4a23").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618340");
  zoomToLocation(0, 21, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_4a24").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618341");
  zoomToLocation(0, 21, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_4a25").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618342");
  zoomToLocation(0, 21, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_4a26").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618343");
  zoomToLocation(0, 21, 112.64510790597768, -8.011194667555896, -15, 0);
});

$("#zoomToRusunawaLegal_5a1").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "607326");
  zoomToLocation(265, 58, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_5a2").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618690");
  zoomToLocation(180, 23, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_5a3").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618700");
  zoomToLocation(180, 23, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_5a4").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618691");
  zoomToLocation(180, 23, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_5a5").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618692");
  zoomToLocation(180, 23, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_5a6").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618693");
  zoomToLocation(180, 23, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_5a7").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618694");
  zoomToLocation(180, 23, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_5a8").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618695");
  zoomToLocation(180, 23, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_5a9").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618696");
  zoomToLocation(180, 23, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_5a10").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618697");
  zoomToLocation(180, 23, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_5a11").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618698");
  zoomToLocation(180, 23, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_5a12").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618701");
  zoomToLocation(180, 23, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_5a13").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618699");
  zoomToLocation(180, 23, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_5a14").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "606942");
  zoomToLocation(100, 18, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_5a15").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618233");
  zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_5a16").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618222");
  zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_5a17").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618223");
  zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_5a18").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618224");
  zoomToLocation(0, 23, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_5a19").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618225");
  zoomToLocation(0, 23, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_5a20").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618226");
  zoomToLocation(0, 23, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_5a21").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618227");
  zoomToLocation(0, 23, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_5a22").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618228");
  zoomToLocation(0, 23, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_5a23").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618229");
  zoomToLocation(0, 23, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_5a24").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618230");
  zoomToLocation(0, 23, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_5a25").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618231");
  zoomToLocation(0, 23, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_5a26").on('click', function () {
  setTransparentByobject_id(rusunawaLegal, "618232");
  zoomToLocation(0, 23, 112.64510790597768, -8.011194667555896, -15, 0);
});


// Measure Toggle Tool
var measure = false;
const tool = new MeasureTool(viewer, {})
$("#meassure").click(function (e) {
  $(".measure-panel").toggleClass('measure-panel-show');
  $("#meassure").toggleClass('selected');
  if ($(".measure-panel").hasClass('measure-panel-show')) {
    measure = true;
  } else {
    measure = false;
    tool.clearAll();
  }
});
$("#mdistance").click(function (e) {
  measure = true;
  measure ? tool.activate('distance') : null;
});
$("#marea").click(function (e) {
  measure = true;
  measure ? tool.activate('area') : null;
});
$("#mclear").click(function (e) {
  tool.clearAll()
  measure = false;
});


//// Layering check/uncheck all ##########################################################################
// siola
$('#siolaLevelAllHide').click(function () {
  siolaBuildingL0.show = false;
  siolaBuildingL1.show = false;
  siolaBuildingL2.show = false;
  siolaBuildingL3.show = false;
  siolaBuildingL4.show = false;
  siolaBuildingL5.show = false;
  $('.siola-building-layer-panel .set_level').prop('checked', false);
});
$('#siolaLevelAllShow').click(function () {
  siolaBuildingL0.show = true;
  siolaBuildingL1.show = true;
  siolaBuildingL2.show = true;
  siolaBuildingL3.show = true;
  siolaBuildingL4.show = true;
  siolaBuildingL5.show = true;
  $('.siola-building-layer-panel .set_level').prop('checked', true);
});

$("#siolaLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(siolaLegal, "817240", isChecked);
  setVisibilityByobject_id(siolaLegal, "825386", isChecked);
  setVisibilityByobject_id(siolaLegal, "820896", isChecked);
  setVisibilityByobject_id(siolaLegal, "820815", isChecked);
  setVisibilityByobject_id(siolaLegal, "919493", isChecked);
  setVisibilityByobject_id(siolaLegal, "820143", isChecked);
  setVisibilityByobject_id(siolaLegal, "821077", isChecked);
  setVisibilityByobject_id(siolaLegal, "823865", isChecked);
  setVisibilityByobject_id(siolaLegal, "821964", isChecked);
  setVisibilityByobject_id(siolaLegal, "826868", isChecked);
});
$("#siolaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(siolaLegal, "841116", isChecked);
  setVisibilityByobject_id(siolaLegal, "838147", isChecked);
  setVisibilityByobject_id(siolaLegal, "840850", isChecked);
  setVisibilityByobject_id(siolaLegal, "829358", isChecked);
  setVisibilityByobject_id(siolaLegal, "829098", isChecked);
  setVisibilityByobject_id(siolaLegal, "839609", isChecked);
  setVisibilityByobject_id(siolaLegal, "913870", isChecked);
});
$("#siolaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(siolaLegal, "914699", isChecked);
  setVisibilityByobject_id(siolaLegal, "831440", isChecked);
  setVisibilityByobject_id(siolaLegal, "843868", isChecked);
  setVisibilityByobject_id(siolaLegal, "830288", isChecked);
  setVisibilityByobject_id(siolaLegal, "831096", isChecked);
  setVisibilityByobject_id(siolaLegal, "848368", isChecked);
  setVisibilityByobject_id(siolaLegal, "847875", isChecked);
});
$("#siolaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(siolaLegal, "849039", isChecked);
  setVisibilityByobject_id(siolaLegal, "886033", isChecked);
  setVisibilityByobject_id(siolaLegal, "849276", isChecked);
});
$("#siolaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(siolaLegal, "850924", isChecked);
});

// balai pemuda
$('#balaiLevelAllHide').click(function () {
  balaiBuildingL0.show = false;
  balaiBuildingBasement.show = false;
  balaiBuildingL1.show = false;
  balaiBuildingL2.show = false;
  $('.balai-building-layer-panel .set_level').prop('checked', false);
});
$('#balaiLevelAllShow').click(function () {
  balaiBuildingL0.show = true;
  balaiBuildingBasement.show = true;
  balaiBuildingL1.show = true;
  balaiBuildingL2.show = true;
  $('.balai-building-layer-panel .set_level').prop('checked', true);
});

$("#balaiLegal_0all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    setVisibilityByobject_id(balaiLegal, "612619", isChecked);
    setVisibilityByobject_id(balaiLegal, "612232", isChecked);
    setVisibilityByobject_id(balaiLegal, "613040", isChecked);
    setVisibilityByobject_id(balaiLegal, "613441", isChecked);
    setVisibilityByobject_id(balaiLegal, "610552", isChecked);
    setVisibilityByobject_id(balaiLegal, "611250", isChecked);
    setVisibilityByobject_id(balaiLegal, "611746", isChecked);
    setVisibilityByobject_id(balaiLegal, "610016", isChecked);
    setVisibilityByobject_id(balaiLegal, "609329", isChecked);
    setVisibilityByobject_id(balaiLegal, "609123", isChecked);
    setVisibilityByobject_id(balaiLegal, "609456", isChecked);
  } else {
    setVisibilityByobject_id(balaiLegal, "612619", isChecked);
    setVisibilityByobject_id(balaiLegal, "612232", isChecked);
    setVisibilityByobject_id(balaiLegal, "613040", isChecked);
    setVisibilityByobject_id(balaiLegal, "613441", isChecked);
    setVisibilityByobject_id(balaiLegal, "610552", isChecked);
    setVisibilityByobject_id(balaiLegal, "611250", isChecked);
    setVisibilityByobject_id(balaiLegal, "611746", isChecked);
    setVisibilityByobject_id(balaiLegal, "610016", isChecked);
    setVisibilityByobject_id(balaiLegal, "609329", isChecked);
    setVisibilityByobject_id(balaiLegal, "609123", isChecked);
    setVisibilityByobject_id(balaiLegal, "609456", isChecked);
  }
});
$("#balaiLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {
    setVisibilityByobject_id(balaiLegal, "550615", isChecked);
    setVisibilityByobject_id(balaiLegal, "558371", isChecked);
    setVisibilityByobject_id(balaiLegal, "559588", isChecked);
    setVisibilityByobject_id(balaiLegal, "600819", isChecked);
    setVisibilityByobject_id(balaiLegal, "560626", isChecked);
    setVisibilityByobject_id(balaiLegal, "592037", isChecked);
    setVisibilityByobject_id(balaiLegal, "639829", isChecked);
    setVisibilityByobject_id(balaiLegal, "595885", isChecked);
    setVisibilityByobject_id(balaiLegal, "596362", isChecked);
    setVisibilityByobject_id(balaiLegal, "596892", isChecked);
    setVisibilityByobject_id(balaiLegal, "598132", isChecked);
    setVisibilityByobject_id(balaiLegal, "599448", isChecked);
    setVisibilityByobject_id(balaiLegal, "601254", isChecked);
  } else {
    setVisibilityByobject_id(balaiLegal, "550615", isChecked);
    setVisibilityByobject_id(balaiLegal, "558371", isChecked);
    setVisibilityByobject_id(balaiLegal, "559588", isChecked);
    setVisibilityByobject_id(balaiLegal, "600819", isChecked);
    setVisibilityByobject_id(balaiLegal, "560626", isChecked);
    setVisibilityByobject_id(balaiLegal, "592037", isChecked);
    setVisibilityByobject_id(balaiLegal, "639829", isChecked);
    setVisibilityByobject_id(balaiLegal, "595885", isChecked);
    setVisibilityByobject_id(balaiLegal, "596362", isChecked);
    setVisibilityByobject_id(balaiLegal, "596892", isChecked);
    setVisibilityByobject_id(balaiLegal, "598132", isChecked);
    setVisibilityByobject_id(balaiLegal, "599448", isChecked);
    setVisibilityByobject_id(balaiLegal, "601254", isChecked);
  }
});

// rusunawa
$('#rusunawaLevelAllHide').click(function () {
  rusunawaBuildingL0.show = false;
  rusunawaBuildingL1.show = false;
  rusunawaBuildingL2.show = false;
  rusunawaBuildingL3.show = false;
  rusunawaBuildingL4.show = false;
  rusunawaBuildingL5.show = false;
  rusunawaBuildingL6.show = false;
  $('.rusunawa-building-layer-panel .set_level').prop('checked', false);
});
$('#rusunawaLevelAllShow').click(function () {
  rusunawaBuildingL0.show = true;
  rusunawaBuildingL1.show = true;
  rusunawaBuildingL2.show = true;
  rusunawaBuildingL3.show = true;
  rusunawaBuildingL4.show = true;
  rusunawaBuildingL5.show = true;
  rusunawaBuildingL6.show = true;
  $('.rusunawa-building-layer-panel .set_level').prop('checked', true);
});

$("#rusunawaLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(rusunawaLegal, "599276", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "599642", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619195", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619194", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619196", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "601694", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "601835", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "601952", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "600414", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "600975", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "600292", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "600222", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "600145", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "600045", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "599963", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "599868", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "599584", isChecked);
});
$("#rusunawaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(rusunawaLegal, "602333", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619134", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619144", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619135", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619136", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619137", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619138", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619139", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619140", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619141", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619142", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619145", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "619143", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "602474", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618566", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618555", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618556", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618557", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618558", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618559", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618560", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618561", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618562", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618563", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618564", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618565", isChecked);
});
$("#rusunawaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(rusunawaLegal, "606558", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618912", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618922", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618913", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618914", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618915", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618916", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618917", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618918", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618919", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618920", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618923", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618921", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "606910", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618455", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618444", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618445", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618446", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618447", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618448", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618449", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618450", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618451", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618452", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618453", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618454", isChecked);
});
$("#rusunawaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(rusunawaLegal, "607296", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618801", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618811", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618802", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618803", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618804", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618805", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618806", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618807", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618808", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618809", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618812", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618810", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "606926", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618344", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618333", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618334", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618335", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618336", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618337", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618338", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618339", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618340", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618341", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618342", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618343", isChecked);
});
$("#rusunawaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityByobject_id(rusunawaLegal, "607326", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618690", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618700", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618691", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618692", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618693", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618694", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618695", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618696", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618697", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618698", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618701", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618699", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "606942", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618233", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618222", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618223", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618224", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618225", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618226", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618227", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618228", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618229", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618230", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618231", isChecked);
  setVisibilityByobject_id(rusunawaLegal, "618232", isChecked);
});

// set style tileset [gml]
const colorMap = {
  "Anotha Blue": new Cesium.Color(0 / 255, 0 / 255, 255 / 255, 1.0), // Anotha Blue
  "Baby Blue": new Cesium.Color(173 / 255, 216 / 255, 230 / 255, 1.0), // Baby Blue
  "Blue": new Cesium.Color(0.0, 0.0, 1.0, 1.0), // Blue
  "Brown": new Cesium.Color(165 / 255, 42 / 255, 42 / 255, 1.0), // Brown
  "Coral": new Cesium.Color(255 / 255, 127 / 255, 80 / 255, 1.0), // Coral
  "Green": new Cesium.Color(0.0, 1.0, 0.0, 1.0), // Green
  "Green bright": new Cesium.Color(0.0, 1.0, 0.5, 1.0), // Green bright
  "Grey": new Cesium.Color(128 / 255, 128 / 255, 128 / 255, 1.0), // Grey
  "Lumut": new Cesium.Color(25, 133, 54, 1.0),
  "Light Blue": new Cesium.Color(173 / 255, 216 / 255, 230 / 255, 1.0), // Light Blue
  "Maroon": new Cesium.Color(128 / 255, 0 / 255, 0 / 255, 1.0), // Maroon
  "Merah": new Cesium.Color(1.0, 0.0, 0.0, 1.0), // Merah
  "Navy": new Cesium.Color(0 / 255, 0 / 255, 128 / 255, 1.0), // Navy
  "Neon Green": new Cesium.Color(57 / 255, 255 / 255, 20 / 255, 1.0), // Neon Green
  "Orange": new Cesium.Color(255 / 255, 165 / 255, 0 / 255, 1.0), // Orange
  "Pink": new Cesium.Color(255 / 255, 192 / 255, 203 / 255, 1.0), // Pink
  "pink baby": new Cesium.Color(255 / 255, 192 / 255, 203 / 255, 1.0), // Pink
  "Purple": new Cesium.Color(128 / 255, 0 / 255, 128 / 255, 1.0), // Purple
  "Red": new Cesium.Color(1.0, 0.0, 0.0, 1.0), // Red
  "Red Pastel": new Cesium.Color(255 / 255, 105 / 255, 97 / 255, 1.0), // Red Pastel
  "Sienna": new Cesium.Color(160 / 255, 82 / 255, 45 / 255, 1.0), // Sienna
  "Violet": new Cesium.Color(238 / 255, 130 / 255, 238 / 255, 1.0), // Violet
  "Yellow": new Cesium.Color(1.0, 1.0, 0.0, 1.0), // Yellow
  "Sage": new Cesium.Color(188 / 255, 206 / 255, 172 / 255, 1.0), // Sage
  "Dark Purple": new Cesium.Color(72 / 255, 61 / 255, 139 / 255, 1.0), // Dark Purple
};

function getColorFromProperty(inputProperties) {
  if (inputProperties.includes("-") || inputProperties.includes(" - ")) {
    const splitString = inputProperties.split('-').map(function (item) {
      return item.trim();
    });
    return splitString[1];
  } else {
    return inputProperties;
  }
}

// Define a color style
let setColorStyle = new Cesium.Cesium3DTileStyle({
  color: {
    evaluateColor: function (feature, result) {
      // Ambil nilai "_paint" dari properti fitur
      const styleName = getColorFromProperty(feature.getProperty("fme_appearance_style_name"));
      // Jika "legal_type" adalah "legal_space", atur transparansi menjadi 0.4
      if (feature.getProperty("legal_type") === "legal_space") {
        return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.4);
      }
      // Temukan warna yang sesuai dari colormap atau gunakan warna default jika tidak ditemukan
      const color = colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0); // Default: Grey
      // Kembalikan warna hasil evaluasi
      return Cesium.Color.clone(color, result);
    },
  },
});

let MappingHideTileset = [];
let MappingTransparentTileset = [];

function mappingHide(Tag, isChecked) {
  if (isChecked) {
    MappingHideTileset = MappingHideTileset.filter(data => data !== Tag);
  } else {
    if (!undefined) {
      MappingHideTileset.push(Tag);
    }
    return
  }
  console.log("hide");
  console.log(MappingHideTileset);
}

function setVisibilityByobject_id(tileset, Tag, isChecked) {
  mappingHide(Tag, isChecked);
  tileset.style = new Cesium.Cesium3DTileStyle({
    show: {
      evaluate: function (feature) {
        return !MappingHideTileset.includes(feature.getProperty("Tag"));
      },
    },
    color: {
      evaluateColor: function (feature, result) {
        // Ambil nilai "_paint" dari properti fitur
        const styleName = getColorFromProperty(feature.getProperty("fme_appearance_style_name"));
        // Jika "legal_type" adalah "legal_space", atur transparansi menjadi 0.4
        if (feature.getProperty("legal_type") === "legal_space") {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.4);
        }
        // MappingTransparentTileset
        if (MappingTransparentTileset.includes(feature.getProperty("Tag"))) {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 1.0);
        } else {
          if (MappingTransparentTileset.length > 0) {
            return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.2);
          }
        }
        // Temukan warna yang sesuai dari colormap atau gunakan warna default jika tidak ditemukan
        const color = colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0); // Default: Grey
        // Kembalikan warna hasil evaluasi
        return Cesium.Color.clone(color, result);
      },
    },
  });
}
// setVisibilityByobject_id(siolaLegal, "915961");

function mappingTransparent(Tag) {
  if (Array.isArray(Tag)) {
    MappingTransparentTileset = Tag
  } else {
    MappingTransparentTileset.push(Tag);
  }
  console.log("transparent");
  console.log(MappingTransparentTileset);
}

function setTransparentByobject_id(tileset, Tag) {
  MappingTransparentTileset = [];
  mappingTransparent(Tag);
  tileset.style = new Cesium.Cesium3DTileStyle({
    color: {
      evaluateColor: function (feature, result) {
        // Ambil nilai "_paint" dari properti fitur
        const styleName = getColorFromProperty(feature.getProperty("fme_appearance_style_name"));
        // Jika "legal_type" adalah "legal_space", atur transparansi menjadi 0.4
        if (feature.getProperty("legal_type") === "legal_space") {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.4);
        }
        // MappingTransparentTileset
        if (MappingTransparentTileset.includes(feature.getProperty("Tag"))) {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 1.0);
        } else {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.2);
        }
      },
    },
    show: {
      evaluate: function (feature) {
        return !MappingHideTileset.includes(feature.getProperty("Tag"));
      },
    },
  });
}
// setTransparentByobject_id(siolaLegal, "915961");
// setTransparentByobject_id(siolaLegal, ["849039", "886033", "849276"]);

// reset Transparency
function resetTransparent(tileset) {
  MappingTransparentTileset = [];
  setVisibilityByobject_id(tileset)
}

// underground view   ###################################################################################
$("#underground_1").change(function () {
  viewer.scene.globe.depthTestAgainstTerrain = !$("#underground_1").prop("checked");
  viewer.scene.screenSpaceCameraController.enableCollisionDetection = !$("#underground_1").prop("checked");
  viewer.scene.globe.translucency.frontFaceAlphaByDistance.nearValue = 0.4;
});

$("#resetTransparent").click(function () {
  resetTransparent(siolaLegal);
  resetTransparent(balaiLegal);
  resetTransparent(rusunawaLegal);
});

// Get Siola   ############################################################################################
const siolaBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337813, {
    show: true,
    featureIdLabel: "siolaBuildingL0",
  })
);
const siolaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337814, {
    show: true,
    featureIdLabel: "siolaBuildingL1",
  })
);
const siolaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337815, {
    show: true,
    featureIdLabel: "siolaBuildingL2",
  })
);
const siolaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337816, {
    show: true,
    featureIdLabel: "siolaBuildingL3",
  })
);
const siolaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337817, {
    show: true,
    featureIdLabel: "siolaBuildingL4",
  })
);
const siolaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337818, {
    show: true,
    featureIdLabel: "siolaBuildingL5",
  }, )
);

const siolaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2465320)
);

siolaLegal.style = setColorStyle;


// hide preloader after finish load data
$(function () {
  $(".preload").addClass("d-none");
  $(".loader-container").removeClass("d-none");
});
firstCamera();

// Get Balai Pemuda   ####################################################################################
const balaiBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376891, {
    show: true,
    featureIdLabel: "balaiBuildingL0",
  })
);
const balaiBuildingBasement = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376892, {
    show: true,
    featureIdLabel: "balaiBuildingBasement",
  })
);
const balaiBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376888, {
    show: true,
    featureIdLabel: "balaiBuildingL1",
  })
);
const balaiBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376890, {
    show: true,
    featureIdLabel: "balaiBuildingL2",
  })
);

const balaiLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2465321)
);

balaiLegal.style = setColorStyle;

// Get Rusunawa   #########################################################################################
const rusunawaBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376563, {
    show: true,
    featureIdLabel: "rusunawaBuildingL0",
  })
);
const rusunawaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376564, {
    show: true,
    featureIdLabel: "rusunawaBuildingL1",
  })
);
const rusunawaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376565, {
    show: true,
    featureIdLabel: "rusunawaBuildingL2",
  })
);
const rusunawaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376566, {
    show: true,
    featureIdLabel: "rusunawaBuildingL3",
  })
);
const rusunawaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376567, {
    show: true,
    featureIdLabel: "rusunawaBuildingL4",
  })
);
const rusunawaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376568, {
    show: true,
    featureIdLabel: "rusunawaBuildingL5",
  }, )
);
const rusunawaBuildingL6 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376570, {
    show: true,
    featureIdLabel: "rusunawaBuildingL6",
  }, )
);

const rusunawaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2465322)
);

rusunawaLegal.style = setColorStyle;



// hide preloader after finish load data
$(function () {
  $(".loader-container").removeClass("d-none");
});


// Buat koleksi bidang pemotongan (clipping plane collection) SIOLA
let siolaClippingPlanes = new Cesium.ClippingPlaneCollection({
  planes: [
    new Cesium.ClippingPlane(new Cesium.Cartesian3(1.0, 0.0, 0.0), 50.0), // Plane X
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 1.0, 0.0), 50.0), // Plane Y
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 0.0, -1.0), 50.0) // Plane Z
  ],
  edgeWidth: 0.0, // Lebar garis untuk menandai pemotongan (bisa disesuaikan)
  edgeColor: Cesium.Color.RED
});
let balaiClippingPlanes = new Cesium.ClippingPlaneCollection({
  planes: [
    new Cesium.ClippingPlane(new Cesium.Cartesian3(1.0, 0.0, 0.0), 50.0), // Plane X
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 1.0, 0.0), 50.0), // Plane Y
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 0.0, -1.0), 50.0) // Plane Z
  ],
  edgeWidth: 0.0, // Lebar garis untuk menandai pemotongan (bisa disesuaikan)
  edgeColor: Cesium.Color.RED
});
let rusunawaClippingPlanes = new Cesium.ClippingPlaneCollection({
  planes: [
    new Cesium.ClippingPlane(new Cesium.Cartesian3(1.0, 0.0, 0.0), 50.0), // Plane X
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 1.0, 0.0), 50.0), // Plane Y
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 0.0, -1.0), 50.0) // Plane Z
  ],
  edgeWidth: 0.0, // Lebar garis untuk menandai pemotongan (bisa disesuaikan)
  edgeColor: Cesium.Color.RED
});

// Daftar tileset dan pemotongan untuk setiap jenis bangunan
let tilesetsList = {
  "clsiola": {
    tileset: [siolaBuildingL0, siolaBuildingL1, siolaBuildingL2, siolaBuildingL3, siolaBuildingL4, siolaBuildingL5],
    clippingPlanes: siolaClippingPlanes
  },
  "clbalai": {
    tileset: [balaiBuildingL0, balaiBuildingBasement, balaiBuildingL1, balaiBuildingL2],
    clippingPlanes: balaiClippingPlanes
  },
  "clrusunawa": {
    tileset: [rusunawaBuildingL0, rusunawaBuildingL1, rusunawaBuildingL2, rusunawaBuildingL3, rusunawaBuildingL4, rusunawaBuildingL5, rusunawaBuildingL6],
    clippingPlanes: rusunawaClippingPlanes
  },
};

// Fungsi untuk membuat ClippingPlaneCollection dengan nilai slider tertentu
function createClippingPlanes(sliderX, sliderY, sliderZ) {
  return new Cesium.ClippingPlaneCollection({
    planes: [
      new Cesium.ClippingPlane(new Cesium.Cartesian3(1.0, 0.0, 0.0), sliderX),
      new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 1.0, 0.0), sliderY),
      new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 0.0, 1.0), sliderZ)
    ],
    edgeWidth: 0.0,
    edgeColor: Cesium.Color.RED
  });
}

// Fungsi untuk memperbarui pemotongan pada tileset berdasarkan nilai slider
function updateClippingPlanes(tilesetInfo, sliderX, sliderY, sliderZ) {
  const clippingPlanes = tilesetInfo.clippingPlanes;
  clippingPlanes.get(0).distance = sliderX;
  clippingPlanes.get(1).distance = sliderY;
  clippingPlanes.get(2).distance = sliderZ;
}
$(".clip-item input[type='range']").on("input", function () {
  // Dapatkan tileset yang sesuai berdasarkan jenis bangunan terpilih
  let selectedRadioValue = $("input[name='flexRadioDefault']:checked").val();
  let tilesetInfo = tilesetsList[selectedRadioValue];
  // Perbarui pemotongan pada setiap tileset dengan nilai slider yang sesuai
  let sliderGroup = $("." + selectedRadioValue);
  let sliderXVal = sliderGroup.find('.sliderX').val();
  let sliderYVal = sliderGroup.find('.sliderY').val();
  let sliderZVal = sliderGroup.find('.sliderZ').val();
  // Perbarui pemotongan pada setiap tileset yang terkait
  updateClippingPlanes(tilesetInfo, sliderXVal, sliderYVal, sliderZVal);
});

function toggleSliderClipGroup() {
  // Sembunyikan semua grup slider
  $(".clip-item > div").hide();
  // Tampilkan grup slider yang sesuai dengan radio box yang terchecked
  let selectedRadioValue = $("input[name='flexRadioDefault']:checked").val();
  $("." + selectedRadioValue).show();
}

$("#reset-clip").click(function (e) {
  resetClipTilesets();
});

function resetClipTilesets(first = false) {
  // Iterasi melalui semua jenis bangunan
  Object.keys(tilesetsList).forEach(function (buildingType) {
    let tilesetInfo = tilesetsList[buildingType];
    // Dapatkan nilai maksimum dan minimum dari elemen input
    let defaultSliderX = parseFloat($("." + buildingType).find('.sliderX').attr('max'));
    let defaultSliderY = parseFloat($("." + buildingType).find('.sliderY').attr('min'));
    let defaultSliderZ = parseFloat($("." + buildingType).find('.sliderZ').attr('min'));
    if (first == 1) {
      // init nilai default dari clippingtileset
      tilesetInfo.tileset.forEach(function (tileset) {
        tileset.clippingPlanes = tilesetInfo.clippingPlanes;
      });
    } else {
      const clippingPlanes = tilesetInfo.clippingPlanes;
      clippingPlanes.get(0).distance = defaultSliderX;
      clippingPlanes.get(1).distance = defaultSliderY;
      clippingPlanes.get(2).distance = defaultSliderZ;
    }
    // Setel nilai slider pada tampilan ke nilai default
    $("." + buildingType).find('.sliderX').val(defaultSliderX);
    $("." + buildingType).find('.sliderY').val(defaultSliderY);
    $("." + buildingType).find('.sliderZ').val(defaultSliderZ);
  });
}



// handle autocomplete seacrh
$(document).ready(function () {
  async function fetchSuggestionsFromDatabase() {
    try {
      const response = await fetch(`/action/get-parcel.php?get=get`); // Replace with your actual API endpoint
      if (!response.ok) {
        throw new Error('Error fetching suggestions');
      }
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Error fetching suggestions:', error);
      throw error; // You may want to handle this error further depending on your needs
    }
  }

  const suggestionsData = [{
    id: "1",
    data: "Siola"
  }, {
    id: "2",
    data: "Balai Pemuda"
  }, {
    id: "3",
    data: "Rusunawa Buring"
  }, {
    id: "siola0floor",
    data: "Siola underground floor"
  }, {
    id: "siola1floor",
    data: "Siola 1st floor"
  }, {
    id: "siola2floor",
    data: "Siola 2nd floor"
  }, {
    id: "siola3floor",
    data: "Siola 3rd floor"
  }, {
    id: "siola4floor",
    data: "Siola 4th floor"
  }, {
    id: "siola5floor",
    data: "Siola 5th floor"
  }, {
    id: "balai0floor",
    data: "Balai Pemuda underground floor"
  }, {
    id: "balai1floor",
    data: "Balai Pemuda 1st floor"
  }, {
    id: "rusun1floor",
    data: "Rusunawa Buring 1st floor"
  }, {
    id: "rusun2floor",
    data: "Rusunawa Buring 2nd floor"
  }, {
    id: "rusun3floor",
    data: "Rusunawa Buring 3rd floor"
  }, {
    id: "rusun4floor",
    data: "Rusunawa Buring 4th floor"
  }, {
    id: "rusun5floor",
    data: "Rusunawa Buring 5th floor"
  }, {
    id: "rusun6floor",
    data: "Rusunawa Buring Roof"
  }, ];

  console.log([...new Set(suggestionsData)]);
  console.log(suggestionsData);

  (async function () {
    try {
      const data = await fetchSuggestionsFromDatabase();
      console.log(data);
      data.forEach(item => {
        // Push separate objects for data with the same ID
        if (item.parcel_id != undefined && item.parcel_id != null && item.parcel_id != "") {
          suggestionsData.push({
            id: item.id,
            data: item.parcel_id
          });
        }
        if (item.parcel_name != undefined && item.parcel_name != null && item.parcel_name != "") {
          suggestionsData.push({
            id: item.id,
            data: item.parcel_name
          });
        }
        if (item.resident_name != undefined && item.resident_name != null && item.resident_name != "") {
          suggestionsData.push({
            id: item.id,
            data: item.resident_name
          });
        }
      });

      $("#searchInput").on('input', function (e) {
        const inputValue = $("#searchInput").val().toLowerCase();
        // Hide autocomplete results if input empty
        if (!inputValue.trim() || inputValue == "") {
          $("#autocompleteResults").html("");
          return;
        }
        const filteredSuggestions = suggestionsData.filter(suggestion =>
          suggestion.data.toLowerCase().includes(inputValue)
        );
        // Generate HTML for autocomplete results
        const resultsHTML = filteredSuggestions.map(suggestion =>
          `<div class="autocomplete-item" data-id="${suggestion.id}">${suggestion.data}</div>`
        ).join("");
        $("#autocompleteResults").html(resultsHTML);
        // Attach click event to each autocomplete item
        $(".autocomplete-item").on("click", function () {
          const selectedId = $(this).data("id");
          const selectedText = $(this).text();
          selectSuggestion(selectedId, selectedText);
        });
      });

    } catch (error) {
      console.log(error);
      // Handle error if needed
    }
  })();

  function selectSuggestion(id, text) {
    $("#searchInput").val(text);
    $("#autocompleteResults").html("");
    console.log("seelct: " + id);
    switch (String(id)) {
      case "1":
        firstCamera();
        break;
      case "2":
        secondCamera();
        break;
      case "3":
        thirdCamera();
        break;
      case "siola0floor":
        zoomToTileset(siolaBuildingL0, 15, 90, 150); //tileset, pitchDegrees = -25, headingDegrees = 0, zoomDistance = 300
        break;
      case "siola1floor":
        zoomToTileset(siolaBuildingL1, -5, 90, 150);
        break;
      case "siola2floor":
        zoomToTileset(siolaBuildingL2, -10, 90, 150);
        break;
      case "siola3floor":
        zoomToTileset(siolaBuildingL3, -15, 90, 150);
        break;
      case "siola4floor":
        zoomToTileset(siolaBuildingL4, -20, 90, 150);
        break;
      case "siola5floor":
        zoomToTileset(siolaBuildingL5, -25, 90, 150);
        break;
      case "balai0floor":
        zoomToTileset(balaiBuildingBasement, -25, 180, 100);
        break;
      case "balai1floor":
        zoomToTileset(balaiBuildingL1, -25, 180, 100);
        break;
      case "rusun1floor":
        zoomToTileset(rusunawaBuildingL1, -25, 180, 100);
        break;
      case "rusun2floor":
        zoomToTileset(rusunawaBuildingL2, -25, 180, 100);
        break;
      case "rusun3floor":
        zoomToTileset(rusunawaBuildingL3, -25, 180, 100);
        break;
      case "rusun4floor":
        zoomToTileset(rusunawaBuildingL4, -25, 180, 100);
        break;
      case "rusun5floor":
        zoomToTileset(rusunawaBuildingL5, -25, 180, 100);
        break;
      case "rusun6floor":
        zoomToTileset(rusunawaBuildingL6, -25, 180, 100);
        break;
      case "921704":
        setTransparentByobject_id(siolaLegal, "921704");
        zoomToLocation(70, -26, 112.73628989849963, -7.25698919103089, 10, 0);
        break;
      case "910222":
        setTransparentByobject_id(siolaLegal, "910222");
        zoomToLocation(60, 65, 112.7364636251925, -7.257092539825164, -20, 0);
        break;
      case "915961":
        setTransparentByobject_id(siolaLegal, "915961");
        zoomToLocation(60, 200, 112.7343253773387, -7.258348227236101, -20, 0);
        break;
      case "850924":
        setTransparentByobject_id(siolaLegal, "850924");
        zoomToTileset(siolaBuildingL5, -20, 90, 150);
        break;
      case "849276":
        setTransparentByobject_id(siolaLegal, "849276");
        zoomToLocation(180, 80, 112.73814898604392, -7.255089250207667, -25, 0);
        break;
      case "886033":
        setTransparentByobject_id(siolaLegal, "886033");
        zoomToLocation(345, 75, 112.73813421339062, -7.257867208348932, -20, 0);
        break;
      case "849039":
        setTransparentByobject_id(siolaLegal, "849039");
        zoomToLocation(65, 75, 112.73661741237805, -7.256992873425595, -25, 0);
        break;
      case "847875":
        setTransparentByobject_id(siolaLegal, "847875");
        zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
        break;
      case "848368":
        setTransparentByobject_id(siolaLegal, "848368");
        zoomToLocation(180, 35, 112.73779026382113, -7.255632571893392, -15, 0);
        break;
      case "831096":
        setTransparentByobject_id(siolaLegal, "831096");
        zoomToLocation(175, 50, 112.73780550486839, -7.255527145036425, -25, 0);
        break;
      case "830288":
        setTransparentByobject_id(siolaLegal, "848368");
        zoomToLocation(180, 35, 112.73779026382113, -7.255632571893392, -15, 0);
        break;
      case "843868":
        setTransparentByobject_id(siolaLegal, "843868");
        zoomToLocation(70, 40, 112.73667745777747, -7.2567879531324495, -15, 0);
        break;
      case "831440":
        setTransparentByobject_id(siolaLegal, "831440");
        zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -15, 0);
        break;
      case "914699":
        setTransparentByobject_id(siolaLegal, "914699");
        zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -15, 0);
        break;
      case "913870":
        setTransparentByobject_id(siolaLegal, "913870");
        zoomToLocation(265, 20, 112.7389374537573, -7.2564733527464185, -15, 0);
        break;
      case "839609":
        setTransparentByobject_id(siolaLegal, "839609");
        zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
        break;
      case "829098":
        setTransparentByobject_id(siolaLegal, "829098");
        zoomToLocation(175, 45, 112.73776680239449, -7.255272479365819, -15, 0);
        break;
      case "829358":
        setTransparentByobject_id(siolaLegal, "829358");
        zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
        break;
      case "840850":
        setTransparentByobject_id(siolaLegal, "840850");
        zoomToLocation(70, 35, 112.73667745777747, -7.2567879531324495, -15, 0);
        break;
      case "838147":
        setTransparentByobject_id(siolaLegal, "838147");
        zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -10, 0);
        break;
      case "841116":
        setTransparentByobject_id(siolaLegal, "841116");
        zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -10, 0);
        break;
      case "821964":
        setTransparentByobject_id(siolaLegal, "821964");
        zoomToLocation(20, 20, 112.73725740076955, -7.257555590592433, -15, 0);
        break;
      case "823865":
        setTransparentByobject_id(siolaLegal, "823865");
        zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -15, 0);
        break;
      case "821077":
        setTransparentByobject_id(siolaLegal, "821077");
        zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -10, 0);
        break;
      case "820143":
        setTransparentByobject_id(siolaLegal, "820143");
        zoomToLocation(180, 20, 112.73774879316747, -7.255707084659419, -20, 0);
        break;
      case "919493":
        setTransparentByobject_id(siolaLegal, "919493");
        zoomToLocation(180, 20, 112.73775089782131, -7.255339612039106, -5, 0);
        break;
      case "820815":
        setTransparentByobject_id(siolaLegal, "820815");
        zoomToLocation(115, 15, 112.73703300890135, -7.256062486631589, -20, 0);
        break;
      case "820896":
        setTransparentByobject_id(siolaLegal, "820896");
        zoomToLocation(70, 25, 112.73614083014726, -7.256673453774129, -15, 0);
        break;
      case "825386":
        setTransparentByobject_id(siolaLegal, "825386");
        zoomToLocation(70, 20, 112.73614083014726, -7.256673453774129, -5, 0);
        break;
      case "826868":
        setTransparentByobject_id(siolaLegal, "826868");
        zoomToLocation(345, 20, 112.73810487457202, -7.257580246584778, -5, 0);
        break;
      case "817240":
        setTransparentByobject_id(siolaLegal, "817240");
        zoomToLocation(115, 20, 112.7364701048379, -7.255725655809104, -5, 0);
        break;
      case "701720":
        zoomToLocation(20, 120, 112.74437101987753, -7.265618497548999, -25, 0);
        break;
      case "671122":
        zoomToLocation(20, 250, 112.7432787543901, -7.267368495006733, -25, 0);
        break;
      case "670768":
        zoomToLocation(20, -35, 112.74455852005875, -7.266254249795577, 11, 0);
        break;
      case "601254":
        setTransparentByobject_id(balaiLegal, "601254");
        zoomToLocation(20, 30, 112.74534520728557, -7.264096743894646, -45, 0);
        break;
      case "599448":
        setTransparentByobject_id(balaiLegal, "599448");
        zoomToLocation(20, 30, 112.74530959098915, -7.264052226780129, -45, 0);
        break;
      case "598132":
        setTransparentByobject_id(balaiLegal, "598132");
        zoomToLocation(20, 30, 112.74530959098915, -7.264052226780129, -45, 0);
        break;
      case "596892":
        setTransparentByobject_id(balaiLegal, "596892");
        zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
        break;
      case "596362":
        setTransparentByobject_id(balaiLegal, "596362");
        zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
        break;
      case "595885":
        setTransparentByobject_id(balaiLegal, "595885");
        zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
        break;
      case "639829":
        setTransparentByobject_id(balaiLegal, "639829");
        zoomToLocation(20, 33, 112.74516885377157, -7.263981056792357, -45, 0);
        break;
      case "592037":
        setTransparentByobject_id(balaiLegal, "592037");
        zoomToLocation(20, 25, 112.74521802863246, -7.264175001191377, -25, 0);
        break;
      case "560626":
        setTransparentByobject_id(balaiLegal, "560626");
        zoomToLocation(20, 25, 112.74521826029621, -7.264175080955373, -25, 0);
        break;
      case "600819":
        setTransparentByobject_id(balaiLegal, "600819");
        zoomToLocation(20, 25, 112.74526629406043, -7.264316162622997, -25, 0);
        break;
      case "559588":
        setTransparentByobject_id(balaiLegal, "559588");
        zoomToLocation(20, 25, 112.74514755642848, -7.2642758111076615, -25, 0);
        break;
      case "558371":
        setTransparentByobject_id(balaiLegal, "558371");
        zoomToLocation(20, 25, 112.74508005165397, -7.2642500848764255, -25, 0);
        break;
      case "550615":
        setTransparentByobject_id(balaiLegal, "550615");
        zoomToLocation(20, 25, 112.74508005165397, -7.2642500848764255, -25, 0);
        break;
      case "609329":
        setTransparentByobject_id(balaiLegal, "609329");
        zoomToLocation(11, 60, 112.74502607249624, -7.264704384970404, -60, 0);
        break;
      case "610016":
        setTransparentByobject_id(balaiLegal, "610016");
        zoomToLocation(20, 105, 112.74541372870215, -7.264674661924839, -60, 0);
        break;
      case "611746":
        setTransparentByobject_id(balaiLegal, "611746");
        zoomToLocation(20, 105, 112.74553493614476, -7.264522246696736, -60, 0);
        break;
      case "611250":
        setTransparentByobject_id(balaiLegal, "611250");
        zoomToLocation(20, 105, 112.74553493614476, -7.264522246696736, -60, 0);
        break;
      case "610552":
        setTransparentByobject_id(balaiLegal, "610552");
        zoomToLocation(20, 105, 112.74553493614476, -7.264522246696736, -60, 0);
        break;
      case "613441":
        setTransparentByobject_id(balaiLegal, "613441");
        zoomToLocation(11, 60, 112.74570068943898, -7.2641893323861195, -60, 0);
        break;
      case "613040":
        setTransparentByobject_id(balaiLegal, "613040");
        zoomToLocation(11, 60, 112.74570068943898, -7.2641893323861195, -60, 0);
        break;
      case "612232":
        setTransparentByobject_id(balaiLegal, "612232");
        zoomToLocation(11, 60, 112.7455540723557, -7.264151688578575, -60, 0);
        break;
      case "612619":
        setTransparentByobject_id(balaiLegal, "612619");
        zoomToLocation(11, 60, 112.7455540723557, -7.264151688578575, -60, 0);
        break;
      case "618232":
        setTransparentByobject_id(rusunawaLegal, "618232");
        zoomToLocation(0, 23, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618231":
        setTransparentByobject_id(rusunawaLegal, "618231");
        zoomToLocation(0, 23, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618230":
        setTransparentByobject_id(rusunawaLegal, "618230");
        zoomToLocation(0, 23, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618229":
        setTransparentByobject_id(rusunawaLegal, "618229");
        zoomToLocation(0, 23, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618228":
        setTransparentByobject_id(rusunawaLegal, "618228");
        zoomToLocation(0, 23, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618227":
        setTransparentByobject_id(rusunawaLegal, "618227");
        zoomToLocation(0, 23, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618226":
        setTransparentByobject_id(rusunawaLegal, "618226");
        zoomToLocation(0, 23, 112.64489976543433, -8.011227147063853, -15, 0);
        break;
      case "618225":
        setTransparentByobject_id(rusunawaLegal, "618225");
        zoomToLocation(0, 23, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618224":
        setTransparentByobject_id(rusunawaLegal, "618224");
        zoomToLocation(0, 23, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618223":
        setTransparentByobject_id(rusunawaLegal, "618223");
        zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618222":
        setTransparentByobject_id(rusunawaLegal, "618222");
        zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618233":
        setTransparentByobject_id(rusunawaLegal, "618233");
        zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "606942":
        setTransparentByobject_id(rusunawaLegal, "606942");
        zoomToLocation(100, 18, 112.64432403935837, -8.010743169218108, -15, 0);
        break;
      case "618699":
        setTransparentByobject_id(rusunawaLegal, "618699");
        zoomToLocation(180, 23, 112.64472517788248, -8.010298593763853, -15, 0);
        break;
      case "618701":
        setTransparentByobject_id(rusunawaLegal, "618701");
        zoomToLocation(180, 23, 112.64472517788248, -8.010298593763853, -15, 0);
        break;
      case "618698":
        setTransparentByobject_id(rusunawaLegal, "618698");
        zoomToLocation(180, 23, 112.64479519186604, -8.010297620811423, -15, 0);
        break;
      case "618697":
        setTransparentByobject_id(rusunawaLegal, "618697");
        zoomToLocation(180, 23, 112.64484878994745, -8.010306178459471, -15, 0);
        break;
      case "618696":
        setTransparentByobject_id(rusunawaLegal, "618696");
        zoomToLocation(180, 23, 112.64484878994745, -8.010306178459471, -15, 0);
        break;
      case "618695":
        setTransparentByobject_id(rusunawaLegal, "618695");
        zoomToLocation(180, 23, 112.6449624128508, -8.010321693114099, -15, 0);
        break;
      case "618694":
        setTransparentByobject_id(rusunawaLegal, "618694");
        zoomToLocation(180, 23, 112.6449624128508, -8.010321693114099, -15, 0);
        break;
      case "618693":
        setTransparentByobject_id(rusunawaLegal, "618693");
        zoomToLocation(180, 23, 112.64504428302469, -8.01031984160891, -15, 0);
        break;
      case "618692":
        setTransparentByobject_id(rusunawaLegal, "618692");
        zoomToLocation(180, 23, 112.64504428302469, -8.01031984160891, -15, 0);
        break;
      case "618691":
        setTransparentByobject_id(rusunawaLegal, "618691");
        zoomToLocation(180, 23, 112.64510978062461, -8.010324528984608, -15, 0);
        break;
      case "618700":
        setTransparentByobject_id(rusunawaLegal, "618700");
        zoomToLocation(180, 23, 112.64510978062461, -8.010324528984608, -15, 0);
        break;
      case "618690":
        setTransparentByobject_id(rusunawaLegal, "618690");
        zoomToLocation(180, 23, 112.64514967384268, -8.01029641222483, -15, 0);
        break;
      case "607326":
        setTransparentByobject_id(rusunawaLegal, "607326");
        zoomToLocation(265, 58, 112.64589105170866, -8.010688873163765, -25, 0);
        break;
      case "618343":
        setTransparentByobject_id(rusunawaLegal, "618343");
        zoomToLocation(0, 21, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618342":
        setTransparentByobject_id(rusunawaLegal, "618342");
        zoomToLocation(0, 21, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618341":
        setTransparentByobject_id(rusunawaLegal, "618341");
        zoomToLocation(0, 21, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618340":
        setTransparentByobject_id(rusunawaLegal, "618340");
        zoomToLocation(0, 21, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618339":
        setTransparentByobject_id(rusunawaLegal, "618339");
        zoomToLocation(0, 21, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618338":
        setTransparentByobject_id(rusunawaLegal, "618338");
        zoomToLocation(0, 21, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618337":
        setTransparentByobject_id(rusunawaLegal, "618337");
        zoomToLocation(0, 21, 112.64489976543433, -8.011227147063853, -15, 0);
        break;
      case "618336":
        setTransparentByobject_id(rusunawaLegal, "618336");
        zoomToLocation(0, 21, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618335":
        setTransparentByobject_id(rusunawaLegal, "618335");
        zoomToLocation(0, 21, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618334":
        setTransparentByobject_id(rusunawaLegal, "618334");
        zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618333":
        setTransparentByobject_id(rusunawaLegal, "618333");
        zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618344":
        setTransparentByobject_id(rusunawaLegal, "618344");
        zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "606926":
        setTransparentByobject_id(rusunawaLegal, "606926");
        zoomToLocation(100, 16, 112.64432403935837, -8.010743169218108, -15, 0);
        break;
      case "618810":
        setTransparentByobject_id(rusunawaLegal, "618810");
        zoomToLocation(180, 21, 112.64472517788248, -8.010298593763853, -15, 0);
        break;
      case "618812":
        setTransparentByobject_id(rusunawaLegal, "618812");
        zoomToLocation(180, 21, 112.64472517788248, -8.010298593763853, -15, 0);
        break;
      case "618809":
        setTransparentByobject_id(rusunawaLegal, "618809");
        zoomToLocation(180, 21, 112.64479519186604, -8.010297620811423, -15, 0);
        break;
      case "618808":
        setTransparentByobject_id(rusunawaLegal, "618808");
        zoomToLocation(180, 21, 112.64484878994745, -8.010306178459471, -15, 0);
        break;
      case "618807":
        setTransparentByobject_id(rusunawaLegal, "618807");
        zoomToLocation(180, 21, 112.64484878994745, -8.010306178459471, -15, 0);
        break;
      case "618806":
        setTransparentByobject_id(rusunawaLegal, "618806");
        zoomToLocation(180, 21, 112.6449624128508, -8.010321693114099, -15, 0);
        break;
      case "618805":
        setTransparentByobject_id(rusunawaLegal, "618805");
        zoomToLocation(180, 21, 112.6449624128508, -8.010321693114099, -15, 0);
        break;
      case "618804":
        setTransparentByobject_id(rusunawaLegal, "618804");
        zoomToLocation(180, 21, 112.64504428302469, -8.01031984160891, -15, 0);
        break;
      case "618803":
        setTransparentByobject_id(rusunawaLegal, "618803");
        zoomToLocation(180, 21, 112.64504428302469, -8.01031984160891, -15, 0);
        break;
      case "618802":
        setTransparentByobject_id(rusunawaLegal, "618802");
        zoomToLocation(180, 21, 112.64510978062461, -8.010324528984608, -15, 0);
        break;
      case "618811":
        setTransparentByobject_id(rusunawaLegal, "618811");
        zoomToLocation(180, 21, 112.64510978062461, -8.010324528984608, -15, 0);
        break;
      case "618801":
        setTransparentByobject_id(rusunawaLegal, "618801");
        zoomToLocation(180, 21, 112.64514967384268, -8.01029641222483, -15, 0);
        break;
      case "607296":
        setTransparentByobject_id(rusunawaLegal, "607296");
        zoomToLocation(265, 56, 112.64589105170866, -8.010688873163765, -25, 0);
        break;
      case "618454":
        setTransparentByobject_id(rusunawaLegal, "618454");
        zoomToLocation(0, 19, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618453":
        setTransparentByobject_id(rusunawaLegal, "618453");
        zoomToLocation(0, 19, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618452":
        setTransparentByobject_id(rusunawaLegal, "618452");
        zoomToLocation(0, 19, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618451":
        setTransparentByobject_id(rusunawaLegal, "618451");
        zoomToLocation(0, 19, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618450":
        setTransparentByobject_id(rusunawaLegal, "618450");
        zoomToLocation(0, 19, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618449":
        setTransparentByobject_id(rusunawaLegal, "618449");
        zoomToLocation(0, 19, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618448":
        setTransparentByobject_id(rusunawaLegal, "618448");
        zoomToLocation(0, 19, 112.64489976543433, -8.011227147063853, -15, 0);
        break;
      case "618447":
        setTransparentByobject_id(rusunawaLegal, "618447");
        zoomToLocation(0, 19, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618446":
        setTransparentByobject_id(rusunawaLegal, "618446");
        zoomToLocation(0, 19, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618445":
        setTransparentByobject_id(rusunawaLegal, "618445");
        zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618444":
        setTransparentByobject_id(rusunawaLegal, "618444");
        zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618455":
        setTransparentByobject_id(rusunawaLegal, "618455");
        zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "606910":
        setTransparentByobject_id(rusunawaLegal, "606910");
        zoomToLocation(100, 14, 112.64432403935837, -8.010743169218108, -15, 0);
        break;
      case "618921":
        setTransparentByobject_id(rusunawaLegal, "618921");
        zoomToLocation(180, 19, 112.64472517788248, -8.010298593763853, -15, 0);
        break;
      case "618923":
        setTransparentByobject_id(rusunawaLegal, "618923");
        zoomToLocation(180, 19, 112.64472517788248, -8.010298593763853, -15, 0);
        break;
      case "618920":
        setTransparentByobject_id(rusunawaLegal, "618920");
        zoomToLocation(180, 19, 112.64479519186604, -8.010297620811423, -15, 0);
        break;
      case "618919":
        setTransparentByobject_id(rusunawaLegal, "618919");
        zoomToLocation(180, 19, 112.64484878994745, -8.010306178459471, -15, 0);
        break;
      case "618918":
        setTransparentByobject_id(rusunawaLegal, "618918");
        zoomToLocation(180, 19, 112.64484878994745, -8.010306178459471, -15, 0);
        break;
      case "618917":
        setTransparentByobject_id(rusunawaLegal, "618917");
        zoomToLocation(180, 19, 112.6449624128508, -8.010321693114099, -15, 0);
        break;
      case "618916":
        setTransparentByobject_id(rusunawaLegal, "618916");
        zoomToLocation(180, 19, 112.6449624128508, -8.010321693114099, -15, 0);
        break;
      case "618915":
        setTransparentByobject_id(rusunawaLegal, "618915");
        zoomToLocation(180, 19, 112.64504428302469, -8.01031984160891, -15, 0);
        break;
      case "618914":
        setTransparentByobject_id(rusunawaLegal, "618914");
        zoomToLocation(180, 19, 112.64504428302469, -8.01031984160891, -15, 0);
        break;
      case "618913":
        setTransparentByobject_id(rusunawaLegal, "618913");
        zoomToLocation(180, 19, 112.64510978062461, -8.010324528984608, -15, 0);
        break;
      case "618922":
        setTransparentByobject_id(rusunawaLegal, "618922");
        zoomToLocation(180, 19, 112.64510978062461, -8.010324528984608, -15, 0);
        break;
      case "618912":
        setTransparentByobject_id(rusunawaLegal, "618912");
        zoomToLocation(180, 19, 112.64514967384268, -8.01029641222483, -15, 0);
        break;
      case "606558":
        setTransparentByobject_id(rusunawaLegal, "606558");
        zoomToLocation(265, 54, 112.64589105170866, -8.010688873163765, -25, 0);
        break;
      case "618565":
        setTransparentByobject_id(rusunawaLegal, "618565");
        zoomToLocation(0, 17, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618564":
        setTransparentByobject_id(rusunawaLegal, "618564");
        zoomToLocation(0, 17, 112.64510790597768, -8.011194667555896, -15, 0);
        break;
      case "618563":
        setTransparentByobject_id(rusunawaLegal, "618563");
        zoomToLocation(0, 17, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618562":
        setTransparentByobject_id(rusunawaLegal, "618562");
        zoomToLocation(0, 17, 112.64503407814374, -8.011198707875575, -15, 0);
        break;
      case "618561":
        setTransparentByobject_id(rusunawaLegal, "618561");
        zoomToLocation(0, 17, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618560":
        setTransparentByobject_id(rusunawaLegal, "618560");
        zoomToLocation(0, 17, 112.64496594980773, -8.011213045680796, -15, 0);
        break;
      case "618559":
        setTransparentByobject_id(rusunawaLegal, "618559");
        zoomToLocation(0, 17, 112.64489976543433, -8.011227147063853, -15, 0);
        break;
      case "618558":
        setTransparentByobject_id(rusunawaLegal, "618558");
        zoomToLocation(0, 17, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618557":
        setTransparentByobject_id(rusunawaLegal, "618557");
        zoomToLocation(0, 17, 112.64483790260891, -8.01121886336246, -15, 0);
        break;
      case "618556":
        setTransparentByobject_id(rusunawaLegal, "618556");
        zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618555":
        setTransparentByobject_id(rusunawaLegal, "618555");
        zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "618566":
        setTransparentByobject_id(rusunawaLegal, "618566");
        zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
        break;
      case "602474":
        setTransparentByobject_id(rusunawaLegal, "602474");
        zoomToLocation(100, 10, 112.64432403935837, -8.010743169218108, -15, 0);
        break;
      case "619145":
        // Implementasi logika untuk kasus ini
        break;
      case "619143":
        // Implementasi logika untuk kasus ini
        break;
      case "619142":
        // Implementasi logika untuk kasus ini
        break;
      case "619141":
        // Implementasi logika untuk kasus ini
        break;
      case "619140":
        // Implementasi logika untuk kasus ini
        break;
      case "619139":
        // Implementasi logika untuk kasus ini
        break;
      case "619138":
        // Implementasi logika untuk kasus ini
        break;
      case "619137":
        // Implementasi logika untuk kasus ini
        break;
      case "619136":
        // Implementasi logika untuk kasus ini
        break;
      case "619135":
        // Implementasi logika untuk kasus ini
        break;
      case "619134":
        // Implementasi logika untuk kasus ini
        break;
      case "602333":
        // Implementasi logika untuk kasus ini
        break;
      case "615229":
        // Implementasi logika untuk kasus ini
        break;
      case "598583":
        // Implementasi logika untuk kasus ini
        break;
      case "598698":
        // Implementasi logika untuk kasus ini
        break;
      case "599584":
        // Implementasi logika untuk kasus ini
        break;
      case "599868":
        // Implementasi logika untuk kasus ini
        break;
      case "599963":
        // Implementasi logika untuk kasus ini
        break;
      case "600045":
        // Implementasi logika untuk kasus ini
        break;
      case "600145":
        // Implementasi logika untuk kasus ini
        break;
      case "600222":
        // Implementasi logika untuk kasus ini
        break;
      case "600292":
        // Implementasi logika untuk kasus ini
        break;
      case "600975":
        // Implementasi logika untuk kasus ini
        break;
      case "600414":
        // Implementasi logika untuk kasus ini
        break;
      case "601952":
        // Implementasi logika untuk kasus ini
        break;
      case "601835":
        // Implementasi logika untuk kasus ini
        break;
      case "601694":
        // Implementasi logika untuk kasus ini
        break;
      case "619196":
        // Implementasi logika untuk kasus ini
        break;
      case "619194":
        // Implementasi logika untuk kasus ini
        break;
      case "619195":
        // Implementasi logika untuk kasus ini
        break;
      case "599642":
        // Implementasi logika untuk kasus ini
        break;
      case "599276":
        // Implementasi logika untuk kasus ini
        break;
      case "700690":
        // Implementasi logika untuk kasus ini
        break;

      default:
        console.error("NOT FOUND");
        break;
    }
  }

});

$(document).ready(function () {
  $(".loader-container").addClass("d-none");
  resetClipTilesets(1);
});