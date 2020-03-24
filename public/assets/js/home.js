const API_URL = "http://localhost/projects/toycar1/car-on-the-table/public/api/";
const FIELDS = "fields";

initPlaceAction();
initMoveAction();
initTurnAction();

function initTurnAction() {
  $("#turn_l, #turn_r").click(function() {
    var x = $(".car-box.active").data("x"),
      y = $(".car-box.active").data("y"),
      f = $(".car-box.active").data("f"),
      t = $(this).data("turn");

    postTurnFields(x, y, f, t);
  });
}

function postTurnFields(x, y, f, t) {
  $.ajax({
    url: API_URL + "turn",
    type: "post",
    dataType: "json",
    contentType: "application/json",
    success: function(data) {
      checkResponseMove(data);
    },
    data: JSON.stringify({ x: x, y: y, f: f, t: t })
  });
}

function initMoveAction() {
  $("#move").click(function() {
    var x = $(".car-box.active").data("x"),
      y = $(".car-box.active").data("y"),
      f = $(".car-box.active").data("f");
    postMoveFields(x, y, f);
  });
}

function postMoveFields(x, y, f) {
  $.ajax({
    url: API_URL + "move",
    type: "post",
    dataType: "json",
    contentType: "application/json",
    success: function(data) {
      checkResponseMove(data);
    },
    data: JSON.stringify({ x: x, y: y, f: f })
  });
}
function checkResponseMove(data) {
  if (typeof data.x == "undefined" || typeof data.y == "undefined") {
    $(".car-msg").hide();

    showMessage("danger", data.message);

    return false;
  }
  placeCar(data);
}

function initPlaceAction() {
  $("#place").click(function() {
    var x = $("#form_car #select_x").val(),
      y = $("#form_car #select_y").val(),
      f = $("#form_car #select_f").val();
    
      if (x == "" || y == "" || f == "") {
        showMessage("danger", "Please select valid inputs.");
        return false;
      }

    postPlaceFields(x, y, f);
  });
}


function postPlaceFields(x, y, f) {
  $.ajax({
    url: API_URL + "place",
    type: "post",
    dataType: "json",
    contentType: "application/json",
    success: function(data) {
      checkResponse(data);
    },
    data: JSON.stringify({ x: x, y: y, f: f })
  });
}

function checkResponse(data) {
  if (typeof data.x == "undefined" || typeof data.y == "undefined") {
    alert(data.message);
    $("#show_message").html(data.message);
    return false;
  }
  placeCar(data);
}

function placeCar(data) {
  $(".car-img").removeClass("visible");
  $(".car-box").removeClass("active");

  var carimage = $("#box" + data.x + data.y)
    .addClass("active")
    .find(".car-img");
  carimage.addClass("visible");
  carimage.removeClass("f-N f-S f-E f-W").addClass("f-" + data.f);

  var carbox = $("#box" + data.x + data.y);
  carbox.data("f", data.f);
  $(".car-msg").hide();
  $(".alert-success.car-msg")
    .html("Action was successful.")
    .show()
    .delay(3000)
    .fadeOut();
}

function showMessage(state, message) {
  $(".alert-" + state + ".car-msg")
    .html(message)
    .show()
    .delay(3000)
    .fadeOut();
}
