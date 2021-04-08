<?php
class Ninja extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index(){

        $this->load->view('ninja_gold_game.php');

    }

    public function process_money(){
        if($this->input->post('submit')){
            $action = $this->input->post('user_actions');
            $coins = ($this->session->userdata('coins')) ? $this->session->userdata('coins') : 0;
            $action_coins = array('farm'=>[10,20],'cave'=>[5,10],'house'=>[2,5],'casino'=>[0,50]);
            $random_coins = rand($action_coins[$action][0],$action_coins[$action][1]);
            $happen = "earned";

            if($action ==  'casino'){
                $rand_action = ['earned','lost'];
                $num = rand(0,1);
                $happen = $rand_action[$num];

            }

            $activities = ($this->session->userdata('activities')) ? $this->session->userdata('activities') : [];
            $activities[] = array('happen'=>$happen,'coins'=>$random_coins,'action'=>$action,'date'=>date("Y/d/m g:i a"));

            if($happen == "earned"){
                $coins += $random_coins;
            }else{
                $coins -= $random_coins;
            }

            $this->session->set_userdata('coins',$coins);
            $this->session->set_userdata('activities',$activities);
            redirect(base_url());


        }
    }
}