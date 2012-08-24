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
            $discripte = '专注WEB前端开发、关注前端动态',
            $loginPwd = 'abcD@1234';

        public
            $defaultArtListNum = 5,
            $getMoreArtNum = 5,
            $topXarticle = 5;

        public function show_rights(){
            return 'Copyright &copy; 2012. &nbsp; Theme by <a href="/" title="' . $this->name . '">' . $this->admin . '</a>';
        }

        public function clip_text($str, $len = 20, $dot = TRUE){
            $i = 0;
            $l = 0;
            $c = 0;
            $a = array();
            while ($l < $len) {
                $t = substr($str, $i, 1);
                if (ord($t) >= 224) {
                    $c = 3;
                    $t = substr($str, $i, $c);
                    $l += 2;
                } elseif (ord($t) >= 192) {
                    $c = 2;
                    $t = substr($str, $i, $c);
                    $l += 2;
                } else {
                    $c = 1;
                    $l++;
                }
                // $t = substr($str, $i, $c);
                $i += $c;
                if ($l > $len) break;
                $a[] = $t;
            }
            $re = implode('', $a);
            if (substr($str, $i, 1) !== false) {
                array_pop($a);
                ($c == 1) and array_pop($a);
                $re = implode('', $a);
                $dot and $re .= '...';
            }
            return $re;

        }
    }
