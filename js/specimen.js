var LOOKUP_MIN_LENGTH = 2;

$(document).ready( function() {

  // Owner name lookup
  $("#ownerLookUp").keyup(function(event) {
      getPersonName("ownerLookUp", "ownerName", event);
  });

  // Finder name lookup
  $("#finderLookUp").keyup(function() {
    getPersonName("finderLookUp", "finderName", event);
  });
  
  // Finder name lookup
  $("#identifierLookUp").keyup(function() {
    getPersonName("identifierLookUp", "identifierName", event);
  });

});

/*
    Person Autocomplete - Owner, Finder, and Identifier
*/

function getPersonName(personValue, personDataList, e) {

  var personName = $("#" + personValue).val(); // Get the person's lookup field value.
  
  /* Check the length of the field being entered in and remove the datalist options so that they
     do not show when the user keys in letters that are below the LOOKUP_MIN_LENGTH. */
  if (personName.length < LOOKUP_MIN_LENGTH) {
     // Remove all options from the datalist.
     $("#" + personDataList).empty();
     return;
  } // if (personName.length < LOOKUP_MIN_LENGTH)

  // Check to see if various keys have been pressed and let normal behaviour for the datalist to occur.
  switch (e.which) {
    case 9:     // Tab
    case 13:    // Return
    case 33:    // Page up
    case 34:    // Page down
    case 38:    // Up arrow
    case 40:    // Down arrow
        return;
  }
//  if(e.which === 13 || e.which === 40 || e.which === 9 || e.which === 38 || ) {return;}
  
  $.ajax({
    method: 'GET',
//    url: 'http://bugs4me.ga/auto-complete.php',
    url: 'http://bugs4me.ga/classes/specimenDAO.php',
    data: {personLookUp: personName},
    dataType: 'html'  // Helps with debugging DAO.
  })
  .done(function(data) {
     // Remove all previous options.
     $("#" + personDataList).empty();
     
//     alert(data);  // debug for php data return
     var personName = jQuery.parseJSON(data);

     // Notify the user if no names or incorrect information has been entered.
     if (personName.length == 0) {alert("No name found"); return;}
     
     // Put the names in a datalist populating the options.
     personName.forEach(function(person) {

       // Create a new <option> element.
       var option = document.createElement('option');
       
       // Set the value using the item in the JSON array.
       option.id = person.PersonId;
       option.value = person.Name;
       
       // Add the <option> element to the <datalist>.
       $("#" + personDataList).append(option);

    }); // personName.forEach(function(person)

  }) // .done(function(data)

  .fail(function(jqXHR, textStatus, errorThrown) {
     alert("In error: " + textStatus + " " + errorThrown);
  }) // .fail(function(jqXHR, textStatus, errorThrown)

} //function getPersonName(personValue, personDataList)

/*
    Specimen File Browser
*/

$(document).on('change', '.btn-file :file', function() {

          var $files = $(this)[0].files,
              filesDisplay = "";

          for (var i = 0; i < $files.length; i++) {
              var file = $files[i];
              if (i == 0) {
                filesDisplay += file.name;
              } else {
                filesDisplay += "; " + file.name;
              }
          }

          $("#file-display").val(filesDisplay);
});