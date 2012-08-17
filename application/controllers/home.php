<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-7-30
     * Time: 下午09:12
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Home extends CI_Controller {

        public $header = array(),
               $page = array(),
               $footer = array();

        public function index(){
            $blog = new Myblog();
            $artNum = $blog->defaultArtListNum;

            //当前页数据
            $this->load->model('Blog');
            $page['c'] = 'null';
            $page['artList'] = $this->Blog->get_article($artNum);
            $page['displayMore'] = TRUE;
            $topX = $blog->topXarticle;
            $page['topx_rows'] = $this->Blog->get_topX_article($topX);
            $page['categorys'] = $this->Blog->get_category_and_count();
            $page['archives'] = $this->Blog->archives();
            $page['tags'] = $this->Blog->get_tags();


            //header和footer
            $header['title'] = $blog->name . ' - 首页';
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('header', $header);
            $this->load->view('index', $page);
            $this->load->view('footer', $footer);
        }

    }