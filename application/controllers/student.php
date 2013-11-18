<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once 'application/controllers/base_page.php';// include_once '../page_base.php';

class Student extends Base_page {
    var $current_controller = "student";
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('StudentModel');
    }
    
    function index($group_id = null)
    {
        if ( !isset($group_id) ) {
            $this->__show_groups();
        } else {
            $this->__show_students($group_id);
        }
    }
    /**
     * Show the list of groups
     */
    function __show_groups()
    {
        $data['groups'] = $this->StudentModel->get_groups();
        $this->__show("Группы", "Группы", "", "student/groups", $data);
    }
    
    /**
     * Show the list of student of group with id
     * 
     * @param integer $group_id
     */
    function __show_students($group_id) 
    {
        if ( ! ($data['group'] = $this->StudentModel->get_group($group_id)) ) {
           $this->__redirect_to_index();
        }
        $data['students'] = $this->StudentModel->get_students($group_id);
        // sort by family
        usort($data['students'], function ($s1, $s2) { 
            return $s1->family===$s2->family?0:$s1->family>$s2->family?+1:-1;
        } );
        $this->__show("{$data['group']->title}",
                "{$data['group']->title}",
                "", "student/students", $data);       
    }
    
    function get_marks($student_id) {
        $this->StudentModel->get_marks();
    }
        
    
}
