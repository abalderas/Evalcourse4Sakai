	<div class="jumbotron">
		<h3>EvalCourse</h3>
		<h4>Sakai release</h4>		
		<hr />
		<div class="row">
			<a href="<?php echo base_url() . "index.php/access/logout";?>" class="btn btn-info">Logout</a>	
		</div>
		<hr />
		<form method="post" action="<?php echo base_url(); ?>index.php/main/search">
			<div class="container">
				<div class="row">
					<div class='col-sm-6'>
						<div class="form-group">
							<label for="mycourse">Course</label>
							<select name="mycourse" id="mycourse" class="form-control">
							<?php
								foreach($courses as $course_id => $course_name) 
								{  
								?>
									<option value="<?php echo $course_id; ?>"><?php echo $course_id . " - " . $course_name; ?></option>
								<?php
								}
							?>
							</select>				
						</div>
					</div>
				</div>
			</div> 
			
			<div class="container">
				<div class="row">
					<div class='col-sm-6'>
						<div class="form-group">
							<label for="myevent">Event</label>
							<select name="myevent" id="myevent" class="form-control">
								<?php
							//echo count($events['result']);//[0]['_id']['tool'];
								
							for($i=0; $i<count($events['result']); $i++) 
							{  
							?>
								<option value="<?php echo $events['result'][$i]['_id']['event']; ?>"><?php echo $events['result'][$i]['_id']['tool'] . " - " . $events['result'][$i]['_id']['event']; ?></option>
							<?php		
							}
							?>
							</select>
						</div>
					</div>
				</div>
			</div> 
			<div class="container">
				<div class="row">
					<div class='col-sm-6'>
						<div class="form-group">
							<label for="from_date">From date (optional)</label>
							<div class='input-group date' id='datetimepicker1'>
								<input type='text' name="from_date" id="from_date"  class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(function () {
							$('#datetimepicker1').datetimepicker({
								locale: 'es',
								format: 'L'
							});
						});
					</script>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class='col-sm-6'>
						<div class="form-group">
							<label for="to_date">To date (optional)</label>
							<div class='input-group date' id='datetimepicker2'>
								<input type='text' name="to_date" id="to_date"  class="form-control" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						$(function () {
							$('#datetimepicker2').datetimepicker({
								locale: 'es',
								format: 'L'
							});
						});
					</script>
				</div>
			</div>			
			<div class="form-group">
				<input type="hidden" name="url_return" value="<?php echo $url_return; ?>" />
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</form>
	</div>
