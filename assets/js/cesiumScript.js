// inisiasi cesium token
// Cesium.Ion.defaultAccessToken =
//   "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiIxODQyMzk1MS1iNWUxLTRhNGQtYTI1OS02OTUzNzI1ZDcwN2MiLCJpZCI6MTcxMjA2LCJpYXQiOjE2OTcwMTI5Mjh9.qk3jXULVR5DGxNlgFOR0aHWgT-1xmz50zY4gE63tXMY";
Cesium.Ion.defaultAccessToken =
  "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJjYzM3MWVhMC05NTVmLTQwZDQtYjVlYS04MGY2NjFhZWJjZTIiLCJpZCI6MTc0NTY5LCJpYXQiOjE2OTg1MDA4NDd9.CJSLBba2oVAnchzPeMZpazEs2EdocRFKSdoRYXy7gBg";

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

// var measureWidget = new Cesium.Measure({
//   container: 'cesiumContainer',
//   scene: viewer.scene,
//   units: new Cesium.MeasureUnits({
//     distanceUnits: Cesium.DistanceUnits.METERS,
//     areaUnits: Cesium.AreaUnits.SQUARE_METERS,
//     volumeUnits: Cesium.VolumeUnits.CUBIC_FEET,
//     angleUnits: Cesium.AngleUnits.DEGREES,
//     slopeUnits: Cesium.AngleUnits.GRADE
//   })
// });

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
    `<tr><th>GlobalId</th><td>${pickedFeature.getProperty("GlobalId")}</td></tr>` +
    `<tr><th>parcel_id</th><td>${pickedFeature.getProperty("parcel_id")}</td></tr>` +
    `<tr><th>Name</th><td>${pickedFeature.getProperty("Name")}</td></tr>` +
    `<tr><th>Longitude</th><td>${pickedFeature.getProperty("Longitude")}</td></tr>` +
    `<tr><th>Latitude</th><td>${pickedFeature.getProperty("Latitude")}</td></tr>` +
    `<tr><th>Height</th><td>${pickedFeature.getProperty("Height")}</td></tr>` +
    `<tr><th>Occupant</th><td>${pickedFeature.getProperty("Occupant")}</td></tr>` +
    `<tr><th>Lenght</th><td>${pickedFeature.getProperty("lenght")}</td></tr>` +
    `<tr><th>Area</th><td>${pickedFeature.getProperty("area")}</td></tr>` +
    `<tr><th>Volume</th><td>${pickedFeature.getProperty("volume")}</td></tr>` +
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
      return;
    }

    if (silhouetteGreen.selected[0] === pickedFeature) {
      return;
    }

    const highlightedFeature = silhouetteBlue.selected[0];
    if (pickedFeature === highlightedFeature) {
      silhouetteBlue.selected = [];
    }

    silhouetteGreen.selected = [pickedFeature];
    viewer.selectedEntity = selectedEntity;
    selectedEntity.description = createPickedFeatureDescription(pickedFeature);

    const parcel = pickedFeature.getProperty("parcel_id");
    console.log(parcel);
    // ajax request with sucses and error
    $.ajax({
      type: "Get",
      url: `../../action/get-parcel.php`,
      data: {
        parcel
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        console.log(response['id']);
        console.log(response['parcel_name']);
        // Update nilai "Occupant" dengan nilai dari response['id']
        pickedFeature.setProperty("Occupant", response['id']);

        // Ensure selectedEntity.description is treated as a string
        const currentDescription = String(selectedEntity.description);

        // Update deskripsi dengan nilai "Occupant" yang baru
        const updatedDescription = currentDescription.replace(
          /<tr><th>Occupant<\/th><td>[^<]*<\/td><\/tr>/,
          `<tr><th>Occupant</th><td>${response['id']}</td></tr>`
        );

        // Set deskripsi yang diperbarui
        selectedEntity.description = updatedDescription;
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
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM", $(this).prop("checked"));
});
$("#siolaLegal_BT").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7D40JE8AAFPK0SK06HE", $(this).prop("checked"));
});
$("#siolaLegal_BB").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7CQ6NV0TGV2RNKNM1GX", $(this).prop("checked"));
});

$("#siolaLegal_1a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7P6DEEDQH6QTE0Z68B8", $(this).prop("checked"));
});
$("#siolaLegal_1a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RRR7HCZP94ETRJK757", $(this).prop("checked"));
});
$("#siolaLegal_1a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX", $(this).prop("checked"));
});
$("#siolaLegal_1a4").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7", $(this).prop("checked"));
});
$("#siolaLegal_1a5").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RZXAKK47WMJVV9YSKB", $(this).prop("checked"));
});
$("#siolaLegal_1a6").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PHEQA5SX964M063XQK", $(this).prop("checked"));
});
$("#siolaLegal_1a7").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QNNM61J5YDVQQ23TB2", $(this).prop("checked"));
});
$("#siolaLegal_1a8").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7R5TWKKPSEM6Q95T28R", $(this).prop("checked"));
});
$("#siolaLegal_1a9").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QX80R8CH3JDZ097JX3", $(this).prop("checked"));
});
$("#siolaLegal_1a10").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK", $(this).prop("checked"));
});

$("#siolaLegal_2a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ", $(this).prop("checked"));
});
$("#siolaLegal_2a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VT5ARB2YC0C7PXKCDY", $(this).prop("checked"));
});
$("#siolaLegal_2a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7TN104KHG9ZEHJVSAX5", $(this).prop("checked"));
});
$("#siolaLegal_2a4").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE", $(this).prop("checked"));
});
$("#siolaLegal_2a5").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7S8KJJGYKK6GDD7BBTN", $(this).prop("checked"));
});
$("#siolaLegal_2a6").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W", $(this).prop("checked"));
});
$("#siolaLegal_2a7").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7V04AZ1NWE2VJ7T6T89", $(this).prop("checked"));
});

$("#siolaLegal_3a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XR27P0H1C69A7TPGZ0", $(this).prop("checked"));
});
$("#siolaLegal_3a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Y68R892D1XNRBV2RPN", $(this).prop("checked"));
});
$("#siolaLegal_3a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WZ79J0N5VRS8HQWJXX", $(this).prop("checked"));
});
$("#siolaLegal_3a4").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7W331GHVRF0QTNJXGRW", $(this).prop("checked"));
});
$("#siolaLegal_3a5").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WCQA085HKSMFMBE8Z0", $(this).prop("checked"));
});
$("#siolaLegal_3a6").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P", $(this).prop("checked"));
});
$("#siolaLegal_3a7").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7X6FYFJW3PN5TQV1DAR", $(this).prop("checked"));
});

$("#siolaLegal_4a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YFWXFTR05G47KJJMJ9", $(this).prop("checked"));
});
$("#siolaLegal_4a2").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YS0BMJZNXP9YB1MSA2", $(this).prop("checked"));
});
$("#siolaLegal_4a3").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3", $(this).prop("checked"));
});

$("#siolaLegal_5a1").change(function () {
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7ZH14YX6V6Y963TEKXQ", $(this).prop("checked"));
});

$("#zoomToSiolaLegal_1all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7P6DEEDQH6QTE0Z68B8",
    "legal_01HM6EM7RRR7HCZP94ETRJK757",
    "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX",
    "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7",
    "legal_01HM6EM7RZXAKK47WMJVV9YSKB",
    "legal_01HM6EM7PHEQA5SX964M063XQK",
    "legal_01HM6EM7QNNM61J5YDVQQ23TB2",
    "legal_01HM6EM7R5TWKKPSEM6Q95T28R",
    "legal_01HM6EM7QX80R8CH3JDZ097JX3",
    "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK"
  ]);
  zoomToTileset(siolaBuildingL1, -5, 90, 150);
});
$("#zoomToSiolaLegal_2all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ",
    "legal_01HM6EM7VT5ARB2YC0C7PXKCDY",
    "legal_01HM6EM7TN104KHG9ZEHJVSAX5",
    "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE",
    "legal_01HM6EM7S8KJJGYKK6GDD7BBTN",
    "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W",
    "legal_01HM6EM7V04AZ1NWE2VJ7T6T89"
  ]);
  zoomToTileset(siolaBuildingL2, -10, 90, 150);
});
$("#zoomToSiolaLegal_3all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7XR27P0H1C69A7TPGZ0",
    "legal_01HM6EM7Y68R892D1XNRBV2RPN",
    "legal_01HM6EM7WZ79J0N5VRS8HQWJXX",
    "legal_01HM6EM7W331GHVRF0QTNJXGRW",
    "legal_01HM6EM7WCQA085HKSMFMBE8Z0",
    "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P",
    "legal_01HM6EM7X6FYFJW3PN5TQV1DAR"
  ]);
  zoomToTileset(siolaBuildingL3, -15, 90, 150);
});
$("#zoomToSiolaLegal_4all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7YFWXFTR05G47KJJMJ9",
    "legal_01HM6EM7YS0BMJZNXP9YB1MSA2",
    "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3"
  ]);
  zoomToTileset(siolaBuildingL4, -15, 90, 150);
});
$("#zoomToSiolaLegal_5all").on('click', function () {
  setTransparentBylegal_id(siolaLegal, [
    "legal_01HM6EM7ZH14YX6V6Y963TEKXQ",
  ]);
  zoomToTileset(siolaBuildingL5, -20, 90, 150);
});

$("#zoomToSiolaLegal_gsb").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7CQ6NV0TGV2RNKNM1GX", $(this).prop("checked"));
  zoomToLocation(60, 65, 112.7364636251925, -7.257092539825164, -20, 0);
});
$("#zoomToSiolaLegal_bt").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM", $(this).prop("checked"));
  zoomToLocation(60, 200, 112.7343253773387, -7.258348227236101, -20, 0);
});
$("#zoomToSiolaLegal_bb").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7D40JE8AAFPK0SK06HE", $(this).prop("checked"));
  zoomToLocation(70, -26, 112.73628989849963, -7.25698919103089, 10, 0);
});

