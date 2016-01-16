<?php
//Set the root path for all files based on the file location of the calling page.

$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);

// Set switches for the header file for the pages leveraging the header file.
$checkLogin = true;  // force login check.
$title = "Bugs4me"; // title for the page.
$dbAccess = true;     // flag for DAO object.

#Debugging turned on.
#error_reporting(E_ALL);
#ini_set("display_errors", 1);

require_once($pathToRoot . "includes/header.php");
?>

    <!-- Specimen -->
<section class="container">
  <br>
  <form>
    <!-- Specimen Owner -->
    <label for="ownerLookUp">Owner</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <input type="text" class="form-control" id="ownerLookUp" list="ownerName" placeholder="Enter owner name" autofocus required>
          <datalist id="ownerName"></datalist>
        </div> <!-- class="form-group" -->
      </div> <!-- class="col-sm-6" -->
    </div> <!-- class="row" -->

    <!-- Specimen Finder -->
    <label for="finderLookUp">Finder</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <input type="text" class="form-control" id="finderLookUp" list="finderName" placeholder="Enter finder name" required>
          <datalist id="finderName"></datalist>
        </div> <!-- class="form-group" -->
      </div> <!-- class="col-sm-6" -->
    </div> <!-- class="row" -->

    <!-- Specimen Identifier -->
    <label for="identifierLookUp">Identifier</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <input type="text" class="form-control" id="identifierLookUp" list="identifierName" placeholder="Enter identifier name" required>
          <datalist id="identifierName"></datalist>
        </div> <!-- class="form-group" -->
      </div> <!-- class="col-sm-6" -->
    </div> <!-- class="row" -->
                  
    <!-- Specimen -->
    <label>Specimen</label>
    <div class="row">
      <div class=" col-sm-6 col-lg-6">
        <div class="input-group">
          <span class="input-group-btn">
            <span class="btn btn-primary btn-file">
              Browse&hellip; <input type="file" multiple>
            </span>
          </span>
          <input type="text" id="file-display" class="form-control" readonly>
        </div> <!-- class="input-group" -->
      </div> <!-- class="col-lg-6 col-sm-6" -->
    </div> <!-- class="row" -->

    <!-- Specimen Sex -->
    <br>
    <label>Specimen Sex</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
        
          <div class="radio">
            <label>
              <input type="radio" name="specimenRadios" id="maleSex" value="male" checked><span>Male</span>
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="specimenRadios" id="femaleSex" value="female"><span>Female</span>
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="specimenRadios" id="unknownSex" value="unknown"><span>Unknown</span>
            </label>
          </div>
          
        </div> <!-- class="form-group" -->
      </div> <!-- class="col-sm-6" -->
    </div> <!-- class="row" -->
             
    <!-- Specimen Method of Capture -->
    <label>Method of Capture</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <select class="form-control">
            <option>Net</option>
            <option>Hand</option>
            <option>Trap</option>
            <option>Cup</option>
            <option>Jar</option>
          </select>
        </div>
      </div>
    </div>
             
    <!-- Specimen Collection Date -->
    <label>Collection Date</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <input type="date" class="form-control" id="specimenCollectionDate" placeholder="Collection Date">
        </div>
      </div>
    </div>
 
    <!-- Specimen Habitat -->
    <label>Habitat</label>
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <textarea rows="4" name="specimenHabitat">Enter habitat...</textarea>
        </div>
      </div>
    </div>

        <!-- Specimen Longitude & Latitude -->
    <label>Longitude and Latitude</label>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <input type="text" class="form-control" id="specimenLongitude" placeholder="Enter longitude" required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <input type="text" class="form-control" id="specimenLatitude" placeholder="Enter latitude" required>
        </div>
      </div>
    </div>

    <!-- Save button -->
    <div class="form-group">
      <div >
        <button type="submit" class="btn btn-default">Save</button>
      </div>
    </div>  <!-- class="form-group" -->
  </form>
<section>   <!-- class="container" -->
<!-- Close the body and put in the footer -->    
<?php require_once($pathToRoot . "includes/footer.php"); ?>