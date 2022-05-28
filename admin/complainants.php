<?php include('db_connect.php');?>
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  transform: scale(1.3);
  padding: 10px;
  cursor:pointer;
}
</style>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>List of Complainant</b>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Name</th>
									<th class="">Information</th>
									<th class="">User Reliabilty</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$complainant = $conn->query("SELECT * FROM complainants  order by name asc ");
								while($row=$complainant->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<p> <b><?php echo ucwords($row['name']) ?></b></p>
									</td>
									<td class="">
										 <p>Contact #: <b><?php echo $row['contact'] ?></b></p>
										 <p>Address: </b></p>
										 <p><small><i><b><?php echo $row['address'] ?></i></small></p>
									</td>
									<td class='text-center'>
										
										<?php if($row['status'] == 1): ?>
											<span class="badge badge-primary">Verified</span>
										<?php else: ?>
											<span class="badge badge-secondary">Unverified</span>
										<?php endif; ?>

									</td>
									<td class="text-center">
									<?php if($row['status'] == 1): ?>
										<button class="btn btn-sm btn-outline-primary unverify_user" type="button" data-id="<?php echo $row['id'] ?>" >Unverify</button>
									<?php else: ?>
										<button class="btn btn-sm btn-outline-primary verify_user" type="button" data-id="<?php echo $row['id'] ?>" >Verify</button>
									<?php endif; ?>
										<button class="btn btn-sm btn-outline-primary view_complaints" type="button" data-id="<?php echo $row['id'] ?>"   data-name="<?php echo $row['name'] ?>">View Complaints</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('.edit_complainant').click(function(){
		uni_modal("Manage complainant Details","manage_complainant.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.view_complaints').click(function(){
		uni_modal("<i class='fa fa-user-secret'></i> "+$(this).attr('data-name')+" Complaints","view_complainant_complaints.php?id="+$(this).attr('data-id'),"mid-large")

	})
	$('.verify_user').click(function(){
		_conf("Are you sure to set the selected complainant as verified?","verify",[$(this).attr('data-id'),1])
	})
	$('.unverify_user').click(function(){
		_conf("Are you sure to set the selected complainant as unverified?","verify",[$(this).attr('data-id'),0])
	})
	$('#check_all').click(function(){
		if($(this).prop('checked') == true)
			$('[name="checked[]"]').prop('checked',true)
		else
			$('[name="checked[]"]').prop('checked',false)
	})
	$('[name="checked[]"]').click(function(){
		var count = $('[name="checked[]"]').length
		var checked = $('[name="checked[]"]:checked').length
		if(count == checked)
			$('#check_all').prop('checked',true)
		else
			$('#check_all').prop('checked',false)
	})
	$('#print_selected').click(function(){
		start_load()
		if($('[name="checked[]"]:checked').length <= 0){
			alert_toast("Select atleast one complainant first.",'warning')
			end_load()
			return false;
		}
		var chk = [];
		$('[name="checked[]"]:checked').each(function(){
			chk.push($(this).val())
		})
		chk = chk.join(',')
		$.ajax({
			url:'print_barcode.php',
			method:'POST',
			data:{tbl:'complainants',ids:chk},
			success:function(resp){
				if(resp){
					var nw = window.open("","_blank","height=800,width=900")
					nw.document.write(resp)
					nw.document.close()
					nw.print()

					setTimeout(function(){
						nw.close()
						end_load()
					},500)

				}
			}
		})
	})
	function verify($id,$status){
		start_load()
		$.ajax({
			url:'ajax.php?action=verify',
			method:'POST',
			data:{id:$id,status:$status},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully updated.",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>