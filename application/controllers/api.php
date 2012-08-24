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
        public $json = array();

        public function get_more_article($num = 5){
            $this->load->model('Blog');
            $category = $_POST['category'];
            $offset = $_POST['offset'];
            $page['artList'] = $this->Blog->get_more_artilce($category, $offset ,$num);
            if($page['artList'] == 0){
                echo 0;
                exit;
            }
            $this->load->view('blog/article_block', $page);
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
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE){
                $blog = new Myblog();
                $this->load->model('Admin');
                $page["artList"] = $this->Admin->artList();
                $page["blogInfo"] = $blog;
                $json["html"] = $this->load->view("admin/ad_article.html", $page, true);
                echo json_encode($json);
            }else{
                header("Location:ad_login");
            }
        }

        public function ad_delete_article($aid){
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE && isset($aid)){
                $sql = "delete from article where id='".$aid."'";
                if($this->db->query($sql)){
                    $json["message"] = "删除成功！";
                    //删除文章对应评论
                    $sql = "delete from comment where aid='".$aid."'";
                    $this->db->query($sql);
                }else{
                    $json["message"] = "删除失败！";
                }
                echo json_encode($json);
            }else{
                header("Location:ad_login");
            }
        }

        public function ad_comment(){
            $session = $this->session->userdata('loginAdmin'); 
            if($session !== FALSE){
                $blog = new Myblog();
                $this->load->model('Admin');
                $page["comments"] = $this->Admin->comment();
                $page["blogInfo"] = $blog;
                $json["html"] = $this->load->view("admin/ad_comment.html", $page, true);
                echo json_encode($json);
            }else{
                header("Location:ad_login");
            }
        }

        public function ad_delete_comment($cid){
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE && isset($cid)){
                $sql = "select aid from comment where id='".$cid."' limit 1";
                $query = $this->db->query($sql);
                $aid = $query->row_array();
                $sql = "delete from comment where id='".$cid."'";
                if($this->db->query($sql)){
                    $json["message"] = "删除成功！";
                    //更新对应文章评论数
                    $sql = "update article set comments=comments-1 where id='".$aid["aid"]."'";
                    $this->db->query($sql);
                }else{
                    $json["message"] = "删除失败！";
                }
                echo json_encode($json);
            }else{
                header("Location:ad_login");
            }
        }

        public function ad_flink(){
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE){
                $this->load->model('Admin');
                $page["flinks"] = $this->Admin->flink();
                $json["html"] = $this->load->view("admin/ad_flink.html", $page, true);
                echo json_encode($json);
            }else{
                header("Location:ad_login");
            }
        }

        public function ad_delete_flink($fid){
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE && isset($fid)){
                $sql = "delete from flinks where id='".$fid."'";
                if($this->db->query($sql)){
                    $json["message"] = "删除成功！";
                }else{
                    $json["message"] = "删除失败！";
                }
                echo json_encode($json);
            }else{
                header("Location:ad_login");
            }
        }

        public function ad_edit_flink($fid=NULL){
            if($fid != NUll){
                $this->load->model('Admin');
                $page["flink"] = $this->Admin->get_flink($fid);
                $json["html"] = $this->load->view("admin/ad_edit_flink.html", $page, true);
            }else{
                $json["html"] = $this->load->view("admin/ad_edit_flink.html", null, true);
            }
            echo json_encode($json);
        }

        public function add_flink(){
            $session = $this->session->userdata('loginAdmin');
            if($session !== FALSE){
                $name = $_POST("name");
                echo $name;
                /*$owner = $_POST("owner") || $name;
                $url = $_POST("url");
                $desc = $_POST("desc") || $name;
                $sql = "insert into flinks (name,owner,url,description) values ('".$name."','".$owner."','".$url."','".$desc."')";
                if($this->db->query($sql)){
                    echo "添加成功！";
                }else{
                    echo "添加失败！";
                }*/
            }else{
                header("Location:ad_login");
            }
        }
    }