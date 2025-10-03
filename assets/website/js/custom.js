jQuery(document).ready(function ($) {
  ("use strict");

  /*=========== Disable Button ===========*/
  function disableSubmitBtn() {
    var submitButton = $("#submits");
    $("#paper-plane").addClass("d-none"); // Updated to match the paper-plane ID in the HTML
    submitButton.addClass("disabled");
    submitButton.attr("disabled", true); // Disables the button
  }

  /*=========== Enable Button ===========*/
  function enableSubmitBtn() {
    var submitButton = $("#submits");
    $("#paper-plane").removeClass("d-none"); // Hide the paper-plane after response
    submitButton.removeClass("disabled");
    submitButton.attr("disabled", false); // Enables the button
  }

  /*============= Countdown ==============*/
  $("[data-countdown]").each(function () {
    var $this = $(this),
      finalDate = $(this).data("countdown");
    $this.countdown(finalDate, function (event) {
      $this.html(
        event.strftime(
          '<span class="dcare-count days"><span class="count-inner"><span class="time-count">%-D</span> <p>Days</p></span></span> <span class="dcare-count hour"><span class="count-inner"><span class="time-count">%-H</span> <p>Hours</p></span></span> <span class="dcare-count minutes"><span class="count-inner"><span class="time-count">%M</span> <p>Minutes</p></span></span> <span class="dcare-count second"><span class="count-inner"><span class="time-count">%S</span> <p>Seconds</p></span></span>'
        )
      );
    });
  });

  // Newsletter
  $("#newsletter_form").submit(function (e) {
    e.preventDefault();

    // Cache jQuery objects for efficiency
    var $submitBtn = $("#submit_newsletter");
    var $btnText = $submitBtn.find(".btn-text");
    var $spinner = $submitBtn.find("#search-spinner");
    var $message = $submitBtn.find(".btn-message");
    var $form = $(this);

    // Hide original text and show spinner
    $btnText.addClass("d-none");
    $spinner.removeClass("d-none");
    $message.addClass("d-none").html(""); // Reset message area
    $submitBtn.prop("disabled", true); // Disable button during request

    var form_data = new FormData(this);

    $.ajax({
      url: base_url + "home/newsletter_ajax",
      type: "POST",
      data: form_data,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      success: function (res) {
        // Hide spinner now that we have a response
        $spinner.addClass("d-none");

        if (res.status) {
          // Success: Show green success message
          // Changed .text() to .html() to render the <p> tag
          $message.html(res.msg).css("color", "#28a745").removeClass("d-none");
        } else {
          // Error: Show red error message
          // Changed .text() to .html() to render the <p> tag
          $message.html(res.msg).css("color", "#FFF").removeClass("d-none");
        }

        // Set a timer to revert the button back to its original state
        setTimeout(function () {
          // Hide the message
          $message.addClass("d-none").html("");
          // Show the original "Subscribe" text and icon
          $btnText.removeClass("d-none");
          // Re-enable the button
          $submitBtn.prop("disabled", false);

          // If the submission was successful, reset the form
          if (res.status) {
            $form[0].reset();
          }
        }, 4000); // Revert after 4 seconds
      },
      error: function () {
        // Handle AJAX errors (e.g., server down)
        $spinner.addClass("d-none");
        $message
          .html("<p>Unable to complete.</p>")
          .css("color", "#FFF")
          .removeClass("d-none");

        setTimeout(function () {
          $message.addClass("d-none").html("");
          $btnText.removeClass("d-none");
          $submitBtn.prop("disabled", false);
        }, 4000);
      },
    });
  });

  $("#admin_login_form").submit(function (e) {
    e.preventDefault();
    var form_data = $(this).serialize();
    var redirect_url = $("#requested_page").val();
    $.ajax({
      url: base_url + "login/login_ajax",
      type: "POST",
      data: form_data,
      dataType: "json",
      success: function (res) {
        if (res.status) {
          $("#status_msg")
            .html(
              '<div class="alert alert-success text-center" style="color: #000">' +
                res.msg +
                "</div>"
            )
            .fadeIn("fast");
          setTimeout(function () {
            $(location).attr("href", redirect_url);
          }, 3000);
        } else {
          $("#status_msg")
            .html(
              '<div class="alert alert-danger text-center" style="color: #000">' +
                res.msg +
                "</div>"
            )
            .fadeIn("fast")
            .delay(10000)
            .fadeOut("slow");
        }
      },
    });
  });

  $('select[multiple="multiple"]').each(function (index, element) {
    // selecting all select elements with multiple and looping throught them

    //getting variables

    var placeHolder = $(this).attr("placeholder");
    var allSelected = $(this).attr("all-selected");
    $(this).multiselect({
      includeSelectAllOption: true,
      nonSelectedText: placeHolder,
      nSelectedText: " - Too many options selected!",
      allSelectedText: allSelected,
      numberDisplayed: 10,
    });
  });

  //Date Picker
  // $(document).ready(function () {
  //   $("#datepicker").datepicker({
  //     format: "dd-mm-yyyy",
  //     autoclose: true,
  //     todayHighlight: true,
  //   });
  // });
});