$("#zoomToSiolaLegal_1a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7P6DEEDQH6QTE0Z68B8");
  zoomToLocation(115, 20, 112.7364701048379, -7.255725655809104, -5, 0);
});
$("#zoomToSiolaLegal_1a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7RRR7HCZP94ETRJK757");
  zoomToLocation(70, 20, 112.73614083014726, -7.256673453774129, -5, 0);
});
$("#zoomToSiolaLegal_1a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX");
  zoomToLocation(70, 25, 112.73614083014726, -7.256673453774129, -15, 0);
});
$("#zoomToSiolaLegal_1a4").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7");
  zoomToLocation(115, 15, 112.73703300890135, -7.256062486631589, -20, 0);
});
$("#zoomToSiolaLegal_1a5").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7RZXAKK47WMJVV9YSKB");
  zoomToLocation(180, 20, 112.73775089782131, -7.255339612039106, -5, 0);
});
$("#zoomToSiolaLegal_1a6").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7PHEQA5SX964M063XQK");
  zoomToLocation(180, 20, 112.73775089782131, -7.255339612039106, -20, 0);
});
$("#zoomToSiolaLegal_1a7").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7QNNM61J5YDVQQ23TB2");
  zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -10, 0);
});
$("#zoomToSiolaLegal_1a8").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7R5TWKKPSEM6Q95T28R");
  zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -15, 0);
});
$("#zoomToSiolaLegal_1a9").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7QX80R8CH3JDZ097JX3");
  zoomToLocation(20, 20, 112.73725740076955, -7.257555590592433, -15, 0);
});
$("#zoomToSiolaLegal_1a10").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK");
  zoomToLocation(345, 20, 112.73810487457202, -7.257580246584778, -5, 0);
});

$("#zoomToSiolaLegal_2a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ");
  zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -10, 0);
});
$("#zoomToSiolaLegal_2a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7VT5ARB2YC0C7PXKCDY");
  zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -10, 0);
});
$("#zoomToSiolaLegal_2a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7TN104KHG9ZEHJVSAX5");
  zoomToLocation(70, 35, 112.73667745777747, -7.2567879531324495, -15, 0);
});
$("#zoomToSiolaLegal_2a4").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE");
  zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
});
$("#zoomToSiolaLegal_2a5").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7S8KJJGYKK6GDD7BBTN");
  zoomToLocation(175, 45, 112.73776680239449, -7.255272479365819, -15, 0);
});
$("#zoomToSiolaLegal_2a6").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W");
  zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
});
$("#zoomToSiolaLegal_2a7").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7V04AZ1NWE2VJ7T6T89");
  zoomToLocation(265, 20, 112.7389374537573, -7.2564733527464185, -15, 0);
});

$("#zoomToSiolaLegal_3a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7XR27P0H1C69A7TPGZ0");
  zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -15, 0);
});
$("#zoomToSiolaLegal_3a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7Y68R892D1XNRBV2RPN");
  zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -15, 0);
});
$("#zoomToSiolaLegal_3a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7WZ79J0N5VRS8HQWJXX");
  zoomToLocation(70, 40, 112.73667745777747, -7.2567879531324495, -15, 0);
});
$("#zoomToSiolaLegal_3a4").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7W331GHVRF0QTNJXGRW");
  zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
});
$("#zoomToSiolaLegal_3a5").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7WCQA085HKSMFMBE8Z0");
  zoomToLocation(175, 50, 112.73780550486839, -7.255527145036425, -25, 0);
});
$("#zoomToSiolaLegal_3a6").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P");
  zoomToLocation(180, 350, 112.73779026382113, -7.255632571893392, -15, 0);
});
$("#zoomToSiolaLegal_3a7").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7X6FYFJW3PN5TQV1DAR");
  zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
});

$("#zoomToSiolaLegal_4a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7YFWXFTR05G47KJJMJ9");
  zoomToLocation(65, 75, 112.73661741237805, -7.256992873425595, -25, 0);
});
$("#zoomToSiolaLegal_4a2").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7YS0BMJZNXP9YB1MSA2");
  zoomToLocation(345, 75, 112.73813421339062, -7.257867208348932, -20, 0);
});
$("#zoomToSiolaLegal_4a3").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3");
  zoomToLocation(180, 80, 112.73814898604392, -7.255089250207667, -25, 0);
});

$("#zoomToSiolaLegal_5a1").on('click', function () {
  setTransparentBylegal_id(siolaLegal, "legal_01HM6EM7ZH14YX6V6Y963TEKXQ");
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

$("#balaiLegal_1a1").change(function () {

});
$("#balaiLegal_1a2").change(function () {

});
$("#balaiLegal_1a3").change(function () {

});
$("#balaiLegal_1a4").change(function () {

});
$("#balaiLegal_1a5").change(function () {

});
$("#balaiLegal_1a6").change(function () {

});
$("#balaiLegal_1a7").change(function () {

});
$("#balaiLegal_1a8").change(function () {

});
$("#balaiLegal_1a9").change(function () {

});
$("#balaiLegal_1a10").change(function () {

});
$("#balaiLegal_1a11").change(function () {

});
$("#balaiLegal_1a12").change(function () {

});
$("#balaiLegal_1a13").change(function () {

});

$("#balaiLegal_0a1").change(function () {

});
$("#balaiLegal_0a2").change(function () {

});
$("#balaiLegal_0a3").change(function () {

});
$("#balaiLegal_0a4").change(function () {

});
$("#balaiLegal_0a5").change(function () {

});
$("#balaiLegal_0a6").change(function () {

});
$("#balaiLegal_0a7").change(function () {

});
$("#balaiLegal_0a8").change(function () {

});
$("#balaiLegal_0a9").change(function () {

});

$("#balaiLegal_GSB").change(function () {

});
$("#balaiLegal_BB").change(function () {

});
$("#balaiLegal_BT").change(function () {

});

$("#zoomToBalaiLegal_0all").on('click', function () {
  zoomToTileset(balaiBuildingL1, -25, 180, 100);
});
$("#zoomToBalaiLegal_1all").on('click', function () {
  zoomToTileset(balaiBuildingL1, -25, 0, 100);
});

$("#zoomToBalaiLegal_gsb").on('click', function () {
  zoomToTileset(balaiLegalGSB, -20, 25, 300);
});
$("#zoomToBalaiLegal_bt").on('click', function () {
  zoomToTileset(balaiLegalBT, -20, 25, 300);
});
$("#zoomToBalaiLegal_bb").on('click', function () {
  zoomToTileset(balaiLegalBB, 15, 25, 300);
});

$("#zoomToBalaiLegal_1a1").on('click', function () {
  zoomToTileset(balaiLegalL1a1, -45, 20, 100);
});
$("#zoomToBalaiLegal_1a2").on('click', function () {
  zoomToTileset(balaiLegalL1a2, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a3").on('click', function () {
  zoomToTileset(balaiLegalL1a3, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a4").on('click', function () {
  zoomToTileset(balaiLegalL1a4, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a5").on('click', function () {
  zoomToTileset(balaiLegalL1a5, -25, 20, 100);
});
$("#zoomToBalaiLegal_1a6").on('click', function () {
  zoomToTileset(balaiLegalL1a6, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a7").on('click', function () {
  zoomToTileset(balaiLegalL1a7, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a8").on('click', function () {
  zoomToTileset(balaiLegalL1a8, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a9").on('click', function () {
  zoomToTileset(balaiLegalL1a9, -25, 80, 100);
});
$("#zoomToBalaiLegal_1a10").on('click', function () {
  zoomToTileset(balaiLegalL1a10, -25, 0, 100);
});
$("#zoomToBalaiLegal_1a11").on('click', function () {
  zoomToTileset(balaiLegalL1a10, -25, 210, 100);
});
$("#zoomToBalaiLegal_1a12").on('click', function () {
  zoomToTileset(balaiLegalL1a10, -25, 210, 100);
});
$("#zoomToBalaiLegal_1a13").on('click', function () {
  zoomToTileset(balaiLegalL1a10, -25, 210, 100);
});

$("#zoomToBalaiLegal_0a1").on('click', function () {
  zoomToTileset(balaiLegalL0a1, -45, 25, 100);
});
$("#zoomToBalaiLegal_0a2").on('click', function () {
  zoomToTileset(balaiLegalL0a2, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a3").on('click', function () {
  zoomToTileset(balaiLegalL0a3, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a4").on('click', function () {
  zoomToTileset(balaiLegalL0a4, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a5").on('click', function () {
  zoomToTileset(balaiLegalL0a5, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a6").on('click', function () {
  zoomToTileset(balaiLegalL0a6, -25, 25, 100);
});
$("#zoomToBalaiLegal_0a7").on('click', function () {
  zoomToTileset(balaiLegalL0a7, -25, 20, 100);
});
$("#zoomToBalaiLegal_0a8").on('click', function () {
  zoomToTileset(balaiLegalL0a8, -25, 20, 100);
});
$("#zoomToBalaiLegal_0a9").on('click', function () {
  zoomToTileset(balaiLegalL0a9, -25, 20, 100);
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
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW920GYWHNG3MC1SR7VE4", $(this).prop("checked"));
});
$("#rusunawaLegal_BB").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW91SR64FJ7F0YVCJK4GS", $(this).prop("checked"));
});
$("#rusunawaLegal_BT").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW7TPS55AHCPWVXSGEPQE", $(this).prop("checked"));
});

$("#rusunawaLegal_1a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW996G1Z61WBQY1XP3QAK", $(this).prop("checked"));
});
$("#rusunawaLegal_1a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AC1QPP7KW6J343B848", $(this).prop("checked"));
});
$("#rusunawaLegal_1a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2", $(this).prop("checked"));
});
$("#rusunawaLegal_1a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CP9GS5QSGGTTV7GMC2", $(this).prop("checked"));
});
$("#rusunawaLegal_1a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CDDCR0RAMWWSX1KHMN", $(this).prop("checked"));
});
$("#rusunawaLegal_1a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CV1M82CGYX5SPVBSFA", $(this).prop("checked"));
});
$("#rusunawaLegal_1a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DBK9J1MN5WFHB9B16J", $(this).prop("checked"));
});
$("#rusunawaLegal_1a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9D52TK6QTBQC832RBNQ", $(this).prop("checked"));
});
$("#rusunawaLegal_1a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DGEFA023Q9HD9WY5EB", $(this).prop("checked"));
});
$("#rusunawaLegal_1a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BS01J71V6KXND1BV4T", $(this).prop("checked"));
});
$("#rusunawaLegal_1a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C3DV3KDRH8EHRK9FVF", $(this).prop("checked"));
});
$("#rusunawaLegal_1a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D", $(this).prop("checked"));
});
$("#rusunawaLegal_1a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BBR6W6WTB8ZP65B2WW", $(this).prop("checked"));
});
$("#rusunawaLegal_1a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B610G13NHKJT44S509", $(this).prop("checked"));
});
$("#rusunawaLegal_1a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B1JJFM7H4E8MZDSDDS", $(this).prop("checked"));
});
$("#rusunawaLegal_1a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AS7JFA6MMEHMX0MWS1", $(this).prop("checked"));
});
$("#rusunawaLegal_1a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AK2ADTV3A79B2A6ZWX", $(this).prop("checked"));
});
$("#rusunawaLegal_1a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89", $(this).prop("checked"));
});
$("#rusunawaLegal_1a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A41HNVDGF7VT7QWE8F", $(this).prop("checked"));
});
$("#rusunawaLegal_1a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C8FC97YYPFMHZSJJCG", $(this).prop("checked"));
});
$("#rusunawaLegal_1a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BXA4XSZ8029S3J260F", $(this).prop("checked"));
});

