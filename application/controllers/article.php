<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-7-30
     * Time: 下午08:52
     * To change this template use File | Settings | File Templates.
     */

    if(!defined('BASEPATH'))exit('No direct script access allowed');

    class Article extends CI_Controller {

        public $header = array(),
               $page = array(),
               $footer = array();

        //分类目录文章
        public function category($category){
            $category = urldecode($category);
            $blog = new Myblog();

            //当前页数据
            $this->load->model('Blog');
            $artNum = $blog->defaultArtListNum;
            $page['c'] = $category;
            $page['artList'] = $this->Blog->get_article($artNum, $category);
            $page['displayMore'] = TRUE;
            if(count($page['artList']) == 0){
                $message['error_text'] = '您查看的栏目不存在或已被移除！';
                $this->load->view('../errors/error_404_noresult',$message);
                return;
            }
            $topX = $blog->topXarticle;
            $page['topx_rows'] = $this->Blog->get_topX_article($topX);
            $page['categorys'] = $this->Blog->get_category_and_count();
            $page['archives'] = $this->Blog->archives();
            $page['tags'] = $this->Blog->get_tags();

            //header和footer
            $header['title'] = $blog->name . ' - 文章分类：'.$category;
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/index', $page);
            $this->load->view('blog/footer', $footer);
        }

        //详细文章页
        public function show($aid){
            $blog = new Myblog();

            //当前页数据
            $this->load->model('Blog');
            $page['aid'] = $aid;
            $page['article'] = $this->Blog->show_article($aid);
            if(count($page['article']) == 0){
                $message['error_text'] = '您查看的文章不存在或已经移除了。';
                $this->load->view('../errors/error_404_noresult',$message);
                return;
            }
            $page['prev_article'] = $this->Blog->get_fd_article($aid, 'prev');
            $page['next_article'] = $this->Blog->get_fd_article($aid, 'next');
            $topX = $blog->topXarticle;
            $page['topx_rows'] = $this->Blog->get_topX_article($topX);
            $page['categorys'] = $this->Blog->get_category_and_count();
            $page['archives'] = $this->Blog->archives();
            $page['tags'] = $this->Blog->get_tags();
            $page['comments'] = $this->Blog->get_comments($aid);

            //header和footer
            $header['title'] = $blog->name . ' - '.$page['article']->title;
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/show', $page);
            $this->load->view('blog/footer', $footer);
        }

        //搜索关键字列表
        public function search($kw){
            $kw = urldecode($kw);
            $blog = new Myblog();

            //当前页数据
            $this->load->model('Blog');
            $page['keyword'] = $kw;
            $result = $this->Blog->search_result($kw);
            $page['count'] = $result['count'];
            $page['artList'] = $result['rows'];

            //header和footer
            $header['title'] = $blog->name . ' - '.$kw.'的搜索结果';
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/search', $page);
            $this->load->view('blog/footer', $footer);
        }

        //标签页
        public function tag($tag){
            $tag = urldecode($tag);
            $blog = new Myblog();

            //当前页数据
            $this->load->model('Blog');
            $artNum = $blog->defaultArtListNum;
            $page['c'] = $tag;
            $page['artList'] = $this->Blog->get_tag_article($tag, $artNum);
            $page['displayMore'] = FALSE;
            if(count($page['artList']) == 0){
                $message['error_text'] = '您查看的标签不存在或已被移除！';
                $this->load->view('../errors/error_404_noresult',$message);
                return;
            }
            $topX = $blog->topXarticle;
            $page['topx_rows'] = $this->Blog->get_topX_article($topX);
            $page['categorys'] = $this->Blog->get_category_and_count();
            $page['archives'] = $this->Blog->archives();
            $page['tags'] = $this->Blog->get_tags();

            //header和footer
            $header['title'] = $blog->name . ' - 标签：'.$tag;
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/index', $page);
            $this->load->view('blog/footer', $footer);
        }

        //文章归档
        public function archives(){
            $blog = new Myblog();
            
            $this->load->model('Blog');
            $page['artList'] = $this->Blog->get_archives();

            //header和footer
            $header['title'] = $blog->name . ' - 文章归档';
            $header['blogInfo'] = $blog;
            $footer['blogInfo'] = $blog;

            $this->load->view('blog/header', $header);
            $this->load->view('blog/archives', $page);
            $this->load->view('blog/footer', $footer);
        }
    }