<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class module_group_model extends MY_Model {
    /* SET MY_Model VARIABLES */
    protected $_table = 'modules_groups';
    protected $primary_key = 'id';
    protected $protected_attributes = ['id'];
    protected $belongs_to = ['Parent_Group' => ['primary_key' => 'fk_parent_group',
                                            'model' => 'module_group_model']];
    protected $has_many = ['Modules_Subjects' => ['primary_key' => 'fk_group',
                                                    'model' => 'modules_subjects_model'],
                           'Child_Groups' => ['primary_key' => 'fk_parent_group',
                                          'model' => 'module_group_model']];

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Returns groups ordered by position
     * @param string $main
     *      The column that will be used for the sorting
     * @param string $direction
     *      'asc' or 'desc', wether it goes from top to bottom or not
     * @return array
     *      All groups
     */
    public function get_ordered($main = 'position', $direction = 'asc'){
        $this->db->order_by($main, $direction);
        return $this->module_group_model->get_all();
    }

    /**
     * Returns the tree of the group and its parents
     * @param integer $parent_group
     *      The parent group, usually at fk_parent_group
     * @return array
     *      All groups sorted
     */
    public function get_tree($parent_group = 0){
        
        $this->db->order_by('position', 'asc');
        $groups = $this->module_group_model->get_many_by("fk_parent_group = ".$parent_group);

        if (count($groups) > 0){
            foreach ($groups as $group) {
                $child_groups = $this->module_group_model->get_many_by("fk_parent_group = ".$group->id);

                if(count($child_groups) > 0){
                    $groups_tree[$group->name_group] = array($group->id, $this->module_group_model->get_tree($group->id));
                } else {
                    $groups_tree[$group->name_group] = array($group->id, $group->name_group);
                }
            }
        } else {
            $groups_tree = NULL;
        }

        return $groups_tree;
    }

    /**
     * Returns a list of groups depending on the filters
     * This is just a big get_many_by()
     * @param array $filters
     *      The filters for the search. 'tf' is for text, 'idf' is for ids, 'wgf' is for weight, 'elf' is for eliminatory, 'pof' is for position, 'pgf' is for parent group
     * @return array
     *      All the groups depending on the filters
     * @deprecated get_many_by()
     */
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
                "name_group LIKE '%".$text_search_contents."%' ";
            $where_text_filter .= ')';

            $where_group_filter .= $where_text_filter;
        }

        /**************
         * id filter
        **************/
        $where_id_filter = "";
        if(isset($filters['idf'])) {
            $id_search_filter = $filters['idf'];
            $where_id_filter .= '(';

            if($id_search_filter instanceof Traversable) {
                foreach ($id_search_filter as $search_id) {
                    $where_id_filter .= 'id LIKE '.$search_id.' OR ';
                }
                $where_id_filter = substr($where_id_filter, 0, -4);
            } else {
                $where_id_filter .= 'id LIKE '.$id_search_filter;
            }
            $where_id_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_id_filter;
        }

        /******************
         * weight filter
        ******************/
        $where_weight_filter = "";
        if(isset($filters['wgf'])) {
            $weight_search_filter = $filters['wgf'];
            $where_weight_filter .= '(';

            if($weight_search_filter instanceof Traversable) {
                foreach ($weight_search_filter as $search_weight) {
                    $where_weight_filter .= 'weight LIKE '.$search_id.' OR ';
                }
                $where_weight_filter = substr($where_weight_filter, 0, -4);
            } else {
                $where_weight_filter .= 'weight LIKE '.$weight_search_filter;
            }
            $where_weight_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_weight_filter;
        }

        /******************
         * eliminatory filter
        ******************/
        $where_eliminatory_filter = "";
        if(isset($filters['elf'])) {
            $eliminatory_search_filter = $filters['wgf'];
            $where_eliminatory_filter .= '(';

            if($eliminatory_search_filter instanceof Traversable) {
                foreach ($eliminatory_search_filter as $search_eliminatory) {
                    $where_eliminatory_filter .= 'eliminatory LIKE '.$search_id.' OR ';
                }
                $where_eliminatory_filter = substr($where_eliminatory_filter, 0, -4);
            } else {
                $where_eliminatory_filter .= 'eliminatory LIKE '.$eliminatory_search_filter;
            }
            $where_eliminatory_filter .= ')';

            if($where_group_filter != '') {
                $where_group_filter .= ' AND ';
            }
            $where_group_filter .= $where_eliminatory_filter;
        }

        /******************
         * position filter
        ******************/
        $where_position_filter = "";
        if(isset($filters['pof'])) {
            $position_search_filter = $filters['pof'];
            $where_position_filter .= '(';

            if($position_search_filter instanceof Traversable) {
                foreach ($position_search_filter as $search_position) {
                    $where_position_filter .= 'position LIKE '.$search_id.' OR ';
                }
                $where_position_filter = substr($where_position_filter, 0, -4);
            } else {
                $where_position_filter .= 'position LIKE '.$position_search_filter;
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
                    $where_parent_filter .= 'fk_parent_group LIKE '.$search_id.' OR ';
                }
                $where_parent_filter = substr($where_parent_filter, 0, -4);
            } else {
                $where_parent_filter .= 'fk_parent_group LIKE '.$parent_search_filter;
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