<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-4
     * Time: 下午11:20
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Api extends CI_Controller {

        public $page = array();

        public function get_more_article($num = 5){
            $this->load->model('Blog');
            $category = $_POST['category'];
            $offset = $_POST['offset'];
            $page['artList'] = $this->Blog->get_more_artilce($category, $offset ,$num);
            if($page['artList'] == 0){
                echo 0;
                exit;
            }

            $this->load->view('article_block', $page);
        }
    }