$("#rusunawaLegal_2a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DTF7VED1JMZYE5GSYE", $(this).prop("checked"));
});
$("#rusunawaLegal_2a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y", $(this).prop("checked"));
});
$("#rusunawaLegal_2a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GRAHX1RCKBGNEM3B2T", $(this).prop("checked"));
});
$("#rusunawaLegal_2a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J91BB3TS79QJ3FYNH6", $(this).prop("checked"));
});
$("#rusunawaLegal_2a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J20S66D2T0VVCKKAX5", $(this).prop("checked"));
});
$("#rusunawaLegal_2a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HVS15HHSSCTJE5QP3S", $(this).prop("checked"));
});
$("#rusunawaLegal_2a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HPCF5JN81YKW88P57J", $(this).prop("checked"));
});
$("#rusunawaLegal_2a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HJAXG353YRWQK707TW", $(this).prop("checked"));
});
$("#rusunawaLegal_2a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HEGVC91YVDTMN82QFB", $(this).prop("checked"));
});
$("#rusunawaLegal_2a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H9S0NZ0S40Y38NWWN2", $(this).prop("checked"));
});
$("#rusunawaLegal_2a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H293QC7RP34NHPNX1A", $(this).prop("checked"));
});
$("#rusunawaLegal_2a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GK7RQPJPPD6ZTG34HP", $(this).prop("checked"));
});
$("#rusunawaLegal_2a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GX4SPW03PXM9F35HTE", $(this).prop("checked"));
});
$("#rusunawaLegal_2a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E61D378B64K62B28EK", $(this).prop("checked"));
});
$("#rusunawaLegal_2a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EE5WASSX5XJV38AZ6H", $(this).prop("checked"));
});
$("#rusunawaLegal_2a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K", $(this).prop("checked"));
});
$("#rusunawaLegal_2a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G76Z0JMNVH6KTTAPK7", $(this).prop("checked"));
});
$("#rusunawaLegal_2a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG", $(this).prop("checked"));
});
$("#rusunawaLegal_2a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FSYXR41VAA2452CAR4", $(this).prop("checked"));
});
$("#rusunawaLegal_2a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FK4DYRSKVNV6BB7B2A", $(this).prop("checked"));
});
$("#rusunawaLegal_2a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FFCKQA7V1Z45X8JTCS", $(this).prop("checked"));
});
$("#rusunawaLegal_2a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FA312J5704SNJ6PYJ3", $(this).prop("checked"));
});
$("#rusunawaLegal_2a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS", $(this).prop("checked"));
});
$("#rusunawaLegal_2a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EZ18RKZYJKHS2Z53R7", $(this).prop("checked"));
});
$("#rusunawaLegal_2a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ET2QPK43G2QTXRE4HC", $(this).prop("checked"));
});
$("#rusunawaLegal_2a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EN8FQ0XDK68F1VXMN1", $(this).prop("checked"));
});
$("#rusunawaLegal_2a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E0KJESXY4H2BNBE7VM", $(this).prop("checked"));
});

$("#rusunawaLegal_3a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MVW5ZGH9QXR49J570K", $(this).prop("checked"));
});
$("#rusunawaLegal_3a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q07D1QQW0A81T6A3W9", $(this).prop("checked"));
});
$("#rusunawaLegal_3a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0", $(this).prop("checked"));
});
$("#rusunawaLegal_3a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ", $(this).prop("checked"));
});
$("#rusunawaLegal_3a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PN986VDPJXJC6EK9JV", $(this).prop("checked"));
});
$("#rusunawaLegal_3a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PGYR5T30KRSHCPZWAK", $(this).prop("checked"));
});
$("#rusunawaLegal_3a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P93F9RHT1J5NZXSYFN", $(this).prop("checked"));
});
$("#rusunawaLegal_3a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P3N98X9TX7VNRBJ15X", $(this).prop("checked"));
});
$("#rusunawaLegal_3a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NZDR7PV98W970T5PRX", $(this).prop("checked"));
});
$("#rusunawaLegal_3a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NSC24K5FPDZEP7XG25", $(this).prop("checked"));
});
$("#rusunawaLegal_3a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NKCN16ZY3MV0T9GWF4", $(this).prop("checked"));
});
$("#rusunawaLegal_3a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N4PHV678XHXKETX2EH", $(this).prop("checked"));
});
$("#rusunawaLegal_3a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NFBP8DPD8X5P03E3TW", $(this).prop("checked"));
});
$("#rusunawaLegal_3a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QBPGW27WGDG51XKR3X", $(this).prop("checked"));
});
$("#rusunawaLegal_3a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM", $(this).prop("checked"));
});
$("#rusunawaLegal_3a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MJRB0A8TY333RE1QFZ", $(this).prop("checked"));
});
$("#rusunawaLegal_3a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ME30WEZRRXDPQA190J", $(this).prop("checked"));
});
$("#rusunawaLegal_3a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M70652KB4774BW89EC", $(this).prop("checked"));
});
$("#rusunawaLegal_3a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M100TA6VY3FM35D5R6", $(this).prop("checked"));
});
$("#rusunawaLegal_3a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KXFWG38WNR24HWCPJK", $(this).prop("checked"));
});
$("#rusunawaLegal_3a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KQ954KPSACVC6D6CE0", $(this).prop("checked"));
});
$("#rusunawaLegal_3a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KKDNMQZ8FRB96RCHCC", $(this).prop("checked"));
});
$("#rusunawaLegal_3a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y", $(this).prop("checked"));
});
$("#rusunawaLegal_3a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K91WCB1AD66JYY3FFS", $(this).prop("checked"));
});
$("#rusunawaLegal_3a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K28V03M20MSEPV7QCD", $(this).prop("checked"));
});
$("#rusunawaLegal_3a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JXP8418XRP007M283B", $(this).prop("checked"));
});
$("#rusunawaLegal_3a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q6K2F6KR3AENXDFWWF", $(this).prop("checked"));
});

$("#rusunawaLegal_4a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9T0W8VBTZ25HCXBGQPS", $(this).prop("checked"));
});
$("#rusunawaLegal_4a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WAGXHBWAAK6QNDA2MH", $(this).prop("checked"));
});
$("#rusunawaLegal_4a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TH737NRNVP2WJJP0S0", $(this).prop("checked"));
});
$("#rusunawaLegal_4a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W5J48VXG0AXKHV30D6", $(this).prop("checked"));
});
$("#rusunawaLegal_4a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W0HX6WBFYMVC7JQ802", $(this).prop("checked"));
});
$("#rusunawaLegal_4a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VVFNDWX99Q10DNPRC5", $(this).prop("checked"));
});
$("#rusunawaLegal_4a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VNV42MDP0DJXTDQQ31", $(this).prop("checked"));
});
$("#rusunawaLegal_4a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VDYT36E93WPXKN0V21", $(this).prop("checked"));
});
$("#rusunawaLegal_4a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN", $(this).prop("checked"));
});
$("#rusunawaLegal_4a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V2DJBF05DRHF42171K", $(this).prop("checked"));
});
$("#rusunawaLegal_4a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TYY1DHDJ12T9WGP98K", $(this).prop("checked"));
});
$("#rusunawaLegal_4a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TBRKRKG84NZMK8XSDY", $(this).prop("checked"));
});
$("#rusunawaLegal_4a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TSRMXJBXXC8FPW0MP0", $(this).prop("checked"));
});
$("#rusunawaLegal_4a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QPWE75DMGH3ZRP2ED4", $(this).prop("checked"));
});
$("#rusunawaLegal_4a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QYSC6XF9HPFBW17TCJ", $(this).prop("checked"));
});
$("#rusunawaLegal_4a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ", $(this).prop("checked"));
});
$("#rusunawaLegal_4a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SJ874QGQMERHQX4R8D", $(this).prop("checked"));
});
$("#rusunawaLegal_4a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ", $(this).prop("checked"));
});
$("#rusunawaLegal_4a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S743XNK211CH82N31G", $(this).prop("checked"));
});
$("#rusunawaLegal_4a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S3D2FG186H849WPBD0", $(this).prop("checked"));
});
$("#rusunawaLegal_4a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RY7Z9V7C40F0XBR2M4", $(this).prop("checked"));
});
$("#rusunawaLegal_4a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM", $(this).prop("checked"));
});
$("#rusunawaLegal_4a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RK19R68AXV9YP9HTY8", $(this).prop("checked"));
});
$("#rusunawaLegal_4a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RBT4M3NX3YH6EMW2E1", $(this).prop("checked"));
});
$("#rusunawaLegal_4a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R7M4KK7A45YWR1FAG8", $(this).prop("checked"));
});
$("#rusunawaLegal_4a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R3NP14ARFTQNV13BEW", $(this).prop("checked"));
});
$("#rusunawaLegal_4a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV", $(this).prop("checked"));
});

