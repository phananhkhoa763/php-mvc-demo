<?php 
class HomeController extends Controller 
{
    public $user;

    public function __construct() {
        $this->user = $this->model('UserModel');
    }

    function index() {
        $request = new Request;
        $getRequest = $request->getFields();
        $listUsers = $this->db->select()->table('suggestions')->limit(1)->get();
        $data['content'] = 'Home/index';
        $data['subContent']['title'] = 'home page';
        $data['subContent']['listUsers'] = $listUsers;
        $this->render('Layouts/clientLayout',$data);
    }

    function detail() {
        $id = $_GET['id'];
        echo 'id : '.$id;
    }

    function update_validate() {
        $request = new Request;
        $request->rules([ 
            'fullname' => 'required|min:5|max:30', 
            'email' => 'required|email|min:6|unique:users:email', 
            'password' => 'required|min:3', 
            'confirm_password' => 'required|match:password',
            'age' => 'required|callback_check_age', 
        ]);

        $request->message([
            'fullname.required' => 'Họ tên không được để trống',
            'fullname.min' => 'Họ tên phải lớn hơn 5 ký tự',
            'fullname.max'=> 'Họ tên phải nhỏ hơn 30 ký tự',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Định dạng email không hợp lệ',
            'email.min' => 'Email phải lớn hơn 6 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải lớn hơn 3 ký tự',
            'confirm_password.required' => 'Nhập lại mật khẩu không được để trống',
            'confirm_password.match' => 'Mật khẩu nhập lại không khớp',
            'age.required' => 'Tuổi không được để trống',
            'age.callback_check_age' => 'Tuổi không được nhỏ hơn 20',
        ]);
        $data['content'] = 'Home/index';
        $data['subContent']['title'] = 'home ad';
        $validate = $request->validate();
        if(!$validate) {
            $data['subContent']['errors'] = $request->errors();
        }
        $this->render('Layouts/clientLayout',$data);
    }

    public function check_age($age) {
        if($age > 20) return true;
        return false; 
    }
}