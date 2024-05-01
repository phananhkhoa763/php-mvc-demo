<?php 
class Route {

    public function handleRoute($url) {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url,'/');
        if(empty($url)) {
            $url = '/';
        }
        $handleUrl = $url;
        foreach($routes as $key => $value) {
            if(preg_match('~'.$key.'~is',$url)) { // kiểm tra xem có tồn tại key trong url hay không
                $handleUrl = preg_replace('~'.$key.'~is',$value,$url);//  Nếu URL khớp với biểu thức chính quy, preg_replace được sử dụng để thay thế URL hiện tại bằng giá trị tương ứng trong mảng routes 
            }
        }
        return $handleUrl;
    }
    
}