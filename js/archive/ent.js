$( document ).ready(function() {

    /* Left Navigation Menu */
    $('#leftNavMenu > ul > li > a').click(function() {

        $('#leftNavMenu li').removeClass('leftNavMenuActive');
        $(this).closest('li').addClass('leftNavMenuActive');

        var checkElement = $(this).next();
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            $(this).closest('li').removeClass('leftNavMenuActive');
            checkElement.slideUp('normal');
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            $('#leftNavMenu ul ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
        }
        if($(this).closest('li').find('ul').children().length == 0) {
            return true;
        } else {
            return false;
        }
    });
    
    /* Table checkbox to select or unselect all checkboxes */
    $("#selectAllChkBoxes").click(function() {
      $('.moc:checkbox').prop('checked', $(this).prop('checked'));
    });
    
    $( "#tableRows" ).change(function() {
    
      var selectedOption = $(this).val();

      $("#tableRows option").each(function(){
        if ($(this).text() == selectedOption) {
          $(this).prop("selected",true);
        } else {
          $(this).removeAttr("selected");
        }
      });
      //$("#tableForm").submit();
    });
    
    /*
    Method of Capture - Add: Enter the new method of capture.
    */
    $("#addMOCModalButton").on("click", function(event) {
        var titleIcon = " class='glyphicon glyphicon-folder-open' aria-hidden='true'"; //"glyphicon-folder-open"
        var titleWords = "Add - Method of Capture";
        var formLayout = '<form class="form-inline" id="addMOCForm"> ' +
                        '<div class="form-group"> ' +
                          '<label for="addMethodOfCapture" class="control-label">&nbsp Enter Method of Capture: </label> ' +
                          '<input class="form-control" id="addMOCData" type="text" name="addMethodOfCapture" autofocus required> ' +
                          '<input class="form-control" id="addMOC" type="hidden" name="addMOC" value="Create"> ' +
                          '<input class="form-control" id="rowCnt" type="hidden" name="rowCount" value="' + $("select option:selected").val() + '"> ' +
                        '</div> <!-- form-group --> ' +
                      '</form> <!-- method="post" name="login" --> '
        var formId = "#addMOCForm";
        var btnLabel = "Create";
        var btnClass = "btn-success";
        var elementId = "tableRowCol";
        var fileURL = "../admin/moc-data.php";
        var requestType = "GET";
        
        jDialog(titleIcon, titleWords, formLayout, formId, btnLabel, btnClass, elementId, fileURL, requestType);
    }); // $("#addMOCModalButton").on("click", function(event)

    /*
    Method of Capture - Edit: Edit a new method of capture.
    */
    $("#editMOCModalButton").on("click", function() {
        var amountChecked = $("input:checked").length;
        
        if (amountChecked == 1 ) {
            var titleIcon = " class='glyphicon glyphicon-edit' aria-hidden='true'"; //"glyphicon-folder-open"
            var titleWords = "Edit - Method of Capture";
            var formLayout =
                '<form class="form-inline" id="editMOCForm"> ' +
                  '<div class="form-group"> ' +
                    '<label for="editMethodOfCapture" class="control-label">Method of Capture:</label> ' +
                    '<input class="form-control" id="editMethodOfCapture" type="text" name="editMethodOfCapture" value="' + $("input:checked").parent().siblings("td").eq(0).text() + '"> ' +
                    '<input class="form-control" id="editMethodOfCaptureId" type="hidden" name="editMethodOfCaptureId" value="' + $("input:checked").val() + '"> ' +
                    '<input class="form-control" id="editMOC" type="hidden" name="editMOC" value="Edit"> ' +
                    '<input class="form-control" id="rowCnt" type="hidden" name="rowCount" value="' + $("select option:selected").val() + '"> ' +
                  '</div> <!-- form-group --> ' +
                '</form> <!-- method="post" name="login" --> ';
                           
            var formId = "#editMOCForm";
            var btnLabel = "Edit";
            var btnClass = "btn-success";
            var elementId = "tableRowCol";
            var fileURL = "../admin/moc-data.php";
            var requestType = "GET";
            
            jDialog(titleIcon, titleWords, formLayout, formId, btnLabel, btnClass, elementId, fileURL, requestType);

//            $('#editMOCModal').modal('toggle');  // Shows the Method of Capture modal.
        } else if (amountChecked == 0) {
            jAlert("Select a record to Edit", "Edit - Select One Record");
        } else {
            jAlert("Select one record for editing.", "Edit - Select One Record");
        }
    
    }); // $("#addMOCModalButton").on("click", function(event)
	
     /*
       Method of Capture Edit - verify one and only one checkbox has
       has been checked to edit a record.
    
    $("#editMOCModalButton").on("click", function(event) {
        var amountChecked = $("input:checked").length;
        
        if (amountChecked == 1 ) {
            $('#editMOCModal').modal('toggle');  // Shows the Method of Capture modal.
        } else if (amountChecked == 0) {
            jAlert("Select a record to Edit", "Edit - Select One Record");
        } else {
            jAlert("Select one record for editing.", "Edit - Select One Record");
        }
    });
     */
     
     /* Method of Capture Edit - Set the input value to the checked Method of Capture for editing purpose. */
    /* $('#editMOCModal').on('show.bs.modal', function () {
    $('#editMOCForm').on('load', function () {
    alert("here");
        var methodOfCapture = '';
        $('input:checked').each(function () {
            methodOfCapture += $(this).parent().siblings('td').eq(0).text();
        });
        $("#editMethodOfCapture").val( methodOfCapture );
    });
     */
     
    /* Method of Capture Edit - set focus in the modal */
    $('#editMOCModal').on('shown.bs.modal', function () {
       $('#editMethodOfCapture').focus();
    });
    
    /* Method of Capture Add - set focus in the modal */
    $('#addMOCModal').on('shown.bs.modal', function () {
       $('#addMethodOfCapture').focus();
    });
    
    $(".toggle-btn").click(function(){
        $("#myCollapsible").collapse('toggle');
    });
    
    // Footer
    $('.scroll-background').hover(function() {
          $('#scroll-text').slideToggle('slow');
    });
});

