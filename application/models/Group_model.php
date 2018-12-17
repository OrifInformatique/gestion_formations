<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class group_model extends MY_Model {
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
    **/
    public function __construct() {
        parent::__construct();
    }

    public function get_next_id() {
        $query = $this->db->query("SHOW TABLE STATUS LIKE 't_groups'");

        $row = $query->row(0);
        $value = $row->Auto_increment;

        return $value;
    }

    public function get_tree($parent_group = 0){
        
        $groups = $this->group_model->get_many_by("FK_Parent_Group = ".$parent_group);

        if (count($groups) > 0){
            foreach ($groups as $group) {
                $child_groups = $this->group_model->get_many_by("FK_Parent_Group = ".$group->ID);

                if(count($child_groups) > 0){
                    $groups_tree[$group->Name_Group] = $this->group_model->get_tree($group->ID);
                } else {
                    $groups_tree[$group->ID] = $group->Name_Group;
                }
            }
        } else {
            $groups_tree = NULL;
        }

        return $groups_tree;
    }


    /**
     * Ne sera certainement jamais utilisé
    **/
    public function get_filtered($filters = NULL) {
        // WHERE clause for filtering
        $where_group_filter = "";

        /****************
         * Text filter
        ****************/
        $where_text_filter = "";
        if(isset($filters['tf'])) {
            $text_search_contents = $filters['ts'];

            $where_text_filter .= '(';
            $where_text_filter .=
                "group_name LIKE '%".$text_search_contents."%' ";
            $where_text_filter .= ')';

            $where_group_filter .= $where_text_filter;
        }

        /**************
         * ID filter
        **************/
        $where_id_filter = "";
        if(isset($filters['idf'])) {
            $id_search_filter = $filters['idf'];
            $where_id_filter .= '(';

            if($id_search_filter instanceof Traversable) {
                foreach ($id_search_filter as $search_id) {
                    $where_id_filter .= 'ID LIKE '.$search_id.' OR ';
                }
                $where_id_filter = substr($where_id_filter, 0, -4);
            } else {
                $where_id_filter .= 'ID LIKE '.$id_search_filter;
            }
            $where_id_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_id_filter;
        }

        /******************
         * Weight filter
        ******************/
        $where_weight_filter = "";
        if(isset($filters['wgf'])) {
            $weight_search_filter = $filters['wgf'];
            $where_weight_filter .= '(';

            if($weight_search_filter instanceof Traversable) {
                foreach ($weight_search_filter as $search_weight) {
                    $where_weight_filter .= 'Weight LIKE '.$search_id.' OR ';
                }
                $where_weight_filter = substr($where_weight_filter, 0, -4);
            } else {
                $where_weight_filter .= 'Weight LIKE '.$weight_search_filter;
            }
            $where_weight_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_weight_filter;
        }

        /******************
         * Eliminatory filter
        ******************/
        $where_eliminatory_filter = "";
        if(isset($filters['elf'])) {
            $eliminatory_search_filter = $filters['wgf'];
            $where_eliminatory_filter .= '(';

            if($eliminatory_search_filter instanceof Traversable) {
                foreach ($eliminatory_search_filter as $search_eliminatory) {
                    $where_eliminatory_filter .= 'Weight LIKE '.$search_id.' OR ';
                }
                $where_eliminatory_filter = substr($where_eliminatory_filter, 0, -4);
            } else {
                $where_eliminatory_filter .= 'Weight LIKE '.$eliminatory_search_filter;
            }
            $where_eliminatory_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_eliminatory_filter;
        }

        /******************
         * Position filter
        ******************/
        $where_position_filter = "";
        if(isset($filters['pof'])) {
            $position_search_filter = $filters['pof'];
            $where_position_filter .= '(';

            if($position_search_filter instanceof Traversable) {
                foreach ($position_search_filter as $search_position) {
                    $where_position_filter .= 'Position LIKE '.$search_id.' OR ';
                }
                $where_position_filter = substr($where_position_filter, 0, -4);
            } else {
                $where_position_filter .= 'Position LIKE '.$position_search_filter;
            }
            $where_position_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_position_filter;
        }

        /******************
         * Parent group filter
        ******************/
        $where_parent_filter = "";
        if(isset($filters['pgf'])) {
            $parent_search_filter = $filters['pgf'];
            $where_parent_filter .= '(';

            if($parent_search_filter instanceof Traversable) {
                foreach ($parent_search_filter as $search_parent) {
                    $where_parent_filter .= 'FK_Parent_Group LIKE '.$search_id.' OR ';
                }
                $where_parent_filter = substr($where_parent_filter, 0, -4);
            } else {
                $where_parent_filter .= 'FK_Parent_Group LIKE '.$parent_search_filter;
            }
            $where_parent_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_parent_filter;
        }

        /********************************
         * Obtains the filtered groups
        ********************************/
        if($where_group_filter == '') {
            $groups = $this->get_all();
        } else {
            $groups = $this->get_many_by($where_group_filter);
        }
        return $groups;
    }
}