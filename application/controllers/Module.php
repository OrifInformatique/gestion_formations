<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Module controller
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */

class Module extends MY_Controller {
    /* MY_Controller variables definition */
    protected $access_level = "*";

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(["module_subject_model", "formation_module_group_model"]);
        $this->load->helper(['form', 'url']);
    }

    /**
     * Displays the list of modules
     */
    public function index(){
        $groups_tree = $this->formation_module_group_model->get_tree();
        $outputs = array(
            'groups' => $this->formation_module_group_model->get_ordered(),
            'groups_tree' => ($groups_tree ?? array()),
            'modules' => $this->module_subject_model->get_ordered('number')
        );
        $this->display_view('module/list', $outputs);
    }

    /**
     * Displays the form to create / modify a module
     * @param integer $id
     *      The id of the module to modify (0 for a new module)
     */
    public function form($id = 0){
        $outputs = array(
            'module' => ($id > 0 ? $this->module_subject_model->get($id) : NULL),
        );

        $this->display_view('module/add', $outputs);
    }

    /**
     * Validates the input from the form
     */
    public function form_validation(){
        // Checks that the inputs don't mess the program
        $this->form_validation->set_rules('title_module', $this->lang->line('module_title'),
            ['required', 'trim','regex_match[/^[A-Za-zÀ-ÿ0-9 \-,\.\'\/]+$/]']);
        $this->form_validation->set_rules('number_module', $this->lang->line('module_number'),
            ['required']);
        $this->form_validation->set_rules('description_module', $this->lang->line('module_description'),
            ['trim','regex_match[/^[A-Za-zÀ-ÿ0-9 \-\.,\?\!:;]+$/]']);

        $req = array(
            'number' => $this->input->post('number_module'),
            'title' => $this->input->post('title_module'),
            'description' => $this->input->post('description_module')
        );

        $module_id = $this->input->post('id');

        if($this->form_validation->run()){
            if($module_id > 0){
                $this->module_subject_model->update($module_id, $req);
            } else {
                $this->module_subject_model->insert($req);
            }
            // Sends the user back to the index
            redirect('module');
        } else {
            $this->form($module_id);
        }
    }

    /**
     * Deletes a module
     * @param integer $id
     *      The id of the module to delete
     * @param integer $confirm
     *      0 to display confirmation, 1 to confirm, anything else to go back to the index
     */
    public function delete($id, $confirm = 0) {
        $this->load->model(['module_group_model','grade_model']);
        // Checks that there is no module group linked to the module
        $modules = $this->module_group_model->count_by('fk_module='.$id);
        $grades = $this->grade_model->count_by('fk_module_subject='.$id);
        $deletion_allowed = ($modules + $grades <= 0);

        $outputs = array(
            'module' => $this->module_subject_model->get($id),
            'deletion_allowed' => $deletion_allowed
        );

        switch($confirm) {
            case 0:
                // Default view, displays the delete view
                $this->display_view('module/delete', $outputs);
                break;
            case 1:
                // In case the user attempts to force the deletion
                if(!$deletion_allowed) redirect('module');
                // Deletes the module and sends the user to a success view
                $this->module_subject_model->delete($id);
                $this->display_view('module/success');
                break;
            default:
                // Any other value sends back to the list of modules
                redirect('module');
                break;
        }
    }
}