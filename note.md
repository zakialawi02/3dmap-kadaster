```

let currentModel;
let buildingHeight;
let axesEntities = [];

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

// Updated function to create and display axes with arrow tips
function createAxes(position, orientation, scale) {
  removeAxes();

  const axisLength = buildingHeight + 10;

  // Helper function to create an axis
  function createAxis(color, direction) {
    const endPosition = Cesium.Matrix4.multiplyByPoint(Cesium.Matrix4.fromTranslationQuaternionRotationScale(position, orientation, new Cesium.Cartesian3(scale, scale, scale)), direction, new Cesium.Cartesian3());

    const axis = viewer.entities.add({
      polyline: {
        positions: [position, endPosition],
        width: 40,
        material: new Cesium.PolylineArrowMaterialProperty(color),
      },
    });

    axesEntities.push(axis);
  }

  // X-axis (Red)
  createAxis(Cesium.Color.RED, new Cesium.Cartesian3(axisLength, 0, 0));

  // Y-axis (Green)
  createAxis(Cesium.Color.GREEN, new Cesium.Cartesian3(0, axisLength, 0));

  // Z-axis (Blue)
  createAxis(Cesium.Color.BLUE, new Cesium.Cartesian3(0, 0, axisLength));
}

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
