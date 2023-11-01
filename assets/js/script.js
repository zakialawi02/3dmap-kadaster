// Handle remove help intruction default cesium
$(document).ready(function () {
  const helpCesium = $(".cesium-navigation-help");
  $(".cesium-viewer-toolbar").remove();
  const helping = $("#helpingCesium");
  helping.append(helpCesium);
  helpCesium.css("top", "70px");
  helpCesium.css("right", "5px");
  $("#helpCesium").on("click", function () {
    helpCesium.toggleClass("cesium-navigation-help-visible");
  });
  $(".cesium-navigation-button-left").removeClass(
    "cesium-navigation-button-selected"
  );
  $(".cesium-navigation-button-left").addClass(
    "cesium-navigation-button-unselected"
  );
  $(".cesium-navigation-button-left").on("click", function () {
    $(".cesium-click-navigation-help").addClass(
      "cesium-click-navigation-help-visible"
    );
    $(".cesium-touch-navigation-help").removeClass(
      "cesium-click-navigation-help-visible"
    );
  });
  $(".cesium-navigation-button-right").on("click", function () {
    $(".cesium-click-navigation-help").removeClass(
      "cesium-click-navigation-help-visible"
    );
    $(".cesium-touch-navigation-help").addClass(
      "cesium-click-navigation-help-visible"
    );
  });
});

$(document).ready(function () {
  $("#layer-segment").change(function (e) {
    $(".building-layer-panel").toggleClass('d-none');
    $(".legal-layer-panel").toggleClass('d-none');
  });

  $("#layer-toggle").click(function (e) {
    $(".layer-panel").toggleClass('layer-panel-show');
  });

  $("#clip-toggle").click(function (e) {
    $(".clip-panel").toggleClass('clip-panel-show');
    $("#sliderX").val(90);
    $("#sliderY").val(90);
    $("#sliderZ").val(90);
  });
});