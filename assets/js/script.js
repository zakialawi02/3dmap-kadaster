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

// Responsive
$("#hamb").click(function (e) {
  $(".nav-menu-group").toggleClass("show");
});

$(".nav-menu-group").click(function (e) {
  $(".nav-menu-group").removeClass("show");
});
$(".nav-menu-group .dropdown-toggle").click(function (e) {
  e.stopPropagation();
});

// Switch Building/Legal segment
$(document).ready(function () {
  $(".building-segment").click(function (e) {
    $(".legal-segment").removeClass('active');
    $(".siola-building-layer-panel").removeClass('d-none');
    $(".siola-legal-layer-panel").addClass('d-none');
    $(".balai-building-layer-panel").removeClass('d-none');
    $(".balai-legal-layer-panel").addClass('d-none');
    $(".rusunawa-building-layer-panel").removeClass('d-none');
    $(".rusunawa-legal-layer-panel").addClass('d-none');
    $(".building-segment").addClass('active');
  });
  $(".legal-segment").click(function (e) {
    $(".building-segment").removeClass('active');
    $(".legal-segment").addClass('active');
    $(".siola-building-layer-panel").addClass('d-none');
    $(".siola-legal-layer-panel").removeClass('d-none');
    $(".balai-building-layer-panel").addClass('d-none');
    $(".balai-legal-layer-panel").removeClass('d-none');
    $(".rusunawa-building-layer-panel").addClass('d-none');
    $(".rusunawa-legal-layer-panel").removeClass('d-none');
  });

  $("#layer-toggle").click(function (e) {
    $(".layer-panel").toggleClass('layer-panel-show');
    $("#layer-toggle").toggleClass('selected');
  });

  $("#clip-toggle").click(function (e) {
    $(".clip-panel").toggleClass('clip-panel-show');
    $("#clip-toggle").toggleClass('selected');
    $(".clip-item input[type='range']").val(90);
  });
});

// clip toggle
toggleSliderClipGroup();
$("input[name='flexRadioDefault']").change(function () {
  toggleSliderClipGroup();
});

function toggleSliderClipGroup() {
  // Sembunyikan semua grup slider
  $(".clip-item > div").hide();
  // Tampilkan grup slider yang sesuai dengan radio box yang terchecked
  $("." + $("input[name='flexRadioDefault']:checked").val()).show();
}

// Minimap toggle
$("#minimap").click(function (e) {
  $(".minimap-panel").toggleClass('minimap-panel-show');
  $("#minimap").toggleClass('selected');
});

// node tree view
$(document).ready(function () {
  $(".caret").click(function () {
    $(this).parent().find(".nested").first().toggleClass("active");
    $(this).toggleClass("caret-down");
  });

  $(".set_legal").change(function () {
    let isChecked = $(this).prop("checked");
    // Handle child checkboxes
    $(this).closest("li").find(".set_legal").prop("checked", isChecked);
    // Handle parent checkboxes
    $(this).parentsUntil("#myUL", "ul").each(function () {
      let hasCheckedChild = $(this).find(".set_legal:checked").length > 0;
      $(this).prev().find(".set_legal").prop("checked", hasCheckedChild);
    });
  });

  $("#closeProperty").click(function (e) {
    $(".property-panel").removeClass("property-panel-show");
  });
});

function formatCustomDate(dateString) {
  if (!dateString) {
    return '-';
  }
  const options = {
    day: 'numeric',
    month: 'short',
    year: 'numeric'
  };
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', options);
}