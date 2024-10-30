```
let currentModel;
let buildingHeight;
let axesEntities = [];
let isDragging = false;
let selectedAxis = null;
let startMousePosition;
let startModelPosition;

// Fungsi untuk membaca file 3D yang diupload
function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = async function (e) {
      const arrayBuffer = e.target.result;
      const uint8Array = new Uint8Array(arrayBuffer);

      if (file.name.endsWith(".glb")) {
        try {
          const bbox = await computeBoundingBoxFromGLB(uint8Array);
          buildingHeight = getObjectHeight(bbox);
          $("#buildingHeight").html(`Tinggi bangunan : ${buildingHeight.toFixed(3)} m`);
          const { length, width } = getBoundingBoxDimensions(bbox);
          console.log("Length:", length, "Width:", width);

          // Tampilkan input koordinat
          document.getElementById("coordinateInputs").style.display = "block";

          // Simpan data file dan bounding box untuk digunakan saat update posisi
          window.uploadedFile = uint8Array;
          window.uploadedFileType = "glb";
          window.uploadedFileBBox = bbox;
        } catch (error) {
          console.log(error);
          alert("Gagal memparsing model GLB");
        }
      } else if (file.name.endsWith(".obj")) {
        // Implementasi untuk OBJ jika diperlukan
        alert("Format file OBJ belum didukung untuk perhitungan tinggi.");
      } else {
        alert("Format file tidak valid. Hanya mendukung GLB atau OBJ.");
      }
    };
    reader.readAsArrayBuffer(file);
  }
}

// Fungsi untuk menghitung bounding box dari model GLB
function computeBoundingBoxFromGLB(uint8Array) {
  return new Promise((resolve, reject) => {
    const loader = new THREE.GLTFLoader();
    const blob = new Blob([uint8Array], { type: "model/gltf-binary" });
    const url = URL.createObjectURL(blob);

    loader.load(
      url,
      (gltf) => {
        const bbox = new THREE.Box3().setFromObject(gltf.scene);
        URL.revokeObjectURL(url);
        resolve(bbox);
      },
      undefined,
      (error) => {
        reject(error);
      }
    );
  });
}

// Fungsi untuk mendapatkan tinggi objek dari bounding box
function getObjectHeight(bbox) {
  const height = bbox.max.y - bbox.min.y;
  return height;
}

// Updated function to create draggable axes
function createAxes(position, orientation, scale) {
  removeAxes();

  const axisLength = buildingHeight + 50;

  // Helper function to create a draggable axis
  function createAxis(color, direction, axisName) {
    const endPosition = Cesium.Matrix4.multiplyByPoint(Cesium.Matrix4.fromTranslationQuaternionRotationScale(position, orientation, new Cesium.Cartesian3(scale, scale, scale)), direction, new Cesium.Cartesian3());

    const axis = viewer.entities.add({
      polyline: {
        positions: [position, endPosition],
        width: 40,
        material: new Cesium.PolylineArrowMaterialProperty(color),
      },
      name: axisName,
    });

    axesEntities.push(axis);
  }

  // Create axes with names
  createAxis(Cesium.Color.RED, new Cesium.Cartesian3(axisLength, 0, 0), "x-axis");
  createAxis(Cesium.Color.GREEN, new Cesium.Cartesian3(0, axisLength, 0), "y-axis");
  createAxis(Cesium.Color.BLUE, new Cesium.Cartesian3(0, 0, axisLength), "z-axis");
}

// Add mouse event handlers
viewer.screenSpaceEventHandler.setInputAction(function (movement) {
  // Get all picked objects
  const pickedObjects = viewer.scene.drillPick(movement.position);

  let axisFound = false;
  for (let i = 0; i < pickedObjects.length; i++) {
    const pickedObject = pickedObjects[i];
    if (Cesium.defined(pickedObject) && pickedObject.id && axesEntities.includes(pickedObject.id)) {
      axisFound = true;
      isDragging = true;
      selectedAxis = pickedObject.id.name;
      startMousePosition = movement.position;
      startModelPosition = Cesium.Cartesian3.clone(currentModel.position.getValue());
      viewer.scene.screenSpaceCameraController.enableRotate = false;
      break;
    }
  }

  if (!axisFound) {
    isDragging = false;
    selectedAxis = null;
  }
}, Cesium.ScreenSpaceEventType.LEFT_DOWN);

viewer.screenSpaceEventHandler.setInputAction(function (movement) {
  if (isDragging && selectedAxis) {
    const currentMousePosition = movement.endPosition;
    const diff = {
      x: currentMousePosition.x - startMousePosition.x,
      y: currentMousePosition.y - startMousePosition.y,
    };

    const ellipsoid = viewer.scene.globe.ellipsoid;

    // Get model's current orientation
    const modelOrientation = currentModel.orientation.getValue();

    // Calculate movement based on selected axis using model's orientation
    let movementAmount = new Cesium.Cartesian3();
    const movementScale = 0.01; // Adjust this value to control movement sensitivity

    switch (selectedAxis) {
      case "x-axis":
        // Red axis - move along model's x-axis
        const xAxis = Cesium.Matrix3.getColumn(Cesium.Matrix3.fromQuaternion(modelOrientation), 0, new Cesium.Cartesian3());
        Cesium.Cartesian3.multiplyByScalar(xAxis, diff.x * movementScale, movementAmount);
        break;
      case "y-axis":
        // Green axis - move along model's y-axis
        const yAxis = Cesium.Matrix3.getColumn(Cesium.Matrix3.fromQuaternion(modelOrientation), 1, new Cesium.Cartesian3());
        Cesium.Cartesian3.multiplyByScalar(yAxis, diff.x * movementScale, movementAmount);
        break;
      case "z-axis":
        // Blue axis - move along model's z-axis
        const zAxis = Cesium.Matrix3.getColumn(Cesium.Matrix3.fromQuaternion(modelOrientation), 2, new Cesium.Cartesian3());
        Cesium.Cartesian3.multiplyByScalar(zAxis, -diff.y * movementScale, movementAmount);
        break;
    }

    // Update model position
    const newPosition = Cesium.Cartesian3.add(currentModel.position.getValue(), movementAmount, new Cesium.Cartesian3());

    currentModel.position = newPosition;

    // Update axes positions
    removeAxes();
    createAxes(newPosition, modelOrientation, 1.0);

    // Update coordinate display
    const cartographic = ellipsoid.cartesianToCartographic(newPosition);
    const lat = Cesium.Math.toDegrees(cartographic.latitude);
    const lon = Cesium.Math.toDegrees(cartographic.longitude);
    document.getElementById("latitude").value = lat.toFixed(6);
    document.getElementById("longitude").value = lon.toFixed(6);
  }
}, Cesium.ScreenSpaceEventType.MOUSE_MOVE);

viewer.screenSpaceEventHandler.setInputAction(function (movement) {
  if (isDragging) {
    isDragging = false;
    selectedAxis = null;
    viewer.scene.screenSpaceCameraController.enableRotate = true;
  }
}, Cesium.ScreenSpaceEventType.LEFT_UP);

// Updated function to remove axes
function removeAxes() {
  axesEntities.forEach((axis) => viewer.entities.remove(axis));
  axesEntities = [];
}

// Modified updateModelPosition function
function updateModelPosition() {
  const latitude = parseFloat(document.getElementById("latitude").value);
  const longitude = parseFloat(document.getElementById("longitude").value);
  const hdg = parseFloat(document.getElementById("hdg").value);
  const xOffset = 0;
  const yOffset = 0;
  const zOffset = 0;

  if (isNaN(latitude) || isNaN(longitude)) {
    alert("Masukkan koordinat yang valid.");
    return;
  }

  const position = Cesium.Cartesian3.fromDegrees(longitude, latitude, 0);
  const heading = Cesium.Math.toRadians(hdg || 0);
  const pitch = 0;
  const roll = 0;
  const hpr = new Cesium.HeadingPitchRoll(heading, pitch, roll);
  const orientation = Cesium.Transforms.headingPitchRollQuaternion(position, hpr);

  if (currentModel) {
    viewer.entities.remove(currentModel);
    removeAxes();
  }

  if (window.uploadedFileType === "glb") {
    currentModel = viewer.entities.add({
      position: Cesium.Cartesian3.add(position, new Cesium.Cartesian3(xOffset, yOffset, zOffset), new Cesium.Cartesian3()),
      orientation: orientation,
      model: {
        uri: URL.createObjectURL(new Blob([window.uploadedFile])),
        scale: 1.0,
      },
    });

    // Create axes at the model's origin
    createAxes(position, orientation, 1.0);
  }

  viewer.flyTo(currentModel, {
    duration: 1,
  });
}

// Fungsi untuk mendapatkan dimensi panjang dan lebar dari penampang bawah model
function getBoundingBoxDimensions(bbox) {
  const length = bbox.max.x - bbox.min.x; // Panjang (sumbu X)
  const width = bbox.max.z - bbox.min.z; // Lebar (sumbu Z)
  return { length, width };
}

// Event listeners
document.getElementById("formFileSm").addEventListener("change", handleFileUpload);
document.getElementById("cek3d").addEventListener("click", updateModelPosition);

```

