<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	// Options required for the events-queries
	var $EventsOps = array(
		array('$group' => array("_id" => array("tool" => '$tool', "event"=>'$event'))),
		array('$sort' => array("_id" => 1))
	);

  var $users = "users_anom";
  var $events = "events_anom";

    public function __construct()
	{
         parent::__construct();
         //loading  the mongodb library
         $this->load->library('mongo_db');
    }

	public function index()
	{
		$this->EventsAll();
	}

	public function EventsCourse($course_id)
	{
		$this->load->view('templates/header');
		$course_data = $this->mongo_db->where(array('site_id' => "$course_id"))->get('courses');

		// course
		$collections['courses']["$course_id"] = $course_data[0]['title'];

		// event
		$collections['events'] = $this->mongo_db->aggregate($this->events, $this->EventsOps);

		// url to return after searching
		$collections['url_return'] = "index.php/main/EventsCourse/" . $course_id;
		$this->load->view('results', $collections);
		$this->load->view('templates/footer');
	}

	public function EventsTeacher($teacher_id = "")
	{
		if ($teacher_id == "")
		{
			$user_session_array = $this->session->get_userdata();
			$teacher_id = $user_session_array['user_id'];
		}
		$this->load->view('templates/header');

		// Collect courses of the teacer
		$this->mongo_db->where(array('eid' => "$teacher_id"));
		$teacher_courses = $this->mongo_db->where_not_in('role.role_name',array("Alumno +", "Alumno"))->get($this->users);

		// teacher's courses
		$collections['courses'] = array();
		for ($i = 0; $i < count($teacher_courses[0]['role']); $i++)
		{
			$course_id = $teacher_courses[0]['role'][$i]['site_id'];
			$course_data =  $this->mongo_db->where(array('site_id' => "$course_id"))->get('courses');

			$collections['courses'][$teacher_courses[0]['role'][$i]['site_id']] = $course_data[0]['title'];
		}

		// events
		$collections['events'] = $this->mongo_db->aggregate($this->events, $this->EventsOps);

		// url to return after searching
		$collections['url_return'] = "index.php/main/EventsTeacher";
		$this->load->view('results', $collections);
		$this->load->view('templates/footer');
	}

	public function EventsAll()
	{
		$this->load->view('templates/header');
		$all_courses = $this->mongo_db->get('courses');

		// all courses
		$collections['courses'] = array();
		for ($i = 0; $i < count($all_courses); $i++)
		{
			$course_id = $all_courses[$i]['site_id'];
			$course_name =  $all_courses[$i]['title'];
			$collections['courses'][$course_id] = $course_name;
		}

		// events
		$collections['events'] = $this->mongo_db->aggregate($this->events, $this->EventsOps);

		// url to return after searching
		$collections['url_return'] = "";
		$this->load->view('results', $collections);
		$this->load->view('templates/footer');
	}

	public function search()
	{
		$this->load->view('templates/header');

		$course = $this->input->post('mycourse');
		$event = $this->input->post('myevent');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');

		$collections['course'] = $course;
		$collections['event'] = $event;
		$collections['url_return'] = $this->input->post('url_return');
		$collections['evalcourse_query'] = "Evidence indicator: get students show milestones in \"$event from course \"echo $course\" ";

		$this->mongo_db->where(array('role.site_id' => "$course"));
		$collections['students'] = $this->mongo_db->where_in('role.role_name',array("Alumno +", "Alumno"))->get($this->users);

		// if a date is included
		if ($from_date!="" || $to_date=="")
		{
			$arrayRange = array();

			if ($from_date!="")
			{
				$from_date = $this->DateFormat($from_date);
				$f_mongo_date = new MongoDate(strtotime($from_date . " 00:00:00"));
				$arrayRange = array_merge($arrayRange, array('$gte' => $f_mongo_date));
				$collections['evalcourse_query'] = $collections['evalcourse_query'] . "between $from_date ";
			}
			if ($to_date!="")
			{
				$to_date = $this->DateFormat($to_date);
				$t_mongo_date = new MongoDate(strtotime($to_date . " 00:00:00"));
				$arrayRange = array_merge($arrayRange, array('$lt' => $t_mongo_date));
				$collections['evalcourse_query'] = $collections['evalcourse_query'] . "and $to_date ";
			}
		}

		if (count($arrayRange)>0)
			$opsMatch = array('$match' =>	array("event" => "$event", "site_id" => "$course", "timestamp" => $arrayRange));
		else
			$opsMatch = array('$match' =>	array("event" => "$event", "site_id" => "$course"));

		$ops =	array(
			$opsMatch,
			array('$group' =>
				array(	"_id" 	=> array("user_id" => '$user_id', "name" => '$name'),
						"count" => array('$sum' => '$occurrence'))
			),
			array('$sort' =>	array("_id" => 1)
			),
			array('$out' =>	"SearchResultsTemp")
		);



		$this->mongo_db->aggregate($this->events, $ops);
		$this->mongo_db->where(array('role.site_id' => "$course"));

		$this->load->view('main_search', $collections);
		$this->mongo_db->drop_collection("SearchResultsTemp");
		$this->load->view('templates/footer');
	}

	public function csv($course, $event)
	{
		$event = rawurldecode($event);
		$filename = "data.csv";
		$result = "";

		$this->mongo_db->where(array('role.site_id' => "$course"));
		$students = $this->mongo_db->where_in('role.role_name',array("Alumno +", "Alumno"))->get($this->users);

		$ops =	array(
					array(
						'$match' =>	array("event" => "$event", "site_id" => "$course")
					),
					array(
						'$group' => array(
										"_id" => array("user_id" => '$user_id', "name" => '$name'),
										"count" => array('$sum' => '$occurrence')
									)
					),
					array(
						'$sort' =>	array(
										"_id" => 1
									)
					),
					array(
						'$out' =>	"SearchResultsTemp"
					)
				);

		$this->mongo_db->aggregate($this->events, $ops);
		$this->mongo_db->where(array('role.site_id' => "$course"));

		for ($i=0; $i<count($students); $i++)
		{

			$data_query = array("_id.user_id" => $students[$i]['user_id']);
			$id_search = $students[$i]['user_id'];
			$student = $this->mongo_db->where(array('_id.user_id' => "$id_search"))->get('SearchResultsTemp');
			if (count($student)>0)
			{
				$result = $result . "$i:".$students[$i]['name'] . ":" . $student[0]['count'] . "\r\n";
			}
			else
			{
				$result = $result . "$i:".$students[$i]['name'] . ":0\r\n";
			}

		}

		$this->mongo_db->drop_collection("SearchResultsTemp");
		force_download($filename, $result);
	}

	public function StudentActivity($course_id, $event, $student_id)
	{
		$this->load->view('templates/header');

		$event = rawurldecode($event);
		$student_search = array("site_id" => "$course_id",
								"event" => "$event",
								"user_id" => "$student_id");
		$data['collection'] = $this->mongo_db->where($student_search)->order_by(array('timestamp' => 1))->get($this->events);

		$data['evalcourse_query'] = "Evidence indicator: get students $student_id show milestones in \"$event from course \"echo $course_id\" ";

		$this->load->view('student_view', $data);
		$this->load->view('templates/footer');
	}

	private function DateFormat($mydate)
	{
		$date_array = explode("/", $mydate);
		if (count($date_array)>1)
			$date_output = $date_array[2] . "-" . $date_array[1] . "-" . $date_array[0];
		else
			$date_output = NULL;
		return $date_output;
	}
}
