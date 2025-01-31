	<script type="text/javascript">
		var items = [];
	</script>
		
	<div class="jumbotron">
		<h3>EvalCourse</h3>
		<hr />
		<h4><?php echo $evalcourse_query; ?></h4>
		<hr />
		<div class="row">	
			<a href="<?php echo base_url() . $url_return;?>" class="btn btn-info">Home</a>
			<a href="<?php echo base_url();?>index.php/main/csv/<?php echo $course . "/" . $event; ?>" class="btn btn-info">Export to csv</a>	
			<a href="<?php echo base_url() . "index.php/access/logout";?>" class="btn btn-info">Logout</a>		
		</div>
		<hr />
		<div class="row">
			<div id="visualization">
				<div id="studentName"><span></span></div>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<thead>
						<tr>
							<th>id</th><th>Student</th><th>Count</th><th>Timeline</th>
						</tr>
					</thead>
					<tbody>
					<?php
					for ($i=0; $i<count($students); $i++)
					{						
						$data_query = array("_id.user_id" => $students[$i]['user_id']);
						$id_search = $students[$i]['user_id'];
						$student = $this->mongo_db->where(array('_id.user_id' => "$id_search"))->get('SearchResultsTemp');
						if (count($student)>0)
							$count = $student[0]['count'];
						else
							$count = 0;							
						echo "<tr><td>$i</td><td>" . $students[$i]['name'] . "</td><td style=\"text-align: right;\">$count</td><td><a href=\"" . base_url(). "index.php/main/StudentActivity/$course" . "/" . $event . "/$id_search\" class=\"btn btn-primary\"  target=\"_blank\">report</a></td></tr>";
						?>
						
						<script type="text/javascript">
							items.push({x: <?php echo $i; ?>, y: <?php echo $count; ?>, label: {content: <?php echo $i; ?>, className: 'tag'}});			
						</script>
						
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		
		<script type="text/javascript">
			var container = document.getElementById('visualization');
			var dataset = new vis.DataSet(items);
			var options = {
				style:'bar',
				barChart: {width:50, align:'center'}, // align: left, center, right
				drawPoints: true,
				orientation:'top'
			};
			var Graph2d = new vis.Graph2d(container, dataset, options);
		</script>
	</div>
