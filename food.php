<?php
include "templates/page_setup.php";
include "templates/header.php";
include "templates/jumbotron.php";
?>
<script src = "display.js"></script>
<div class = "container-fluid product-list" id="content" style ="">
  <div class = "row">
    <div class = "col-md-12">
<?php
if(isset($_SESSION['status']) and $_SESSION['status']=='Admin'){
  echo '<a href = "ingredient_form.php?action=new" class = "btn bth-default btn-sm">Add new ingredient to database<span class = "glyphicon glyphicon-plus"></a><br>';
}
?>
      <div class="row" id = "dis">
      </div>
    </div>
  </div>
  <div id="debug"></div>
</div>

<?php include "templates/footer.php";?>