$("#rusunawaLegal_5a1").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Z2GR1BZENX99V8SD6F", $(this).prop("checked"));
});
$("#rusunawaLegal_5a2").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK", $(this).prop("checked"));
});
$("#rusunawaLegal_5a3").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZK0V03298BB5X130WY", $(this).prop("checked"));
});
$("#rusunawaLegal_5a4").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA16RNAX53BA0R1PTXJ6", $(this).prop("checked"));
});
$("#rusunawaLegal_5a5").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA12ZB7TYZJNHAHPY7WW", $(this).prop("checked"));
});
$("#rusunawaLegal_5a6").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0XYNJRXAY0B63N5BBV", $(this).prop("checked"));
});
$("#rusunawaLegal_5a7").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0NGNZCR80RNDCXMH5M", $(this).prop("checked"));
});
$("#rusunawaLegal_5a8").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0G6XMNZHKP9KN1BBT4", $(this).prop("checked"));
});
$("#rusunawaLegal_5a9").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0B8MQSKPHR04CJKNP4", $(this).prop("checked"));
});
$("#rusunawaLegal_5a10").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA05B4C592FR7Z3CRX8B", $(this).prop("checked"));
});
$("#rusunawaLegal_5a11").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D", $(this).prop("checked"));
});
$("#rusunawaLegal_5a12").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZDPFQYCG9Y6K9F771W", $(this).prop("checked"));
});
$("#rusunawaLegal_5a13").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZSR8817RCJG52R8WDP", $(this).prop("checked"));
});
$("#rusunawaLegal_5a14").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WPJPS0THQYCNXRXP6D", $(this).prop("checked"));
});
$("#rusunawaLegal_5a15").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WZRP309VTB8P8YQKBQ", $(this).prop("checked"));
});
$("#rusunawaLegal_5a16").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YT7MKD01KC38EX2WQP", $(this).prop("checked"));
});
$("#rusunawaLegal_5a17").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y", $(this).prop("checked"));
});
$("#rusunawaLegal_5a18").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YD78PQ60W3B1P7C3J7", $(this).prop("checked"));
});
$("#rusunawaLegal_5a19").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y9G9K73HXMFXZS05BK", $(this).prop("checked"));
});
$("#rusunawaLegal_5a20").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH", $(this).prop("checked"));
});
$("#rusunawaLegal_5a21").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XZFE0FB81H22C1BJC5", $(this).prop("checked"));
});
$("#rusunawaLegal_5a22").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XVME2NBE8PHXHX9Q2J", $(this).prop("checked"));
});
$("#rusunawaLegal_5a23").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XMAR7XJ0CG8P17GTAS", $(this).prop("checked"));
});
$("#rusunawaLegal_5a24").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW", $(this).prop("checked"));
});
$("#rusunawaLegal_5a25").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M", $(this).prop("checked"));
});
$("#rusunawaLegal_5a26").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9X4WWVMEB76J2P1XP7D", $(this).prop("checked"));
});
$("#rusunawaLegal_5a27").change(function () {
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2", $(this).prop("checked"));
});



