<?php session_start();

// 自訂的 Controller
class IndexController extends Controller
{

	// 共用的留言板物件
	private $models = NULL;

	// 建構函式
	public function __construct()
	{
		$this->models = new FaceTech;
	}

    // °õ¦æ°Ê§@
    public final function run()
    {
		if((isset($_SESSION['id']) && $_SESSION['id'] != NULL) && $this->models->isEnable($_SESSION['id'])) {
	        $this->{$this->action}();
		} else {
			if ($this->action == 'login' || $this->action == 'dologin' || $this->action == 'register' || $this->action == 'doregister') {
	        	$this->{$this->action}();
			} else {
				unset($_SESSION['id']);
				$this->redirectTo('./index.php?act=login');
			}
		}
    }

	// 主頁
	protected function index()
	{
		$account = $_GET['account'];
		
		if ($account != NULL) {
			if ($id = $this->models->accountIsExist($account)) {
				$view = new HtmlView;
				$view->setVar(user, $user1 = $this->models->getUser($_SESSION['id']));
				$view->setVar(userMessages, $user2 = $this->models->getUser($id));
				$view->setVar(friendType, $this->models->isFriend($_SESSION['id'], $user2['id']));
				$view->setVar(messages, $this->models->getMessages($user2['id']));
				$view->render('index.tpl.php');
			} else {
				$this->redirectTo('./');
			}
		} else {
			$view = new HtmlView;
			$view->setVar(user, $user = $this->models->getUser($_SESSION['id']));
			/*if ($user['type'] == 0) $view->setVar(messages, $this->models->getFriendsMessages($_SESSION['id']));
			else if ($user['type'] == 1)*/ $view->setVar(messages, $this->models->getAllMessages());
			$view->render('index.tpl.php');
		}
	}
	
	// 登入頁
	protected function login()
	{
		switch ($_GET['errorMessage']) {
			case '1':
				$message = 'NULL';
				break;
				
			case '2':
				$message = '帳號或密碼錯誤';
				break;
				
			case '3':
				$message = '您的帳號被凍結了';
				break;
				
			default:
		}
		
		if(isset($_SESSION['id']) && $_SESSION['id'] != null) {
			$this->redirectTo('./');
		} else {
			$view = new HtmlView;
			$view->setVar(message, $message);
			$view->render('login.tpl.php');
		}
	}
	
	// 登入
	protected function doLogin()
	{
		$account = $_POST['account'];
		$password = $_POST['password'];
		
		if ($account != null && $password != null) {
			if ($id = $this->models->validate($account, $password)) {
				if ($this->models->isEnable($id)) {
					//將帳號寫入session，方便驗證使用者身份
					$_SESSION['id'] = $id;
					$this->redirectTo('./');
				} else {
					//帳號被凍結
					$this->redirectTo('./index.php?act=login&errorMessage=3');
				}
			} else {
				//賬號或密碼錯誤
				$this->redirectTo('./index.php?act=login&errorMessage=2');
			}
		} else {
			//資訊不完全
			$this->redirectTo('./index.php?act=login&errorMessage=1');
		}
	}
	
	// 登出
	protected function logout()
	{
		unset($_SESSION['id']);
		
		$this->redirectTo('./');
	}
	
	// 註冊頁
	protected function register()
	{
		switch ($_GET['errorMessage']) {
			case '1':
				$message = '資訊不齊全';
				break;
				
			case '2':
				$message = '註冊失敗';
				break;
				
			case '3':
				$message = '此帳號已經存在';
				break;
				
			case '4':
				$message = '密碼兩次不一樣';
				break;
				
			default:
		}
		if(isset($_SESSION['id']) && $_SESSION['id'] != null) {
			$this->redirectTo('./');
		} else {
			$view = new HtmlView;
			$view->setVar(message, $message);
			$view->render('register.tpl.php');
		}
	}
	
