jQuery(document).ready(function ($) {
  ("use strict");

  const csrf_hash = $("#csrf_hash").val();

  // Dropzone Configuration
  Dropzone.options.upload_photo_form = {
    maxFilesize: 3,
    acceptedFiles: ".jpg, .jpeg, .png, .gif",
    init: function () {
      this.on("success", function () {
        if (
          this.getQueuedFiles().length == 0 &&
          this.getUploadingFiles().length == 0
        ) {
          location.reload(); //reload page after upload success
        }
      });
    },
  };

  // Utility functions to handle button states
  function toggleSubmitBtn(isDisabled) {
    const submitButton = $("#submit");
    submitButton.prop("disabled", isDisabled);
    submitButton.toggleClass("disabled", isDisabled);
    submitButton.html(isDisabled ? "Please Wait..." : "Submit");
  }

  // Quick Mail Form Submission
  $("#quick_mail_form").on("submit", function (e) {
    e.preventDefault();
    const formData = $(this).serialize();

    $.post(base_url + "admin/send_quick_mail_ajax", formData, function (msg) {
      const alertType = msg == 1 ? "success" : "danger";
      const alertMessage =
        msg == 1 ? "Mail successfully sent." : "Email not Sent!";
      $("#q_status_msg")
        .html(
          `<div class="alert alert-${alertType} text-center">${alertMessage}</div>`
        )
        .fadeIn("fast")
        .delay(30000)
        .fadeOut("slow");
      if (msg == 1) $("#quick_mail_form")[0].reset();
    });
  });

  //Loading icon on submit
  $(document).ready(function () {
    $("#submit_button").submit(function (e) {
      $("#send_mail_btn").attr("disabled", true); // Disable the button
      $("#btn_text").text("Please wait..."); // Change the button text
      $("#loading_icon").show(); // Show the loading icon
    });
  });

  //Loading icon on submit
  $(document).ready(function () {
    $("#submit_buttons").submit(function (e) {
      $("#send_mail_btns").attr("disabled", true); // Disable the button
      $("#btn_texts").text("Please wait..."); // Change the button text
      $("#loading_icons").show(); // Show the loading icon
    });
  });

  // Reusable DataTable Initialization Function
  function initializeDataTable(selector, ajaxUrl, searchLabel) {
    return $(selector).DataTable({
      paging: true,
      pageLength: 10,
      lengthChange: true,
      searching: true,
      info: true,
      scrollX: true,
      autoWidth: false,
      ordering: true,
      stateSave: true,
      processing: false,
      serverSide: true,
      pagingType: "simple_numbers",
      dom: "<'dt_len_change'l>f<'dt_buttons'B>trip",
      language: {
        search: searchLabel,
        processing: "Please wait a sec...",
        info: "Showing _START_ to _END_ of _TOTAL_",
        infoFiltered: "(filtered from _MAX_ total)",
        emptyTable: "No data to show.",
        lengthMenu: "Show _MENU_ entries",
      },
      ajax: {
        url: ajaxUrl,
        type: "POST",
        data: { q2r_secure: csrf_hash },
      },
      columnDefs: [{ targets: [0, 1], orderable: false }],
      buttons: [
        { extend: "colvis", className: "data_export_buttons" },
        { extend: "print", className: "data_export_buttons" },
        { extend: "excel", className: "data_export_buttons" },
        { extend: "csv", className: "data_export_buttons" },
        { extend: "pdf", className: "data_export_buttons" },
      ],
    });
  }

  // Initialize DataTables - Events
  initializeDataTable(
    "#upcoming_events_table",
    base_url + "admin_events/events_ajax",
    "Search/filter user:"
  )
    .order([5, "desc"])
    .draw(); // 5 is the index of 'Date added' column

  // Initialize DataTables - Staff
  initializeDataTable(
    "#all_staff_table",
    base_url + "admin_staff/staff_ajax",
    "Search/filter user:"
  )
    .order([7, "desc"])
    .draw(); // 7 is the index of 'Date added' column

  // Initialize DataTables - Projects
  initializeDataTable(
    "#all_projects_table",
    base_url + "admin_projects/projects_ajax",
    "Search/filter user:"
  )
    .order([11, "desc"])
    .draw(); // 11 is the index of 'Date added' column

  // Initialize DataTables - Awards
  initializeDataTable(
    "#all_awards_table",
    base_url + "admin_awards/awards_ajax",
    "Search/filter user:"
  )
    .order([5, "desc"])
    .draw(); // 5 is the index of 'Date added' column

  // Trumbowyg Text Editor
  $("#email_message").trumbowyg({
    btns: [
      ["viewHTML"],
      ["formatting"],
      ["bold", "italic", "underline", "del"],
      ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
      ["unorderedList", "orderedList"],
      ["link"],
      ["removeformat"],
      ["fullscreen"],
    ],
  });

  // Trumbowyg Text Editor
  $("#email_messages").trumbowyg({
    btns: [
      ["viewHTML"],
      ["formatting"],
      ["bold", "italic", "underline", "del"],
      ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
      ["unorderedList", "orderedList"],
      ["link"],
      ["removeformat"],
      ["fullscreen"],
    ],
  });

  // display field depending of type
  // Find the select element first
  const typeSelectElement = document.querySelector('select[name="type"]');

  // **Only** run the code if the select element exists on the current page
  if (typeSelectElement) {
    // This function handles showing or hiding the fields
    function updateForm() {
      var selectedValue = typeSelectElement.value;
      var isBlog = selectedValue === "blog";

      document.getElementById("event_date").style.display = isBlog
        ? "none"
        : "block";
      document.getElementById("event_venue").style.display = isBlog
        ? "none"
        : "block";
      document.getElementById("other_images").style.display = isBlog
        ? "none"
        : "block";
    }

    // Add the event listener to the dropdown
    typeSelectElement.addEventListener("change", updateForm);

    // Run the function once when the page loads
    updateForm();
  }
});