```
viewer.screenSpaceEventHandler.setInputAction(function (movement) {
  if (isDragging && selectedAxis) {
    const currentMousePosition = movement.endPosition;
    const diff = {
      x: currentMousePosition.x - startMousePosition.x,
      y: currentMousePosition.y - startMousePosition.y,
    };

    const ellipsoid = viewer.scene.globe.ellipsoid;

    // Ambil orientasi kamera
    const cameraDirection = viewer.camera.direction;

    // Dapatkan orientasi model saat ini
    const modelOrientation = currentModel.orientation.getValue();

    let movementAmount = new Cesium.Cartesian3();
    const movementScale = 0.01; // Adjust this value to control movement sensitivity

    // Sesuaikan gerakan berdasarkan sumbu yang dipilih
    switch (selectedAxis) {
      case "x-axis":
        const xAxis = Cesium.Matrix3.getColumn(Cesium.Matrix3.fromQuaternion(modelOrientation), 0, new Cesium.Cartesian3());
        const signX = Cesium.Cartesian3.dot(xAxis, cameraDirection) < 0 ? -1 : 1;
        Cesium.Cartesian3.multiplyByScalar(xAxis, signX * diff.x * movementScale, movementAmount);
        break;

      case "y-axis":
        const yAxis = Cesium.Matrix3.getColumn(Cesium.Matrix3.fromQuaternion(modelOrientation), 1, new Cesium.Cartesian3());
        const signY = Cesium.Cartesian3.dot(yAxis, cameraDirection) < 0 ? -1 : 1;
        Cesium.Cartesian3.multiplyByScalar(yAxis, signY * diff.x * movementScale, movementAmount);
        break;

      case "z-axis":
        const zAxis = Cesium.Matrix3.getColumn(Cesium.Matrix3.fromQuaternion(modelOrientation), 2, new Cesium.Cartesian3());
        const signZ = Cesium.Cartesian3.dot(zAxis, cameraDirection) < 0 ? -1 : 1;
        Cesium.Cartesian3.multiplyByScalar(zAxis, -signZ * diff.y * movementScale, movementAmount);
        break;
    }

    const newPosition = Cesium.Cartesian3.add(currentModel.position.getValue(), movementAmount, new Cesium.Cartesian3());
    currentModel.position = newPosition;
    removeAxes();
    createAxes(newPosition, modelOrientation, 1.0);

    const cartographic = ellipsoid.cartesianToCartographic(newPosition);
    document.getElementById("latitude").value = Cesium.Math.toDegrees(cartographic.latitude).toFixed(6);
    document.getElementById("longitude").value = Cesium.Math.toDegrees(cartographic.longitude).toFixed(6);
  }
}, Cesium.ScreenSpaceEventType.MOUSE_MOVE);

```