	// 註冊
	protected function doRegister()
	{
		$account = $_POST['account'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$username = $_POST['username'];
		$birthday = $_POST['birthday'];
		$telephone1 = $_POST['telephone1'];
		$telephone2 = $_POST['telephone2'];
		$city = $_POST['city'];
		
		if ($this->models->accountIsExist($account)) {
			//is exist
			$this->redirectTo('./index.php?act=register&errorMessage=3');
		} else {
			if ($account != null && $password != null && $password2 != null && $username != null && $birthday != null && $telephone1 != null && $telephone2 != null && $city != null) {
				if ($password == $password2) {
					$user = array(
							'account'	=> $account,
							'password'	=> $password,
							'username'	=> $username,
							'birthday'	=> $birthday,
							'telephone'	=> $telephone1 . '-' . $telephone2,
							'city'		=> $city);
					
					if ($id = $this->models->addUser($user)) {
						//success
						$_SESSION['id'] = $id;
						$this->redirectTo('./');
					} else {
						//fail
						$this->redirectTo('./index.php?act=register&errorMessage=2');
					}
				} else {
					//密碼兩次不一樣
					$this->redirectTo('./index.php?act=register&errorMessage=4');
				}
			} else {
				//資訊不齊全
				$this->redirectTo('./index.php?act=register&errorMessage=1');
			}
		}
	}
	
	// 使用者管理頁
	protected function manageUsers()
	{
		if ($this->models->getType($_SESSION['id']) == 1) {
			$view = new HtmlView;
			$view->setVar(user, $this->models->getUser($_SESSION['id']));
			$view->setVar(usersMessages, $this->models->getAllUsers());
			$view->render('manageUsers.tpl.php');
		} else {
			$this->redirectTo('./');
		}
	}
	
	// 修改使用者帳戶頁面
	protected function editUser()
	{
		$id = $_GET['id'];
		if ($id == NULL) $id = $_SESSION['id'];
		
		if ($_SESSION['id'] == $id || $this->models->getType($_SESSION['id']) == 1) {
			$view = new HtmlView;
			$view->setVar(user, $this->models->getUser($_SESSION['id']));
			$view->setVar(userMessages, $this->models->getUser($id));
			$view->render('editUser.tpl.php');
		} else {
			echo "<script>history.go(-1);</script>";
		}
	}
	
	// 修改使用者帳戶
	protected function doEditUser()
	{
		$id = $_GET['id'];
		
		if ($_FILES["head"]["error"] > 0){
			echo "Error: " . $_FILES["head"]["error"];
			$head = NULL;
		} else {
			move_uploaded_file($_FILES["head"]["tmp_name"], "./head/" . $this->models->getAccount($id));
			$head = $this->models->getAccount($id);
		}
		
		$username = $_POST['username'];
		$birthday = $_POST['birthday'];
		$telephone1 = $_POST['telephone1'];
		$telephone2 = $_POST['telephone2'];
		if ($telephone1 == NULL || $telephone2 == NULL) $telephone = NULL;
		else $telephone = $telephone1 . '-' . $telephone2;
		$city = $_POST['city'];
		
		$password = $_POST['password'];
		$newPassword = $_POST['newPassword'];
		$newPassword2 = $_POST['newPassword2'];
		if (!$this->models->validateWithId($id, $password) || $newPassword != $newPassword2) $newPassword = NULL;
		
		if ($_SESSION['id'] == $id || $this->models->getType($_SESSION['id']) == 1) {
			if (!$this->models->editUser($id, $newPassword, $username, $head, $birthday, $telephone, $city)) die('修改帳戶失敗');
		}
		echo "<script>history.go(-2);</script>";
	}
	
	// 刪除使用者賬戶
	protected function deleteUser()
	{
		$id = $_GET['id'];
		
		if (($_SESSION['id'] == $id || $this->models->getType($_SESSION['id']) == 1) && $this->models->getType($id) == 0) {
			if (!$this->models->deleteUser($id)) die('刪除帳戶失敗');
		}
		echo "<script>history.go(-1);</script>";
	}
	
	// 凍結使用者帳戶
	protected function disableUser()
	{
		$id = $_GET['id'];
		
		if (($_SESSION['id'] == $id || $this->models->getType($_SESSION['id']) == 1) && $this->models->getType($id) == 0) {
			if (!$this->models->disable($id)) die('凍結帳戶失敗');
		}
		echo "<script>history.go(-1);</script>";
	}
	
	// 解凍使用者帳戶
	protected function enableUser()
	{
		$id = $_GET['id'];
		
		if (($_SESSION['id'] == $id || $this->models->getType($_SESSION['id']) == 1) && $this->models->getType($id) == 0) {
			if ($this->models->enable($id)) die('起動帳戶失敗');
		}
		echo "<script>history.go(-1);</script>";
	}
	
	// 搜尋使用者
	protected function searchUsers()
	{
		$keyword = $_GET['keyword'];
		
		$view = new HtmlView;
		$view->setVar(message, '搜尋關鍵字：' . $keyword);
		$view->setVar(usersMessages, $this->models->searchUsers($_SESSION['id'], $keyword));
		$view->setVar(user, $this->models->getUser($_SESSION['id']));
		$view->render('users.tpl.php');
	}
	
	//好友清單
	protected function friends()
	{
		$view = new HtmlView;
		$view->setVar(message, '好友名單：' . $keyword);
		$view->setVar(allFriends, $this->models->getAllFriends($_SESSION['id']));
		$view->setVar(user, $this->models->getUser($_SESSION['id']));
		$view->render('users.tpl.php');
	}
	
	// 加為好友
	protected function addFriend()
	{
		$id = $_GET['id'];
		if (!$this->models->addFriend($_SESSION['id'], $id)) die('申請好友失敗');
		echo "<script>history.go(-1);</script>";
	}
	
	// 確認交友申請
	protected function confirmFriend()
	{
		$id = $_GET['id'];
		if (!$this->models->confirmFriend($_SESSION['id'], $id)) die('確認交友申請失敗');
		echo "<script>history.go(-1);</script>";
	}
	
	// 取消交友申請
	protected function cancalAddFriend()
	{
		$id = $_GET['id'];
		if (!$this->models->cancalAddFriend($_SESSION['id'], $id)) die('取消好友申請失敗');
		echo "<script>history.go(-1);</script>";
	}
	
	// 拒絕交友申請
	protected function refuseFriend()
	{
		$id = $_GET['id'];
		if (!$this->models->refuseFriend($_SESSION['id'], $id)) die('拒絕好友申請失敗');
		echo "<script>history.go(-1);</script>";
	}
	
	// 刪除好友
	protected function removeFriend()
	{
		$id = $_GET['id'];
		if (!$this->models->removeFriend($_SESSION['id'], $id)) die('刪除好友失敗');
		echo "<script>history.go(-1);</script>";
	}
	
	// 改群組
	protected function changeGroup()
	{
		$id = $_GET['id'];
		$groupName = $_GET['groupName'];
		if (!$this->models->changeGroup($_SESSION['id'], $id, $groupName)) die('改群組失敗');
		echo "<script>history.go(-1);</script>";
	}
	
	/*****************************************************************************************************************************************/
	
	// 新曾留言
	protected function addMessage()
	{
		$id1 = $_POST['userId1'];
		$id2 = $_SESSION['id'];
		$message = $_POST['message'];
		
		if ($message != NULL) {
			if (!$this->models->addMessage($id1, $id2, $message)) die('留言失敗');
		}
		
		$this->redirectTo('./index.php?account=' . $_POST['account']);
	}
	
	// 新增回復
	protected function addResponse()
	{
		$messageId = $_POST['messageId'];
		$id = $_SESSION['id'];
		$response = $_POST['response'];
		
		if ($response != NULL) {
			if (!$this->models->addResponse($messageId, $id, $response)) die('回復留言失敗');
		}
		
		$this->redirectTo('./index.php?account=' . $_POST['account']);
	}
	
	// 編輯留言頁面
	protected function editMessage()
	{
		$messageId = $_GET['messageId'];
		
		if ($this->models->getType($_SESSION['id']) == 1 || $this->models->getMessageUserId1($messageId) == $_SESSION['id']) {
			$view = new HtmlView;
			$view->setVar(user, $this->models->getUser($_SESSION['id']));
			$view->setVar(message, $this->models->getMessage($messageId));
			$view->render('editMessage.tpl.php');
		} else {
			echo "<script>history.go(-1);</script>";
		}
	}
	
	// 編輯回復頁面
	protected function editResponse()
	{
		$responseId = $_GET['responseId'];
		
		if ($this->models->getType($_SESSION['id']) == 1) {
			$view = new HtmlView;
			$view->setVar(user, $this->models->getUser($_SESSION['id']));
			$view->setVar(response, $this->models->getResponse($responseId));
			$view->render('editMessage.tpl.php');
		} else {
			echo "<script>history.go(-1);</script>";
		}
	}
	
	// 編輯留言
	protected function doEditMessage()
	{
		$messageId = $_GET['messageId'];
		$message = $_POST['message'];
		
		if ($this->models->getType($_SESSION['id']) == 1 || $this->models->getMessageUserId1($messageId) == $_SESSION['id']) {
			if (!$this->models->editMessage($messageId, $message)) die('編輯留言失敗');
		}
		
		echo "<script>history.go(-2);</script>";
	}
	
	// 編輯回復
	protected function doEditResponse()
	{
		$responseId = $_GET['responseId'];
		$response = $_POST['response'];
		
		if ($this->models->getType($_SESSION['id']) == 1) {
			if (!$this->models->editResponse($responseId, $response)) die('編輯回復失敗');
		}
		
		echo "<script>history.go(-2);</script>";
	}
	
	// 刪除留言
	protected function deleteMessage()
	{
		$messageId = $_POST['messageId'];
		
		if ($this->models->getType($_SESSION['id']) == 1 || $this->models->getMessageUserId1($messageId) == $_SESSION['id']) {
			if (!$this->models->deleteMessage($messageId)) die('刪除留言失敗');
		}
		
		$this->redirectTo('./index.php?account=' . $_POST['account']);
	}
	
	// 刪除回復
	protected function deleteResponse()
	{
		$responseId = $_POST['responseId'];
		
		if ($this->models->getType($_SESSION['id']) == 1 || $this->models->getMessageUserId1FromResponseId($responseId) == $_SESSION['id']) {
			if (!$this->models->deleteResponse($responseId)) die('刪除回復失敗');
		}
		
		$this->redirectTo('./index.php?account=' . $_POST['account']);
	}

	// 解構函式
	public function __destruct()
	{
		$this->models = NULL;
	}

}