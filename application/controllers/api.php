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

        public function submit_comment(){
            $this->load->model('Blog');
            $aid = $_POST['aid'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $website = $_POST['website'];
            $content = $_POST['content'];
            
            $message = $this->Blog->submit_comment($aid, $name, $email, $website, $content);
            echo json_encode($message);
        }

        public function get_last_comment($aid){
            $this->load->model('Blog');
            $html = $this->Blog->get_last_comment($aid);

            echo $html;
        }

        public function ad_article(){
            $blog = new Myblog();
            $this->load->model('Admin');
            $page["artList"] = $this->Admin->artList();
            $page["blogInfo"] = $blog;

            $this->load->view("admin/ad_article.html", $page);
        }

        public function ad_comment(){
            $blog = new Myblog();
            $this->load->model('Admin');
            $page["comments"] = $this->Admin->comment();
            $page["blogInfo"] = $blog;

            $this->load->view("admin/ad_comment.html", $page);
        }

        public function ad_flink(){
            $blog = new Myblog();
            $this->load->model('Admin');
            $page["flinks"] = $this->Admin->flink();
            $page["blogInfo"] = $blog;

            $this->load->view("admin/ad_flink.html", $page);
        }
    }