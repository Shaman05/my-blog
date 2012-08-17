<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-8-1
     * Time: 下午10:10
     * To change this template use File | Settings | File Templates.
     */

    Class Blog extends CI_Model{

        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        //获取最新的x篇文章
        function get_article($num, $category = NULL){
            $condition = !$category ? '' : ' where category="'.$category.'"';
            $sql = 'select * from article'.$condition.' order by pub_date desc limit '.$num;
            $query = $this->db->query($sql);
            return $query->result();
        }

        //获取文章$aid详细内容
        function show_article($aid){
            if(!$aid)return;
            $sql = 'select * from article where id="'.$aid.'"';
            $update = 'update article set hits=hits+1 where id="'.$aid.'"';
            $this->db->query($update);
            $query = $this->db->query($sql);
            return $query->row();
        }

        //获取搜索关键字文章列表
        function search_result($kw){
            $result = array();
            $sql = 'select * from article where title like "%'.$kw.'%" or tag like "%'.$kw.'%" order by pub_date desc';
            $query = $this -> db -> query($sql);
            $result['count'] = $query->num_rows();
            $result['rows'] = $query -> result();
            return $result;
        }

        //获取搜索关键字文章列表
        function get_tag_article($tag, $num){
            $sql = 'select * from article where tag like "%'.$tag.'%" order by pub_date desc limit '.$num;
            $query = $this -> db -> query($sql);
            return $query->result();
        }

        //获取更多的10篇文章
        function get_more_artilce($category, $offset = 0, $num){
            $condition = $category == 'null' ? '' : ' where category="'.$category.'"';
            $sql = 'select * from article'.$condition.' order by pub_date desc limit '.$offset.','.$num;
            $query = $this->db->query($sql);
            if($query->num_rows() == 0){
                return 0;
            }
            return $query->result();
        }

        //获取上一篇,下一篇
        function get_fd_article($thisID, $fd){
            if($fd == 'prev')
                $sql = 'select id,title from article where id<'.$thisID.' order by pub_date desc limit 1';
            else if($fd == 'next')
                $sql = 'select id,title from article where id>'.$thisID.' order by pub_date asc limit 1';
            $query = $this->db->query($sql);
            if($query->num_rows() == 0){
                return 0;
            }
            return $query->row();
        }

        //Top5文章
        function get_topX_article($num = 5){
            $sql = 'select id,title from article order by hits desc limit '.$num;
            $query = $this->db->query($sql);
            if($query->num_rows() == 0){
                return 0;
            }
            return $query->result();
        }

        //获取分类目录及文章数量
        function get_category_and_count(){
            $category_arr = array();
            $category = array();
            $temp = array();
            $sql = 'select category from article';
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result)){
                $temp[] = $row["category"];
            }
            $temp = array_unique($temp);
            foreach($temp as $val){
                $category["name"] = $val; //分类名
                $sql = 'select * from article where category="'.$val.'"';
                $category["count"] = mysql_num_rows(mysql_query($sql)); //文章数
                array_push($category_arr,$category);
            }
            return $category_arr;
        }

        //文章归档
        function archives(){
            $date_arr = array();
            $sql = 'select pub_date from article order by pub_date desc';
            $result = mysql_query($sql);
            while($row = mysql_fetch_array($result)){
                $date_arr[] = date("Y-m",strtotime($row["pub_date"]));
            }
            $date_arr = array_unique($date_arr);
            return $date_arr;
        }

        //获取月份文章
        function get_article_by_month($m){
            $date = explode('-',$m);
            $year = $date[0];
            $month = $date[1];
            $articles = array();
            //$article_num = 0;
            $sql = 'select * from article where year(pub_date)="'.$year.'" and month(pub_date)="'.$month.'" order by pub_date desc';
            $result = mysql_query($sql);
            //$article_num=mysql_num_rows($result);
            while($row = mysql_fetch_array($result)){
                $articles[] = $row;
            }
            return $articles;
        }

        //获取标签组,并统计次数
        function get_tags(){
            $tagArr = array();
            $sql = 'select tag from article';
            $query = $this->db->query($sql);
            if($query->num_rows() == 0){
                return 0;
            }
            foreach($query->result_array() as $row){
                foreach(explode(',',$row['tag']) as $tag){
                    $tag !== '' && $tagArr[] = $tag;
                }
            }
            $tagArr = array_unique($tagArr);
            return $tagArr;
        }

        //获取评论
        function get_comments($aid){
            $sql = 'select * from comment where aid="'.$aid.'" order by c_time asc';
            $query = $this->db->query($sql);
            return $query->result_array();
        }

        //写入评论
        function submit_comment($aid, $name, $email=NULL, $website=NULL, $content){
            $message = array('status' => false, 'text' => 'error!');
            if(!$name || !$content){
                $message['text'] = '姓名或者内容不能为空！';
                return $message;
            }
            $content = htmlspecialchars($content);
            $content = str_replace("\n","<br>",str_replace(" ","&nbsp;",$content));
            $sql = 'insert into comment (aid,name,email,site,content) values ("'.$aid.'","'.$name.'","'.$email.'","'.$website.'","'.$content.'")';
            if($this->db->query($sql)){
                $message['status'] = true;
                $message['text'] = '添加评论成功！';
                $update = 'update article set comments=comments+1 where id="'.$aid.'"';
                $this->db->query($update);
            }else{
                $message['text'] = '评论失败！';
            }
            return $message;
        }

        //获取id为$aid的最后一条评论
        function get_last_comment($aid){
            $sql = 'select * from comment where aid="'.$aid.'" order by c_time desc limit 1';
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $html = '<li>'.
                        '<div><a href="'.$row['site'].'">'.$row['name'].'</a> 在 <span>'.$row['c_time'].'</a></span> 发表了评论:</div>'.
                        '<p>'.$row['content'].'</p>'.
                    '</li>';
            return $html;
        }
    }