function jDialog (dTitleIcon, dTitleWords, dFormLayout, dFormId, dBtnLabel, dBtnClass, dElementId, dFileURL, dRequestType) {

    bootbox.dialog({
        title: '<span' + dTitleIcon + '></span> &nbsp' +
               dTitleWords,
        message: dFormLayout,
        buttons: {
            success: {
                label: dBtnLabel,
                className: dBtnClass,
                callback: function () {
                    changeMOC($(dFormId).serialize(), dElementId, dFileURL, dRequestType);
                }  //  callback
            },  //  success
            cancel: {
                 label: "Cancel",
                 className: "btn-cancel"
            }  //  cancel
        }  //  buttons
    }); //bootbox.dialog
}

function changeMOC(formData, elementId, fileURL, requestType) {

    var request = $.ajax({
        url: fileURL,
        type: requestType,
        data: formData
    }); // var request = $.ajax 
   
    request.done(function (response, textStatus, jqXHR){
       document.getElementById(elementId).innerHTML = response;
    }); // request.done(function (response, textStatus, jqXHR)
    
    // callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        jAlert("The following error occured: " + textStatus + " " + errorThrown,
               "ERROR!");
    }); //  request.fail(function (jqXHR, textStatus, errorThrown)
}

function jAlert(alertText, alertTitle) {
    bootbox.dialog ({
        message: alertText,
        title: '<img class="bootbox-images" src="/images/important.gif" alt="Important"> &nbsp' +
           alertTitle,
        buttons: {
          confirm: {
            label: "Ok",
            className: "btn-confirm"
          }  //confirm:
        }  // buttons:
    });  // bootbox.dialog
}  //  function jAlert()

/*
function getEditMOC () {
    alert("here get");
        var methodOfCapture = '';
        $('input:checked').each(function () {
            methodOfCapture += $(this).parent().siblings('td').eq(0).text();
        });
        //return methodOfCapture);
        alert($('input:checked').parent().siblings('td').eq(0).text());
        alert('<input class="form-control" id="editMethodOfCapture" type="text" name="editMethodOfCapture" value="' + $('input:checked').parent().siblings('td').eq(0).text() + '"> ');
        alert('<input class="form-control" id="editMethodOfCaptureId" type="text" name="editMethodOfCaptureId" value="' + $('input:checked').val() + '"> ');
        //$("#editMethodOfCapture").val( methodOfCapture );
        //$(document).getElementById("#editMethodOfCapture").innerHTML = methodOfCapture;
}
*/

/* Smooth Scroll */
$('a[href=#body-section]').click(function(){
  if(location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname)
  {
    var target = $(this.hash);
    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

    if(target.length)
    {
      $('html,body').animate({
        scrollTop: target.offset().top
      }, 1000);
      
      return false;
    }
  }
});

/** 
 * Keeps the footer at the bottom of the page, no matter how little content is on the page
 * adds or removes footer-drop class (in css) based on whether footer is too high
 ** footer-drop class:  position: absolute; bottom: 0; width: 100%;
 */
function footerDrop()
{
  $(document).ready(function() {
    $body = $('body');
    $footer = $('footer');

    // removes the footer-drop clas
    var removeClass = function() {
      $footer.removeClass(function(index, currentClass) {
        if(currentClass === "footer-drop")
        {
          var removedClass = "footer-drop";
        }
        return removedClass;
      });
    }

    // This is triggered at the beginning to ensure that the process starts over (otherwise the measurements aren't accurate)
    removeClass();

    var window_height = $(window).height();
    var footer_bottom = $footer.offset().top + $footer.height();

    // If the footer isn't at the bottom, then add the class to force it to the bottom
    if(footer_bottom < window_height)
    {
      $footer.addClass(function(index, currentClass) {
      if(currentClass !== "footer-drop")
      {
        var addedClass = "footer-drop";
      }
        return addedClass;
      });
    }

    // Measure to make sure the footer and body don't overlap
    var footer_top = $footer.offset().top;
    var body_bottom = $body.offset().top + $body.height();
   
    // if the footer and body overlap, then rip the class back off
    if(footer_top > body_bottom)
    {
      removeClass();
    }
  });
}

// Adjusts the footer everytime a page reloads or resizes
$(window).on("resize load", footerDrop);