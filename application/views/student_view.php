	<script type="text/javascript">
		var items = [];
	</script>
		
	<div class="jumbotron">
		<h3>EvalCourse</h3>
		<hr />
		<h4><?php echo $evalcourse_query; ?></h4>
		<hr />
		<div class="row">
			<a href="<?php echo base_url() . "index.php/access/logout";?>" class="btn btn-info">Logout</a>	
		</div>
		<hr />
		<div class="row">
			<div id="visualization"></div>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<thead>
						<tr>
							<th>Student</th><th>Date</th><th>Count</th>
						</tr>
					</thead>
					<tbody>
					<?php
					
					for ($i=0; $i<count($collection); $i++)
					{	
						$student_name = $collection[$i]['name'];
						//var_dump($collection[$i]['timestamp']);
						$date_event = date('Y-m-d', $collection[$i]['timestamp']->sec);
						$occurrence = $collection[$i]['occurrence'];
						echo "<tr><td>$student_name</td><td>$date_event</td><td style=\"text-align: right;\">$occurrence</td></tr>";
						/*
						$data_query = array("_id.user_id" => $students[$i]['user_id']);
						$id_search = $students[$i]['user_id'];
						$student = $this->mongo_db->where(array('_id.user_id' => "$id_search"))->get('SearchResultsTemp');
						if (count($student)>0)
							$count = $student[0]['count'];
						else
							$count = 0;							
						echo "<tr><td>$i</td><td>" . $students[$i]['name'] . "</td><td>$count</td><td><a href=\"" . base_url(). "index.php/main/StudentActivity/$course" . "/" . $event . "/$id_search\" class=\"btn btn-primary\">report</a></td></tr>";
						*/
						?>
						
						<script type="text/javascript">
							items.push({x: '<?php echo $date_event; ?>', y: <?php echo $occurrence; ?>, label: {content: <?php echo $occurrence; ?>, className: 'tag'}});			
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
