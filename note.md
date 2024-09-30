````let currentModel;
let buildingHeight;

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

// Fungsi untuk menampilkan model dan mengupdate posisinya
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
  } else if (window.uploadedFileType === "obj") {
    const modelMatrix = Cesium.Transforms.eastNorthUpToFixedFrame(position);
    const primitive = viewer.scene.primitives.add(
      Cesium.Model.fromGltf({
        url: URL.createObjectURL(new Blob([window.uploadedFile])),
        modelMatrix: modelMatrix,
        scale: 1.0,
      })
    );
    currentModel = primitive;
  }

  addAxes(position);

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

// Fungsi untuk menambahkan sumbu XYZ pada model dengan offset 5 meter ke atas
function addAxes(position) {
  // Define the length of the axes for visualization
  const axisLength = buildingHeight + 10;

  // Adjust the position by adding 5 meters to the Z-axis
  const offsetPosition = Cesium.Cartesian3.add(position, new Cesium.Cartesian3(0, 3, 0), new Cesium.Cartesian3());

  // Define the rotation matrix for the X axis
  const xRotationMatrix = Cesium.Matrix3.fromRotationZ(Cesium.Math.toRadians(23));
  const xDirection = Cesium.Matrix3.multiplyByVector(xRotationMatrix, new Cesium.Cartesian3(1, 0, 0), new Cesium.Cartesian3());

  const rmz = Cesium.Matrix3.fromRotationZ(Cesium.Math.toRadians(23));
  const rmx = Cesium.Matrix3.fromRotationX(Cesium.Math.toRadians(-5));
  const yRotationMatrix = Cesium.Matrix3.multiply(rmx, rmz, new Cesium.Matrix3());
  const yDirection = Cesium.Matrix3.multiplyByVector(yRotationMatrix, new Cesium.Cartesian3(0, 1, 0), new Cesium.Cartesian3());

  const zRotationMatrix = Cesium.Matrix3.fromRotationX(Cesium.Math.toRadians(-7));
  const zDirection = Cesium.Matrix3.multiplyByVector(zRotationMatrix, new Cesium.Cartesian3(0, 0, 1), new Cesium.Cartesian3());

  // Add X axis (Red)
  viewer.entities.add({
    id: "Xaxis",
    name: "X axis",
    polyline: {
      positions: [offsetPosition, Cesium.Cartesian3.add(offsetPosition, Cesium.Cartesian3.multiplyByScalar(xDirection, axisLength, new Cesium.Cartesian3()), new Cesium.Cartesian3())],
      width: 25,
      arcType: Cesium.ArcType.NONE,
      material: new Cesium.PolylineArrowMaterialProperty(Cesium.Color.RED),
      depthFailMaterial: new Cesium.PolylineArrowMaterialProperty(new Cesium.Color(1.0, 0, 0, 0.2)),
    },
  });

  // Add Y axis (Green)
  viewer.entities.add({
    id: "Yaxis",
    name: "Y axis",
    polyline: {
      positions: [offsetPosition, Cesium.Cartesian3.add(offsetPosition, Cesium.Cartesian3.multiplyByScalar(yDirection, axisLength, new Cesium.Cartesian3()), new Cesium.Cartesian3())],
      width: 25,
      arcType: Cesium.ArcType.NONE,
      material: new Cesium.PolylineArrowMaterialProperty(Cesium.Color.GREEN),
      depthFailMaterial: new Cesium.PolylineArrowMaterialProperty(new Cesium.Color(0, 1, 0, 0.2)),
    },
  });

  // Add Z axis (Blue)
  viewer.entities.add({
    id: "Zaxis",
    name: "Z axis",
    polyline: {
      positions: [offsetPosition, Cesium.Cartesian3.add(offsetPosition, Cesium.Cartesian3.multiplyByScalar(zDirection, axisLength, new Cesium.Cartesian3()), new Cesium.Cartesian3())],
      width: 25,
      arcType: Cesium.ArcType.NONE,
      material: new Cesium.PolylineArrowMaterialProperty(Cesium.Color.BLUE),
      depthFailMaterial: new Cesium.PolylineArrowMaterialProperty(new Cesium.Color(0, 0, 1, 0.2)),
    },
  });
}

// Fungsi untuk menghapus sumbu XYZ
function removeAxes() {
  viewer.entities.removeAll(); // This will remove all entities; you might want to refine this to remove only the axes
}



// Event listeners
document.getElementById("formFileSm").addEventListener("change", handleFileUpload);
document.getElementById("cek3d").addEventListener("click", updateModelPosition);```
````
