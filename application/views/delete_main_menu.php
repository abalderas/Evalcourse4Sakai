
		
	<div class="jumbotron">
		<h3>EvalCourse</h3>
		<h4>Sakai release</h4>
		<hr />
		<form method="post" action="<?php echo base_url(); ?>index.php/main/search">
			<?php
			//selecting records from the collection - surfinme_index
			//$result=$collection->find();
			?>
			<div class="form-group">
				<label for="mycourse">Course</label>
				<?php
				if (!isset($course_id))
				{
				?>
				<select name="mycourse" id="mycourse" class="form-control">
				<?php
					foreach($courses as $course_data) 
					{  
					?>
						<option value="<?php echo $course_data['site_id']; ?>"><?php echo $course_data['site_id'] . " - " . $course_data['title']; ?></option>
					<?php
					}
				?>
				</select>
				<?php
				} // fin isset
				else
				{
				?>
				<br />
				<label>&nbsp;&nbsp;&nbsp;<?php echo $course_id; ?></label>
				<input type="hidden" name="mycourse" id="mycourse" value="<?php echo $course_id; ?>" />				
				<?php
				}
				?>
			</div>
			
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
			
			<div class="form-group">
				<button type="submit" class="btn btn-default">Submit</button>
			</div>
		</form>
	</div>
