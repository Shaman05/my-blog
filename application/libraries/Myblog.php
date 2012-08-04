<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Shaman
     * Date: 12-7-30
     * Time: 下午10:03
     * To change this template use File | Settings | File Templates.
     */
    class Myblog
    {
        public
            $name = 'Shaman 博客',
            $admin = 'Shaman',
            $user = 'Devin.Chen',
            $siteUrl = 'http://shaman05.com/',
            $discripte = '专注WEB前端开发、关注前端动态';

        public
            $defaultArtListNum = 5,
            $getMoreArtNum = 5,
            $topXarticle = 5;

        public function show_rights(){
            return 'Copyright &copy; 2012. &nbsp; Theme by <a href="/" title="' . $this->name . '">' . $this->admin . '</a>';
        }

        public function clip_text($string, $num){
            if(strlen($string) > $num*3){
                return substr($string, 0, $num*3).'...';
            }
            return $string;
        }
    }
