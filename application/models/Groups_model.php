<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * User is used to give access to the application.
 * User type is used to give different access rights (defining an access level).
 * 
 * @author      Orif, section informatique (BuYa)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
class groups_model extends MY_Model
{
    /* SET MY_Model VARIABLES */
    protected $_table = 't_groups';
    protected $primary_key = 'ID';
    protected $protected_attributes = ['ID'];
    protected $belongs_to = ['t_groups' => ['primary_key' => 'FK_Parent_Group',
                                            'model' => 'groups_model']];
    protected $has_many = ['t_modules_subjects' => ['primary_key' => 'FK_Group',
                                                    'model' => 'modules_subjects_model'],
                           't_groups' => ['primary_key' => 'FK_Parent_Group',
                                          'model' => 'groups_model']];

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

}