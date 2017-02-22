<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//error_reporting(E_ALL);

/*



 * To change this template, choose Tools | Templates



 * and open the template in the editor.



 */


/**
 * Description of users
 *
 * @author user
 */
class users extends CI_Controller{



    public function __construct()



    {



        parent::__construct();



        $this->load->library('session');



        $this->load->helper('cookie');


        if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {


            $this->lang->load('code', 'english');



        } else {



            $this->lang->load('code', 'it');



        }


        $this->load->library('image_lib');



        $this->load->model("users/usersm");
        $this->load->model("property/propertym");



        //authenticate();



        /* if($this->session->userdata('user_id')){



            $data['pref_info']=$this->usersm->get_pref_info();



            if( isset($data['pref_info'][0]['language'] ) && ( $data['pref_info'][0]['language'] == "english" )) {



                $this->lang->load('code', 'english');



                //$_COOKIE['lang']='english';



            } else {



                $this->lang->load('code', 'it');



                //$_COOKIE['lang']='it';



            }



        }else{



            if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {



                $this->lang->load('code', 'english');



            } else {



                $this->lang->load('code', 'it');



            }



        } */



    }


    public function index()



    {



        $data = array();



        $data['users'] = $this->usersm->getUsers();



        //echo "<pre>";print_r($data);exit;


        $this->load->view("users/index", $data);


    }


    public function common_reg()
    {


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');



        }



        $data = array();



        $data['sitepage'] = "signup";



        //$this->session->set_userdata('user_id',0);


