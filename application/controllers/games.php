<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends CI_Controller {

	public function index()
	{
		$this->load->view('game');
	}

	public function get_gold()
	{		
		switch($this->input->post('building'))
		{
			case 'farm':
				$gold = rand(10,20);
				break;
			case 'cave':
				$gold = rand(5,10);
				break;
			case 'house':
				$gold = rand(2,5);
				break;
			case 'casino':
				$gold = rand(-50,50);
				break;
		}

		// now that we have the process to get gold, let's deal with updating session
		if($this->session->userdata('gold'))	
		{
			// update this value, it exists in session
			$temp_gold_count = $this->session->userdata('gold');
			$temp_gold_count += $gold;
			$this->session->set_userdata('gold', $temp_gold_count);
		}
		else
		{
			$this->session->set_userdata('gold', $gold);
		}

		// Update session with the activity of each turn
		if($this->session->userdata('activities'))
		{
			//This value already exists in session, so let's update it
			$activities_array = $this->session->userdata('activities');
			if($gold < 0)
			{
				//we lost money this turn, so we add a different message to $activities_array:
				$gold = abs($gold); //we want the absolute value, so we don't print the negative sign.
				$activities_array[] = "<span id='red'>You went to the {$this->input->post('building')} and lost {$gold} gold.</span>";
			}
			else
			{
				$activities_array[] = "You went to the {$this->input->post('building')} and earned {$gold} gold.";
			}
			//Add our new, enhanced activities array back into session:
			$this->session->set_userdata('activities', $activities_array);
		}
		else
		{
			//intialize this, we're adding it to session for the first time
			if($gold < 0)
			{
				//we lost money this turn, so we add a different message to $activities_array:
				$gold = abs($gold); //we want the absolute value, so we don't print the negative sign.
				$this_turn = "<p id='red'>You went to the {$this->input->post('building')} and lost {$gold} gold.</p>";
			}
			else
			{
				$this_turn = "You went to the {$this->input->post('building')} and earned {$gold} gold.";
			}
			$activities = array($this_turn);
			//I'm adding an array with one string in it, but this is because we want
			// it to be an array of many strings, later on
			//Therefore, we make this an array from the get-go!
			$this->session->set_userdata('activities', $activities);
		}

		// Making a new HTTP request to "localhost:8888/"
		redirect(base_url());

	}


	public function reset()
	{
		$this->session->unset_userdata('activities');
		$this->session->unset_userdata('gold');	
		redirect(base_url());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */