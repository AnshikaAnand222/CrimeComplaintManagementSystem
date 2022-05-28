<link rel="stylesheet" href="admin/assets/wysiwyg/css/froala_editor.css">
  <link rel="stylesheet" href="admin/assets/wysiwyg/css/froala_style.css">
<?php 
include 'admin/db_connect.php'; 
?>
<style>
    #cat-list li{
        cursor: pointer;
    }
       #cat-list li:hover {
        color: white;
        background: #007bff8f;
    }
    .prod-item p{
        margin: unset;
    }
    .bid-tag {
    position: absolute;
    right: .5em;
}
</style>
<?php 
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
?>
<div class="container">
    <div class="col-lg-12">
      <div class="fr-wrapper">
          <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>
      </div>
    </div>
</div>
       
<script>
    
</script>