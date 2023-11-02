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
  $(".building-segment").click(function (e) {
    $(".legal-segment").removeClass('active');
    $(".siola-building-layer-panel").removeClass('d-none');
    $(".siola-legal-layer-panel").addClass('d-none');
    $(".balai-building-layer-panel").removeClass('d-none');
    $(".balai-legal-layer-panel").addClass('d-none');
    $(".building-segment").addClass('active');
  });
  $(".legal-segment").click(function (e) {
    $(".building-segment").removeClass('active');
    $(".legal-segment").addClass('active');
    $(".siola-building-layer-panel").addClass('d-none');
    $(".siola-legal-layer-panel").removeClass('d-none');
    $(".balai-building-layer-panel").addClass('d-none');
    $(".balai-legal-layer-panel").removeClass('d-none');
  });

  $("#layer-toggle").click(function (e) {
    $(".layer-panel").toggleClass('layer-panel-show');
    $("#layer-toggle").toggleClass('selected');
  });

  $("#clip-toggle").click(function (e) {
    $(".clip-panel").toggleClass('clip-panel-show');
    $("#clip-toggle").toggleClass('selected');
    $("#sliderX").val(90);
    $("#sliderY").val(90);
    $("#sliderZ").val(90);
  });
});