$("#zoomToRusunawaLegal_1all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW996G1Z61WBQY1XP3QAK",
    "legal_01HM6EW9AC1QPP7KW6J343B848",
    "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2",
    "legal_01HM6EW9CP9GS5QSGGTTV7GMC2",
    "legal_01HM6EW9CDDCR0RAMWWSX1KHMN",
    "legal_01HM6EW9CV1M82CGYX5SPVBSFA",
    "legal_01HM6EW9DBK9J1MN5WFHB9B16J",
    "legal_01HM6EW9D52TK6QTBQC832RBNQ",
    "legal_01HM6EW9DGEFA023Q9HD9WY5EB",
    "legal_01HM6EW9BS01J71V6KXND1BV4T",
    "legal_01HM6EW9C3DV3KDRH8EHRK9FVF",
    "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D",
    "legal_01HM6EW9BBR6W6WTB8ZP65B2WW",
    "legal_01HM6EW9B610G13NHKJT44S509",
    "legal_01HM6EW9B1JJFM7H4E8MZDSDDS",
    "legal_01HM6EW9AS7JFA6MMEHMX0MWS1",
    "legal_01HM6EW9AK2ADTV3A79B2A6ZWX",
    "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89",
    "legal_01HM6EW9A41HNVDGF7VT7QWE8F",
    "legal_01HM6EW9C8FC97YYPFMHZSJJCG",
    "legal_01HM6EW9BXA4XSZ8029S3J260F",
  ]);
  zoomToTileset(rusunawaBuildingL1, -25, 180, 100);
});
$("#zoomToRusunawaLegal_2all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9DTF7VED1JMZYE5GSYE",
    "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y",
    "legal_01HM6EW9GRAHX1RCKBGNEM3B2T",
    "legal_01HM6EW9J91BB3TS79QJ3FYNH6",
    "legal_01HM6EW9J20S66D2T0VVCKKAX5",
    "legal_01HM6EW9HVS15HHSSCTJE5QP3S",
    "legal_01HM6EW9HPCF5JN81YKW88P57J",
    "legal_01HM6EW9HJAXG353YRWQK707TW",
    "legal_01HM6EW9HEGVC91YVDTMN82QFB",
    "legal_01HM6EW9H9S0NZ0S40Y38NWWN2",
    "legal_01HM6EW9H293QC7RP34NHPNX1A",
    "legal_01HM6EW9GK7RQPJPPD6ZTG34HP",
    "legal_01HM6EW9GX4SPW03PXM9F35HTE",
    "legal_01HM6EW9E61D378B64K62B28EK",
    "legal_01HM6EW9EE5WASSX5XJV38AZ6H",
    "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K",
    "legal_01HM6EW9G76Z0JMNVH6KTTAPK7",
    "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG",
    "legal_01HM6EW9FSYXR41VAA2452CAR4",
    "legal_01HM6EW9FK4DYRSKVNV6BB7B2A",
    "legal_01HM6EW9FFCKQA7V1Z45X8JTCS",
    "legal_01HM6EW9FA312J5704SNJ6PYJ3",
    "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS",
    "legal_01HM6EW9EZ18RKZYJKHS2Z53R7",
    "legal_01HM6EW9ET2QPK43G2QTXRE4HC",
    "legal_01HM6EW9EN8FQ0XDK68F1VXMN1",
    "legal_01HM6EW9E0KJESXY4H2BNBE7VM",
  ]);
  zoomToTileset(rusunawaBuildingL2, -25, 180, 100);
});
$("#zoomToRusunawaLegal_3all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9MVW5ZGH9QXR49J570K",
    "legal_01HM6EW9Q07D1QQW0A81T6A3W9",
    "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0",
    "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ",
    "legal_01HM6EW9PN986VDPJXJC6EK9JV",
    "legal_01HM6EW9PGYR5T30KRSHCPZWAK",
    "legal_01HM6EW9P93F9RHT1J5NZXSYFN",
    "legal_01HM6EW9P3N98X9TX7VNRBJ15X",
    "legal_01HM6EW9NZDR7PV98W970T5PRX",
    "legal_01HM6EW9NSC24K5FPDZEP7XG25",
    "legal_01HM6EW9NKCN16ZY3MV0T9GWF4",
    "legal_01HM6EW9N4PHV678XHXKETX2EH",
    "legal_01HM6EW9NFBP8DPD8X5P03E3TW",
    "legal_01HM6EW9QBPGW27WGDG51XKR3X",
    "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM",
    "legal_01HM6EW9MJRB0A8TY333RE1QFZ",
    "legal_01HM6EW9ME30WEZRRXDPQA190J",
    "legal_01HM6EW9M70652KB4774BW89EC",
    "legal_01HM6EW9M100TA6VY3FM35D5R6",
    "legal_01HM6EW9KXFWG38WNR24HWCPJK",
    "legal_01HM6EW9KQ954KPSACVC6D6CE0",
    "legal_01HM6EW9KKDNMQZ8FRB96RCHCC",
    "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y",
    "legal_01HM6EW9K91WCB1AD66JYY3FFS",
    "legal_01HM6EW9K28V03M20MSEPV7QCD",
    "legal_01HM6EW9JXP8418XRP007M283B",
    "legal_01HM6EW9Q6K2F6KR3AENXDFWWF",
  ]);
  zoomToTileset(rusunawaBuildingL3, -25, 180, 100);
});
$("#zoomToRusunawaLegal_4all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9T0W8VBTZ25HCXBGQPS",
    "legal_01HM6EW9WAGXHBWAAK6QNDA2MH",
    "legal_01HM6EW9TH737NRNVP2WJJP0S0",
    "legal_01HM6EW9W5J48VXG0AXKHV30D6",
    "legal_01HM6EW9W0HX6WBFYMVC7JQ802",
    "legal_01HM6EW9VVFNDWX99Q10DNPRC5",
    "legal_01HM6EW9VNV42MDP0DJXTDQQ31",
    "legal_01HM6EW9VDYT36E93WPXKN0V21",
    "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN",
    "legal_01HM6EW9V2DJBF05DRHF42171K",
    "legal_01HM6EW9TYY1DHDJ12T9WGP98K",
    "legal_01HM6EW9TBRKRKG84NZMK8XSDY",
    "legal_01HM6EW9TSRMXJBXXC8FPW0MP0",
    "legal_01HM6EW9QPWE75DMGH3ZRP2ED4",
    "legal_01HM6EW9QYSC6XF9HPFBW17TCJ",
    "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ",
    "legal_01HM6EW9SJ874QGQMERHQX4R8D",
    "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ",
    "legal_01HM6EW9S743XNK211CH82N31G",
    "legal_01HM6EW9S3D2FG186H849WPBD0",
    "legal_01HM6EW9RY7Z9V7C40F0XBR2M4",
    "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM",
    "legal_01HM6EW9RK19R68AXV9YP9HTY8",
    "legal_01HM6EW9RBT4M3NX3YH6EMW2E1",
    "legal_01HM6EW9R7M4KK7A45YWR1FAG8",
    "legal_01HM6EW9R3NP14ARFTQNV13BEW",
    "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV",
  ]);
  zoomToTileset(rusunawaBuildingL4, -25, 180, 100);
});
$("#zoomToRusunawaLegal_5all").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, [
    "legal_01HM6EW9Z2GR1BZENX99V8SD6F",
    "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK",
    "legal_01HM6EW9ZK0V03298BB5X130WY",
    "legal_01HM6EWA16RNAX53BA0R1PTXJ6",
    "legal_01HM6EWA12ZB7TYZJNHAHPY7WW",
    "legal_01HM6EWA0XYNJRXAY0B63N5BBV",
    "legal_01HM6EWA0NGNZCR80RNDCXMH5M",
    "legal_01HM6EWA0G6XMNZHKP9KN1BBT4",
    "legal_01HM6EWA0B8MQSKPHR04CJKNP4",
    "legal_01HM6EWA05B4C592FR7Z3CRX8B",
    "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D",
    "legal_01HM6EW9ZDPFQYCG9Y6K9F771W",
    "legal_01HM6EW9ZSR8817RCJG52R8WDP",
    "legal_01HM6EW9WPJPS0THQYCNXRXP6D",
    "legal_01HM6EW9WZRP309VTB8P8YQKBQ",
    "legal_01HM6EW9YT7MKD01KC38EX2WQP",
    "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y",
    "legal_01HM6EW9YD78PQ60W3B1P7C3J7",
    "legal_01HM6EW9Y9G9K73HXMFXZS05BK",
    "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH",
    "legal_01HM6EW9XZFE0FB81H22C1BJC5",
    "legal_01HM6EW9XVME2NBE8PHXHX9Q2J",
    "legal_01HM6EW9XMAR7XJ0CG8P17GTAS",
    "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW",
    "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M",
    "legal_01HM6EW9X4WWVMEB76J2P1XP7D",
    "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2",
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
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW996G1Z61WBQY1XP3QAK");
  zoomToLocation(265, 50, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_1a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9AC1QPP7KW6J343B848");
  zoomToLocation(180, 15, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_1a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2");
  zoomToLocation(180, 15, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_1a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CP9GS5QSGGTTV7GMC2");
  zoomToLocation(180, 15, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_1a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CDDCR0RAMWWSX1KHMN");
  zoomToLocation(180, 15, 112.64500479106304, -8.010318705620248, -15, 0);
});
$("#zoomToRusunawaLegal_1a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9CV1M82CGYX5SPVBSFA");
  zoomToLocation(180, 15, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_1a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9DBK9J1MN5WFHB9B16J");
  zoomToLocation(180, 15, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_1a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9D52TK6QTBQC832RBNQ");
  zoomToLocation(180, 15, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_1a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9DGEFA023Q9HD9WY5EB");
  zoomToLocation(180, 15, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_1a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BS01J71V6KXND1BV4T");
  zoomToLocation(100, 10, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_1a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9C3DV3KDRH8EHRK9FVF");
  zoomToLocation(100, 10, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_1a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D");
  zoomToLocation(0, 15, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_1a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BBR6W6WTB8ZP65B2WW");
  zoomToLocation(0, 15, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_1a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9B610G13NHKJT44S509");
  zoomToLocation(0, 15, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_1a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9B1JJFM7H4E8MZDSDDS");
  zoomToLocation(0, 15, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_1a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9AS7JFA6MMEHMX0MWS1");
  zoomToLocation(0, 15, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_1a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9AK2ADTV3A79B2A6ZWX");
  zoomToLocation(0, 15, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_1a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89");
  zoomToLocation(0, 15, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_1a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9A41HNVDGF7VT7QWE8F");
  zoomToLocation(0, 15, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_1a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9C8FC97YYPFMHZSJJCG");
  zoomToLocation(0, 15, 112.64516418338256, -8.011135952579131, -15, 0);
});
$("#zoomToRusunawaLegal_1a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9BXA4XSZ8029S3J260F");
  zoomToLocation(0, 15, 112.64516418338256, -8.011135952579131, -15, 0);
});

$("#zoomToRusunawaLegal_2a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9DTF7VED1JMZYE5GSYE");
  zoomToLocation(265, 52, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_2a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y");
  zoomToLocation(180, 17, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_2a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GRAHX1RCKBGNEM3B2T");
  zoomToLocation(180, 17, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_2a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9J91BB3TS79QJ3FYNH6");
  zoomToLocation(180, 17, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_2a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9J20S66D2T0VVCKKAX5");
  zoomToLocation(180, 17, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_2a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HVS15HHSSCTJE5QP3S");
  zoomToLocation(180, 17, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_2a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HPCF5JN81YKW88P57J");
  zoomToLocation(180, 17, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_2a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HJAXG353YRWQK707TW");
  zoomToLocation(180, 17, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_2a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9HEGVC91YVDTMN82QFB");
  zoomToLocation(180, 17, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_2a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9H9S0NZ0S40Y38NWWN2");
  zoomToLocation(180, 17, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_2a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9H293QC7RP34NHPNX1A");
  zoomToLocation(180, 17, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_2a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GK7RQPJPPD6ZTG34HP");
  zoomToLocation(180, 17, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_2a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GX4SPW03PXM9F35HTE");
  zoomToLocation(180, 17, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_2a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9E61D378B64K62B28EK");
  zoomToLocation(100, 10, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_2a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9EE5WASSX5XJV38AZ6H");
  zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_2a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K");
  zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_2a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9G76Z0JMNVH6KTTAPK7");
  zoomToLocation(0, 17, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_2a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG");
  zoomToLocation(0, 17, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_2a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FSYXR41VAA2452CAR4");
  zoomToLocation(0, 17, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_2a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FK4DYRSKVNV6BB7B2A");
  zoomToLocation(0, 17, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_2a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FFCKQA7V1Z45X8JTCS");
  zoomToLocation(0, 17, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_2a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9FA312J5704SNJ6PYJ3");
  zoomToLocation(0, 17, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_2a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS");
  zoomToLocation(0, 17, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_2a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9EZ18RKZYJKHS2Z53R7");
  zoomToLocation(0, 17, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_2a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ET2QPK43G2QTXRE4HC");
  zoomToLocation(0, 17, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_2a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9EN8FQ0XDK68F1VXMN1");
  zoomToLocation(0, 17, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_2a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9E0KJESXY4H2BNBE7VM");
  zoomToLocation(0, 17, 112.64516418338256, -8.011135952579131, -15, 0);
});

$("#zoomToRusunawaLegal_3a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9MVW5ZGH9QXR49J570K");
  zoomToLocation(265, 54, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_3a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Q07D1QQW0A81T6A3W9");
  zoomToLocation(180, 19, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_3a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0");
  zoomToLocation(180, 19, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_3a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ");
  zoomToLocation(180, 19, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_3a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9PN986VDPJXJC6EK9JV");
  zoomToLocation(180, 19, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_3a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9PGYR5T30KRSHCPZWAK");
  zoomToLocation(180, 19, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_3a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9P93F9RHT1J5NZXSYFN");
  zoomToLocation(180, 19, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_3a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9P3N98X9TX7VNRBJ15X");
  zoomToLocation(180, 19, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_3a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NZDR7PV98W970T5PRX");
  zoomToLocation(180, 19, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_3a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NSC24K5FPDZEP7XG25");
  zoomToLocation(180, 19, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_3a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NKCN16ZY3MV0T9GWF4");
  zoomToLocation(180, 19, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_3a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9N4PHV678XHXKETX2EH");
  zoomToLocation(180, 19, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_3a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9NFBP8DPD8X5P03E3TW");
  zoomToLocation(180, 19, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_3a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QBPGW27WGDG51XKR3X");
  zoomToLocation(100, 14, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_3a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM");
  zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_3a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9MJRB0A8TY333RE1QFZ");
  zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_3a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ME30WEZRRXDPQA190J");
  zoomToLocation(0, 19, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_3a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9M70652KB4774BW89EC");
  zoomToLocation(0, 19, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_3a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9M100TA6VY3FM35D5R6");
  zoomToLocation(0, 19, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_3a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KXFWG38WNR24HWCPJK");
  zoomToLocation(0, 19, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_3a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KQ954KPSACVC6D6CE0");
  zoomToLocation(0, 19, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_3a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KKDNMQZ8FRB96RCHCC");
  zoomToLocation(0, 19, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_3a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y");
  zoomToLocation(0, 19, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_3a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9K91WCB1AD66JYY3FFS");
  zoomToLocation(0, 19, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_3a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9K28V03M20MSEPV7QCD");
  zoomToLocation(0, 19, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_3a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9JXP8418XRP007M283B");
  zoomToLocation(0, 19, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_3a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Q6K2F6KR3AENXDFWWF");
  zoomToLocation(0, 19, 112.64516418338256, -8.011135952579131, -15, 0);
});

$("#zoomToRusunawaLegal_4a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9T0W8VBTZ25HCXBGQPS");
  zoomToLocation(265, 56, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_4a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WAGXHBWAAK6QNDA2MH");
  zoomToLocation(180, 21, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_4a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TH737NRNVP2WJJP0S0");
  zoomToLocation(180, 21, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_4a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9W5J48VXG0AXKHV30D6");
  zoomToLocation(180, 21, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_4a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9W0HX6WBFYMVC7JQ802");
  zoomToLocation(180, 21, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_4a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9VVFNDWX99Q10DNPRC5");
  zoomToLocation(180, 21, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_4a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9VNV42MDP0DJXTDQQ31");
  zoomToLocation(180, 21, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_4a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9VDYT36E93WPXKN0V21");
  zoomToLocation(180, 21, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_4a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN");
  zoomToLocation(180, 21, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_4a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9V2DJBF05DRHF42171K");
  zoomToLocation(180, 21, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_4a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TYY1DHDJ12T9WGP98K");
  zoomToLocation(180, 21, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_4a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TBRKRKG84NZMK8XSDY");
  zoomToLocation(180, 21, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_4a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9TSRMXJBXXC8FPW0MP0");
  zoomToLocation(180, 21, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_4a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QPWE75DMGH3ZRP2ED4");
  zoomToLocation(100, 16, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_4a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QYSC6XF9HPFBW17TCJ");
  zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_4a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ");
  zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_4a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9SJ874QGQMERHQX4R8D");
  zoomToLocation(0, 21, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_4a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ");
  zoomToLocation(0, 21, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_4a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9S743XNK211CH82N31G");
  zoomToLocation(0, 21, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_4a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9S3D2FG186H849WPBD0");
  zoomToLocation(0, 21, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_4a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RY7Z9V7C40F0XBR2M4");
  zoomToLocation(0, 21, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_4a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM");
  zoomToLocation(0, 21, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_4a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RK19R68AXV9YP9HTY8");
  zoomToLocation(0, 21, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_4a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9RBT4M3NX3YH6EMW2E1");
  zoomToLocation(0, 21, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_4a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9R7M4KK7A45YWR1FAG8");
  zoomToLocation(0, 21, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_4a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9R3NP14ARFTQNV13BEW");
  zoomToLocation(0, 21, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_4a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV");
  zoomToLocation(0, 21, 112.64516418338256, -8.011135952579131, -15, 0);
});

$("#zoomToRusunawaLegal_5a1").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Z2GR1BZENX99V8SD6F");
  zoomToLocation(265, 58, 112.64589105170866, -8.010688873163765, -25, 0);
});
$("#zoomToRusunawaLegal_5a2").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK");
  zoomToLocation(180, 23, 112.64514967384268, -8.01029641222483, -15, 0);
});
$("#zoomToRusunawaLegal_5a3").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZK0V03298BB5X130WY");
  zoomToLocation(180, 23, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_5a4").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA16RNAX53BA0R1PTXJ6");
  zoomToLocation(180, 23, 112.64510978062461, -8.010324528984608, -15, 0);
});
$("#zoomToRusunawaLegal_5a5").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA12ZB7TYZJNHAHPY7WW");
  zoomToLocation(180, 23, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_5a6").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0XYNJRXAY0B63N5BBV");
  zoomToLocation(180, 23, 112.64504428302469, -8.01031984160891, -15, 0);
});
$("#zoomToRusunawaLegal_5a7").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0NGNZCR80RNDCXMH5M");
  zoomToLocation(180, 23, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_5a8").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0G6XMNZHKP9KN1BBT4");
  zoomToLocation(180, 23, 112.6449624128508, -8.010321693114099, -15, 0);
});
$("#zoomToRusunawaLegal_5a9").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA0B8MQSKPHR04CJKNP4");
  zoomToLocation(180, 23, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_5a10").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EWA05B4C592FR7Z3CRX8B");
  zoomToLocation(180, 23, 112.64484878994745, -8.010306178459471, -15, 0);
});
$("#zoomToRusunawaLegal_5a11").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D");
  zoomToLocation(180, 23, 112.64479519186604, -8.010297620811423, -15, 0);
});
$("#zoomToRusunawaLegal_5a12").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZDPFQYCG9Y6K9F771W");
  zoomToLocation(180, 23, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_5a13").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9ZSR8817RCJG52R8WDP");
  zoomToLocation(180, 23, 112.64472517788248, -8.010298593763853, -15, 0);
});
$("#zoomToRusunawaLegal_5a14").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WPJPS0THQYCNXRXP6D");
  zoomToLocation(100, 18, 112.64432403935837, -8.010743169218108, -15, 0);
});
$("#zoomToRusunawaLegal_5a15").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WZRP309VTB8P8YQKBQ");
  zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_5a16").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9YT7MKD01KC38EX2WQP");
  zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_5a17").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y");
  zoomToLocation(0, 23, 112.6447275664712, -8.011221986832947, -15, 0);
});
$("#zoomToRusunawaLegal_5a18").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9YD78PQ60W3B1P7C3J7");
  zoomToLocation(0, 23, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_5a19").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Y9G9K73HXMFXZS05BK");
  zoomToLocation(0, 23, 112.64483790260891, -8.01121886336246, -15, 0);
});
$("#zoomToRusunawaLegal_5a20").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH");
  zoomToLocation(0, 23, 112.64489976543433, -8.011227147063853, -15, 0);
});
$("#zoomToRusunawaLegal_5a21").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XZFE0FB81H22C1BJC5");
  zoomToLocation(0, 23, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_5a22").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XVME2NBE8PHXHX9Q2J");
  zoomToLocation(0, 23, 112.64496594980773, -8.011213045680796, -15, 0);
});
$("#zoomToRusunawaLegal_5a23").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XMAR7XJ0CG8P17GTAS");
  zoomToLocation(0, 23, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_5a24").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW");
  zoomToLocation(0, 23, 112.64503407814374, -8.011198707875575, -15, 0);
});
$("#zoomToRusunawaLegal_5a25").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M");
  zoomToLocation(0, 23, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_5a26").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9X4WWVMEB76J2P1XP7D");
  zoomToLocation(0, 23, 112.64510790597768, -8.011194667555896, -15, 0);
});
$("#zoomToRusunawaLegal_5a27").on('click', function () {
  setTransparentBylegal_id(rusunawaLegal, "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2");
  zoomToLocation(0, 23, 112.64516418338256, -8.011135952579131, -15, 0);
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
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7P6DEEDQH6QTE0Z68B8", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RRR7HCZP94ETRJK757", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Q59K0S7NYA9DQ5DAFX", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PTPYH074Q5ZJDGV3Z7", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RZXAKK47WMJVV9YSKB", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7PHEQA5SX964M063XQK", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QNNM61J5YDVQQ23TB2", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7R5TWKKPSEM6Q95T28R", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7QX80R8CH3JDZ097JX3", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7RGJQ3F0CYEX3NJM7HK", isChecked);
});
$("#siolaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VAYDZ2BHP9Y7TVMYWQ", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7VT5ARB2YC0C7PXKCDY", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7TN104KHG9ZEHJVSAX5", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7SFH37VQ3NC3JQ6PRXE", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7S8KJJGYKK6GDD7BBTN", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7T1RPZKGCBDXAJXRJ4W", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7V04AZ1NWE2VJ7T6T89", isChecked);
});
$("#siolaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XR27P0H1C69A7TPGZ0", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Y68R892D1XNRBV2RPN", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WZ79J0N5VRS8HQWJXX", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7W331GHVRF0QTNJXGRW", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7WCQA085HKSMFMBE8Z0", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7XGYZB3Z6BKJQSVDH9P", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7X6FYFJW3PN5TQV1DAR", isChecked);
});
$("#siolaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YFWXFTR05G47KJJMJ9", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7YS0BMJZNXP9YB1MSA2", isChecked);
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3", isChecked);
});
$("#siolaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM7ZH14YX6V6Y963TEKXQ", isChecked);
});

// balai pemuda
$('#balaiLevelAllHide').click(function () {
  balaiBuildingL0.show = false;
  balaiBuildingL1.show = false;
  balaiBuildingL2.show = false;
  $('.balai-building-layer-panel .set_level').prop('checked', false);
});
$('#balaiLevelAllShow').click(function () {
  balaiBuildingL0.show = true;
  balaiBuildingL1.show = true;
  balaiBuildingL2.show = true;
  $('.balai-building-layer-panel .set_level').prop('checked', true);
});

$("#balaiLegal_0all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

  }
});
$("#balaiLegal_1all").change(function () {
  let isChecked = $(this).prop("checked");
  if (isChecked) {

  } else {

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
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW996G1Z61WBQY1XP3QAK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AC1QPP7KW6J343B848", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CJ26GJS4A4JP9JQ4W2", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CP9GS5QSGGTTV7GMC2", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CDDCR0RAMWWSX1KHMN", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9CV1M82CGYX5SPVBSFA", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DBK9J1MN5WFHB9B16J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9D52TK6QTBQC832RBNQ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DGEFA023Q9HD9WY5EB", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BS01J71V6KXND1BV4T", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C3DV3KDRH8EHRK9FVF", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BJ60VSCFTXEQJ1TY5D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BBR6W6WTB8ZP65B2WW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B610G13NHKJT44S509", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9B1JJFM7H4E8MZDSDDS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AS7JFA6MMEHMX0MWS1", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9AK2ADTV3A79B2A6ZWX", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A95Q8QTDWZ0Q7YYN89", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9A41HNVDGF7VT7QWE8F", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9C8FC97YYPFMHZSJJCG", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9BXA4XSZ8029S3J260F", isChecked);
});
$("#rusunawaLegal_2all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9DTF7VED1JMZYE5GSYE", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JF1A9Q205ZXXM3JA7Y", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GRAHX1RCKBGNEM3B2T", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J91BB3TS79QJ3FYNH6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9J20S66D2T0VVCKKAX5", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HVS15HHSSCTJE5QP3S", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HPCF5JN81YKW88P57J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HJAXG353YRWQK707TW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9HEGVC91YVDTMN82QFB", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H9S0NZ0S40Y38NWWN2", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9H293QC7RP34NHPNX1A", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GK7RQPJPPD6ZTG34HP", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GX4SPW03PXM9F35HTE", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E61D378B64K62B28EK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EE5WASSX5XJV38AZ6H", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9GB4EA4ZFYAN4VCRV0K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G76Z0JMNVH6KTTAPK7", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9G0FDEXXV7ZSD2MJNGG", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FSYXR41VAA2452CAR4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FK4DYRSKVNV6BB7B2A", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FFCKQA7V1Z45X8JTCS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9FA312J5704SNJ6PYJ3", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9F5ZHB9G3B71ZZAJPWS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EZ18RKZYJKHS2Z53R7", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ET2QPK43G2QTXRE4HC", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9EN8FQ0XDK68F1VXMN1", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9E0KJESXY4H2BNBE7VM", isChecked);
});
$("#rusunawaLegal_3all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MVW5ZGH9QXR49J570K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q07D1QQW0A81T6A3W9", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N9DADE0PTZWVZ0FZJ0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PTZ0A2AJXXMBRP22YJ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PN986VDPJXJC6EK9JV", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9PGYR5T30KRSHCPZWAK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P93F9RHT1J5NZXSYFN", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9P3N98X9TX7VNRBJ15X", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NZDR7PV98W970T5PRX", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NSC24K5FPDZEP7XG25", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NKCN16ZY3MV0T9GWF4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9N4PHV678XHXKETX2EH", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9NFBP8DPD8X5P03E3TW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QBPGW27WGDG51XKR3X", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JRNGDQ0NPCYT2BC9XM", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9MJRB0A8TY333RE1QFZ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ME30WEZRRXDPQA190J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M70652KB4774BW89EC", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9M100TA6VY3FM35D5R6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KXFWG38WNR24HWCPJK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KQ954KPSACVC6D6CE0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KKDNMQZ8FRB96RCHCC", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9KFXPTCSYEJY3YYJP1Y", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K91WCB1AD66JYY3FFS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9K28V03M20MSEPV7QCD", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9JXP8418XRP007M283B", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Q6K2F6KR3AENXDFWWF", isChecked);
});
$("#rusunawaLegal_4all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9T0W8VBTZ25HCXBGQPS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WAGXHBWAAK6QNDA2MH", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TH737NRNVP2WJJP0S0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W5J48VXG0AXKHV30D6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9W0HX6WBFYMVC7JQ802", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VVFNDWX99Q10DNPRC5", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VNV42MDP0DJXTDQQ31", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9VDYT36E93WPXKN0V21", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V7F3QSSW9S0PZ2S4XN", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9V2DJBF05DRHF42171K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TYY1DHDJ12T9WGP98K", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TBRKRKG84NZMK8XSDY", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9TSRMXJBXXC8FPW0MP0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QPWE75DMGH3ZRP2ED4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QYSC6XF9HPFBW17TCJ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SRS0BKZ4ZRADS2CRXJ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SJ874QGQMERHQX4R8D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9SBTCFP7MF8HMNE1VYQ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S743XNK211CH82N31G", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9S3D2FG186H849WPBD0", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RY7Z9V7C40F0XBR2M4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RS0Z4J8DY4RQNZ08SM", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RK19R68AXV9YP9HTY8", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9RBT4M3NX3YH6EMW2E1", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R7M4KK7A45YWR1FAG8", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9R3NP14ARFTQNV13BEW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9QJFQDZ0HFHTNAGBPFV", isChecked);
});
$("#rusunawaLegal_5all").change(function () {
  let isChecked = $(this).prop("checked");
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Z2GR1BZENX99V8SD6F", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA1DXZJ1FG2R8KJBSMXK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZK0V03298BB5X130WY", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA16RNAX53BA0R1PTXJ6", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA12ZB7TYZJNHAHPY7WW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0XYNJRXAY0B63N5BBV", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0NGNZCR80RNDCXMH5M", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0G6XMNZHKP9KN1BBT4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA0B8MQSKPHR04CJKNP4", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EWA05B4C592FR7Z3CRX8B", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZZP9YD2N3BSGFK7V5D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZDPFQYCG9Y6K9F771W", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9ZSR8817RCJG52R8WDP", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WPJPS0THQYCNXRXP6D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WZRP309VTB8P8YQKBQ", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YT7MKD01KC38EX2WQP", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YKDPC8XACE4HQWVJ9Y", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9YD78PQ60W3B1P7C3J7", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y9G9K73HXMFXZS05BK", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9Y4Q2R6WQGXXYQR2ZXH", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XZFE0FB81H22C1BJC5", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XVME2NBE8PHXHX9Q2J", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XMAR7XJ0CG8P17GTAS", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XFYBGNR5ZSEE6YP5EW", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9XAKH8N3MA9GXBEYJ7M", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9X4WWVMEB76J2P1XP7D", isChecked);
  setVisibilityBylegal_id(rusunawaLegal, "legal_01HM6EW9WGQFJWZ7B6CY7YCSN2", isChecked);
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

function mappingHide(legal_id, isChecked) {
  if (isChecked) {
    MappingHideTileset = MappingHideTileset.filter(data => data !== legal_id);
  } else {
    if (!undefined) {
      MappingHideTileset.push(legal_id);
    }
    return
  }
  console.log("hide");
  console.log(MappingHideTileset);
}

function setVisibilityBylegal_id(tileset, legal_id, isChecked) {
  mappingHide(legal_id, isChecked);
  tileset.style = new Cesium.Cesium3DTileStyle({
    show: {
      evaluate: function (feature) {
        return !MappingHideTileset.includes(feature.getProperty("legal_id"));
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
        if (MappingTransparentTileset.includes(feature.getProperty("legal_id"))) {
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
// setVisibilityBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM");

function mappingTransparent(legal_id) {
  if (Array.isArray(legal_id)) {
    MappingTransparentTileset = legal_id
  } else {
    MappingTransparentTileset.push(legal_id);
  }
  console.log("transparent");
  console.log(MappingTransparentTileset);
}

function setTransparentBylegal_id(tileset, legal_id) {
  MappingTransparentTileset = [];
  mappingTransparent(legal_id);
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
        if (MappingTransparentTileset.includes(feature.getProperty("legal_id"))) {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 1.0);
        } else {
          return Cesium.Color.fromAlpha(colorMap[styleName] || new Cesium.Color(0.5, 0.5, 0.5, 1.0), 0.2);
        }
      },
    },
    show: {
      evaluate: function (feature) {
        return !MappingHideTileset.includes(feature.getProperty("legal_id"));
      },
    },
  });
}
// setTransparentBylegal_id(siolaLegal, "legal_01HM6EM65YF59D5W766TETFSKM");
// setTransparentBylegal_id(siolaLegal, ["legal_01HM6EM7YFWXFTR05G47KJJMJ9", "legal_01HM6EM7YS0BMJZNXP9YB1MSA2", "legal_01HM6EM7Z3RDFRDC7RKB5XDFB3"]);

// reset Transparency
function resetTransparent(tileset) {
  MappingTransparentTileset = [];
  setVisibilityBylegal_id(tileset)
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
  await Cesium.Cesium3DTileset.fromIonAssetId(2337191, {
    show: true,
    featureIdLabel: "siolaBuildingL0",
  })
);
const siolaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337170, {
    show: true,
    featureIdLabel: "siolaBuildingL1",
  })
);
const siolaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337183, {
    show: true,
    featureIdLabel: "siolaBuildingL2",
  })
);
const siolaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337185, {
    show: true,
    featureIdLabel: "siolaBuildingL3",
  })
);
const siolaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337177, {
    show: true,
    featureIdLabel: "siolaBuildingL4",
  })
);
const siolaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2337254, {
    show: true,
    featureIdLabel: "siolaBuildingL5",
  })
);

const siolaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2426318)
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
  await Cesium.Cesium3DTileset.fromIonAssetId(2376896, {
    show: true,
    featureIdLabel: "balaiBuildingL0",
  })
);
const balaiBuildingBasement = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376894, {
    show: true,
    featureIdLabel: "balaiBuildingBasement",
  })
);
const balaiBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376898, {
    show: true,
    featureIdLabel: "balaiBuildingL1",
  })
);
const balaiBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376900, {
    show: true,
    featureIdLabel: "balaiBuildingL2",
  })
);

const balaiLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2423897)
);

balaiLegal.style = setColorStyle;

// Get Rusunawa   #########################################################################################
const rusunawaBuildingL0 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376598, {
    show: true,
    featureIdLabel: "rusunawaBuildingL0",
  })
);
const rusunawaBuildingL1 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376599, {
    show: true,
    featureIdLabel: "rusunawaBuildingL1",
  })
);
const rusunawaBuildingL2 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376600, {
    show: true,
    featureIdLabel: "rusunawaBuildingL2",
  })
);
const rusunawaBuildingL3 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376601, {
    show: true,
    featureIdLabel: "rusunawaBuildingL3",
  })
);
const rusunawaBuildingL4 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376602, {
    show: true,
    featureIdLabel: "rusunawaBuildingL4",
  })
);
const rusunawaBuildingL5 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376603, {
    show: true,
    featureIdLabel: "rusunawaBuildingL5",
  }, )
);
const rusunawaBuildingL6 = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2376604, {
    show: true,
    featureIdLabel: "rusunawaBuildingL6",
  }, )
);

const rusunawaLegal = viewer.scene.primitives.add(
  await Cesium.Cesium3DTileset.fromIonAssetId(2422063)
);

rusunawaLegal.style = setColorStyle;



// hide preloader after finish load data
$(function () {
  $(".loader-container").removeClass("d-none");
});


// Buat koleksi bidang pemotongan (clipping plane collection) SIOLA
var clippingPlanes = new Cesium.ClippingPlaneCollection({
  planes: [
    new Cesium.ClippingPlane(new Cesium.Cartesian3(1.0, 0.0, 0.0), 50.0), // Plane X
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 1.0, 0.0), 50.0), // Plane Y
    new Cesium.ClippingPlane(new Cesium.Cartesian3(0.0, 0.0, -1.0), 50.0) // Plane Z
  ],
  edgeWidth: 0.0, // Lebar garis untuk menandai pemotongan (bisa disesuaikan)
  edgeColor: Cesium.Color.RED
});
// Terapkan koleksi bidang pemotongan pada objek 3D Tileset
updateClip2Model();

