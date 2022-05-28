<?php 
include 'db_connect.php'; 
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM responders_team where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<div class="container-fluid">
	<form action="" id="manage-responder">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		<div class="form-group">
			<label for="" class="control-label">Station</label>
			<select name="station_id" id="" class="custom-select select2">
				<option value=""></option>
				<?php
					$qry = $conn->query("SELECT * FROM stations order by name asc");
					while($row= $qry->fetch_array()):
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($station_id) && $station_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']) ?></option>
			<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Name</label>
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
	</form>
</div>
<script>
	$('#manage-responder').on('reset',function(){
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('#manage-responder').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_responder',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully saved.",'success')
						setTimeout(function(){
							location.reload()
						},1000)
				}else if(resp == 2){
				$('#msg').html('<div class="alert alert-danger mx-2">Responder Team already exist.</div>')
				end_load()
				}	
			}
		})
	})
</script>