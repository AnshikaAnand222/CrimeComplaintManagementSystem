<?php
include 'db_connect.php';
?>
<div class="container-fluid py-1">
	<table class="table table-bordered table-hover" id="complaint-tbl">
        <thead>
          <tr>
            <th width="20%">Date</th>
            <th width="30%">Report</th>
            <th width="30%">Incident Address</th>
            <th width="10%">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $status = array("","Pending","Received","Action Made");
          $qry = $conn->query("SELECT * FROM complaints where complainant_id = {$_GET['id']} order by unix_timestamp(date_created) desc ");
          while($row = $qry->fetch_array()):
          ?>
          <tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
            <td><?php echo date('M d, Y h:i A',strtotime($row['date_created'])) ?></td>
            <td><?php echo $row['message'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $status[$row['status']] ?></td>
          </tr>
        <?php endwhile; ?>
        </tbody>
  </table>
</div>
<div class="modal-footer row display py-1">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
		</div>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: block
	}
	.border-gradien-alert{
		border-image: linear-gradient(to right, red , yellow) !important;
	}
	.border-alert th, 
	.border-alert td {
	  animation: blink 200ms infinite alternate;
	}

	@keyframes blink {
	  from {
	    border-color: white;
	  }
	  to {
	    border-color: red;
		background: #ff00002b;
	  }
	}
</style>
<script>
	$('#complaint-tbl').dataTable();
</script>