function updateClip2Model() {
  siolaBuildingL0.clippingPlanes = clippingPlanes;
  siolaBuildingL1.clippingPlanes = clippingPlanes;
  siolaBuildingL2.clippingPlanes = clippingPlanes;
  siolaBuildingL3.clippingPlanes = clippingPlanes;
  siolaBuildingL4.clippingPlanes = clippingPlanes;
  siolaBuildingL5.clippingPlanes = clippingPlanes;
}
// Event listener for slider X using jQuery
$('#sliderX').on('input', function () {
  var xValue = parseFloat($(this).val());
  clippingPlanes.get(0).distance = xValue;
  // Reset the other planes to a distance that allows visibility
  clippingPlanes.get(1).distance = -50; // Y-plane
  clippingPlanes.get(2).distance = -50; // Z-plane
  $('#sliderY').val(90);
  $('#sliderZ').val(90);
  updateClip2Model();
});

// Event listener for slider Y using jQuery
$('#sliderY').on('input', function () {
  var yValue = parseFloat($(this).val());
  clippingPlanes.get(1).distance = yValue;
  // Reset the other planes to a distance that allows visibility
  clippingPlanes.get(0).distance = -50; // X-plane
  clippingPlanes.get(2).distance = -50; // Z-plane
  $('#sliderX').val(90);
  $('#sliderZ').val(90);
  updateClip2Model();
});

