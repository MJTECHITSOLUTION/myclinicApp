const app = new Vue({
    el: '#app',
});


var baseURL = SITE_URL;


(function ($) {


    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

    // Model to edit appointment status
    $('#EDITRDVModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var rdv_date = button.data('rdv_date') // Extract info from data-* attributes
        var rdv_id = button.data('rdv_id') // Extract info from data-* attributes
        var rdv_time_start = button.data('rdv_time_start') // Extract info from data-* attributes
        var rdv_time_end = button.data('rdv_time_end') // Extract info from data-* attributes
        var reason = button.data('reason') // Extract info from data-* attributes
        var patient_name = button.data('patient_name') // Extract info from data-* attributes
        var selectedPatientID = $("#patient_name").val() // Extract info from data-* attributes
        var selectedPatientName = $("#patient_name option:selected").text() // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('#patient_name').text(patient_name)
        modal.find('#rdv_date').text(rdv_date)
        modal.find('#rdv_time').text(rdv_time_start + ' - ' + rdv_time_end)
        modal.find('#rdv_time_start_input').val(rdv_time_start)
        modal.find('#rdv_time_end_input').val(rdv_time_end)
        modal.find('#patient_input').val(selectedPatientID)
        modal.find('#rdv_id').val(rdv_id)
        modal.find('#rdv_id2').val(rdv_id)
        modal.find('#rdv_id3').val(rdv_id)
        modal.find('#rdv_id4').val(rdv_id)
        modal.find('#reason_for_visit').val(reason)
    })


    // Model to edit appointment status
    $('#DeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var link = button.data('link') // Extract info from data-* attributes

        var modal = $(this)
        modal.find('#delete_link').attr("href", link)
    })


    // Repeatables for billing and prescriptions

    // $(".billing_labels .repeatable").repeatable({
    //   addTrigger: ".billing_labels .add",
    //   deleteTrigger: ".billing_labels .delete",
    //   template: "#billing_labels",
    //   startWith: 1,
    //   max: 5
    // });

    $(document).ready(function () {
        // Initialize repeatable elements
        $(".drugs_labels .repeatable").repeatable({
            addTrigger: ".drugs_labels .add",
            deleteTrigger: ".drugs_labels .delete",
            template: "#drugs_labels",
            startWith: 1,
            max: 5,
            afterAdd: function () {
                // AJAX call to get drugs by category
                $(".multiselect-drugs_cat").on("change", function () {
                    var $row = $(this).closest('.field-group.row');
                    var typeId = $(this).val();
                    var $drugSelect = $row.find('.multiselect-drug');

                    if (typeId) {
                        $.ajax({
                            url: '/get-medicaments-by-type',
                            type: 'GET',
                            data: { type_id: typeId },
                            success: function (data) {
                                $drugSelect.empty();
                                $drugSelect.append('<option value="">Sélectionner un Médicament...</option>');
                                $.each(data, function (key, value) {
                                    $drugSelect.append('<option value="' + value.id + '">' + value.trade_name + '</option>');
                                });
                                $drugSelect.select2();
                            },
                            error: function (xhr, status, error) {
                                console.log('Error:', error);
                            }
                        });
                    } else {
                        $drugSelect.empty();
                        $drugSelect.append('<option value="">Sélectionner un Médicament...</option>');
                        $drugSelect.select2();
                    }
                });


                // Initialize select2 for various elements
                $('.multiselect-drug').select2();
                $('.multiselect-type_med').select2();
                $('.medicament').select2();
                $('.multiselect-drugs_cat').select2();

                // Handle change event for multiselect-drug within repeatable fields
                $(document).on("change", ".multiselect-drug", function () {
                    var medicamentId = $(this).val();
                    console.log('Selected Medicament ID:', medicamentId); // Debugging log
                    var drugAdviceInput = $(this).closest(".field-group.row").find("#drug_advice");

                    if (medicamentId) {
                        $.ajax({
                            url: '/get-posologie-by-medicament',
                            type: 'GET',
                            data: { medicament_id: medicamentId },
                            success: function (data) {
                                console.log('Received Data:', data); // Debugging log
                                if (data && data.posologie) {
                                    drugAdviceInput.val(data.posologie);
                                } else {
                                    drugAdviceInput.val(''); // Clear if no data
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error:', xhr.responseText); // Improved error logging
                            }
                        });
                    } else {
                        drugAdviceInput.val(''); // Clear if no medicament is selected
                    }
                });
            }
        });
    });




// $(document).ready(function() {
//      $(".medicament_labels .repeatable").repeatable({
//          addTrigger: ".medicament_labels .add",
//          deleteTrigger: ".medicament_labels .delete",
//          template: "#medicament_labels",
//          startWith: 1,
//          max: 5,
//          afterAdd: function () {
//              // Handle type change to update medicament options
//              $(".multiselect-type_med").on("change", function () {
//                  var typeId = $(this).val();
//                  var medicamentSelect = $(this).closest(".field-group.row").find(".medicament");
//
//                  if (typeId) {
//                      $.ajax({
//                          url: '/get-medicaments-by-type', // Ensure this route is defined in web.php
//                          type: 'GET',
//                          data: { type_id: typeId },
//                          success: function(data) {
//                              medicamentSelect.empty();
//                              medicamentSelect.append('<option value="">Sélectionner medicament</option>');
//                              $.each(data, function(key, value) {
//                                  medicamentSelect.append('<option value="'+ value.id +'" data-remarque="'+ value.remarque +'">'+ value.medicament +'</option>');
//                              });
//                          },
//                          error: function(xhr, status, error) {
//                              console.error(xhr.responseText);
//                          }
//                      });
//                  } else {
//                      medicamentSelect.empty();
//                      medicamentSelect.append('<option value="">Sélectionner medicament</option>');
//                  }
//              });
//
//              // Handle medicament change to update posologie
//              $(".medicament").on("change", function() {
//                  var medicamentId = $(this).val();
//                  var drugAdviceInput = $(this).closest(".field-group.row").find("#drug_advice");
//
//                  if (medicamentId) {
//                      $.ajax({
//                          url: '/get-posologie-by-medicament',
//                          type: 'GET',
//                          data: { medicament_id: medicamentId },
//                          success: function(data) {
//                              if (data && data.posologie) {
//                                  drugAdviceInput.val(data.posologie);
//                              } else {
//                                  drugAdviceInput.val(''); // Clear if no data
//                              }
//                          },
//                          error: function(xhr, status, error) {
//                              console.error(xhr.responseText);
//                          }
//                      });
//                  } else {
//                      drugAdviceInput.val(''); // Clear if no medicament is selected
//                  }
//              });
//
//              $('.multiselect-drug').select2();
//              $('.multiselect-type_med').select2();
//              $('.medicament').select2();
//          }
//      });
//  });

//
// $(document).on('change', '.test-select', function () {
//     var testId = $(this).val();
//     var currentAnalyseSelect = $(this).closest('.field-group').find('.analyse-select');
//     if (testId) {
//         $.ajax({
//             url: '/getAnalyses/' + testId,
//             type: 'GET',
//             dataType: 'json',
//             data: {
//                 analyse_id: currentAnalyseSelect.val() // Pass the selected value(s) directly
//             },
//             success: function (data) {
//                 currentAnalyseSelect.prop('disabled', false).html('');
//                 $.each(data, function (key, value) {
//                     currentAnalyseSelect.append('<option value="' + value.id + '">' + value.analyse_name + '</option>');
//                 });
//             }
//         });
//     } else {
//         currentAnalyseSelect.prop('disabled', true).html('<option value="">Select Analyse</option>');
//     }
// });


var money = 0;

$('.target').on('change', function () {
    money = document.getElementById("rdvdate").value;
    AddAppointment(money);

});

function AddAppointment(date) {

    $.ajax({
        url: baseURL + '/appointment/checkslots/' + date,
        type: 'GET',
        cache: false,
        success: function (array) {
            var options = '';
            $.each(array, function (key, value) {

                if (value.available == "available") {
                    options = options + '<div class="col-sm-6 col-md-4 mb-2"><button class="btn btn-doctorino btn-block" data-toggle="modal" data-target="#RDVModalSubmit" data-rdv_date="' + date + '" data-rdv_time_start="' + value.start + '" data-rdv_time_end="' + value.end + '" >' + value.start + ' - ' + value.end + '</button></div>';

                } else {
                    var btn = 'danger';
                    options = options + '<div class="col-sm-6 col-md-4 mb-2"><button class="btn btn-danger btn-block">' + value.start + ' - ' + value.end + '</button></div>';
                }

            });


            var skillhtml = options;

            $(".myorders").html(skillhtml);

            $("#help-block").css("display", "none");

            if (!options) {
                $("#help-block").css("display", "block");
                $("#help-block").html("<img src='../img/rest.png'/> <br> <b>Désolé, le docteur ne travaille pas ce jour-là</b>");
            }

            $('#RDVModalSubmit').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var rdv_date = button.data('rdv_date') // Extract info from data-* attributes
                var rdv_time_start = button.data('rdv_time_start') // Extract info from data-* attributes
                var rdv_time_end = button.data('rdv_time_end') // Extract info from data-* attributes
                var selectedPatientID = $("#patient_name").val() // Extract info from data-* attributes
                var selectedPatientName = $("#patient_name option:selected").text() // Extract info from data-* attributes
                var Selectedreason = $("textarea#reason").val() // Extract info from data-* attributes

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                if (selectedPatientID == 0) {
                    modal.find('#patient_name').html('<span class="text-danger"><b>Sélectionner le patient avant de soumettre</b></span>')

                } else {
                    modal.find('#patient_name').text(selectedPatientName)
                }
                modal.find('#rdv_date').text(rdv_date)
                modal.find('#reason_for_visit').text(Selectedreason)
                modal.find('#rdv_time').text(rdv_time_start + ' - ' + rdv_time_end)
                modal.find('#rdv_time_start_input').val(rdv_time_start)
                modal.find('#rdv_time_end_input').val(rdv_time_end)
                modal.find('#patient_input').val(selectedPatientID)
                modal.find('#reason_for_visit').val(reason_for_visit)
                modal.find('#rdv_date_input').val(rdv_date)
                modal.find('#reason_for_visit_input').val(Selectedreason)
                if ($('#sms').is(":checked")) {
                    modal.find('#send_sms').val(1)
                } else {
                    modal.find('#send_sms').val(0)
                    console.log(Selectedreason);
                }
            })

        },


        error: function () {
            $("#help-block").text("Sorry, An error has occurred");
        }
    }, "json");
}

// RDV and age date picker
$('#rdvdate').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd',
    minDate: function () {
        var date = new Date();
        date.setDate(date.getDate());
        return new Date(date.getFullYear(), date.getMonth(), date.getDate());
    }
});

$('#birthday').datepicker({
    uiLibrary: 'bootstrap4'
});

})
(jQuery); // End of use strict