        $this->load->view("users/common_reg", $data);


    }


    public function comon_signup()
    {


        $data = array();



        $data['sitepage'] = "comon_signup";


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');



        }



        $new_user['contact_ph_no'] = $this->input->post('ph_no');



        $this->session->set_userdata($new_user);



        $data['countries'] = $this->usersm->get_country();


        $captcha_lib = base_url() . '/captcha/';


        $this->load->helper('captcha');


        $captcha_path = base_url();


        /*$vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



            'img_width' => '280',



            'img_height' => 80,



            'expiration' => 7200



        ); */



        $vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



            'img_width' => '380',



            'img_height' => 80,



            'font_size' => 30,



            'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



            'expiration' => 7200



        );



        $cap = create_captcha($vals);



        $data['captcha'] = array(



            'captcha_time' => $cap['time'],



            'ip_address' => $this->input->ip_address(),



            'word' => $cap['word']



        );



        $query = $this->db->insert_string('captcha', $data['captcha']);



        $this->db->query($query);



        $data['cap_img'] = $cap['image'];


        $this->load->view("users/reg_user", $data);


    }


    public function do_registration()



    {


        if (!$this->input->post()) {


            redirect('/users/comon_signup');



        }



        $data = array();



        $data['sitepage'] = "comon_signup";



        $this->load->library('form_validation');



        $new_user['contact_ph_no'] = $this->input->post('ph_no');



        $this->session->set_userdata($new_user);


        if ($this->input->post('submit') == $this->lang->line('reg_user_button_register')) {



            $this->form_validation->set_rules('user_name', '�', 'required|is_unique[zc_user.user_name]xss_clean|callback_alpha_dash_space');



            $this->form_validation->set_rules('first_name', '�', 'required');



            $this->form_validation->set_rules('last_name', '�', 'required');



            $this->form_validation->set_rules('country', '�', 'required');



            $this->form_validation->set_rules('city', '�', 'required');



            //$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');



            $this->form_validation->set_rules('reg_day', '�', 'required');



            $this->form_validation->set_rules('reg_month', '�', 'required');



            $this->form_validation->set_rules('reg_year', '�', 'required');



            $this->form_validation->set_rules('gender', '�', 'required');



            $this->form_validation->set_rules('email', '�', 'required|valid_email|is_unique[zc_user.email_id]');



            $this->form_validation->set_rules('email2', '�', 'required|valid_email');



            $this->form_validation->set_rules('password', '�', 'required|matches[pass2]|min_length[8]');



            $this->form_validation->set_rules('pass2', '�', 'required|min_length[8]');



            $this->form_validation->set_rules('agree_terms', '�', 'required');



            //print_r($_POST);


            if ($this->form_validation->run() == FALSE) {


                $data['countries'] = $this->usersm->get_country();


                $captcha_lib = base_url() . '/captcha/';


                $this->load->helper('captcha');



                $captcha_path = base_url();



                /*$vals = array(



                    'img_path' => './captcha/',



                    'img_url' => $captcha_lib,



                    'img_width' => '280',



                    'img_height' => 80,



                    'expiration' => 7200



                ); */


                $vals = array(



                    'img_path' => './captcha/',



                    'img_url' => $captcha_lib,



                    'img_width' => '380',



                    'img_height' => 80,



                    'font_size' => 30,



                    'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



                    'expiration' => 7200



                );



                $cap = create_captcha($vals);



                $data['captcha'] = array(



                    'captcha_time' => $cap['time'],



                    'ip_address' => $this->input->ip_address(),



                    'word' => $cap['word']



                );



                $query = $this->db->insert_string('captcha', $data['captcha']);



                $this->db->query($query);


                $data['cap_img'] = $cap['image'];


                $this->load->view("users/reg_user", $data);


            } else {


                $expiration = time() - 7200;


                $this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);



                $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";



                $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);



                $query = $this->db->query($sql, $binds);



                $row = $query->row();



                if ($row->count == 0) {



                    $data['countries'] = $this->usersm->get_country();


                    $captcha_lib = base_url() . '/captcha/';


                    $this->load->helper('captcha');



                    $captcha_path = base_url();



                    /*$vals = array(



                    'img_path' => './captcha/',



                    'img_url' => $captcha_lib,



                    'img_width' => '280',



                    'img_height' => 80,



                    'expiration' => 7200



                    ); */


                    $vals = array(



                        'img_path' => './captcha/',



                        'img_url' => $captcha_lib,



                        'img_width' => '380',



                        'img_height' => 80,



                        'font_size' => 30,



                        'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



                        'expiration' => 7200



                    );



                    $cap = create_captcha($vals);



                    $data['captcha'] = array(



                        'captcha_time' => $cap['time'],



                        'ip_address' => $this->input->ip_address(),



                        'word' => $cap['word']



                    );



                    $query = $this->db->insert_string('captcha', $data['captcha']);



                    $this->db->query($query);



                    $data['captcha_err'] = $this->lang->line('reg_user_you_submit_wrong_captcha');


                    $data['cap_img'] = $cap['image'];


                    $this->load->view("users/reg_user", $data);


                } else {


                    $new_user = array();



                    $access_token = access_token();


                    $new_user['user_type'] = '1';


                    $new_user['user_name'] = $this->input->post('user_name');



                    $new_user['first_name'] = $this->input->post('first_name');



                    $new_user['last_name'] = $this->input->post('last_name');



                    $new_user['contact_ph_no'] = $this->input->post('ph_no');



                    //$new_user['date_of_birth'] = $this->input->post('date_of_birth');


                    $new_user['date_of_birth'] = $this->input->post('reg_day') . '-' . $this->input->post('reg_month') . '-' . $this->input->post('reg_year');


                    $new_user['city'] = $this->input->post('city');



                    $new_user['country'] = $this->input->post('country');



                    $new_user['email_id'] = $this->input->post('email');


                    $new_user['password'] = $this->generate_password_string($access_token, $this->input->post('password'));


                    $new_user['gender'] = $this->input->post('gender');


                    $new_user['access_token'] = $access_token;


                    $new_user['agree_terms'] = $this->input->post('agree_terms');



                    $new_user['receive_mail'] = $this->input->post('receive_mail');


                    $new_user['reg_day'] = $this->input->post('reg_day');



                    $new_user['reg_month'] = $this->input->post('reg_month');



                    $new_user['reg_year'] = $this->input->post('reg_year');


                    $this->session->set_userdata($new_user);



                    $ym = $this->session->all_userdata();



                    redirect('users/user_edit');



                }



            }



        } else {


            $data['countries'] = $this->usersm->get_country();


            $captcha_lib = base_url() . '/captcha/';



            $this->load->helper('captcha');


            $captcha_path = base_url();


            /*$vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



            'img_width' => '280',



            'img_height' => 80,



            'expiration' => 7200



            ); */



            $vals = array(



                'img_path' => './captcha/',



                'img_url' => $captcha_lib,



                'img_width' => '380',



                'img_height' => 80,



                'font_size' => 30,



                'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



                'expiration' => 7200



            );



            $cap = create_captcha($vals);



            $data['captcha'] = array(



                'captcha_time' => $cap['time'],



                'ip_address' => $this->input->ip_address(),



                'word' => $cap['word']



            );



            $query = $this->db->insert_string('captcha', $data['captcha']);



            $this->db->query($query);


            $data['cap_img'] = $cap['image'];


            $this->load->view("users/reg_user", $data);



        }



    }


    private function generate_password_string($access_token, $raw_password)



    {



        $divider = '_';



        $raw_string = $access_token . $divider . $raw_password;



        $encrypted_password = md5($raw_string);



        return $encrypted_password;



    }


    function check_email_avail()
    {


        $email_id = $this->input->post('email');


        if ($email_id == '') {



            echo '2';



            exit;



        } else {



            $user_list_cnt = get_perticular_count('zc_user', " and email_id='" . $email_id . "'");



            echo $user_list_cnt;



            exit;



        }



    }


    function check_ssn_avail()
    {


        $socialSN = $this->input->post('ssn');


        if ($socialSN == '') {



            echo '2';



            exit;



        } else {


            $user_list_cnt = get_perticular_count('zc_user', " and social_secuirity_number='" . $socialSN . "'");


            echo $user_list_cnt;



            exit;



        }



    }


    function check_user_avail()
    {


        $user_name = $this->input->post('user_name');


        $user_list_cnt = get_perticular_count('zc_user', " and user_name='" . $user_name . "'");



        echo $user_list_cnt;



        exit;



    }


    function check_comp_avail()
    {


        $company_name = $this->input->post('company_name');


        if ($company_name == '') {



            echo '2';



            exit;


        } else {


            $user_list_cnt = get_perticular_count('zc_user', " and company_name='" . $company_name . "'");



            echo $user_list_cnt;



            exit;



        }



    }


    function check_bussname_avail()
    {


        $business_name = $this->input->post('business_name');


        if ($business_name == '') {



            echo '2';



            exit;


        } else {


            $user_list_cnt = get_perticular_count('zc_user', " and business_name='" . $business_name . "'");



            echo $user_list_cnt;



            exit;



        }



    }


    function check_vat_avail()
    {


        $vat_no = $this->input->post('vat_no');


        if ($vat_no == '') {



            echo '2';



            exit;


        } else {


            $user_list_cnt = get_perticular_count('zc_user', " and vat_number='" . $vat_no . "'");



            echo $user_list_cnt;



            exit;



        }



    }


    public function user_edit()
    {


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');



        }



        $data = array();



        $data['sitepage'] = "comon_signup";



        $data['countries'] = $this->usersm->get_country();


        $data['title'] = "user edit";


        $this->load->view("users/user_edit", $data);



    }


    public function acctivation()
    {



        $access_token = $this->uri->segment('4');



        $uid = $this->uri->segment('3');


        $user_cnt = get_perticular_count('zc_user', " and user_id='" . $uid . "'");


        if ($user_cnt != 0) {


            $verified_not = get_perticular_field_value('zc_user', 'verified', " and user_id='" . $uid . "'");


            if ($verified_not == 0) {


                $rs = $this->usersm->activate_user($access_token, $uid);


                if ($rs) {


                    $this->session->set_userdata('reg_id', $uid);


                    $user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");


                    $new_email_not = get_perticular_field_value('zc_user', 'receive_mail', " and user_id='" . $uid . "'");


                    $rs_new_preferenc = $this->usersm->new_preference($uid, $new_email_not);


                    if ($user_type == 1) {


                        $data['title'] = $this->lang->line('user_activation_successfull_msg');


                        $this->load->view('users/thanks_useract', $data);



                    }


                    if ($user_type == 2) {


                        $data['title'] = $this->lang->line('user_activation_successfull_msg');


                        $this->load->view('users/thanksowneract', $data);



                    }


                    if ($user_type == 3) {


                        $data['title'] = $this->lang->line('user_activation_successfull_msg');


                        $this->load->view('users/thanksagencyact', $data);



                    }



                }


            } else {


                $user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");


                if ($user_type == 1) {


                    $data['title'] = $this->lang->line('user_activation_successfull_msg');


                    $this->load->view('users/thanks_useract_alredy', $data);



                }


                if ($user_type == 2) {


                    $data['title'] = $this->lang->line('user_activation_successfull_msg');


                    $this->load->view('users/thanksowneract_alredy', $data);



                }


                if ($user_type == 3) {


                    $data['title'] = $this->lang->line('user_activation_successfull_msg');


                    $this->load->view('users/thanksagencyact_alredy', $data);



                }



            }


        } else {


            $data['title'] = "Activation unSuccessfull";


            $this->load->view('users/thanksagencyact_fail', $data);



        }


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');



        }


    }


    public function delUserForNotActvAftr72hrs()
    {



        $userIDarray = $this->usersm->UserListForNotActvAftr72hrs();


        if (!empty($userIDarray)) {


            $this->usersm->DeltheseUsersForNotActvAccAftr72hrs($userIDarray);



        }



    }


    function confirm_individual_reg()



    {


        $new_user = array();


        $new_arr = $this->session->all_userdata();


        if (isset($new_arr) && ($new_arr['access_token'] == "")) {



            redirect('/');



        }


        $new_user['user_type'] = '1';


        $new_user['user_name'] = $this->input->post('user_name');



        $new_user['first_name'] = $this->input->post('first_name');



        $new_user['last_name'] = $this->input->post('last_name');



        $new_user['contact_ph_no'] = $this->input->post('ph_no');



        //$new_user['date_of_birth'] = $this->input->post('date_of_birth');


        $new_user['date_of_birth'] = $this->input->post('reg_day') . '-' . $this->input->post('reg_month') . '-' . $this->input->post('reg_year');


        $new_user['city'] = $this->input->post('city');



        $new_user['country'] = $this->input->post('country');



        $new_user['email_id'] = $this->input->post('email');



        $new_user['password'] = $new_arr['password'];



        $new_user['gender'] = $this->input->post('gender');


        $new_user['access_token'] = $new_arr['access_token'];


        $new_user['agree_terms'] = $new_arr['agree_terms'];



        $new_user['receive_mail'] = $new_arr['receive_mail'];


        //echo '<pre>';print_r($new_user);die;


        $rs = $this->usersm->insertUser($new_user);


        if ($rs) {


            $new_data = array();


            $new_data['user_id'] = $rs;


            if ($this->input->post('language_nm') != '') {


                $new_data['language'] = $this->input->post('language_nm');



            }


            $this->db->insert('zc_user_preference', $new_data);


            $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");


            $new_user['user_name'] = '';



            $new_user['first_name'] = '';



            $new_user['last_name'] = '';



            $new_user['contact_ph_no'] = '';



            $new_user['date_of_birth'] = '';



            $new_user['city'] = '';



            $new_user['country'] = '';



            $new_user['email_id'] = '';



            $new_user['password'] = '';



            $new_user['gender'] = '';


            $new_user['access_token'] = '';


            $new_user['agree_terms'] = '';



            $new_user['receive_mail'] = '';


            $this->session->set_userdata($new_user);


            $open_page_flag['open_page_flag'] = 'yes';



            $this->session->set_userdata($open_page_flag);


            $email = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $rs . "'");


            $user_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $rs . "'") . ' ' . get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $rs . "'");


            $passwrd = get_perticular_field_value('zc_user', 'password', " and user_id='" . $rs . "'");


            $link = base_url() . 'users/acctivation/' . $rs . '/' . $passwrd;


            $details = array();



            //$details['from']= isset($default_email) ? $default_email : "no-reply@zapcasa.it";


            $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";


            //$details['to']=$email;


            $mail_to = $email;


            //$details['subject']= $this->lang->line('thanks_text_subject');


            $subject = $this->lang->line('thanks_text_subject');


            $msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">



				<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">



					<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>



				    <div style="border-bottom:1px solid #d1d1d1;">



				    	<img src="' . base_url() . 'assets/images/logo.png" alt="ZapCasa"/>



				    </div>



				    <div style="padding:15px;">



				    	<strong>' . $this->lang->line('thanks_hi') . ' ' . $user_name . '</strong><br>



				        <p>' . $this->lang->line('thanks_text_1') . '</p><br>



				        <p><strong>' . $this->lang->line('thanks_text_note') . '</strong> ' . $this->lang->line('thanks_text_2') . '. </p><br>



				        <p> ' . $this->lang->line('thanks_text_3') . ': </p>



				        <p><a href="' . $link . '"><strong> ' . $link . '</strong></a></p><br>



				        <p>' . $this->lang->line('thanks_text_4') . ',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>



				    </div>



				</div>



				</body>';



            //$details['message']= $msg;


            $body = $msg;


            sendemail($mail_from, $mail_to, $subject, $body, $cc = '');







            //send_mail($details);



            //$url='user/thanks/'.$rs;



            //redirect($url);



            //echo $rs;die("kkk");



            redirect('users/thanks');



        }



    }


    function edit_user_reg()
    {



        $data = array();


        $data['title'] = "user edit";


        $this->load->view('users/user_edit_reg', $data);



    }


    public function reg_owner()
    {



        $data['sitepage'] = "comon_signup";



        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {


            redirect('users/my_account');



        }



        $new_user['phone_2'] = '';



        $this->session->set_userdata($new_user);



        /*$captcha_lib=base_url().'/captcha/';



        $this->load->helper('captcha');



        $captcha_path=base_url();



        $vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



                        'img_width' => '380',



            'img_height' => 80,



                        'font_size' => 30,



                         'font_path' => FCPATH . 'captcha/fonts/verdana.ttf',



            'expiration' => 7200



        );



        $cap = create_captcha($vals);



        $data['captcha'] = array(



            'captcha_time' => $cap['time'],



            'ip_address' => $this->input->ip_address(),



            'word' => $cap['word']



        );







        $query = $this->db->insert_string('captcha', $data['captcha']);



        $this->db->query($query);



        $data['cap_img']=$cap['image'];*/


        if ($_COOKIE['lang'] == "it") {


            $data['provinces'] = $this->usersm->get_state_list_it();


        } else {


            $data['provinces'] = $this->usersm->get_state_list();



        }


        $this->load->view("users/reg_owner", $data);


    }


    public function alpha_dash_space($str)



    {



        //$this->CI->form_validation->set_message('alpha_dash_space', 'aaaaaaaaaaaaaa');



        return (preg_match("/s/", $str)) ? FALSE : TRUE;



    }


    public function pci_password($str)
    {


        return (preg_match('/^(?=^.{8,99}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[' . $special . '])(?!.*?(.)1{1,})^.*$/', $str)) ? TRUE : FALSE;



        //return ( ! preg_match("/^(d++(?! */))? *-? *(?:(d+) */ *(d+))?.*$/", $str)) ? FALSE : TRUE;



        //return FALSE;



    }


    function do_owner_reg()
    {


        if (!$this->input->post()) {



            redirect('/users/reg_owner');



        }



        $data['sitepage'] = "comon_signup";



        $this->load->library('form_validation');



        /////////store in session while first input/////////////////////////////////////



        $new_user['phone_2'] = $this->input->post('phone_2');



        $this->session->set_userdata($new_user);



        /////////session ends///////////////////////////////////////////



        if ($this->input->post('submit') ==/*'Register' || 'Registrati'*/



            $this->lang->line('reg_owner_button_register')



        ) {


            $SSNSetRuleTxt = ($_COOKIE['lang'] == 'english' ? 'Social Secuirity Number' : 'Codice Fiscale');


            $EmailIDSetRuleTxt = ($_COOKIE['lang'] == 'english' ? 'Email' : 'Email');


            $UserNameSetRuleTxt = ($_COOKIE['lang'] == 'english' ? 'User Name' : 'Username');







            //$this->form_validation->set_rules('captcha','Security Code','required');



            $this->form_validation->set_rules('user_name', $UserNameSetRuleTxt, 'required|min_length[5]|is_unique[zc_user.user_name]|xss_clean|callback_alpha_dash_space');



            $this->form_validation->set_rules('first_name', '�', 'required');



            $this->form_validation->set_rules('last_name', '�', 'required');



            $this->form_validation->set_rules('social_secuirity_number', $SSNSetRuleTxt, 'required|min_length[16]|is_unique[zc_user.social_secuirity_number]');



            $this->form_validation->set_rules('city', '�', 'required');



            $this->form_validation->set_rules('province', 'Province', 'required');



            $this->form_validation->set_rules('reg_day', '�', 'required');



            $this->form_validation->set_rules('reg_month', '�', 'required');



            $this->form_validation->set_rules('reg_year', '�', 'required');


            //$this->form_validation->set_rules('date_of_birth', 'Date of Birth', 'required');



            $this->form_validation->set_rules('street_address', 'Street Address', 'required');



            $this->form_validation->set_rules('street_no', '�', 'required');



            $this->form_validation->set_rules('zip', 'ZIP', 'required|numeric|xss_clean');



            $this->form_validation->set_rules('phone_1', '�', 'required|min_length[7]');



            $this->form_validation->set_rules('phone_2', '�', 'min_length[7]');



            $this->form_validation->set_rules('email', $EmailIDSetRuleTxt, 'required|valid_email|is_unique[zc_user.email_id]|matches[email2]');



            $this->form_validation->set_rules('email2', '�', 'required|valid_email');



            $this->form_validation->set_rules('password', '�', 'required|matches[pass2]|min_length[8]');


            //$this->form_validation->set_rules('password', 'Password', 'required|matches[pass2]|min_length[8]|alpha_numeric');



            $this->form_validation->set_rules('pass2', '�', 'required|min_length[8]');



            //$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required|min_length[8]|alpha_numeric');



            $this->form_validation->set_rules('agree_terms', '�', 'required');



            //print_r($_POST);



            if ($this->form_validation->run() == FALSE) {



                //$data['provinces']=$this->usersm->get_province();



                /*$captcha_lib=base_url().'/captcha/';



                $this->load->helper('captcha');



                $captcha_path=base_url();



                /* $vals = array(



                'img_path' => './captcha/',



                'img_url' => $captcha_lib,



                'img_width' => '280',



                'img_height' => 80,



                'expiration' => 7200



                );*/



                /*    $vals = array(



                'img_path' => './captcha/',



                'img_url' => $captcha_lib,



                'img_width' => '380',



                'img_height' => 80,



                'font_size' => 30,



                'font_path' => FCPATH . 'captcha/fonts/verdana.ttf',



                'expiration' => 7200



                );



                $cap = create_captcha($vals);



                $data['captcha'] = array(



                'captcha_time' => $cap['time'],



                'ip_address' => $this->input->ip_address(),



                'word' => $cap['word']



                );



                //print_r($data['captcha']);die;



                $query = $this->db->insert_string('captcha', $data['captcha']);



                $this->db->query($query);



                $data['cap_img']=$cap['image'];*/



                // $this->session->set_userdata($data['captcha']);



                //$data['provinces']=$this->usersm->get_state_list();


                if ($_COOKIE['lang'] == "it") {


                    $data['provinces'] = $this->usersm->get_state_list_it();


                } else {


                    $data['provinces'] = $this->usersm->get_state_list();



                }


                $province = set_value('province');


                if ($province) {


                    $data['city'] = $this->usersm->get_city($province, $_COOKIE['lang']);



                }


                $this->load->view('users/reg_owner', $data);


            } else {


                $new_user = array();


                $access_token = access_token();


                $new_user['user_type'] = '2';


                $new_user['user_name'] = $this->input->post('user_name');



                $new_user['first_name'] = $this->input->post('first_name');



                $new_user['last_name'] = $this->input->post('last_name');



                $new_user['social_secuirity_number'] = $this->input->post('social_secuirity_number');


                $new_user['date_of_birth'] = $this->input->post('reg_day') . '-' . $this->input->post('reg_month') . '-' . $this->input->post('reg_year');


                $new_user['city'] = stripslashes($this->input->post('city'));



                $new_user['province'] = stripslashes($this->input->post('province'));



                $new_user['street_address'] = $this->input->post('street_address');



                $new_user['street_no'] = $this->input->post('street_no');



                $new_user['zip'] = $this->input->post('zip');



                $new_user['phone_1'] = $this->input->post('phone_1');



                $new_user['phone_2'] = $this->input->post('phone_2');



                $new_user['email_id'] = $this->input->post('email');


                $new_user['password'] = $this->generate_password_string($access_token, $this->input->post('password'));


                $new_user['gender'] = $this->input->post('gender');


                $new_user['access_token'] = $access_token;


                $new_user['agree_terms'] = $this->input->post('agree_terms');



                $new_user['receive_mail'] = $this->input->post('receive_mail');


                $new_user['reg_day'] = $this->input->post('reg_day');



                $new_user['reg_month'] = $this->input->post('reg_month');



                $new_user['reg_year'] = $this->input->post('reg_year');


                $this->session->set_userdata($new_user);


                $ym = $this->session->all_userdata();


                redirect('users/owner_edit');


                /*$rs=$this->user_model->insert_user( $new_user );



                if($rs)



                {



                $email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");



                $user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");



                $passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");



                $link=base_url().'user/acctivation/'.$rs.'/'.$passwrd;



                $details=array();



                $details['from']="biswabijoymukherji@rediffmail.com";



                $details['to']=$email;



                $details['subject']="Congratulation";



                $details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";



                send_mail($details);



                redirect('user/thanksowner');



                }*/



            }


        } else {


            if ($_COOKIE['lang'] == "it") {


                $data['provinces'] = $this->usersm->get_state_list_it();


            } else {


                $data['provinces'] = $this->usersm->get_state_list();



            }



            //$data['provinces']=$this->usersm->get_province();



            /* $captcha_lib=base_url().'/captcha/';



            $this->load->helper('captcha');



            $captcha_path=base_url();



            $vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



            'img_width' => '380',



            'img_height' => 80,



            'font_size' => 30,



            'font_path' => FCPATH . 'captcha/fonts/verdana.ttf',



            'expiration' => 7200



            );



            $cap = create_captcha($vals);



            $data['captcha'] = array(



            'captcha_time' => $cap['time'],



            'ip_address' => $this->input->ip_address(),



            'word' => $cap['word']



            );



            //print_r($data['captcha']);die;



            $query = $this->db->insert_string('captcha', $data['captcha']);



            $this->db->query($query);



            $data['cap_img']=$cap['image']; */



            // $this->session->set_userdata($data['captcha']);



            // $data['provinces']=$this->usersm->get_state_list();


            $this->load->view('users/reg_owner', $data);


        }



    }


    public function owner_edit()
    {



        $data = array();


        $new_user = array();


        $new_arr = $this->session->all_userdata();



        //echo '<pre>';print_r($new_arr);die;


        if (isset($new_arr) && ($new_arr['access_token'] == "")) {


            redirect('/');



        }



        $data['sitepage'] = "comon_signup";



        $data['countries'] = $this->usersm->get_country();


        $data['title'] = "owner edit";


        /////for captcha///


        $captcha_lib = base_url() . '/captcha/';


        $this->load->helper('captcha');


        $captcha_path = base_url();


        $vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



            'img_width' => '380',



            'img_height' => 80,



            'font_size' => 30,



            'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



            'expiration' => 7200



        );



        $cap = create_captcha($vals);



        $data['captcha'] = array(



            'captcha_time' => $cap['time'],



            'ip_address' => $this->input->ip_address(),



            'word' => $cap['word']



        );



        $query = $this->db->insert_string('captcha', $data['captcha']);



        $this->db->query($query);


        $data['cap_img'] = $cap['image'];


        ////for captcha end////



        //$data['provinces']=$this->usersm->get_state_list();


        if ($_COOKIE['lang'] == 'it') {


            $data['provinces'] = $this->usersm->get_state_list_it();


        } else {


            $data['provinces'] = $this->usersm->get_state_list();



        }


        if ($new_arr['province']) {


            $data['city'] = $this->usersm->get_city(addslashes($new_arr['province']), $_COOKIE['lang']);



        }


        $this->load->view("users/owner_edit", $data);



    }


    function confirm_owner_reg()
    {


        $new_arr = $this->session->all_userdata();


        if ($new_arr['user_type'] == '') {



            redirect('/');



        }



        $data['sitepage'] = "comon_signup";



        ///echo 'ffffffffffffff';die;



        ///for captcha///


        $expiration = time() - 7200; // Two hour limit


        $this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);







        // Then see if a captcha exists:



        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";



        $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);



        $query = $this->db->query($sql, $binds);



        $row = $query->row();


        if ($row->count == 0) {


            $captcha_lib = base_url() . '/captcha/';



            $this->load->helper('captcha');


            $captcha_path = base_url();


            $vals = array(



                'img_path' => './captcha/',



                'img_url' => $captcha_lib,



                'img_width' => '380',



                'img_height' => 80,



                'font_size' => 30,



                'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



                'expiration' => 7200



            );



            $cap = create_captcha($vals);



            $data['captcha'] = array(



                'captcha_time' => $cap['time'],



                'ip_address' => $this->input->ip_address(),



                'word' => $cap['word']



            );



            //print_r($data['captcha']);die;



            $query = $this->db->insert_string('captcha', $data['captcha']);



            $this->db->query($query);


            $data['cap_img'] = $cap['image'];


            $data['captcha_err'] = $this->lang->line('reg_owner_you_submit_wrong_captcha');



            // $this->session->set_userdata($data['captcha']);



            //$data['provinces']=$this->usersm->get_state_list();


            if ($_COOKIE['lang'] == 'it') {


                $data['provinces'] = $this->usersm->get_state_list_it();


            } else {


                $data['provinces'] = $this->usersm->get_state_list();



            }


            $province = set_value('province');


            $data['city'] = $this->usersm->get_city($province, $_COOKIE['lang']);


            if ($province) {



                //$data['city']=$this->usersm->get_city(addslashes($province),$_COOKIE['lang']);



            }


            if ($this->input->post('social_secuirity_number') != '') {



                $data['new_arr'] = $this->input->post();



                //$data['new_arr'] = $this->session->all_userdata();



                $data['edit_mode'] = 1;



            }


            $this->load->view('users/owner_edit', $data);


        } else {     /////for captcha end////


            $new_user = array();


            $new_arr = $this->session->all_userdata();


            $new_user['user_type'] = '2';


            $new_user['user_name'] = $this->input->post('user_name');



            $new_user['first_name'] = $this->input->post('first_name');



            $new_user['last_name'] = $this->input->post('last_name');



            $new_user['social_secuirity_number'] = $this->input->post('social_secuirity_number');



            //$new_user['date_of_birth'] = $this->input->post('date_of_birth');


            $new_user['date_of_birth'] = $this->input->post('reg_day') . '-' . $this->input->post('reg_month') . '-' . $this->input->post('reg_year');


            $new_user['city'] = $this->input->post('city');



            $new_user['province'] = $this->input->post('province');



            $new_user['street_address'] = $this->input->post('street_address');



            $new_user['street_no'] = $this->input->post('street_no');



            $new_user['zip'] = $this->input->post('zip');



            $new_user['phone_1'] = $this->input->post('phone_1');



            $new_user['phone_2'] = $this->input->post('phone_2');



            $new_user['email_id'] = $this->input->post('email');



            $new_user['password'] = $new_arr['password'];


            $new_user['access_token'] = $new_arr['access_token'];


            $new_user['agree_terms'] = $new_arr['agree_terms'];



            $new_user['receive_mail'] = $new_arr['receive_mail'];



            //$new_user['about_me'] = $this->input->post('about_me');



            //echo '<pre>';print_r($new_user);die;



            //$file=$_FILES;



            //echo '<pre>';print_r($file);die;


            $owner_posting_limit = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='owner_posting_limit'");


            $new_user['posting_property_limit'] = $owner_posting_limit;


            //print_r($new_user);



            //die();


            $rs = $this->usersm->insertUser($new_user);



            //$this->upload_image_1('user_file_1',$rs);



            //$this->upload_image_2('user_file_2',$rs);


            if ($rs) {


                $new_data = array();


                $new_data['user_id'] = $rs;


                if ($this->input->post('language_nm') != '') {


                    $new_data['language'] = $this->input->post('language_nm');



                }


                $this->db->insert('zc_user_preference', $new_data);


                //echo "ssss";die();


                $new_user['user_name'] = '';


                $new_user['first_name'] = '';



                $new_user['last_name'] = '';



                $new_user['social_secuirity_number'] = '';



                $new_user['date_of_birth'] = '';



                $new_user['city'] = '';



                $new_user['province'] = '';



                $new_user['street_address'] = '';



                $new_user['street_no'] = '';



                $new_user['zip'] = '';



                $new_user['phone_1'] = '';



                $new_user['phone_2'] = '';



                $new_user['email_id'] = '';



                $new_user['password'] = '';


                $new_user['access_token'] = '';


                $new_user['agree_terms'] = '';



                $new_user['receive_mail'] = '';


                $this->session->set_userdata($new_user);


                $open_page_flag['open_page_flag'] = 'yes';



                $this->session->set_userdata($open_page_flag);


                $email = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $rs . "'");



                $user_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $rs . "'") . ' ' . get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $rs . "'");



                $passwrd = get_perticular_field_value('zc_user', 'password', " and user_id='" . $rs . "'");



                $link = base_url() . 'users/acctivation/' . $rs . '/' . $passwrd;



                $details = array();



                $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");



                //$details['from']= isset($default_email) ? $default_email : "no-reply@zapcasa.it";



                $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";



                //$details['to']=$email;



                $mail_to = $email;



                //$details['subject'] = $this->lang->line('thanks_owner_subject');



                $subject = $this->lang->line('thanks_text_subject');



                //$details['message']="<strong>Hi  ".$user_name.",</strong> <br/> <br/>You are receiving this email because you have requested to register on Zapcasa.it <br/> <br/><strong>Note: </strong>If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours. <br/><br/>  To activate your ZapCasa account, please click on the following link or copy and paste it into your browser: <br/> <strong> ".$link."</strong> <br/><br/>Regards,<br/><strong> www.zapcasa.it</strong>";



                //$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";



                $msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">



                                <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">



                                        <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>



                                    <div style="border-bottom:1px solid #d1d1d1;">



                                        <img src="'.base_url().'assets/images/logo.png" alt="ZapCasa"/>



                                    </div>



                                    <div style="padding:15px;">



                                        <strong>'.$this->lang->line('thanks_owner_hi').' '.$user_name.'</strong>



                                        <p>'.$this->lang->line('thanks_owner_text_1').'</p>



                                        <p><strong>'.$this->lang->line('thanks_owner_note').'</strong> '.$this->lang->line('thanks_owner_text_2').' </p>



                                        <p> '.$this->lang->line('thanks_owner_text_3').': </p>



                                        <p><a href="'.$link.'"><strong>'.$link.'</strong></a></p><br>



                                        <p>'.$this->lang->line('thanks_owner_text_4').',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>



                                    </div>



                                </div>







                                </body>';



                //$details['message']= $msg;



                $body = $msg;


                sendemail($mail_from, $mail_to, $subject, $body, $cc = '');



                //send_mail($details);



                //$url='user/thanksowner/'.$rs;



                //redirect($url);



                // echo '<pre>';print_r($rs);die;



                //redirect('users/thanksowner'/$rs);



                redirect('users/thanksowner');



            }



        }



    }


    public function thanksowner()
    {



        //echo "thanks...";die();



        $open_page_flag = $this->session->userdata('open_page_flag');



        if (isset($open_page_flag) && ($open_page_flag == "yes")) {


            $data['title'] = $this->lang->line('user_registration_successfull_title');


            $data['msg'] = $this->lang->line('user_your_account_successfully_created_msg');


            $data['before_activation'] = 1;



            $data['login_data'] = 1;



            //$open_page_flag['open_page_flag'] = '';



            //$this->session->set_userdata($open_page_flag);


            $this->load->view('users/thanksowner', $data);


        } else {



            redirect('/');



        }



    }


    public function reg_agency()
    {



        $data['sitepage'] = "comon_signup";


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');



        }



        $new_user['phone_2'] = $this->input->post('phone_2');



        $new_user['fax_no'] = $this->input->post('fax_no');



        $new_user['website'] = $this->input->post('website');



        $this->session->set_userdata($new_user);


        /* $captcha_lib=base_url().'/captcha/';



        $this->load->helper('captcha');



        $captcha_path=base_url();



        $vals = array(



        'img_path' => './captcha/',



        'img_url' => $captcha_lib,



        'img_width' => '380',



        'img_height' => 80,



        'font_size' => 30,



        'font_path' => FCPATH . 'captcha/fonts/verdana.ttf',



        'expiration' => 7200



        );



        $cap = create_captcha($vals);



        $data['captcha'] = array(



        'captcha_time' => $cap['time'],



        'ip_address' => $this->input->ip_address(),



        'word' => $cap['word']



        );



        $query = $this->db->insert_string('captcha', $data['captcha']);



        $this->db->query($query);



        $data['cap_img']=$cap['image']; */



        //$data['provinces']=$this->usersm->get_state_list();


        if ($_COOKIE['lang'] == "it") {


            $data['provinces'] = $this->usersm->get_state_list_it();


        } else {


            $data['provinces'] = $this->usersm->get_state_list();



        }



        $this->load->view('users/reg_agency', $data);



    }


    function do_agency_reg()
    {


        if (!$this->input->post()) {



            redirect('/users/reg_agency');



        }



        $this->load->library('form_validation');



        $new_user['phone_2'] = $this->input->post('phone_2');



        $new_user['fax_no'] = $this->input->post('fax_no');



        $new_user['website'] = $this->input->post('website');



        $this->session->set_userdata($new_user);


        if ($this->input->post('submit') ==/*'Register' || 'Registrati'*/
            $this->lang->line('reg_agency_button_register')
        ) {


            $UserNameSetRuleTxt = ($this->input->post('user_name') ? ($_COOKIE['lang'] == 'english' ? 'User Name' : 'Username') : '�');


            $BusNmSetRuleTxt = ($_COOKIE['lang'] == 'english' ? 'Business Name' : 'Nome azienda');


            $VatNoSetRuleTxt = ($_COOKIE['lang'] == 'english' ? 'VAT Number' : 'P. IVA');


            $EmailIDSetRuleTxt = ($this->input->post('email') ? ($_COOKIE['lang'] == 'english' ? 'Email' : 'Email') : '�');







            //$this->form_validation->set_rules('captcha','Security Code','required');



            $this->form_validation->set_rules('user_name', $UserNameSetRuleTxt, 'required|is_unique[zc_user.user_name]|xss_clean|callback_alpha_dash_space');



            $this->form_validation->set_rules('company_name', '�', 'required');



            $this->form_validation->set_rules('business_name', $BusNmSetRuleTxt, 'required|is_unique[zc_user.business_name]');



            $this->form_validation->set_rules('vat_number', $VatNoSetRuleTxt, 'required|is_unique[zc_user.vat_number]');



            $this->form_validation->set_rules('first_name', '�', 'required');



            $this->form_validation->set_rules('last_name', '�', 'required');



            $this->form_validation->set_rules('contact_ph_no', '�', 'required|min_length[7]');



            $this->form_validation->set_rules('province', 'Province', 'required');



            $this->form_validation->set_rules('city', 'City', 'required');



            $this->form_validation->set_rules('street_address', '�', 'required');



            $this->form_validation->set_rules('street_no', '�', 'required');



            $this->form_validation->set_rules('zip', '�', 'required');



            $this->form_validation->set_rules('phone_1', '�', 'required|min_length[7]');



            $this->form_validation->set_rules('phone_2', '�', 'min_length[7]');



            $this->form_validation->set_rules('fax_no', '�', 'min_length[7]');



            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[zc_user.email_id]');



            $this->form_validation->set_rules('email', $EmailIDSetRuleTxt, 'required|valid_email|is_unique[zc_user.email_id]|matches[email2]');



            $this->form_validation->set_rules('email2', '�', 'required');



            $this->form_validation->set_rules('password', '�', 'required|matches[pass2]');



            $this->form_validation->set_rules('pass2', '�', 'required');


            $this->form_validation->set_rules('agree_terms', '�', 'required');



            //print_r($_POST);


            if ($this->form_validation->run() == FALSE) {


                /* $captcha_lib=base_url().'/captcha/';



                $this->load->helper('captcha');



                $captcha_path=base_url();



                $vals = array(



                'img_path' => './captcha/',



                'img_url' => $captcha_lib,



                'img_width' => '380',



                'img_height' => 80,



                'font_size' => 30,



                'font_path' => FCPATH . 'captcha/fonts/verdana.ttf',



                'expiration' => 7200



                );



                $cap = create_captcha($vals);



                $data['captcha'] = array(



                'captcha_time' => $cap['time'],



                'ip_address' => $this->input->ip_address(),



                'word' => $cap['word']



                );



                //print_r($data['captcha']);die;



                $query = $this->db->insert_string('captcha', $data['captcha']);



                $this->db->query($query);



                // $this->session->set_userdata($data['captcha']);



                $data['cap_img']=$cap['image']; */



                // $data['provinces']=$this->usersm->get_state_list();


                if ($_COOKIE['lang'] == "it") {


                    $data['provinces'] = $this->usersm->get_state_list_it();


                } else {


                    $data['provinces'] = $this->usersm->get_state_list();



                }


                $province = set_value('province');


                if ($province) {


                    $data['city'] = $this->usersm->get_city($province, $_COOKIE['lang']);



                }


                $this->load->view('users/reg_agency', $data);


            } else {


                $new_user = array();


                $access_token = access_token();


                $new_user['user_type'] = '3';


                $new_user['user_name'] = $this->input->post('user_name');



                $new_user['company_name'] = $this->input->post('company_name');



                $new_user['business_name'] = $this->input->post('business_name');



                $new_user['vat_number'] = $this->input->post('vat_number');



                $new_user['first_name'] = $this->input->post('first_name');



                $new_user['last_name'] = $this->input->post('last_name');



                $new_user['contact_ph_no'] = $this->input->post('contact_ph_no');



                $new_user['province'] = stripslashes($this->input->post('province'));



                $new_user['city'] = stripslashes($this->input->post('city'));



                $new_user['street_address'] = $this->input->post('street_address');



                $new_user['street_no'] = $this->input->post('street_no');



                $new_user['zip'] = $this->input->post('zip');



                $new_user['phone_1'] = $this->input->post('phone_1');



                $new_user['phone_2'] = $this->input->post('phone_2');



                $new_user['fax_no'] = $this->input->post('fax_no');



                $new_user['website'] = $this->input->post('website');



                $new_user['email_id'] = $this->input->post('email');


                $new_user['password'] = $this->generate_password_string($access_token, $this->input->post('password'));


                $new_user['gender'] = $this->input->post('gender');


                $new_user['access_token'] = $access_token;


                $new_user['agree_terms'] = $this->input->post('agree_terms');



                $new_user['receive_mail'] = $this->input->post('receive_mail');



                $this->session->set_userdata($new_user);


                $ym = $this->session->all_userdata();


                //echo '<pre>';print_r($ym);die;



                redirect('users/agency_edit');



                /*$rs=$this->user_model->insert_user( $new_user );



                if($rs)



                {



                $email=get_perticular_field_value('zc_user','email_id'," and user_id='".$rs."'");



                $user_name=get_perticular_field_value('zc_user','first_name'," and user_id='".$rs."'").' '.get_perticular_field_value('zc_user','last_name'," and user_id='".$rs."'");



                $passwrd=get_perticular_field_value('zc_user','password'," and user_id='".$rs."'");



                $link=base_url().'user/acctivation/'.$rs.'/'.$passwrd;



                $details=array();



                $details['from']="biswabijoymukherji@rediffmail.com";



                $details['to']=$email;



                $details['subject']="Congratulation";



                $details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";



                send_mail($details);



                redirect('user/thanksagency');



                }*/



            }



        }



    }


    function agency_edit()
    {



        $data['sitepage'] = "comon_signup";


        $new_user = array();


        $new_arr = $this->session->all_userdata();



        //echo '<pre>';print_r($new_arr);die;


        if (isset($new_arr) && ($new_arr['access_token'] == "")) {


            redirect('/');



        }



        ////for captcha///


        $captcha_lib = base_url() . '/captcha/';


        $this->load->helper('captcha');


        $captcha_path = base_url();


        $vals = array(



            'img_path' => './captcha/',



            'img_url' => $captcha_lib,



            'img_width' => '380',



            'img_height' => 80,



            'font_size' => 30,



            'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



            'expiration' => 7200



        );


        $cap = create_captcha($vals);



        $data['captcha'] = array(



            'captcha_time' => $cap['time'],



            'ip_address' => $this->input->ip_address(),



            'word' => $cap['word']



        );


        $query = $this->db->insert_string('captcha', $data['captcha']);



        $this->db->query($query);


        $data['cap_img'] = $cap['image'];


        ////for captcha end///


        if ($_COOKIE['lang'] == 'it') {


            $data['provinces'] = $this->usersm->get_state_list_it();


        } else {


            $data['provinces'] = $this->usersm->get_state_list();



        }


        if ($new_arr['province']) {


            $data['city'] = $this->usersm->get_city(addslashes($new_arr['province']), $_COOKIE['lang']);



        }


        //$data['city']=$this->usersm->get_city($new_arr['province']);


        $data['title'] = "agency_edit";


        $this->load->view('users/agency_edit', $data);



    }


    function confirm_agency_reg()
    {


        if (!$this->input->post('captcha')) {



            //redirect(base_url());



        }


        $new_arr = $this->session->all_userdata();


        if ($new_arr['user_type'] == '') {



            redirect('/');



        }


        $data['sitepage'] = "comon_signup";



        //echo 'ffffffffffffff';die;



        ///for captcha///


        $expiration = time() - 7200;    //Two hour limit


        $this->db->query("DELETE FROM captcha WHERE captcha_time < " . $expiration);







        // Then see if a captcha exists:



        $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";



        $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);



        $query = $this->db->query($sql, $binds);



        $row = $query->row();


        if ($row->count == 0) {



            $captcha_lib = base_url() . '/captcha/';



            $this->load->helper('captcha');


            $captcha_path = base_url();


            $vals = array(



                'img_path' => './captcha/',



                'img_url' => $captcha_lib,



                'img_width' => '380',



                'img_height' => 80,



                'font_size' => 30,



                'font_path' => FCPATH . 'captcha/fonts/ADLER___.TTF',



                'expiration' => 7200



            );



            $cap = create_captcha($vals);



            $data['captcha'] = array(



                'captcha_time' => $cap['time'],



                'ip_address' => $this->input->ip_address(),



                'word' => $cap['word']



            );



            $query = $this->db->insert_string('captcha', $data['captcha']);



            $this->db->query($query);


            $data['cap_img'] = $cap['image'];


            $data['captcha_err'] = $this->lang->line('reg_agency_you_submit_wrong_captcha');



            ////for captcha end///


            $data['title'] = "agency_edit";


            //$data['provinces']=$this->usersm->get_state_list();


            $province = set_value('province');


            if ($_COOKIE['lang'] == 'it') {


                $data['provinces'] = $this->usersm->get_state_list_it();


            } else {


                $data['provinces'] = $this->usersm->get_state_list();



            }


            $province = set_value('province');


            $data['city'] = $this->usersm->get_city($province, $_COOKIE['lang']);


            if ($this->input->post('email') != '') {



                $data['new_arr'] = $this->input->post();



                //$data['new_arr'] = $this->session->all_userdata();



                $data['edit_mode'] = 1;



            }


            //$data['city']=$this->usersm->get_city($province);


            $this->load->view('users/agency_edit', $data);


            //redirect('users/agency_edit');


        } /////for captcha end////



        else {


            $new_user = array();


            $new_arr = $this->session->all_userdata();


            $new_user['user_type'] = '3';


            $new_user['user_name'] = $this->input->post('user_name');


            $new_user['company_name'] = $this->input->post('company_name');


            $new_user['business_name'] = $this->input->post('business_name');



            $new_user['vat_number'] = $this->input->post('vat_number');



            $new_user['first_name'] = $this->input->post('first_name');



            $new_user['last_name'] = $this->input->post('last_name');



            $new_user['contact_ph_no'] = $this->input->post('contact_ph_no');



            $new_user['province'] = mysql_real_escape_string($this->input->post('province'));



            $new_user['city'] = mysql_real_escape_string($this->input->post('city'));



            $new_user['street_address'] = $this->input->post('street_address');



            $new_user['street_no'] = $this->input->post('street_no');



            $new_user['zip'] = $this->input->post('zip');



            $new_user['phone_1'] = $this->input->post('phone_1');



            $new_user['phone_2'] = $this->input->post('phone_2');



            $new_user['fax_no'] = $this->input->post('fax_no');



            $new_user['website'] = $this->input->post('website');



            $new_user['email_id'] = $this->input->post('email');



            $new_user['password'] = $new_arr['password'];


            $new_user['access_token'] = $new_arr['access_token'];


            $new_user['agree_terms'] = $new_arr['agree_terms'];



            $new_user['receive_mail'] = $new_arr['receive_mail'];



            //$new_user['about_me'] = $this->input->post('about_me');


            //echo '<pre>';print_r($new_user);die;



            //$file=$_FILES;



            //echo '<pre>';print_r($file);die;


            $agency_posting_limit = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='agency_posting_limit'");


            $new_user['posting_property_limit'] = $agency_posting_limit;


            $rs = $this->usersm->insertUser($new_user);



            /*$this->upload_image_1('user_file_1',$rs);



            $this->upload_image_2('user_file_2',$rs);*/


            if ($rs) {


                $new_data = array();


                $new_data['user_id'] = $rs;


                if ($this->input->post('language_nm') != '') {


                    $new_data['language'] = $this->input->post('language_nm');



                }


                $this->db->insert('zc_user_preference', $new_data);


                $new_user['user_type'] = '';


                $new_user['user_name'] = '';



                $new_user['company_name'] = '';



                $new_user['business_name'] = '';



                $new_user['vat_number'] = '';



                $new_user['first_name'] = '';



                $new_user['last_name'] = '';



                $new_user['contact_ph_no'] = '';



                $new_user['province'] = '';



                $new_user['city'] = '';



                $new_user['street_address'] = '';



                $new_user['street_no'] = '';



                $new_user['zip'] = '';



                $new_user['phone_1'] = '';



                $new_user['phone_2'] = '';



                $new_user['fax_no'] = '';


                $new_user['website'] = '';


                $new_user['email_id'] = '';



                $new_user['password'] = '';


                $new_user['access_token'] = '';


                $new_user['agree_terms'] = '';



                $new_user['receive_mail'] = '';



                $new_user['about_me'] = '';


                $this->session->set_userdata($new_user);


                $open_page_flag['open_page_flag'] = 'yes';



                $this->session->set_userdata($open_page_flag);


                $email = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $rs . "'");


                $user_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $rs . "'") . ' ' . get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $rs . "'");


                $passwrd = get_perticular_field_value('zc_user', 'password', " and user_id='" . $rs . "'");


                $link = base_url() . 'users/acctivation/' . $rs . '/' . $passwrd;



                //$details=array();


                $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");


                $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";


                $mail_to = $email;


                $subject = $this->lang->line('thanks_text_subject');



                //$details['message']="<strong>Hi  ".$user_name.",</strong> <br/> <br/>You are receiving this email because you have requested to register on Zapcasa.it <br/> <br/><strong>Note: </strong>If you did not to apply for registration then do nothing, your email will be automatically deleted within 72 hours. <br/><br/>  To activate your ZapCasa account, please click on the following link or copy and paste it into your browser: <br/> <strong> ".$link."</strong> <br/><br/>Regards,<br/><strong> www.zapcasa.it</strong>";



                //$details['message']="Welcome  ".$user_name.",<br/> To activate your account please click on the following Link <br/>  <strong> ".$link."</strong>";


                $msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">



								<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">



										<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>



									<div style="border-bottom:1px solid #d1d1d1;">



										<img src="' . base_url() . 'assets/images/logo.png" alt="ZapCasa"/>



									</div>



									<div style="padding:15px;">



										<strong>' . $this->lang->line('thanks_agency_hi') . ' ' . $user_name . '</strong>



										<p>' . $this->lang->line('thanks_agency_text_1') . '</p>



										<p><strong>' . $this->lang->line('thanks_agency_text_note') . '</strong> ' . $this->lang->line('thanks_agency_text_2') . ' </p>



										<p> ' . $this->lang->line('thanks_agency_text_3') . ': </p>



										<p><a href="' . $link . '"><strong> ' . $link . '</strong></a></p><br>



										<p>' . $this->lang->line('thanks_agency_text_4') . ',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>



									</div>



								</div>







						</body>';


                // $details['message']= $msg;


                $body = $msg;


                sendemail($mail_from, $mail_to, $subject, $body, $cc = '');


                //send_mail($details);


                $url = 'users/thanksagency/' . $rs;


                redirect($url);


            }


        }


    }


    public function thanksagency()
    {



        $data['sitepage'] = "Thanks Agency";


        $open_page_flag = $this->session->userdata('open_page_flag');


        if (isset($open_page_flag) && ($open_page_flag == "yes")) {


            $data['title'] = $this->lang->line('user_registration_successfull_title');


            $data['msg'] = $this->lang->line('user_your_account_successfully_created_msg');


            $data['before_activation'] = 1;


            $data['login_data'] = 1;







            //$open_page_flag['open_page_flag'] = '';


            //$this->session->set_userdata($open_page_flag);


            $this->load->view('users/thanksagency', $data);



        } else {


            redirect('/');


        }


    }


    public function login()
    {



        $data = array();


        $data['msg'] = '';


        if ($this->input->post("email")) {


            $email = $this->input->post('email');


            $raw_password = $this->input->post('password');


            $user_id = get_perticular_field_value('zc_user', 'user_id', " and email_id='" . $email . "' or user_name='" . $email . "'");


            $access_token = get_perticular_field_value('zc_user', 'access_token', " and email_id='" . $email . "' or user_name='" . $email . "'");


            $pwd = $this->generate_password_string($access_token, $raw_password);



            $data['user_id'] = $user_id;


            $data['password'] = $pwd;


            $rs = get_perticular_count('zc_user', " and (email_id='" . $email . "' or user_name='" . $email . "') and password='" . $pwd . "'");


            if ($rs == 1) {



                $user_info = $this->usersm->check_login($data);


                if (count($user_info) > 0) {


                    if ($user_info[0]['status'] == '0') {


                        $this->session->set_userdata('blocked_note', $user_info[0]['blocked_note']);



                        echo 'invalid';


                    } else {


                        //echo "==========".$_COOKIE['lang'];


                        $this->session->set_userdata('user_id', $user_info[0]['user_id']);


                        echo 1;


                    }


                } else {


                    echo 0;


                }


            } else {


                echo 0;


            }


        } else {


            echo 0;


        }


    }


    public function my_account()
    {



        $data = array();


        $data['sitepage'] = "My Account";


        $data['msg'] = '';


        $data['title'] = "My Account";


        $uid = $this->session->userdata('user_id');


        $data['tab_icon'] = '1';


        $data['user_detail'] = $this->usersm->user_profile($uid);


        $user_type = $data['user_detail'][0]['user_type'];


        $data['provinces'] = $this->usersm->get_state_list();


        $data['city'] = $this->usersm->get_city($data['user_detail'][0]['province'], $_COOKIE['lang']);


        $data['countries'] = $this->usersm->get_country();


        if ($user_type == 1) {


            $this->load->view("users/user_profile", $data);


        } elseif ($user_type == 2) {


            $this->load->view("users/owner_profile", $data);


        } elseif ($user_type == 3) {


            $this->load->view("users/agency_profile", $data);


        } else {



            redirect('/');


        }


    }


    public function logout()
    {



        $this->do_logout();


    }


    private function do_logout()
    {


        $this->session->set_userdata('user_id', 0);


        $this->session->set_userdata('session_id', 0);







        $this->session->sess_destroy();


        redirect('/');


    }


    public function thanks()


    {


        //echo"hii"; die();


        $open_page_flag = $this->session->userdata('open_page_flag');


        if (isset($open_page_flag) && ($open_page_flag == "yes")) {


            $data['title'] = $this->lang->line('user_registration_successfull_title');


            $data['msg'] = $this->lang->line('user_your_account_successfully_created_msg');


            $data['before_activation'] = 1;


            $data['login_data'] = 1;







            $open_page_flag['open_page_flag'] = '';


            $this->session->set_userdata($open_page_flag);


            $open_page_flag = $this->session->userdata('open_page_flag');


            $this->load->view('users/thanks_user', $data);


        } else {


            redirect('/');


        }


    }


    function city_search()


    {


        $province = $this->input->post('name');


        $lang = $this->input->post('lang');


        if ($province && $lang) {


            //echo $lang ; exit();


            $rs = $this->usersm->get_city($province, $lang);


            //echo '<pre>';print_r($rs);die;


            if ($rs) {


                foreach ($rs as $key => $val) {


                    echo '<option value="' . $val . '">' . str_replace("'", "'", $val) . '</option>';



                }


            }


        }


    }


    public function my_preference()
    {


        $uid = $this->session->userdata('user_id');


        if ($uid == 0 || $uid == '') {



            redirect('/');


        } else {


            /*if($this->input->post('submit')=='Submit')*/


            if ($this->input->post('submit') != '') {


                //echo '<pre>';print_r($_POST);


                $new_data = array();


                $new_data['user_id'] = $uid;


                if ($this->input->post('send_me_email') != '') {


                    $new_data['send_me_email'] = $this->input->post('send_me_email');



                }


                if ($this->input->post('reply_msg') != '') {


                    $new_data['reply_msg'] = $this->input->post('reply_msg');



                }


                if ($this->input->post('email_alerts') != '') {


                    $new_data['email_alerts'] = $this->input->post('email_alerts');



                }


                if ($this->input->post('newsletter') != '') {


                    $new_data['newsletter'] = $this->input->post('newsletter');



                }


                if ($this->input->post('invisible') != '') {


                    $new_data['invisible'] = $this->input->post('invisible');



                }


                if ($this->input->post('my_address_display') != '') {


                    $new_data['my_address_display'] = $this->input->post('my_address_display');



                }


                if ($this->input->post('my_contact_info') != '') {


                    $new_data['my_contact_info'] = $this->input->post('my_contact_info');



                }


                if ($this->input->post('language_nm') != '') {


                    $new_data['language'] = $this->input->post('language_nm');



                }


                $rs = $this->usersm->pref_info($new_data);


                if ($rs) {


                    if ($this->input->post('language_nm') == "english") {



                        $this->lang->load('code', 'english');


                        $_COOKIE['lang'] = "english";


                    } else {


                        $this->lang->load('code', 'it');


                        $_COOKIE['lang'] == "it";


                    }


                    $msg = $this->lang->line('contact_us_text_user_email');


                    $this->session->set_flashdata('success', $msg);


                    redirect('users/my_preference');


                }


            } else {


                $data['pref_info'] = $this->usersm->get_pref_info();


                if ($data['pref_info'][0]['language'] != '') {



                    //setcookie('lang',$data['pref_info'][0]['language'], time() + (86400 * 30), "/");


                    if (isset($data['pref_info'][0]['language']) && ($data['pref_info'][0]['language'] == "english")) {


                        //$this->lang->load('code', 'english');


                    } else {


                        //$this->lang->load('code', 'it');


                    }


                }


                $this->load->view('users/preference', $data);


            }


        }


    }


    public function change_password()
    {


        $data['title'] = "change_password";


        if ($this->input->post('submit') != '') {


            $uid = $this->session->userdata('user_id');


            $access_token = get_perticular_field_value('zc_user', 'access_token', " and user_id='" . $uid . "'");


            $oldpass = get_perticular_field_value('zc_user', 'password', " and user_id='" . $uid . "'");


            $pwd = $this->generate_password_string($access_token, $this->input->post('oldpassword'));


            if ($oldpass != $pwd) {



                $this->session->set_flashdata('error', "Invalid current password, please try again!");


                redirect('users/change_password');


            } else if ($this->input->post('password') != $this->input->post('pass2')) {



                $this->session->set_flashdata('error', "Passwords does not match!");


                redirect('users/change_password');
                exit;


            } else {


                $password = $this->generate_password_string($access_token, $this->input->post('password'));


                $this->usersm->change_password($uid, $password);



                $msg = $this->lang->line('changed_password_success_message');


                $this->session->set_flashdata('success', $msg);


                redirect('users/change_password');


            }


        } else {


            $this->load->view('users/change_password', $data);



        }


    }


    public function forget_password()
    {


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');


        }


        //echo $pwd=get_random_password();


        $this->load->view('users/forgot_password');


    }


    public function change_pwd()
    {


        $email = $this->input->post('email');


        $user_id = get_perticular_field_value('zc_user', 'user_id', " and email_id='" . $email . "'");


        if ($user_id != '') {


            $user_status = get_perticular_field_value('zc_user', 'status', " and user_id='" . $user_id . "'");



            if ($user_status == '0') {


                redirect('users/blockedpage');


            } else {


                $raw_password = get_random_password();


                $access_token = get_perticular_field_value('zc_user', 'access_token', " and email_id='" . $email . "'");


                $pwd = $this->generate_password_string($access_token, $raw_password);


                $rs = $this->usersm->change_pwd($user_id, $pwd);







                //redirect('/');


                $user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $user_id . "'");


                if ($user_type == 3) {


                    $user_name = get_perticular_field_value('zc_user', 'company_name', " and user_id='" . $user_id . "'");


                } else {


                    $user_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $user_id . "'") . ' ' . get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $user_id . "'");



                }


                $msg = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">



						<div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">



							<div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>



							<div style="border-bottom:1px solid #d1d1d1;">



								<img src="' . base_url() . 'assets/images/logo.png" alt="ZapCasa"/>



							</div>



							<div style="padding:15px;">



								<strong>' . $this->lang->line('change-pwd-hi') . ' ' . $user_name . '</strong>



								<p>' . $this->lang->line('change-pwd-text-1') . '</p>



								<p><strong>' . $this->lang->line('change-pwd-note') . ':</strong> ' . $this->lang->line('change-pwd-text-2') . ' </p>



								<p><strong>' . $this->lang->line('change-pwd-text-3') . '</strong> ' . $this->lang->line('change-pwd-text-4') . '.</p>



								<p><strong>' . $this->lang->line('change-pwd-text-5') . '</strong> ' . $raw_password . '</p><br>



								<p>' . $this->lang->line('change-pwd-text-6') . ',<br><a href="http://www.zapcasa.it">www.zapcasa.it</a></p>



							</div>



						</div>



					</body>';


                $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");



                $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";


                $mail_to = $email;


                $subject = $this->lang->line('change-pwd-subject');







                $body = $msg;


                sendemail($mail_from, $mail_to, $subject, $body, $cc = '');











                $this->session->set_flashdata('success', '1');


                redirect('users/forget_password');


            }


        } else {


            $this->session->set_flashdata('error', '1');


            redirect('users/forget_password');


        }


    }


    public function check_email_avail_after_reg()
    {


        $uid = $this->session->userdata('user_id');


        $email_id = $this->input->post('email');


        $email_ids = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");


        if ($email_id == $email_ids) {



            echo 2;


            exit;


        } else {


            $user_list_cnt = get_perticular_count('zc_user', " and email_id='" . $email_id . "'");



            echo $user_list_cnt;


            exit;


        }


    }


    public function update_owner_reg()
    {


        $uid = $this->session->userdata('user_id');



        $new_user['city'] = mysql_real_escape_string($this->input->post('city'));


        $new_user['province'] = mysql_real_escape_string($this->input->post('province'));


        $new_user['street_address'] = $this->input->post('street_address');


        $new_user['street_no'] = $this->input->post('street_no');


        $new_user['zip'] = $this->input->post('zip');


        $new_user['phone_1'] = $this->input->post('phone_1');


        $new_user['phone_2'] = $this->input->post('phone_2');


        $new_user['email_id'] = $this->input->post('email');


        $new_user['location'] = $this->input->post('location');


        $new_user['about_me'] = mysql_real_escape_string($this->input->post('about_me'));


        //echo '<pre>';print_r($new_user);die;


        //$file=$_FILES;


        //echo '<pre>';print_r($file);die;


        $rs = $this->usersm->upadte_owner($new_user, $uid);


        $this->upload_image_1('user_file_1', $uid);


        $this->upload_image_2('user_file_2', $uid);



        $msg = $this->lang->line('user_info_success_message');


        $this->session->set_flashdata('success', $msg);


        redirect('users/manage_location');


    }


    public function upload_image_1($form_field_name, $uid)


    {


        $config['upload_path'] = './assets/uploads/';


        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG|jpeg|GIF';


        $config['encrypt_name'] = TRUE;


        $config['set_file_ext'] = TRUE;


        $this->load->library('upload', $config);


        if (!$this->upload->do_upload($form_field_name)) {


            $errors = $this->upload->display_errors();


        } else {


            ////////////////delete image first////////////////////


            $uid = $this->session->userdata('user_id');


            $dfile_name = get_perticular_field_value('zc_user', 'file_1', " and user_id='" . $uid . "'");


            $dfile = 'assets/uploads/' . $dfile_name;


            if (is_file($dfile))


                @unlink($dfile);


            $dfile_thmb = 'assets/uploads/thumb_92_82/' . $dfile_name;


            if (is_file($dfile_thmb))


                @unlink($dfile_thmb);


            /////////////delete image end//////////////////////////


            if (!is_dir('assets/uploads/thumb_92_82')) {


                mkdir('./assets/uploads/thumb_92_82', 0777, true);


            }


            $upload_data = $this->upload->data();


            $file_names = $upload_data['file_name'];


            $rs_update = $this->usersm->update_profile_1($file_names, $uid);


            $config = array(


                'source_image' => $upload_data['full_path'], //path to the uploaded image


                'new_image' => "assets/uploads/thumb_92_82/" . $file_names, //path to


                'maintain_ratio' => true,


                'width' => 128,


                'height' => 128


            );


            $this->image_lib->initialize($config);


            $this->image_lib->resize();


        }


    }


    public function upload_image_2($form_field_name, $uid)


    {


        $config['upload_path'] = './assets/uploads/';


        $config['allowed_types'] = 'gif|jpg|png|JPG|JPEG|PNG|jpeg|GIF';


        $config['encrypt_name'] = TRUE;


        $this->load->library('upload', $config);


        if (!$this->upload->do_upload($form_field_name)) {


            $errors = $this->upload->display_errors();


        } else {


            ////////////////delete image first////////////////////


            $uid = $this->session->userdata('user_id');


            $dfile_name = get_perticular_field_value('zc_user', 'file_2', " and user_id='" . $uid . "'");


            $dfile = 'assets/uploads/' . $dfile_name;


            if (is_file($dfile))


                @unlink($dfile);


            $dfile_thmb = 'assets/uploads/thumb_92_82/' . $dfile_name;


            if (is_file($dfile_thmb))


                @unlink($dfile_thmb);


            /////////////delete image end//////////////////////////


            if (!is_dir('assets/uploads/thumb_92_82')) {


                mkdir('./assets/uploads/thumb_92_82', 0777, true);


            }


            $upload_data = $this->upload->data();


            $file_names = $upload_data['file_name'];


            $rs_update = $this->usersm->update_profile_2($file_names, $uid);


            $config = array(


                'source_image' => $upload_data['full_path'], //path to the uploaded image


                'new_image' => "assets/uploads/thumb_92_82/" . $file_names, //path to


                'maintain_ratio' => true,


                'width' => 430,


                'height' => 300


            );


            $this->image_lib->initialize($config);


            $this->image_lib->resize();


        }


    }


    public function update_user_reg()
    {


        $uid = $this->session->userdata('user_id');



        $new_user['first_name'] = $this->input->post('first_name');


        $new_user['last_name'] = $this->input->post('last_name');


        $new_user['contact_ph_no'] = $this->input->post('ph_no');


        $new_user['date_of_birth'] = $this->input->post('reg_day') . '-' . $this->input->post('reg_month') . '-' . $this->input->post('reg_year');


        $new_user['city'] = $this->input->post('city');


        $new_user['country'] = $this->input->post('country');


        $new_user['email_id'] = $this->input->post('email');


        $rs = $this->usersm->upadte_user($new_user, $uid);


        $msg = $this->lang->line('user_info_success_message');


        $this->session->set_flashdata('success', $msg);


        redirect('users/manage_location');


    }


    public function update_agency_reg()


    {


        $uid = $this->session->userdata('user_id');


        $new_user['first_name'] = $this->input->post('first_name');


        $new_user['last_name'] = $this->input->post('last_name');


        $new_user['contact_ph_no'] = $this->input->post('contact_ph_no');


        $new_user['city'] = mysql_real_escape_string($this->input->post('city'));


        $new_user['province'] = mysql_real_escape_string($this->input->post('province'));


        $new_user['street_address'] = $this->input->post('street_address');


        $new_user['street_no'] = $this->input->post('street_no');


        $new_user['zip'] = $this->input->post('zip');


        $new_user['phone_1'] = $this->input->post('phone_1');


        $new_user['phone_2'] = $this->input->post('phone_2');


        $new_user['fax_no'] = $this->input->post('fax_no');


        $new_user['website'] = $this->input->post('website');


        $new_user['email_id'] = $this->input->post('email');


        $new_user['location'] = $this->input->post('location');


        $new_user['about_me'] = mysql_real_escape_string($this->input->post('about_me'));


        //echo '<pre>';print_r($new_user);die;


        //$file=$_FILES;


        //echo '<pre>';print_r($file);die;


        $rs = $this->usersm->upadte_agency($new_user, $uid);


        $this->upload_image_1('user_file_1', $uid);


        $this->upload_image_2('user_file_2', $uid);


        $msg = $this->lang->line('user_info_success_message');


        $this->session->set_flashdata('success', $msg);


        redirect('users/manage_location');


    }


    public function manage_location()


    {


        $uid = $this->session->userdata('user_id');


        //if( $uid != 0 ) {


        //	redirect('users/my_account');


        //}


        $data = array();


        $data['user_details'] = $this->usersm->user_profile($uid);


        $this->load->view('users/manage-location', $data);


    }


    public function update_location()


    {


        //$uid = $this->input->post('locupdatefor');


        $uid = $this->session->userdata('user_id');


        //$this->session->set_flashdata('msg', $msgdata);


        //redirect('users/my_account');


        if ($uid == 0 || $uid == '') {


            redirect('users/common_reg');


        } else {


            $user_type = get_perticular_field_value('zc_user', 'user_type', " and user_id='" . $uid . "'");


            if ($user_type = '1') {


                $new_user['latitude'] = (float)$this->input->post('promaplatitude');


                $new_user['longitude'] = (float)$this->input->post('promaplongitude');


                $property_ids = $this->usersm->edit_user_land($new_user, $uid);


                $msgdata = $this->lang->line('property_the_property_is_posted_successfully');


                $this->session->set_flashdata('msg', $msgdata);


                redirect('users/my_account');


            } else {


                $msgdata = $this->lang->line('property_please_login_to_add_your_property');


                $this->session->set_flashdata('error_user', $msgdata);


                redirect('users/common_reg');


            }


        }


    }


    public function remove1()
    {


        $uid = $this->session->userdata('user_id');


        $file_name = get_perticular_field_value('zc_user', 'file_1', " and user_id='" . $uid . "'");


        $file = 'assets/uploads/' . $file_name;


        if (is_file($file))



            @unlink($file);


        $file_thmb = 'assets/uploads/thumb_92_82/' . $file_name;


        if (is_file($file_thmb))



            @unlink($file_thmb);


        $this->usersm->delete_img($uid, $file = '1');


        redirect('users/my_account');


    }


    public function remove2()
    {


        $uid = $this->session->userdata('user_id');


        $file_name = get_perticular_field_value('zc_user', 'file_2', " and user_id='" . $uid . "'");


        $file = 'assets/uploads/' . $file_name;


        if (is_file($file))



            @unlink($file);


        $file_thmb = 'assets/uploads/thumb_92_82/' . $file_name;


        if (is_file($file_thmb))



            @unlink($file_thmb);


        $this->usersm->delete_img($uid, $file = '2');


        redirect('users/my_account');


    }


    public function blockedpage()
    {


        $uid = $this->session->userdata('user_id');


        if ($uid != 0) {



            redirect('users/my_account');


        }


        $data = array();


        $this->load->view("users/blockeduserprofile", $data);


    }


    public function delete_account()
    {


        $this->load->view('users/delete_acc');


    }


    public function del_acc()
    {


        $rs = $this->usersm->del_acc();


        if ($rs) {


            $this->session->set_userdata('user_id', 0);


            $this->session->set_userdata('session_id', 0);



            $this->session->sess_destroy();


            $open_page_flag['open_page_flag'] = 'yes';


            $this->session->set_userdata($open_page_flag);


            $this->load->view('users/thanks_del');


        }


    }


    //===========================================================================


    public function facebookLogin()


    {


        //print "<pre>";


        //print_r($_REQUEST);


        //die;


        if (isset($_REQUEST['email'])) {



            $email = $_REQUEST['email'];


            $fb_id = $_REQUEST['fb_id'];


            $birthday = $_REQUEST['birthday'];


            $gender = ucfirst(strtolower($_REQUEST['gender']));


            $first_name = $_REQUEST['first_name'];


            $last_name = $_REQUEST['last_name'];


            $pass = $_REQUEST['fb_id'];


            $access_token = access_token();


            $password = $this->generate_password_string($access_token, $pass);


            $chk_email = $this->usersm->pop_search("select * from zc_user where email_id = '" . $email . "'");


            if (count($chk_email) > 0 && $chk_email != '' && !is_null($chk_email)) {



                $this->session->set_userdata('user_id', $chk_email[0]['user_id']);


                //redirect(base_url().'user/my_account');


                echo 1;


            } else {


                $qry = "insert into zc_user set email_id = '" . $email . "', first_name = '" . $first_name . "', last_name = '" . $last_name . "', password = '" . $password . "'";


                $rs = $this->usersm->insert_update($qry);


                if ($rs > 0) {


                    $qry = "insert into zc_user_preference set user_id = '" . $rs . "'";


                    $rs1 = $this->usersm->insert_update($qry);


                }


                $this->session->set_userdata('user_id', $rs);


                $user_id = $rs;


                $email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $user_id . "'");


                $first_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $user_id . "'");


                $last_name = get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $user_id . "'");


                $details = array();


                $details['from'] = "no-reply@zapcasa.it";


                $details['to'] = /*$*/


                    $email;


                $details['subject'] = $this->lang->line('social_login_mail_subject');


                $link = '';


                $details['message'] = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">



							 <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">



							  <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>



								 <div style="border-bottom:1px solid #d1d1d1;">



								  <img src="' . base_url() . 'asset/images/logo.png" alt="ZapCasa"/>



								 </div>



								 <div style="padding:15px;">



								  <strong>' . $this->lang->line('new_mail-hi') . ' ' . $first_name . " " . $last_name . '</strong>



									 <p>' . $this->lang->line('social_login_mail_content') . ': </p>



									 <p>' . $pass . '</p>







									 <p><br>www.zapcasa.it</p>



								 </div>



							 </div>







							 </body>';


                //if( send_mail($details) )


                //{


                echo 1;


                //}


            }


        } else {


            $email = '';


            $fb_id = '';


            $birthday = '';


            $gender = '';


            $first_name = '';


            $last_name = '';


            //redirect('/');


            echo 2;


        }


    }



    //===========================================================================


    //===========================================================================


    public function google()


    {


        $google_client_id = '486148900452-hji9n8dt4ag1tnp4d15mkn96i4immnk2.apps.googleusercontent.com';


        $google_client_secret = 'jig6WKmBU7c-HXkhaUn_Es5B';


        $google_redirect_url = base_url() . 'user/google';


        $google_developer_key = '486148900452-hji9n8dt4ag1tnp4d15mkn96i4immnk2@developer.gserviceaccount.com';


        require_once dirname(__FILE__) . '/../../asset/src/Google_Client.php';


        require_once dirname(__FILE__) . '/../../asset/src/contrib/Google_Oauth2Service.php';







        $gClient = new Google_Client();


        $gClient->setApplicationName('fds-login');


        $gClient->setClientId($google_client_id);


        $gClient->setClientSecret($google_client_secret);


        $gClient->setRedirectUri($google_redirect_url);


        $gClient->setDeveloperKey($google_developer_key);


        $google_oauthV2 = new Google_Oauth2Service($gClient);


        $code = '';


        if (isset($_REQUEST['code'])) {



            $code = trim($_REQUEST['code']);


        }


        $gClient->authenticate($code);


        $token = $gClient->getAccessToken();


        if ($gClient->getAccessToken()) {



            $user = $google_oauthV2->userinfo->get();


            $id_google = $user['id'];


            $email = $user['email'];


            $first_name = $user['given_name'];


            $last_name = $user['family_name'];


            $username_array = explode('@', $email);


            $username = $username_array[0];


            $pass = $user['id'];


            $access_token = access_token();


            $password = $this->generate_password_string($access_token, $pass);


            $chk_email = $this->user_model->pop_search("select * from zc_user where email_id = '" . $email . "'");


            if (count($chk_email) > 0) {


                $user_id = $chk_email[0]['user_id'];


                $this->session->set_userdata('user_id', $user_id);


            } else {


                $qry = "insert into zc_user set email_id = '" . $email . "', first_name = '" . $first_name . "', last_name = '" . $last_name . "', password = '" . $password . "'";


                $rs = $this->user_model->insert_update($qry);


                $this->session->set_userdata('user_id', $rs);


                $user_id = $rs;


                $email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $user_id . "'");


                $first_name = get_perticular_field_value('zc_user', 'first_name', " and user_id='" . $user_id . "'");


                $last_name = get_perticular_field_value('zc_user', 'last_name', " and user_id='" . $user_id . "'");


                $details = array();


                $details['from'] = "no-reply@zapcasa.it";


                $details['to'] = $email;//"soumalya.arb@gmail.com";


                $details['subject'] = $this->lang->line('social_login_mail_subject');


                $link = '';


                $details['message'] = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">



							 <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">



							  <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>



								 <div style="border-bottom:1px solid #d1d1d1;">



								  <img src="' . base_url() . 'asset/images/logo.png" alt="ZapCasa"/>



								 </div>



								 <div style="padding:15px;">



								  <strong>' . $this->lang->line('new_mail-hi') . ' ' . $first_name . " " . $last_name . '</strong>



									 <p>' . $this->lang->line('social_login_mail_content') . ':</p>



									 <p>' . $pass . '</p>







									 <p><br>www.zapcasa.it</p>



								 </div>



							 </div>







							 </body>';


                //if( send_mail($details) )


                //{


                redirect(base_url() . 'user/my_account');


                //}


            }


        } else {


            $id_google = "";


            $email = "";


            $first_name = "";


            $last_name = "";


            $username_array = "";


            $username = "";


            redirect(base_url() . 'user/comon_signup');


        }


    }


    public function change_password_process()


    {


        $data['title'] = "change_password";


        $uid = $this->session->userdata('user_id');


        $access_token = get_perticular_field_value('zc_user', 'access_token', " and user_id='" . $uid . "'");


        $oldpass = get_perticular_field_value('zc_user', 'password', " and user_id='" . $uid . "'");


        $pwd = $this->generate_password_string($access_token, $this->input->post('oldpassword'));


        if ($oldpass != $pwd) {


            echo json_encode(FALSE);


        } else {


            echo json_encode(TRUE);


        }


    }


    public function check_same_password_process()


    {


        $data['title'] = "change_password";


        //$uid = $this->session->userdata('user_id');


        /*$access_token = get_perticular_field_value('zc_user', 'access_token', " and user_id='" . $uid . "'");



        $oldpass = get_perticular_field_value('zc_user', 'password', " and user_id='" . $uid . "'");



        $pwd = $this->generate_password_string($access_token, $this->input->post('oldpassword'));*/


        if ($this->input->post('oldpassword') == $this->input->post('password')) {


            echo json_encode(FALSE);


        } else {


            echo json_encode(TRUE);


        }


    }


    public function cron_test()
    {


        $to = 'parmarvikrantr@gmail.com';



        $subject = 'Test Cron Job';


        $message = "Hello testig message";


        $headers = 'From: Vikrant <vcodertest@gmail.com>' . PHP_EOL .


            'Reply-To: Vikrant <vcodertest@gmail.com>' . PHP_EOL .


            'X-Mailer: PHP/' . phpversion();


        if (!mail($to, $subject, $message, $headers)) {


            $Status = 0;



        }


    }


    public function daily_alert()
    {

//echo " In Function : ";

        $user_list = get_all_value('zc_user', " and status='1'");

#		echo "<pre>"; print_r($user_list);exit;

        foreach ($user_list as $k => $V) {

            # echo "<br> ==> ".$k." => ".

            $uid = $V['user_id'];
            $firstname = $V['first_name'];
            $lastname = $V['last_name'];

            $search_list = get_all_value('zc_save_search', " and saved_by_user_id='" . $uid . "' AND rec_option = 1 ");
            $user_preferences = get_perticular_field_value('	zc_user_preference', 'email_alerts', " and user_id='" . $uid . "'");
            $user_language = get_perticular_field_value('zc_user_preference', 'language', " and user_id='" . $uid . "'");

            // echo "<pre><br> => ".$uid; print_r($user_language);exit;

            if ($user_preferences == 1) {

                foreach ($search_list as $sk => $sV) {
                    $save_search_id = $sV['saved_id'];
                    #$rs=$this->usersm->get_details_saved_property( $save_search_id );
                    $rs = $this->usersm->get_details_saved_property($save_search_id);
                    if (count($rs) > 0) {
                        $data = "";
                        $location = isset($rs['location']) ? urlencode($rs['location']) : '';
                        $category_id = isset($rs['category']) ? $rs['category'] : '';
                        $add_neighbour_zip = isset($rs['add_neighbour_zip']) ? $rs['add_neighbour_zip'] : '';
                        $contract_id = isset($rs['contract_id']) ? $rs['contract_id'] : '';
                        $status = isset($rs['status']) ? $rs['status'] : '';
                        $property_category = isset($rs['property_category']) ? $rs['property_category'] : '';
                        $saved_property_name = $rs['saved_property_name'];
                        $min_price = isset($rs['min_price']) ? urlencode($rs['min_price']) : '';
                        $max_price = isset($rs['max_price']) ? urlencode($rs['max_price']) : '';
                        $min_room = isset($rs['min_room']) ? $rs['min_room'] : '';
                        $max_room = isset($rs['max_room']) ? $rs['max_room'] : '';
                        $for_luxury = isset($rs['for_luxury']) ? $rs['for_luxury'] : '';

                        if ($min_price == '0,00') {
                            $min_price = "";
                        }
                        if ($max_price == '0,00') {
                            $max_price = "";
                        }
                        if ($min_room == '0') {
                            $min_room = "";
                        }
                        if ($max_room == '0') {
                            $max_room = "";
                        }

                        $typology = isset($rs['typology']) ? $rs['typology'] : '';
                        $property_post_by_type = isset($rs['property_post_by_type']) ? $rs['property_post_by_type'] : '';
                        $bathrooms_no = isset($rs['bathrooms_no']) ? $rs['bathrooms_no'] : '';
                        $min_surface_area = isset($rs['min_surface_area']) ? $rs['min_surface_area'] : '';
                        $max_surface_area = isset($rs['max_surface_area']) ? $rs['max_surface_area'] : '';
                        $min_beds_no = isset($rs['min_beds_no']) ? $rs['min_beds_no'] : '';
                        $max_beds_no = isset($rs['max_beds_no']) ? $rs['max_beds_no'] : '';
                        $for_luxury = isset($rs['for_luxury']) ? $rs['for_luxury'] : '';
                        if ($min_surface_area == '0') {
                            $min_surface_area = "";
                        }
                        if ($max_surface_area == '0') {
                            $max_surface_area = "";
                        }
                        if ($min_beds_no == '0') {
                            $min_beds_no = "";
                        }
                        if ($max_beds_no == '0') {
                            $max_beds_no = "";
                        }
                        if ($bathrooms_no == '0') {
                            $bathrooms_no = "";
                        }

                        $kind = isset($rs['kind']) ? $rs['kind'] : '';
                        $energyclass = isset($rs['energyclass']) ? $rs['energyclass'] : '';
                        $heating = isset($rs['heating']) ? $rs['heating'] : '';
                        $parking = isset($rs['parking']) ? $rs['parking'] : '';
                        $furnished = isset($rs['furnished']) ? $rs['furnished'] : '';
                        $roommates = isset($rs['roommates']) ? $rs['roommates'] : '';
                        $occupation = isset($rs['occupation']) ? $rs['occupation'] : '';
                        $smokers = isset($rs['smokers']) ? $rs['smokers'] : '';
                        $pets = isset($rs['pets']) ? $rs['pets'] : '';
                        $elevator = isset($rs['elevator']) ? $rs['elevator'] : '';
                        $air_conditioning = isset($rs['air_conditioning']) ? $rs['air_conditioning'] : '';
                        $garden = isset($rs['garden']) ? $rs['garden'] : '';
                        $terrace = isset($rs['terrace']) ? $rs['terrace'] : '';
                        $balcony = isset($rs['balcony']) ? $rs['balcony'] : '';

                        if ($kind == '0') {
                            $kind = "";
                        }
                        if ($energyclass == '0') {
                            $energyclass = "";
                        }
                        if ($heating == '0') {
                            $heating = "";
                        }
                        if ($parking == '0') {
                            $parking = "";
                        }
                        if ($furnished == '0') {
                            $furnished = "";
                        }
                        if ($roommates == '0') {
                            $roommates = "";
                        }
                        if ($occupation == '0') {
                            $occupation = "";
                        }
                        if ($smokers == '0') {
                            $smokers = "";
                        }
                        if ($pets == '0') {
                            $pets = "";
                        }
                        if ($elevator == '0') {
                            $elevator = "";
                        }
                        if ($air_conditioning == '0') {
                            $air_conditioning = "";
                        }
                        if ($garden == '0') {
                            $garden = "";
                        }
                        if ($terrace == '0') {
                            $terrace = "";
                        }
                        if ($balcony == '0') {
                            $balcony = "";
                        }
                        $contract_type = "";
                        if ($contract_id != "") {
                            $contract_type = "&contract_type=" . $contract_id;
                        }

                        $status_id = "";
                        if ($status != "") {
                            $status_array = explode(",", $status);

                            for ($i = 0; $i < count($status_array); $i++) {
                                if ($i == 0) {
                                    $status_id = "&status[]=" . $status_array[$i];
                                } else {
                                    $status_id = $status_id . "&status[]=" . $status_array[$i];
                                }
                            }
                        }
                        $typology_id = "";
                        if ($typology != "") {
                            $typology_array = explode(",", $typology);
                            for ($i = 0; $i < count($typology_array); $i++) {
                                if ($i == 0) {
                                    $typology_id = "&typology[]=" . $typology_array[$i];
                                } else {
                                    $typology_id = $typology_id . "&typology[]=" . $typology_array[$i];
                                }
                            }
                        }
                        $property_post_by_id = "";
                        if ($property_post_by_type != "") {
                            $property_post_by_array = explode(",", $property_post_by_type);
                            for ($i = 0; $i < count($property_post_by_array); $i++) {
                                if ($i == 0) {
                                    $property_post_by_id = "&posted_by=" . $property_post_by_array[$i];
                                } else {
                                    $property_post_by_id = $property_post_by_id . "&posted_by=" . $property_post_by_array[$i];
                                }
                            }
                        }
                        $otherCriteria = "";
                        $elevator_cond = "";
                        if ($elevator != '0') {
                            $elevator_cond = "&elevator=" . $elevator;
                        }
                        $air_conditioning_cond = "";
                        if ($air_conditioning != '0') {
                            $air_conditioning_cond = "&air_conditioning=" . $air_conditioning;
                        }
                        $garden_cond = "";
                        if ($garden != '0') {
                            $garden_cond = "&garden=" . $garden;
                        }
                        $terrace_cond = "";
                        if ($terrace != '0') {
                            $terrace_cond = "&terrace=" . $terrace;
                        }
                        $balcony_cond = "";
                        if ($balcony != '0') {
                            $balcony_cond = "&balcony=" . $balcony;
                        }
                        $smokers_cond = "";
                        if ($smokers != '0') {
                            $smokers_cond = "&smokers=" . $smokers;
                        }
                        $pets_cond = "";
                        if ($pets != '0') {
                            $pets_cond = "&pets=" . $pets;
                        }
                        $otherCriteria = $elevator_cond . $air_conditioning_cond . $garden_cond . $terrace_cond . $balcony_cond . $smokers_cond . $pets_cond;
                        $queryStr = $contract_type . $property_post_by_id . $status_id;

                        $date = date('Y-m-d');

                        $data = "?location=$location&category_id=$category_id&add_neighbour_zip=$add_neighbour_zip&for_luxury=$for_luxury&property_cat=$property_category&min_price=$min_price&max_price=$max_price&min_beds_no=$min_beds_no&max_beds_no=$max_beds_no&min_room=$min_room&max_room=$max_room$typology_id&bathrooms_no=$bathrooms_no&min_surface_area=$min_surface_area&max_surface_area=$max_surface_area&kind=$kind&energyclass=$energyclass&heating=$heating&parking=$parking&roommates=$roommates&occupation=$occupation&furnished=$furnished$queryStr$otherCriteria&search=Search&category_search=$property_category&save_search_id=$save_search_id&save_search_name=$saved_property_name&posting_time='" . $date . "'";
                        //$data = "?location=$location&category_id=$category_id&add_neighbour_zip=$add_neighbour_zip&property_cat=$property_category&min_price=$min_price&max_price=$max_price&min_room=$min_room&max_room=$max_room$typology_id&bathrooms_no=$bathrooms_no&min_surface_area=$min_surface_area&max_surface_area=$max_surface_area&kind=$kind&energyclass=$energyclass&heating=$heating&parking=$parking&furnished=$furnished$queryStr$otherCriteria&search=Search&category_search=$property_category&save_search_id=$save_search_id&save_search_name=$saved_property_name&posting_time='".$date."'";
                        $searchPrms = trim(preg_replace('/[\s\t\n\r\s]+/', ' ', $data));


                        $url = 'http://www.zapcasa.it/zap-test3/users/common_search' . $data;

                        $ch = curl_init();
                        // Disable SSL verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        // Will return the response, if false it print the response
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        // Set the url
                        curl_setopt($ch, CURLOPT_URL, $url);
                        // Execute
                        $result = curl_exec($ch);
                        // Closing
                        curl_close($ch);
                        // Will dump a beauty json :3
                        //var_dump(json_decode($result, true));
                        $MasterData = json_decode($result, true);
                        //echo "<br> <pre>=== Master : ";
                        // print_r($MasterData);exit;

                        // echo $count;exit;
                        if (is_array($MasterData['property_details'])) {
                            $PDCount = count($MasterData['property_details']);
                        } else {
                            $PDCount = $MasterData['property_details'];
                        }

                        //print_r($MasterData);exit;
                        // echo "<br> <pre>=== Master : ";
                        // print_r($PDCount);
                        $MasterData = $MasterData['property_details'];
                        //echo "<br> <pre>=== Master : ";
                        // print_r($MasterData['property_details']);exit;
                        $TempOut = ''; 
                        
                        $max = count($MasterData);
                        for ($m = 0; $m < $max; $m++) {
                            $tempcls = '';
                            if ($m % 2 != 0) {
                                $tempcls = 'alt';
                            }
                            $desc = $MasterData[$m]['description'];
                            $s_description = substr($desc, 0, 20);
                            $category_id = $MasterData[$m]['category_id'];
                            if ($category_id == '6' || $category_id == '7') {
                                $first_segment = 'Business';
                            } elseif ($category_id == '1') {
                                $first_segment = 'Residential';
                            } elseif ($category_id == '3') {
                                $first_segment = 'Rooms';
                            } elseif ($category_id == '4') {
                                $first_segment = 'Land';
                            } elseif ($category_id == '5') {
                                $first_segment = 'Vacations';
                            }
                            $Rent = $MasterData[$m]['name'];
                            if ($user_language == 'it' && $Rent == 'Rent') {
                                $rentname = 'Affitto';
                            } else {
                                $rentname = 'Vendita';

                            }
                            if ($user_language == 'it' && $first_segment == 'Land') {
                                $catname = 'Terreni';
                            } else if ($user_language == 'it' && $first_segment == 'Business') {
                                $catname = 'Commerciale';

                            } else if ($user_language == 'it' && $first_segment == 'Residential') {
                                $catname = 'Residenziale';

                            } else if ($user_language == 'it' && $first_segment == 'Rooms') {
                                $catname = 'Stanze';

                            } else if ($user_language == 'it' && $first_segment == 'Vacations') {
                                $catname = 'Vacanze';

                            }
                            // $street=$MasterData[$m]['street_address'];
                            $TempOut .= '<li style="margin-left:0px;margin-top: 17px;list-style:none;" class="' . $tempcls . '">
                <div class="listingImg" style="float: left;position: relative;text-align: center;width: 138px;">
                        <a href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                        <img
                            src="http://www.zapcasa.it/zap-test3/assets/uploads/Property/Property' . $MasterData[$m]['property_id'] . '/thumb_92_82/' . $MasterData[$m]['main_img'] . '"
                            alt="" style="position: relative;text-align: center;width: 185px;background: #FFFFFF;border: 1px solid #E6E6E6; height: auto !important;width: 122px;padding: 3px;margin-right: 90px;position: relative;">
                        
                        <div class="listingShw"></div>
                    </a>

                    <div style="text-align:left; margin-left:6px;"> <br>
                        <br> <span
                            style="font-weight:bold; color:#5199D4;"> </span></div>
                     </div>
                <div class="listingContent" style="float: left; padding-left: 5px;width: 300px;padding-right: 8px;">
                        <h4 style="font-weight:bold;font-size:12px; margin-top: 0px;margin: 0px;">' . $this->lang->line('ref_code') . ': ' . CreateNewRefToken($MasterData[$m]['property_id'], $MasterData[$m]['name']) . '</h4>
                    <h2 class="hackerspace" style="color: #074D86;font-size: 15px;margin-top: -14px;text-decoration:none;font-weight: bold;margin:0px;">
                        <a style ="color: #074D86;font-size: 15px;margin-top: -14px;text-decoration:none;"href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                                                ' . $MasterData[$m]['name'] . '
                            For ' . $MasterData[$m]['typology_name'] . ' in ' . $MasterData[$m]['city_name'] . ', ' . $MasterData[$m]['province_code'] . '</a></h2>
                        
                    <div class="listAddress" style="/* float: left; */margin-bottom: -11px;width: 100%;margin-top: -12px;font-size: 10px;"><h3 style="margin:0px;"> ' . $MasterData[$m]['street_address'] . ', ' . $MasterData[$m]['street_no'] . ' - ' . $MasterData[$m]['zip'] . ' </h3>
                </div>
                    <p style="margin:0px;margin-top:5px;text-align:left;color: #686868;line-height: 1.3em;font-size: 13px;"> ' . $s_description . '<br></p> 

                    <div class="propFeatures" style="width:100%;">
                        <div style="float:left; margin-bottom: 18px;"><font style="color:#ED6B1F"><span
                                    style="color:#ED6B1F; font-weight:bold;float:left;">�' . $MasterData[$m]['price'] . '&nbsp;</span><span
                                    style="color:#000; font-weight:bold;float:left;">Per Month&nbsp;</span></font></div>
                        
                    </div>

                </div>
                <div style="display:table;border-bottom: 1px dashed #c4c4c4;width:100%;background:#888;min-height:25px;margin-top:10px;"> 
                    <div style="display:table-cell;vertical-align:middle;padding-left:5px;"> 
                    <strong style="font-weight:bold;">Published:</strong> ' . date('d', strtotime($MasterData[$m]['posting_time'])) . '-' . date('m', strtotime($MasterData[$m]['posting_time'])) . '-' . date('Y', strtotime($MasterData[$m]['posting_time'])) . '
                     </div> 
                     <div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;"> ' . $first_segment . ' </div> </div>
            </li>';
                            $TempOut_ITALIAN .= '<li style="margin-left:0px;margin-top: 17px;list-style:none;" class="' . $tempcls . '">
                <div class="listingImg" style="float: left;
    position: relative;
    text-align: center;
    width: 138px;">
                        <a href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                        <img
                            src="http://www.zapcasa.it/zap-test3/assets/uploads/Property/Property' . $MasterData[$m]['property_id'] . '/thumb_92_82/' . $MasterData[$m]['main_img'] . '"
                            alt="" style="position: relative;text-align: center;width: 185px;background: #FFFFFF;
    border: 1px solid #E6E6E6;
    height: auto !important;
    width: 122px;
    padding: 3px;
    margin-right: 90px;
    position: relative;
    ">
                        
                        <div class="listingShw"></div>
                    </a>

                    <div style="text-align:left; margin-left:6px;"> <br>
                        <br> <span
                            style="font-weight:bold; color:#5199D4;"> </span></div>
                     </div>
                <div class="listingContent" style="float: left;
    padding-left: 5px;
    width: 300px;
    
    padding-right: 8px;"><h4 style="font-weight:bold;font-size:12px; margin-top: 0px;margin: 0px;">Rif: ' . CreateNewRefToken($MasterData[$m]['property_id'], $MasterData[$m]['name']) . '</h4>

                    <h2 class="hackerspace" style="color: #074D86;
    font-size: 15px;
    margin-top: -14px;
    text-decoration:none;
    font-weight: bold;
    margin:0px;
    "><a style ="color: #074D86;
    font-size: 15px;
    margin-top: -14px;
    text-decoration:none;
    "href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                                                ' . $MasterData[$m]['typology_name_it'] . ' in ' . $rentname . '
                            a ' . $MasterData[$m]['city_name_it'] . ', ' . $MasterData[$m]['province_code'] . '</a></h2>
                        
                    <div class="listAddress" style="
    /* float: left; */
    
   margin-bottom: -11px;
    width: 100%;
    margin-top: -12px;
    font-size: 10px;"><h3 style="margin:0px;">
    ' . $MasterData[$m]['street_address'] . ', ' . $MasterData[$m]['street_no'] . ' - ' . $MasterData[$m]['zip'] . ' </h3></div>
                    <p style="text-align:left;color: #686868;
    line-height: 1.3em;
    
    font-size: 13px;margin:0px;margin-top:0px;"> ' . $s_description . '<br></p> 

                    <div class="propFeatures" style="width:100%;">
                        <div style="float:left; margin-bottom: 18px;"><font style="color:#ED6B1F"><span
                                    style="color:#ED6B1F; font-weight:bold;float:left;">�' . $MasterData[$m]['price'] . '&nbsp;</span><span
                                    style="color:#000; font-weight:bold;float:left;">Al mese&nbsp;</span></font></div>
                        
                    </div>

                </div>
                <div style="display:table;border-bottom: 1px dashed #c4c4c4;width:100%;background:#888;min-height:25px;margin-top:10px;"> 
                    <div style="display:table-cell;vertical-align:middle;padding-left:5px;"> 
                    <strong style="font-weight:bold;">Pubblicato:</strong> ' . date('d', strtotime($MasterData[$m]['posting_time'])) . '-' . date('m', strtotime($MasterData[$m]['posting_time'])) . '-' . date('Y', strtotime($MasterData[$m]['posting_time'])) . '
                     </div> 
                     <div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;"> ' . $catname . ' </div> </div>
            </li>';   
                        }
//echo "<br> ==> ".$TempOut;exit;

                        $OUTPUT_HTML = '



<div id="search_full" class="searchresult_box" style="width:100% !important;">
    <span style="font-weight:bold; font-size: 15px;">' . $this->lang->line('new_mail-hi') . ' ' . $firstname . " " . $lastname . ',</span></n>
    <br>
    <p style="font-weight:bold; font-size: 15px; margin-top: 5px;">Here are the properties added for your saved search = ' . $saved_property_name . '</p>
    
    <br>
    <div style="position: relative;">
        <ul style="padding: 0px;">
            ' . $TempOut . '
        </ul>
        <div style="margin-left:40%; margin-bottom:20px;">
                    

                        <a class="mainbt" href="' . base_url() . 'property/search' . $searchPrms . '" style="border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    color: #fff;
    float: left;
    margin-right: 10px;
    font-size: 16px;
   
    text-transform: uppercase;
    cursor: pointer;
    border: 1px solid #c95d00;
    padding: 0px 13px 0px 13px;
    height: 35px;
    line-height: 35px;
    text-decoration: none;
    background-color: #c95d00;
        margin-top:26px;">
                            View All
                        </a>

                        <div style="clear: both"></div>
                    
         </div>
    </div>
    
    <div class="clear"></div>
    <div class="clear"></div>
</div>
                        ';
                        $OUTPUT_HTML_ITALIAN = '



<div id="search_full" class="searchresult_box" style="width:100% !important;">
    <span style="font-weight:bold; font-size: 15px;">Ciao ' . $firstname . " " . $lastname . ',</span></n>
    <br>
    <p style="font-weight:bold; font-size: 15px; margin-top: 5px;">Ecco gli immobili aggiunti per la tua ricerca salvata = ' . $saved_property_name . '</p>
    
    <br>
    <div style="position: relative;">
        <ul style="padding:0px;">
            ' . $TempOut_ITALIAN . '
        </ul>
        <div style="margin-left:40%; margin-bottom:20px;">
            <a class="mainbt" href="' . base_url() . 'property/search' . $searchPrms . '" style="border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;color: #fff;float: left;margin-right: 10px;font-size: 16px;text-transform: uppercase;cursor: pointer;border: 1px solid #c95d00;padding: 0px 13px 0px 13px;height: 35px;line-height: 35px;text-decoration: none; background-color: #c95d00; margin-top: 26px;">
                            Vedi Tutti
                        </a>
                        <div style="clear: both"></div>
         </div>
    </div>
    
    <div class="clear"></div>
    <div class="clear"></div>
</div>
                        ';

                        #echo $OUTPUT_HTML;
                        //echo "<br> <pre>=== Master : ";
                        // print_r($PDCount);
                        //echo $PDCount;exit;
                        if ($PDCount > 0 && $user_language == 'english') {
                            $email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");
                            $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");
                            $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
                            $mail_to = $email_user;
                            //$mail_to      = 'vikas.maheshwari97@yahoo.in,parmarvikrantr@gmail.com';
                            $subject = $this->lang->line('daily_mail_subject');
                            $body = '';

                            $body = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
                                                <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
                                                    <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
                                                        <div style="border-bottom:1px solid #d1d1d1;">
                                                            <img src="' . base_url() . 'assets/images/logo.png" alt="logo"/>
                                                        </div>
                                                        <div style="">

                                                                ' . $OUTPUT_HTML . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </body>';

                            /* $headers = 'From: Zapcasa <>' . PHP_EOL .
                            'Reply-To: Vikrant <vikas.maheshwari1991.vm@gmail.com>' . PHP_EOL .
                            'X-Mailer: PHP/' . phpversion();*/
                            //echo $body;
                            sendemail($mail_from, $mail_to, $subject, $body, $cc = '');

                        } else if ($PDCount > 0 && $user_language == 'it') {
                            $email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");
                            $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");
                            $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
                            $mail_to = $email_user;
                            //$mail_to      = 'vikas.maheshwari97@yahoo.in,parmarvikrantr@gmail.com';
                            $subject = 'Alert messaggio giornalieri';
                            //echo $subject;exit;
                            $body = '';

                            $body = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
                                                <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
                                                    <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
                                                        <div style="border-bottom:1px solid #d1d1d1;">
                                                            <img src="' . base_url() . 'assets/images/logo.png" alt="logo"/>
                                                        </div>
                                                        <div style="">

                                                                ' . $OUTPUT_HTML_ITALIAN . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </body>';

                            /*$headers = 'From: Zapcasa <>' . PHP_EOL .
                            'Reply-To: Vikrant <vikas.maheshwari1991.vm@gmail.com>' . PHP_EOL .
                            'X-Mailer: PHP/' . phpversion();*/
                            // echo $body;
                            sendemail($mail_from, $mail_to, $subject, $body, $cc = '');
                        }

                    }


                }

            }

        }
    }

    public function weekly_alert()
    {

        $user_list = get_all_value('zc_user', " and status='1'");
        foreach ($user_list as $k => $V) {
            $uid = $V['user_id'];
            $firstname = $V['first_name'];
            $lastname = $V['last_name'];
            $search_list = get_all_value('zc_save_search', " and saved_by_user_id='" . $uid . "' AND rec_option = 2 ");
            $user_preferences = get_perticular_field_value('  zc_user_preference', 'email_alerts', " and user_id='" . $uid . "'");
            $user_language = get_perticular_field_value('zc_user_preference', 'language', " and user_id='" . $uid . "'");


            if ($user_preferences == 1 && $uid == 207) {

                foreach ($search_list as $sk => $sV) {
                    $save_search_id = $sV['saved_id'];
                    #$rs=$this->usersm->get_details_saved_property( $save_search_id );
                    $rs = $this->usersm->get_details_saved_property($save_search_id);
                    if (count($rs) > 0) {
                        $data = "";
                        $location = isset($rs['location']) ? urlencode($rs['location']) : '';
                        $category_id = isset($rs['category']) ? $rs['category'] : '';
                        $add_neighbour_zip = isset($rs['add_neighbour_zip']) ? $rs['add_neighbour_zip'] : '';
                        $contract_id = isset($rs['contract_id']) ? $rs['contract_id'] : '';
                        $status = isset($rs['status']) ? $rs['status'] : '';
                        $property_category = isset($rs['property_category']) ? $rs['property_category'] : '';
                        $saved_property_name = $rs['saved_property_name'];
                        $min_price = isset($rs['min_price']) ? urlencode($rs['min_price']) : '';
                        $max_price = isset($rs['max_price']) ? urlencode($rs['max_price']) : '';
                        $min_room = isset($rs['min_room']) ? $rs['min_room'] : '';
                        $max_room = isset($rs['max_room']) ? $rs['max_room'] : '';
                        $for_luxury = isset($rs['for_luxury']) ? $rs['for_luxury'] : '';

                        if ($min_price == '0,00') {
                            $min_price = "";
                        }
                        if ($max_price == '0,00') {
                            $max_price = "";
                        }
                        if ($min_room == '0') {
                            $min_room = "";
                        }
                        if ($max_room == '0') {
                            $max_room = "";
                        }

                        $typology = isset($rs['typology']) ? $rs['typology'] : '';
                        $property_post_by_type = isset($rs['property_post_by_type']) ? $rs['property_post_by_type'] : '';
                        $bathrooms_no = isset($rs['bathrooms_no']) ? $rs['bathrooms_no'] : '';
                        $min_surface_area = isset($rs['min_surface_area']) ? $rs['min_surface_area'] : '';
                        $max_surface_area = isset($rs['max_surface_area']) ? $rs['max_surface_area'] : '';
                        $min_beds_no = isset($rs['min_beds_no']) ? $rs['min_beds_no'] : '';
                        $max_beds_no = isset($rs['max_beds_no']) ? $rs['max_beds_no'] : '';
                        if ($min_surface_area == '0') {
                            $min_surface_area = "";
                        }
                        if ($max_surface_area == '0') {
                            $max_surface_area = "";
                        }
                        if ($min_beds_no == '0') {
                            $min_beds_no = "";
                        }
                        if ($max_beds_no == '0') {
                            $max_beds_no = "";
                        }
                        if ($bathrooms_no == '0') {
                            $bathrooms_no = "";
                        }

                        $kind = isset($rs['kind']) ? $rs['kind'] : '';
                        $energyclass = isset($rs['energyclass']) ? $rs['energyclass'] : '';
                        $heating = isset($rs['heating']) ? $rs['heating'] : '';
                        $parking = isset($rs['parking']) ? $rs['parking'] : '';
                        $furnished = isset($rs['furnished']) ? $rs['furnished'] : '';
                        $roommates = isset($rs['roommates']) ? $rs['roommates'] : '';
                        $occupation = isset($rs['occupation']) ? $rs['occupation'] : '';
                        $smokers = isset($rs['smokers']) ? $rs['smokers'] : '';
                        $pets = isset($rs['pets']) ? $rs['pets'] : '';
                        $elevator = isset($rs['elevator']) ? $rs['elevator'] : '';
                        $air_conditioning = isset($rs['air_conditioning']) ? $rs['air_conditioning'] : '';
                        $garden = isset($rs['garden']) ? $rs['garden'] : '';
                        $terrace = isset($rs['terrace']) ? $rs['terrace'] : '';
                        $balcony = isset($rs['balcony']) ? $rs['balcony'] : '';

                        if ($kind == '0') {
                            $kind = "";
                        }
                        if ($energyclass == '0') {
                            $energyclass = "";
                        }
                        if ($heating == '0') {
                            $heating = "";
                        }
                        if ($parking == '0') {
                            $parking = "";
                        }
                        if ($furnished == '0') {
                            $furnished = "";
                        }
                        if ($roommates == '0') {
                            $roommates = "";
                        }
                        if ($occupation == '0') {
                            $occupation = "";
                        }
                        if ($smokers == '0') {
                            $smokers = "";
                        }
                        if ($pets == '0') {
                            $pets = "";
                        }
                        if ($elevator == '0') {
                            $elevator = "";
                        }
                        if ($air_conditioning == '0') {
                            $air_conditioning = "";
                        }
                        if ($garden == '0') {
                            $garden = "";
                        }
                        if ($terrace == '0') {
                            $terrace = "";
                        }
                        if ($balcony == '0') {
                            $balcony = "";
                        }
                        $contract_type = "";
                        if ($contract_id != "") {
                            $contract_type = "&contract_type=" . $contract_id;
                        }

                        $status_id = "";
                        if ($status != "") {
                            $status_array = explode(",", $status);

                            for ($i = 0; $i < count($status_array); $i++) {
                                if ($i == 0) {
                                    $status_id = "&status[]=" . $status_array[$i];
                                } else {
                                    $status_id = $status_id . "&status[]=" . $status_array[$i];
                                }
                            }
                        }
                        $typology_id = "";
                        if ($typology != "") {
                            $typology_array = explode(",", $typology);
                            for ($i = 0; $i < count($typology_array); $i++) {
                                if ($i == 0) {
                                    $typology_id = "&typology[]=" . $typology_array[$i];
                                } else {
                                    $typology_id = $typology_id . "&typology[]=" . $typology_array[$i];
                                }
                            }
                        }
                        $property_post_by_id = "";
                        if ($property_post_by_type != "") {
                            $property_post_by_array = explode(",", $property_post_by_type);
                            for ($i = 0; $i < count($property_post_by_array); $i++) {
                                if ($i == 0) {
                                    $property_post_by_id = "&posted_by[]=" . $property_post_by_array[$i];
                                } else {
                                    $property_post_by_id = $property_post_by_id . "&posted_by[]=" . $property_post_by_array[$i];
                                }
                            }
                        }
                        $otherCriteria = "";
                        $elevator_cond = "";
                        if ($elevator != '0') {
                            $elevator_cond = "&elevator=" . $elevator;
                        }
                        $air_conditioning_cond = "";
                        if ($air_conditioning != '0') {
                            $air_conditioning_cond = "&air_conditioning=" . $air_conditioning;
                        }
                        $garden_cond = "";
                        if ($garden != '0') {
                            $garden_cond = "&garden=" . $garden;
                        }
                        $terrace_cond = "";
                        if ($terrace != '0') {
                            $terrace_cond = "&terrace=" . $terrace;
                        }
                        $balcony_cond = "";
                        if ($balcony != '0') {
                            $balcony_cond = "&balcony=" . $balcony;
                        }
                        $smokers_cond = "";
                        if ($smokers != '0') {
                            $smokers_cond = "&smokers=" . $smokers;
                        }
                        $pets_cond = "";
                        if ($pets != '0') {
                            $pets_cond = "&pets=" . $pets;
                        }
                        $otherCriteria = $elevator_cond . $air_conditioning_cond . $garden_cond . $terrace_cond . $balcony_cond . $smokers_cond . $pets_cond;
                        $queryStr = $contract_type . $property_post_by_id . $status_id;

                        //$date= " between date_sub(now(),INTERVAL 1 WEEK) and now()";
                        $date = date('Y-m-d');
                        //echo $date;
                        // echo "<pre>"; print_r($date);
                        // $data = "?location=$location&category_id=$category_id&add_neighbour_zip=$add_neighbour_zip&property_cat=$property_category&min_price=$min_price&max_price=$max_price&min_room=$min_room&max_room=$max_room$typology_id&bathrooms_no=$bathrooms_no&min_surface_area=$min_surface_area&max_surface_area=$max_surface_area&kind=$kind&energyclass=$energyclass&heating=$heating&parking=$parking&furnished=$furnished$queryStr$otherCriteria&search=Search&category_search=$property_category&save_search_id=$save_search_id&save_search_name=$saved_property_name&posting_time=$date&TYPE=WEEKLY";
                        $data = "?location=$location&category_id=$category_id&add_neighbour_zip=$add_neighbour_zip&for_luxury=$for_luxury&property_cat=$property_category&min_price=$min_price&max_price=$max_price&min_beds_no=$min_beds_no&max_beds_no=$max_beds_no&min_room=$min_room&max_room=$max_room$typology_id&bathrooms_no=$bathrooms_no&min_surface_area=$min_surface_area&max_surface_area=$max_surface_area&kind=$kind&energyclass=$energyclass&heating=$heating&parking=$parking&roommates=$roommates&occupation=$occupation&furnished=$furnished$queryStr$otherCriteria&search=Search&category_search=$property_category&save_search_id=$save_search_id&save_search_name=$saved_property_name&TYPE=WEEKLY&posting_time='" . $date . "'"; 
                        $searchPrms = trim(preg_replace('/[\s\t\n\r\s]+/', ' ', $data));
                        // echo "<pre>Data => "; print_r($data);exit;
                        # echo "<br> <pre> Param => "; print_r($searchPrms);exit;
                        $url = 'http://www.zapcasa.it/zap-test3/users/common_search' . $data;
                        $ch = curl_init();
                        // Disable SSL verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        // Will return the response, if false it print the response
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        // Set the url
                        curl_setopt($ch, CURLOPT_URL, $url);
                        // Execute
                        $result = curl_exec($ch);
                        #var_dump($ch);
                        #var_dump($result);
                        // Closing
                        curl_close($ch);
                        // Will dump a beauty json :3
                        //var_dump(json_decode($result, true));
                        $MasterData = json_decode($result, true);
                        //$count=$MasterData['propertyCount'];
                        echo "<br> <pre>=== Master : ";
                        print_r($$MasterData['property_details']);
                        exit;
                        if (is_array($MasterData['property_details'])) {
                            $PDCount = count($MasterData['property_details']);
                        } else {
                            $PDCount = $MasterData['property_details'];
                        }

                        $MasterData = $MasterData['property_details'];
                        #print_r($MasterData);
                        $TempOut = ''; 
                        
                        $max = count($MasterData);
                        for ($m = 0; $m < $max; $m++) {
                            $tempcls = '';
                            if ($m % 2 != 0) {
                                $tempcls = 'alt';
                            }
                            $desc = $MasterData[$m]['description'];
                            $s_description = substr($desc, 0, 20);
                            $category_id = $MasterData[$m]['category_id'];
                            if ($category_id == '6' || $category_id == '7') {
                                $first_segment = 'Business';
                            } elseif ($category_id == '1') {
                                $first_segment = 'Residential';
                            } elseif ($category_id == '3') {
                                $first_segment = 'Rooms';
                            } elseif ($category_id == '4') {
                                $first_segment = 'Land';
                            } elseif ($category_id == '5') {
                                $first_segment = 'Vacations';
                            }
                            $Rent = $MasterData[$m]['name'];
                            if ($user_language == 'it' && $Rent == 'Rent') {
                                $rentname = 'Affitto';
                            } else {
                                $rentname = 'Vendita';

                            }
                            if ($user_language == 'it' && $first_segment == 'Land') {
                                $catname = 'Terreni';
                            } else if ($user_language == 'it' && $first_segment == 'Business') {
                                $catname = 'Commerciale';

                            } else if ($user_language == 'it' && $first_segment == 'Residential') {
                                $catname = 'Residenziale';

                            } else if ($user_language == 'it' && $first_segment == 'Rooms') {
                                $catname = 'Stanze';

                            } else if ($user_language == 'it' && $first_segment == 'Vacations') {
                                $catname = 'Vacanze';

                            }
                            // $street=$MasterData[$m]['street_address'];


                            // $street=$MasterData[$m]['street_address'];
                            $TempOut .= '<li style="margin-left:0px;margin-top: 17px;list-style:none;" class="' . $tempcls . '">
                <div class="listingImg" style="float: left;position: relative;text-align: center;width: 138px;">
                        <a href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                        <img
                            src="http://www.zapcasa.it/zap-test3/assets/uploads/Property/Property' . $MasterData[$m]['property_id'] . '/thumb_92_82/' . $MasterData[$m]['main_img'] . '"
                            alt="" style="position: relative;text-align: center;width: 185px;background: #FFFFFF;border: 1px solid #E6E6E6; height: auto !important;width: 122px;padding: 3px;margin-right: 90px;position: relative;">
                        
                        <div class="listingShw"></div>
                    </a>

                    <div style="text-align:left; margin-left:6px;"> <br>
                        <br> <span
                            style="font-weight:bold; color:#5199D4;"> </span></div>
                     </div>
                <div class="listingContent" style="float: left; padding-left: 5px;width: 300px;padding-right: 8px;">
                        <h4 style="font-weight:bold;font-size:12px; margin-top: 0px;margin: 0px;">' . $this->lang->line('ref_code') . ': ' . CreateNewRefToken($MasterData[$m]['property_id'], $MasterData[$m]['name']) . '</h4>
                    <h2 class="hackerspace" style="color: #074D86;font-size: 15px;margin-top: -14px;text-decoration:none;font-weight: bold;margin:0px;">
                        <a style ="color: #074D86;font-size: 15px;margin-top: -14px;text-decoration:none;"href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                                                ' . $MasterData[$m]['name'] . '
                            For ' . $MasterData[$m]['typology_name'] . ' in ' . $MasterData[$m]['provience_name'] . ', ' . $MasterData[$m]['province_code'] . '</a></h2>
                        
                    <div class="listAddress" style="/* float: left; */margin-bottom: -11px;width: 100%;margin-top: -12px;font-size: 10px;"><h3 style="margin:0px;"> ' . $MasterData[$m]['street_address'] . ', ' . $MasterData[$m]['street_no'] . ' - ' . $MasterData[$m]['zip'] . ' </h3>
                </div>
                    <p style="margin:0px;margin-top:5px;text-align:left;color: #686868;line-height: 1.3em;font-size: 13px;"> ' . $s_description . '<br></p> 

                    <div class="propFeatures" style="width:100%;">
                        <div style="float:left; margin-bottom: 18px;"><font style="color:#ED6B1F"><span
                                    style="color:#ED6B1F; font-weight:bold;float:left;">�' . $MasterData[$m]['price'] . '&nbsp;</span><span
                                    style="color:#000; font-weight:bold;float:left;">Per Month&nbsp;</span></font></div>
                        
                    </div>

                </div>
                <div style="display:table;border-bottom: 1px dashed #c4c4c4;width:100%;background:#888;min-height:25px;margin-top:10px;"> 
                    <div style="display:table-cell;vertical-align:middle;padding-left:5px;"> 
                    <strong style="font-weight:bold;">Published:</strong> ' . date('d', strtotime($MasterData[$m]['posting_time'])) . '-' . date('m', strtotime($MasterData[$m]['posting_time'])) . '-' . date('Y', strtotime($MasterData[$m]['posting_time'])) . '
                     </div> 
                     <div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;"> ' . $first_segment . ' </div> </div>
            </li>';
                            $TempOut_ITALIAN .= '<li style="margin-left:0px;margin-top: 17px;list-style:none;" class="' . $tempcls . '">
                <div class="listingImg" style="float: left;
    position: relative;
    text-align: center;
    width: 138px;">
                        <a href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                        <img
                            src="http://www.zapcasa.it/zap-test3/assets/uploads/Property/Property' . $MasterData[$m]['property_id'] . '/thumb_92_82/' . $MasterData[$m]['main_img'] . '"
                            alt="" style="position: relative;text-align: center;width: 185px;background: #FFFFFF;
    border: 1px solid #E6E6E6;
    height: auto !important;
    width: 122px;
    padding: 3px;
    margin-right: 90px;
    position: relative;
    ">
                        
                        <div class="listingShw"></div>
                    </a>

                    <div style="text-align:left; margin-left:6px;"> <br>
                        <br> <span
                            style="font-weight:bold; color:#5199D4;"> </span></div>
                     </div>
                <div class="listingContent" style="float: left;
    padding-left: 5px;
    width: 300px;
    
    padding-right: 8px;"><h4 style="font-weight:bold;font-size:12px; margin-top: 0px;margin: 0px;">Rif: ' . CreateNewRefToken($MasterData[$m]['property_id'], $MasterData[$m]['name']) . '</h4>

                    <h2 class="hackerspace" style="color: #074D86;
    font-size: 15px;
    margin-top: -14px;
    text-decoration:none;
    font-weight: bold;
    margin:0px;
    "><a style ="color: #074D86;
    font-size: 15px;
    margin-top: -14px;
    text-decoration:none;
    "href="' . base_url() . '' . $first_segment . '/' . $MasterData[$m]['name'] . '-' . $MasterData[$m]['city_name'] . '-' . $MasterData[$m]['provience_name'] . '-' . $MasterData[$m]['property_id'] . '">
                                                ' . $MasterData[$m]['typology_name_it'] . ' in ' . $rentname . '
                            a ' . $MasterData[$m]['provience_name_it'] . ', ' . $MasterData[$m]['province_code'] . '</a></h2>
                        
                    <div class="listAddress" style="
    /* float: left; */
    
   margin-bottom: -11px;
    width: 100%;
    margin-top: -12px;
    font-size: 10px;"><h3 style="margin:0px;">
    ' . $MasterData[$m]['street_address'] . ', ' . $MasterData[$m]['street_no'] . ' - ' . $MasterData[$m]['zip'] . ' </h3></div>
                    <p style="text-align:left;color: #686868;
    line-height: 1.3em;
    
    font-size: 13px;margin:0px;margin-top:0px;"> ' . $s_description . '<br></p> 

                    <div class="propFeatures" style="width:100%;">
                        <div style="float:left; margin-bottom: 18px;"><font style="color:#ED6B1F"><span
                                    style="color:#ED6B1F; font-weight:bold;float:left;">�' . $MasterData[$m]['price'] . '&nbsp;</span><span
                                    style="color:#000; font-weight:bold;float:left;">Al mese&nbsp;</span></font></div>
                        
                    </div>

                </div>
                <div style="display:table;border-bottom: 1px dashed #c4c4c4;width:100%;background:#888;min-height:25px;margin-top:10px;"> 
                    <div style="display:table-cell;vertical-align:middle;padding-left:5px;"> 
                    <strong style="font-weight:bold;">Pubblicato:</strong> ' . date('d', strtotime($MasterData[$m]['posting_time'])) . '-' . date('m', strtotime($MasterData[$m]['posting_time'])) . '-' . date('Y', strtotime($MasterData[$m]['posting_time'])) . '
                     </div> 
                     <div style="display:table-cell;vertical-align:middle;text-align:right;padding-right:5px;"> ' . $catname . ' </div> </div>
            </li>';   
                        }
//echo "<br> ==> ".$TempOut;exit;

                        $OUTPUT_HTML = '



<div id="search_full" class="searchresult_box" style="width:100% !important;">
    <span style="font-weight:bold; font-size: 15px;">' . $this->lang->line('new_mail-hi') . ' ' . $firstname . " " . $lastname . ',</span></n>
    <br>
    <p style="font-weight:bold; font-size: 15px; margin-top: 5px;">Save Search Name = ' . $saved_property_name . '</p>
    
    <p style="font-weight:bold; font-size: 15px;">Here are the properties added for your saved search </p>
    <br>
    <div style="position: relative;">
        <ul style="padding: 0px;">
            ' . $TempOut . '
        </ul>
        <div style="margin-left:40%; margin-bottom:20px;">
                    

                        <a class="mainbt" href="' . base_url() . 'property/search' . $searchPrms . '" style="border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    color: #fff;
    float: left;
    margin-right: 10px;
    font-size: 16px;
   
    text-transform: uppercase;
    cursor: pointer;
    border: 1px solid #c95d00;
    padding: 0px 13px 0px 13px;
    height: 35px;
    line-height: 35px;
    text-decoration: none;
    background-color: #c95d00;
        margin-top:26px;">
                            View All
                        </a>

                        <div style="clear: both"></div>
                    
         </div>
    </div>
    
    <div class="clear"></div>
    <div class="clear"></div>
</div>
                        ';
                        $OUTPUT_HTML_ITALIAN = '



<div id="search_full" class="searchresult_box" style="width:100% !important;">
    <span style="font-weight:bold; font-size: 15px;">Ciao ' . $firstname . " " . $lastname . ',</span></n>
    <br>
    <p style="font-weight:bold; font-size: 15px; margin-top: 5px;">Nome della ricerca salvata = ' . $saved_property_name . '</p>
    
    <p style="font-weight:bold; font-size: 15px;">Ecco gli immobili aggiunti per la tua ricerca salvata </p>
    <br>
    <div style="position: relative;">
        <ul style="padding:0px;">
            ' . $TempOut_ITALIAN . '
        </ul>
        <div style="margin-left:40%; margin-bottom:20px;">
            <a class="mainbt" href="' . base_url() . 'property/search' . $searchPrms . '" style="border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;color: #fff;float: left;margin-right: 10px;font-size: 16px;text-transform: uppercase;cursor: pointer;border: 1px solid #c95d00;padding: 0px 13px 0px 13px;height: 35px;line-height: 35px;text-decoration: none; background-color: #c95d00; margin-top: 26px;">
                            Vedi Tutti
                        </a>
                        <div style="clear: both"></div>
         </div>
    </div>
    
    <div class="clear"></div>
    <div class="clear"></div>
</div>
                        ';

                        #echo $OUTPUT_HTML;
                        //echo "<br> <pre>=== Master : ";
                        // print_r($PDCount);
                        //echo $PDCount;exit;
                        if ($PDCount > 0 && $user_language == 'english') {
                            $email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");
                            $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");
                            $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
                            $mail_to = $email_user;
                            //$mail_to      = 'vikas.maheshwari97@yahoo.in,parmarvikrantr@gmail.com';
                            $subject = $this->lang->line('weekly_mail_subject');
                            $body = '';

                            $body = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
                                                <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
                                                    <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
                                                        <div style="border-bottom:1px solid #d1d1d1;">
                                                            <img src="' . base_url() . 'assets/images/logo.png" alt="logo"/>
                                                        </div>
                                                        <div style="">

                                                                ' . $OUTPUT_HTML . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </body>';

                            /* $headers = 'From: Zapcasa <>' . PHP_EOL .
                            'Reply-To: Vikrant <vikas.maheshwari1991.vm@gmail.com>' . PHP_EOL .
                            'X-Mailer: PHP/' . phpversion();*/
                            //echo $body;exit;
                            sendemail($mail_from, $mail_to, $subject, $body, $cc = '');

                        } else if ($PDCount > 0 && $user_language == 'it') {
                            $email_user = get_perticular_field_value('zc_user', 'email_id', " and user_id='" . $uid . "'");
                            $default_email = get_perticular_field_value('zc_settings', 'meta_value', " and meta_name='default_email'");
                            $mail_from = isset($default_email) ? $default_email : "no-reply@zapcasa.it";
                            $mail_to = $email_user;
                            //$mail_to      = 'vikas.maheshwari97@yahoo.in,parmarvikrantr@gmail.com';
                            $subject = 'Alert messaggio giornalieri';
                            //echo $subject;exit;
                            $body = '';

                            $body = '<body style="font-family:Century Gothic; color: #4c4d51; font-size:13px;">
                                                <div style="width:550px; margin:0 auto; border:1px solid #d1d1d1;">
                                                    <div style="background: none repeat scroll 0 0 #3d8ac1; height:4px; width: 100%;"></div>
                                                        <div style="border-bottom:1px solid #d1d1d1;">
                                                            <img src="' . base_url() . 'assets/images/logo.png" alt="logo"/>
                                                        </div>
                                                        <div style="">

                                                                ' . $OUTPUT_HTML_ITALIAN . '
                                                        </div>
                                                    </div>
                                                </div>
                                            </body>';

                            /*$headers = 'From: Zapcasa <>' . PHP_EOL .
                            'Reply-To: Vikrant <vikas.maheshwari1991.vm@gmail.com>' . PHP_EOL .
                            'X-Mailer: PHP/' . phpversion();*/
                            //echo $body;exit;
                            sendemail($mail_from, $mail_to, $subject, $body, $cc = '');
                        }

                    }


                }

            }

        }
    }

    public function common_search($catname = '')
    {
        #echo "aaaaa";exit;
        $data = array();
        $filters = array();
        $category_id = '0';
        $contract_type = 'all';
        $posted_by = 'all';
        $location = '';
        $min_price = '0';
        $max_price = '0';
        $min_room = '0';
        $max_room = '0';
        $status = '';
        $pcat_id = '0';
        $segments = '';
        $segments_it = '';
        $parentCatname = '';
        $parentCatname_it = '';
        $for_typology = '';
        $for_luxury = '';
        $for_business = '';
        if ($this->input->get('for_typology')) {
            $for_typology = $this->input->get('for_typology');
        }
        if ($this->input->get('category_id')) {
            $category_id = $this->input->get('category_id');
        }
        if ($this->input->get('contract_type')) {
            $contract_type = $this->input->get('contract_type');
        }
        if ($this->input->get('posted_by')) {
            $posted_by = $this->input->get('posted_by');
        }
        if ($this->input->get('location')) {
            $location = $this->input->get('location');
        }
        if ($this->input->get('min_price') /*&& $this->input->get('min_price') > 0*/) {
            $min_price = $this->input->get('min_price');
        }
        if ($this->input->get('max_price') /*&& $this->input->get('max_price') > 0*/) {
            $max_price = $this->input->get('max_price');
        }
        if ($this->input->get('min_room') /*&& $this->input->get('min_room') > 0*/) {
            $min_room = $this->input->get('min_room');
        }
        if ($this->input->get('max_room') /*&& $this->input->get('max_room') > 0*/) {
            $max_room = $this->input->get('max_room');
        }
        if ($this->input->get('status')) {
            $status = $this->input->get('status');
        }
        if ($this->input->get('for_business')) {
            $for_business = $this->input->get('for_business');
        }
        if ($this->input->get('for_luxury')) {
            $for_luxury = $this->input->get('for_luxury');
        }
        if ($this->input->get('posting_time')) {
            $posting_time = $this->input->get('posting_time');
        }
        if ($this->input->get('TYPE') == 'WEEKLY') {
            $TYPE = $this->input->get('TYPE');
        }

        $order_option = '';
        if ($this->input->get('order_option')) {
            $order_option = $this->input->get('order_option');
        }
        if ($catname != '') {
            $category = getCategoryDetails(" and short_code = '" . $catname . "'");
        } else if ($for_business != '') {
            $category = getCategoryDetails(" and short_code = '" . $for_business . "'");
        } else if ($for_luxury != '') {
            $category = getCategoryDetails(" and short_code = '" . $for_luxury . "'");
        } else {
            if ($for_typology != '') {
                $category = getCategoryDetails(" and category_id = " . $for_typology);
            } else {
                $category = getCategoryDetails(" and category_id = " . $category_id);
            }
        }

        if (count($category) > 0) {
            if ($for_luxury != '') {
                $category_id = 10;
                $pcat_id = 10;
            } else {
                $category_id = $category[0]['category_id'];
                $pcat_id = $category[0]['parent_id'];
            }
            $category_code = $category[0]['short_code'];
            $segments = $category[0]['name'];
            $segments_it = $category[0]['name_it'];
            if ($pcat_id != 0) {
                $pcat = getCategoryDetails(" and category_id = " . $pcat_id);
                $parentCatname = $pcat[0]['name'];
                $parentCatname_it = $pcat[0]['name_it'];
            }
        }
        $filters['category_id'] = $category[0]['category_id'];
        $filters['contract_type'] = $this->input->get('contract_type');
        $filters['posted_by'] = $this->input->get('posted_by');
        $filters['min_price'] = $this->input->get('min_price');
        $filters['max_price'] = $this->input->get('max_price');
        $filters['min_room'] = $this->input->get('min_room');
        $filters['max_room'] = $this->input->get('max_room');
        $filters['status'] = $this->input->get('status');
        $filters['location'] = $this->input->get('location');

        $filters['status'] = $this->input->get('status');
        $filters['typology'] = $this->input->get('typology');
        $filters['bathrooms_no'] = $this->input->get('bathrooms_no');
        $filters['min_surface_area'] = $this->input->get('min_surface_area');
        $filters['max_surface_area'] = $this->input->get('max_surface_area');
        $filters['min_beds_no'] = $this->input->get('min_beds_no');
        $filters['max_beds_no'] = $this->input->get('max_beds_no');
        $filters['kind'] = $this->input->get('kind');
        $filters['energyclass'] = $this->input->get('energyclass');
        $filters['heating'] = $this->input->get('heating');
        $filters['parking'] = $this->input->get('parking');
        $filters['furnished'] = $this->input->get('furnished');
        $filters['roommates'] = $this->input->get('roommates');
        $filters['occupation'] = $this->input->get('occupation');
        $filters['smokers'] = $this->input->get('smokers');
        $filters['pets'] = $this->input->get('pets');
        $filters['elevator'] = $this->input->get('elevator');
        $filters['air_conditioning'] = $this->input->get('air_conditioning');
        $filters['garden'] = $this->input->get('garden');
        $filters['terrace'] = $this->input->get('terrace');
        $filters['balcony'] = $this->input->get('balcony');
        $filters['posting_time'] = $this->input->get('posting_time');
        $filters['TYPE'] = $this->input->get('TYPE');
        $filters['order_option'] = $order_option;

        $filters['parent_id'] = $pcat_id;

        $filters['for_business'] = $for_business;
        $filters['for_luxury'] = $for_luxury;

        //Pagination
        $page = (int)(!isset($_GET['page']) ? 1 : $_GET['page']);
        $page = ($page == 0 ? 1 : $page);
        //limit in each page
        $perpage = 10;
        $startpoint = ($page * $perpage) - $perpage;

        $uid = $this->session->userdata('user_id');

        if ($uid == 0 || $uid == '') {
            $data['property_details'] = $this->propertym->getProeprtiesByFilter($filters, $startpoint, $perpage);
        } else {
            if ($this->input->get('save_search_id')) {
                $filters['save_search_id'] = $this->input->get('save_search_id');
            }
            $this->session->set_userdata('new_search', $filters);
            $data['property_details'] = $this->propertym->getProeprtiesByFilter($filters, $startpoint, $perpage);
        }
        /*echo "<pre>";
        var_dump($data['property_details']);
        die();*/

        if (!strpos($_SERVER['QUERY_STRING'], "page=") === false) {
            $QUERY_STRING = str_replace("&page=" . $_GET['page'], "", $_SERVER['QUERY_STRING']);
        } else {
            $QUERY_STRING = $_SERVER['QUERY_STRING'];
        }

        if ($QUERY_STRING == '') {
            $QUERY_STRING = 'category_id=' . $category_id;
        }

        $path = base_url() . 'property/search?' . $QUERY_STRING . '&page=';
        $cureentPage = $_GET['page'];
        $data['pagination'] = $this->propertym->PropertyListingPages($filters, $perpage, $path, $cureentPage, 'pagination');
        $data['propertyCount'] = $this->propertym->PropertyListingPages($filters, $perpage, $path, $cureentPage, 'propertycounter');

        $data['category_id'] = $category_id;
        $data['contract_type'] = $contract_type;
        $data['posted_by'] = $posted_by;
        $data['min_price'] = $min_price;
        $data['max_price'] = $max_price;
        $data['min_room'] = $min_room;
        $data['max_room'] = $max_room;
        $data['status'] = $status;
        $data['location'] = $location;
        $data['parent_id'] = $pcat_id;

        if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] == "english")) {
            $data['search_title'] = $segments;
            $data['parentCatname'] = $parentCatname;
        } else {
            $data['search_title'] = $segments_it;
            $data['parentCatname'] = $parentCatname_it;
        }
#echo "<pre>"; print_r($data);exit;
        echo json_encode($data);
        exit;
    }

    public function rangeWeek($datestr)
    {
        date_default_timezone_set(date_default_timezone_get());
        $dt = strtotime($datestr);
        $res['start'] = date('N', $dt) == 1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
        $res['end'] = date('N', $dt) == 7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
        return $res;
    }

}

?>