// Event listener for slider Z using jQuery
$('#sliderZ').on('input', function () {
  var zValue = parseFloat($(this).val());
  clippingPlanes.get(2).distance = zValue;
  // Reset the other planes to a distance that allows visibility
  clippingPlanes.get(0).distance = -50; // X-plane
  clippingPlanes.get(1).distance = -50; // Y-plane
  $('#sliderX').val(90);
  $('#sliderY').val(90);
  updateClip2Model();
});

$("#reset-clip").click(function (e) {
  clippingPlanes.get(0).distance = 50; // X-plane
  clippingPlanes.get(1).distance = 50; // Y-plane
  clippingPlanes.get(2).distance = 50; // Z-plane
  updateClip2Model();
  $("#sliderX").val(90);
  $("#sliderY").val(90);
  $("#sliderZ").val(90);
});


// handle autocomplete seacrh
$(document).ready(function () {
  const suggestions = ["Siola L0", "Siola L1", "Siola L2", "Siola L3", "Siola L4", "Siola L5", "Siola L1.1", "Siola L1.2", "Siola L1.3", "Siola L1.4", "Siola L1.5", "Siola L1.6", "Siola L1.7", "Siola L1.8", "Siola L1.9", "Siola L1.10", "Siola L2.1", "Siola L2.2", "Siola L2.3", "Siola L2.4", "Siola L2.5", "Siola L2.6", "Siola L2.7", "Siola L3.1", "Siola L3.2", "Siola L3.3", "Siola L3.4", "Siola L3.5", "Siola L3.6", "Siola L3.7", "Siola L4.1", "Siola L4.2", "Siola L4.3", "Siola L5.1", "Siola"];
  $("#searchInput").keyup(function (e) {
    const inputValue = $("#searchInput").val().toLowerCase();
    // Hide autocomplete results if input empty
    if (!inputValue.trim()) {
      $("#autocompleteResults").html("");
      return;
    }
    const filteredSuggestions = suggestions.filter(suggestion =>
      suggestion.toLowerCase().includes(inputValue)
    );
    // Generate HTML for autocomplete results
    const resultsHTML = filteredSuggestions.map(suggestion =>
      `<div class="autocomplete-item">${suggestion}</div>`
    ).join("");
    $("#autocompleteResults").html(resultsHTML);
    // Attach click event to each autocomplete item
    $(".autocomplete-item").on("click", function () {
      selectSuggestion($(this).text());
    });
  });

  function selectSuggestion(value) {
    $("#searchInput").val(value);
    $("#autocompleteResults").html("");

    // Call specific function based on selected suggestion
    getSearchResult(value);
  }

  $("#searchButton").click(function (e) {
    selectSuggestion($("#searchInput").val())
  });

  function getSearchResult(value) {
    // Call specific function based on selected suggestion
    switch (value.toLowerCase()) {
      case "siola":
        firstCamera()
        break;
      case "siola l0":
        zoomToTileset(siolaBuildingL0, 15, 90, 150); //tileset, pitchDegrees = -25, headingDegrees = 0, zoomDistance = 300
        break;
      case "siola l1":
        zoomToTileset(siolaBuildingL1, -5, 90, 150);
        break;
      case "siola l2":
        zoomToTileset(siolaBuildingL2, -10, 90, 150);
        break;
      case "siola l3":
        zoomToTileset(siolaBuildingL3, -15, 90, 150);
        break;
      case "siola l4":
        zoomToTileset(siolaBuildingL4, -20, 90, 150);
        break;
      case "siola l5":
        zoomToTileset(siolaBuildingL5, -25, 90, 150);
        break;
      case "siola l1.1":
        zoomToLocation(115, 20, 112.7364701048379, -7.255725655809104, -5, 0);
        break;
      case "siola l1.2":
        zoomToLocation(70, 20, 112.73614083014726, -7.256673453774129, -5, 0);
        break;
      case "siola l1.3":
        zoomToLocation(70, 25, 112.73614083014726, -7.256673453774129, -15, 0);
        break;
      case "siola l1.4":
        zoomToLocation(115, 15, 112.73703300890135, -7.256062486631589, -20, 0);
        break;
      case "siola l1.5":
        zoomToLocation(180, 20, 112.73775089782131, -7.255339612039106, -5, 0);
        break;
      case "siola l1.6":
        zoomToLocation(180, 20, 112.73775089782131, -7.255339612039106, -20, 0);
        break;
      case "siola l1.7":
        zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -10, 0);
        break;
      case "siola l1.8":
        zoomToLocation(180, 20, 112.73811080939606, -7.255376393416146, -15, 0);
        break;
      case "siola l1.9":
        zoomToLocation(20, 20, 112.73725740076955, -7.257555590592433, -15, 0);
        break;
      case "siola l1.10":
        zoomToLocation(345, 20, 112.73810487457202, -7.257580246584778, -5, 0);
        break;
      case "siola l2.1":
        zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -10, 0);
        break;
      case "siola l2.2":
        zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -10, 0);
        break;
      case "siola l2.3":
        zoomToLocation(70, 35, 112.73667745777747, -7.2567879531324495, -15, 0);
        break;
      case "siola l2.4":
        zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
        break;
      case "siola l2.5":
        zoomToLocation(175, 45, 112.73776680239449, -7.255272479365819, -15, 0);
        break;
      case "siola l2.6":
        zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
        break;
      case "siola l2.7":
        zoomToLocation(265, 20, 112.7389374537573, -7.2564733527464185, -15, 0);
        break;
      case "siola l3.1":
        zoomToLocation(80, 30, 112.73652142258982, -7.256981171712124, -15, 0);
        break;
      case "siola l3.2":
        zoomToLocation(105, 40, 112.73650362692631, -7.255917393432451, -15, 0);
        break;
      case "siola l3.3":
        zoomToLocation(70, 40, 112.73667745777747, -7.2567879531324495, -15, 0);
        break;
      case "siola l3.4":
        zoomToLocation(345, 45, 112.73801409021175, -7.257541510238534, -15, 0);
        break;
      case "siola l3.5":
        zoomToLocation(175, 50, 112.73780550486839, -7.255527145036425, -25, 0);
        break;
      case "siola l3.6":
        zoomToLocation(180, 350, 112.73779026382113, -7.255632571893392, -15, 0);
        break;
      case "siola l3.7":
        zoomToLocation(175, 45, 112.73810218273863, -7.255308352851056, -15, 0);
        break;
      case "siola l4.1":
        zoomToLocation(65, 75, 112.73661741237805, -7.256992873425595, -25, 0);
        break;
      case "siola l4.2":
        zoomToLocation(345, 75, 112.73813421339062, -7.257867208348932, -20, 0);
        break;
      case "siola l4.3":
        zoomToLocation(180, 80, 112.73814898604392, -7.255089250207667, -25, 0);
        break;
      case "siola l5.1":
        zoomToTileset(siolaBuildingL5, -20, 90, 150);
        break;
      default:
        // Default case if no specific function is defined for the suggestion
        break;
    }

  }

});

$(document).ready(function () {
  $(".loader-container").addClass("d-none");
});