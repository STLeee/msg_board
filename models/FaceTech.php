<?php

// 留言版類別
class FaceTech
{
    // 建構函式
    public function __construct()
    {
        if(!@mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)) die("無法對資料庫連線");
		mysql_query("SET NAMES utf8");
		if(!@mysql_select_db(DB_NAME)) die("無法使用資料庫");
    }
	
	public function getAllUsers()
	{
		$sql = "SELECT * FROM users";
		$result = mysql_query($sql);
		
		$users = array();
		while ($row = @mysql_fetch_row($result)) {
			$users[] = array (
            		'id'		=> $row[0],
            		'account'	=> $row[1],
            		'password'	=> $row[2],
            		'type'		=> $row[3],
					'enable'	=> $row[4],
            		'username'	=> $row[5],
					'head'		=> $row[6],
					'birthday'	=> $row[7],
					'telephone'	=> $row[8],
					'city'		=> $row[9]);
		}
		mysql_free_result($result);
		
		return $users;
	}
    
    // 確認
    public function validate($_account, $_password)
    {
        $sql = "SELECT * FROM users WHERE account = '$_account'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		$user = array (
            'id'		=> $row[0],
            'account'	=> $row[1],
            'password'	=> $row[2],
            'type'		=> $row[3],
			'enable'	=> $row[4],
            'username'	=> $row[5],
			'head'		=> $row[6],
			'birthday'	=> $row[7],
			'telephone'	=> $row[8],
			'city'		=> $row[9]);
		
		if($_account != null && $_password != null && $user['account'] == $_account && $user['password'] == $_password) return $user['id'];
		else return 0;
    }
	
    // 確認ID
    public function validateWithId($_id, $_password)
    {
        $sql = "SELECT * FROM users WHERE id = '$_id'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		$user = array (
            'id'		=> $row[0],
            'account'	=> $row[1],
            'password'	=> $row[2],
            'type'		=> $row[3],
			'enable'	=> $row[4],
            'username'	=> $row[5],
			'head'		=> $row[6],
			'birthday'	=> $row[7],
			'telephone'	=> $row[8],
			'city'		=> $row[9]);
		
		if($_id != null && $_password != null && $user['id'] == $_id && $user['password'] == $_password) return true;
		else return false;
    }
	
	// 新增
	public function addUser($_user)
	{
		$_account = $_user['account'];
		$_password = $_user['password'];
		$_username = $_user['username'];
		$_birthday = $_user['birthday'];
		$_telephone = $_user['telephone'];
		$_city = $_user['city'];
		
		$sql = "INSERT INTO users (account, password, username, birthday, telephone, city) VALUES ('$_account', '$_password', '$_username', '$_birthday', '$_telephone', '$_city')";
		$result = mysql_query($sql);
		if ($result) {
			//success
			mysql_free_result($result);
			$sql = "SELECT * FROM users WHERE account = '$_account'";
			$result = mysql_query($sql);
			$row = @mysql_fetch_row($result);
			mysql_free_result($result);
			return $row[0];
		} else {
			//fail
			mysql_free_result($result);
			return 0;
		}
	}
	
	// 修改使用者帳戶
	public function editUser($_id, $_newPassword, $_username, $_head, $_birthday, $_telephone, $_city)
	{
		$sql = "UPDATE users SET id='$_id'";
		if ($_newPassword != NULL) 	$sql = $sql . ", password = '$_newPassword'";
		if ($_username != NULL) 	$sql = $sql . ", username = '$_username'";
		if ($_head != NULL) 		$sql = $sql . ", head = '$_head'";
		if ($_birthday != NULL) 	$sql = $sql . ", birthday = '$_birthday'";
		if ($_telephone != NULL) 	$sql = $sql . ", telephone = '$_telephone'";
		if ($_city != NULL) 		$sql = $sql . ", city = '$_city'";
		$sql = $sql . " WHERE id = '$_id'";
		$result = mysql_query($sql);
		
		if ($result) {
			mysql_free_result($result);
			return true;
		} else {
			mysql_free_result($result);
			return false;
		}
	}
	
	// 刪除帳戶
	public function deleteUser($_id)
	{
		$sql = "DELETE FROM users WHERE id = '$_id'";
		$result = mysql_query($sql);
		if ($result) {
			mysql_free_result($result);
			
			$sql = "DELETE FROM friends WHERE userId1 = '$_id' OR userId2 = '$_id'";
			$result = mysql_query($sql);
			mysql_free_result($result);
			
			$sql = "DELETE FROM messages WHERE userId1 = '$_id' OR userId2 = '$_id'";
			$result = mysql_query($sql);
			mysql_free_result($result);
			
			$sql = "DELETE FROM responses WHERE userId = '$_id'";
			$result = mysql_query($sql);
			mysql_free_result($result);
			
			return true;
		} else {
			mysql_free_result($result);
			return false;
		}
	}
	
	// 確認證號是否存在
	public function accountIsExist($_account)
	{
		$sql = "SELECT * FROM users WHERE account = '$_account'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		if ($row) return $row[0];
		else return 0;
	}
	
	// 取得帳號資訊
	public function getUser($_id)
	{
		$sql = "SELECT * FROM users WHERE id = '$_id'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		$user = array (
            'id'		=> $row[0],
            'account'	=> $row[1],
            'password'	=> $row[2],
            'type'		=> $row[3],
			'enable'	=> $row[4],
            'username'	=> $row[5],
			'head'		=> $row[6],
			'birthday'	=> $row[7],
			'telephone'	=> $row[8],
			'city'		=> $row[9]);
			
		return $user;
	}
	
	// 取得帳號資訊
	public function getUserAndFriendType($_id1, $_id2)
	{
		$sql = "SELECT * FROM users WHERE id = '$_id2'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		$user = array (
            'id'		=> $row[0],
            'account'	=> $row[1],
            'password'	=> $row[2],
            'type'		=> $row[3],
			'enable'	=> $row[4],
            'username'	=> $row[5],
			'head'		=> $row[6],
			'birthday'	=> $row[7],
			'telephone'	=> $row[8],
			'city'		=> $row[9],
			'friendType'=> $this->isFriend($_id1, $_id2));
			
		return $user;
	}
	
	// 取得帳號
	public function getAccount($_id)
	{
		$user = $this->getUser($_id);
		return $user['account'];
	}
	
	// 取得帳號權限
	public function getType($_id)
	{
		$user = $this->getUser($_id);
		return $user['type'];
	}
	
	// 取得帳號是否啓用
	public function isEnable($_id)
	{
		$user = $this->getUser($_id);
		return $user['enable'];
	}
	
	// 凍結帳號
	public function disable($_id)
	{
		if ($this->isEnable($_id)) {
			$sql = "UPDATE users SET enable = '0' WHERE id = '$_id'";
			$result = mysql_query($sql);
			
			if ($result) {
				mysql_free_result($result);
				return true;
			} else {
				mysql_free_result($result);
				return false;
			}
		} else return true;
	}
	
	// 解鎖帳號
	public function enable($_id)
	{
		if (!$this->isEnable($_id)) {
			$sql = "UPDATE users SET enable = '1' WHERE id = '$_id'";
			$result = mysql_query($sql);
		
			if (!$result) {
				mysql_free_result($result);
				return true;
			} else {
				mysql_free_result($result);
				return false;
			}
		} else return true;
	}
	
	// 搜尋使用者
	public function searchUsers($_id, $_keyword)
	{
		$sql = "SELECT * FROM users WHERE account LIKE '%$_keyword%' OR username LIKE '%$_keyword%'";
		$result = mysql_query($sql);
		
		$users = array();
		while ($row = @mysql_fetch_row($result)) {
			$users[] = array (
            		'id'		=> $row[0],
            		'account'	=> $row[1],
            		'password'	=> $row[2],
            		'type'		=> $row[3],
					'enable'	=> $row[4],
            		'username'	=> $row[5],
					'head'		=> $row[6],
					'birthday'	=> $row[7],
					'telephone'	=> $row[8],
					'city'		=> $row[9],
					'friendType'=> $this->isFriend($_id, $row[0]));
		}
		mysql_free_result($result);
			
		return $users; 
	}
	
	/**********************************************************************************************************/
	
	// 取得好友清單
	public function getAllFriends($_id)
	{
		$sql = "SELECT * FROM friends WHERE userId1 = '$_id'";
		$result = mysql_query($sql);
		
		$unFriends = array();
		$allFriends[] = array(
				'groupName'	=>	'未確認的好友申請',
				'friends'	=>	$unFriends);
		while ($row = @mysql_fetch_row($result)) {
			if (!$row[2]) {
				$allFriends[0]['friends'][] = $this->getUser($row[1]);
			} else {
				$position = 0;
				foreach($allFriends as $group) {
					if ($group['groupName'] == $row[3]) break;
					else $position++;
				}
					
				if ($position < count($allFriends)) {
					$allFriends[$position]['friends'][] = $this->getUser($row[1]);
				} else {
					$friends = array();
					$friends[] = $this->getUser($row[1]);
					$allFriends[] = array(
							'groupName'	=>	$row[3],
							'friends'	=>	$friends);
				}
			}
		}
		mysql_free_result($result);
			
		return $allFriends; 
	}
	
	// 取得好友ID
	public function getAllFriendsId($_id)
	{
		$sql = "SELECT * FROM friends WHERE userId1 = '$_id'";
		$result = mysql_query($sql);
		
		$allFriendsId = array();
		while ($row = @mysql_fetch_row($result)) {
			if ($row[2] == 1) $allFriendsId[] = $row[1];
		}
		mysql_free_result($result);
			
		return $allFriendsId; 
	}
	
	// 確認好友狀態
	public function isFriend($_id1, $_id2)
	{
		$sql = "SELECT * FROM friends WHERE userId1 = '$_id1' AND userId2 = '$_id2'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		mysql_free_result($result);
		$sql2 = "SELECT * FROM friends WHERE userId1 = '$_id2' AND userId2 = '$_id1'";
		$result2 = mysql_query($sql2);
		$row2 = @mysql_fetch_row($result2);
		mysql_free_result($result2);
		
		if ($row) return $row[2] + 2;
		else if ($row2 && $row2[2] == 0) return 1; 
		else return 0;
		//0:你不是我朋友
		//1:我想當你的朋友
		//2:我還沒決定要不要當你的朋友
		//3:你是我得朋友
	}
	
	// 加為好友
	public function addFriend($_id1, $_id2)
	{
		if (!$this->isFriend($_id1, $_id2)) {
			if (!$this->isFriend($_id2, $_id1)) {
				$sql = "INSERT INTO friends (userId1, userId2) VALUES ('$_id2', '$_id1')";
				$result = mysql_query($sql);
				if ($result) {
					mysql_free_result($result);
					return true;
				} else {
					mysql_free_result($result);
					return false;
				}
			} else if ($this->isFriend($_id2, $_id1) == 3) {
				$sql = "INSERT INTO friends (userId1, userId2, type) VALUES ('$_id1', '$_id2', '1')";
				$result = mysql_query($sql);
				if ($result) {
					mysql_free_result($result);
					return true;
				} else {
					mysql_free_result($result);
					return false;
				}
			}
		}
	}
	
	// 確認交友申請
	public function confirmFriend($_id1, $_id2)
	{
		if ($this->isFriend($_id1, $_id2) == 2) {
			$sql = "UPDATE friends SET type = '1' WHERE userId1 = '$_id1' AND userId2 = '$_id2'";
			$result = mysql_query($sql);
			if ($result) {
				mysql_free_result($result);
				
				$sql = "INSERT INTO friends (userId1, userId2, type) VALUES ('$_id2', '$_id1', '1')";
				$result = mysql_query($sql);
				if ($result) {
					mysql_free_result($result);
					return true;
				} else {
					mysql_free_result($result);
					return false;
				}
			} else {
				mysql_free_result($result);
				return false;
			}
		}
	}
	
	// 取消交友申請
	public function cancalAddFriend($_id1, $_id2)
	{
		if ($this->isFriend($_id1, $_id2) == 1) {
			$sql = "DELETE FROM friends WHERE userId1 = '$_id2' AND userId2 = '$_id1'";
			$result = mysql_query($sql);
			if ($result) {
				mysql_free_result($result);
				return true;
			} else {
				mysql_free_result($result);
				return false;
			}
		}
	}
	
	// 拒絕交友申請
	public function refuseFriend($_id1, $_id2)
	{
		if ($this->isFriend($_id1, $_id2) == 2) {
			$sql = "DELETE FROM friends WHERE userId1 = '$_id1' AND userId2 = '$_id2'";
			$result = mysql_query($sql);
			if ($result) {
				mysql_free_result($result);
				return true;
			} else {
				mysql_free_result($result);
				return false;
			}
		}
	}
	
	// 刪除好友
	public function removeFriend($_id1, $_id2)
	{
		if ($this->isFriend($_id1, $_id2) == 3) {
			$sql = "DELETE FROM friends WHERE userId1 = '$_id1' AND userId2 = '$_id2'";
			$result = mysql_query($sql);
			if ($result) {
				mysql_free_result($result);
				return true;
			} else {
				mysql_free_result($result);
				return false;
			}
		}
	}
	
	// 改群組
	public function changeGroup($_id1, $_id2, $groupName)
	{
		if ($this->isFriend($_id1, $_id2) == 3) {
			echo $_id1.", ". $_id2.", ". $groupName."<br>";
			$sql = "UPDATE friends SET `group` = '$groupName' WHERE userId1 = '$_id1' AND userId2 = '$_id2'";
			$result = mysql_query($sql);
			if ($result) {
				mysql_free_result($result);
				return true;
			} else {
				mysql_free_result($result);
				return false;
			}
		}
	}
	
	/****************************************************************************************************************************/
	
	
	
	public function addMessage($_id1, $_id2, $_message)
	{
		$sql = "INSERT INTO messages (`userId1`, `userId2`, `date`, `message`) VALUES ('$_id1', '$_id2', NOW(), '$_message')";
		$result = mysql_query($sql);
		if ($result) {
			//success
			mysql_free_result($result);
			return true;
		} else {
			//fail
			mysql_free_result($result);
			return false;
		}
	}
	
	// 取得留言
	public function getMessage($_messageId)
	{
		$sql = "SELECT * FROM messages WHERE id = '$_messageId'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		$message = array (
				'id'		=>	$row[0],
				'user1'		=>	$this->getUser($row[1]),
				'user2'		=>	$this->getUser($row[2]),
				'date'		=>	$row[3],
				'message'	=>	$row[4],
				'responses'	=>	$this->getResponses($row[0]));
		
		return $message;
	}
	
	// 取得留言主人的ID
	public function getMessageUserId1($_messageId)
	{
		$message = $this->getMessage($_messageId);
		
		return $message['user1']['id'];
	}
	
	// 取得留言主人的ID
	public function getMessageUserId1FromResponseId($_responseId)
	{
		$response = $this->getResponse($_responseId);
		$message = $this->getMessage($response['messageId']);
		
		return $message['user1']['id'];
	}
	
	// 取得個人得留言
	public function getMessages($_id)
	{
		$sql = "SELECT * FROM messages WHERE userId1 = '$_id'";
		$result = mysql_query($sql);
		
		$messages = array();
		while ($row = @mysql_fetch_row($result)) {
			$messages[] = array (
					'id'		=>	$row[0],
            		'user1'		=>	$this->getUser($row[1]),
					'user2'		=>	$this->getUser($row[2]),
					'date'		=>	$row[3],
            		'message'	=>	$row[4],
					'responses'	=>	$this->getResponses($row[0]));
		}
		mysql_free_result($result);
		
		krsort($messages);
		return $messages;
	}
	
	// 取得所有留言
	public function getAllMessages()
	{
		$allFriendsId = $this->getAllFriendsId($_id);
		$sql = "SELECT * FROM messages";
		
		$result = mysql_query($sql);
		
		$messages = array();
		while ($row = @mysql_fetch_row($result)) {
			$messages[] = array (
					'id'		=>	$row[0],
            		'user1'		=>	$this->getUser($row[1]),
					'user2'		=>	$this->getUser($row[2]),
					'date'		=>	$row[3],
            		'message'	=>	$row[4],
					'responses'	=>	$this->getResponses($row[0]));
		}
		mysql_free_result($result);
		
		krsort($messages);
		return $messages;
	}
	
	// 取得所有朋友的留言
	public function getFriendsMessages($_id)
	{
		$allFriendsId = $this->getAllFriendsId($_id);
		$sql = "SELECT * FROM messages WHERE userId1 = '$_id'";
		foreach ($allFriendsId as $friendId) {
			$sql = $sql . " OR userId1 = '$friendId'";
		}
		
		$result = mysql_query($sql);
		
		$messages = array();
		while ($row = @mysql_fetch_row($result)) {
			$messages[] = array (
					'id'		=>	$row[0],
            		'user1'		=>	$this->getUser($row[1]),
					'user2'		=>	$this->getUser($row[2]),
					'date'		=>	$row[3],
            		'message'	=>	$row[4],
					'responses'	=>	$this->getResponses($row[0]));
		}
		mysql_free_result($result);
		
		krsort($messages);
		return $messages;
	}
	
	// 新增回復
	public function addResponse($_messageId, $_id, $_response)
	{
		$sql = "INSERT INTO responses (messageId, userId, date, response) VALUES ('$_messageId', '$_id', NOW(), '$_response')";
		$result = mysql_query($sql);
		if ($result) {
			//success
			mysql_free_result($result);
			return true;
		} else {
			//fail
			mysql_free_result($result);
			return false;
		}
	}
	
	// 取得所有回覆
	public function getResponses($_messageId)
	{
		$sql = "SELECT * FROM responses WHERE messageId = '$_messageId'";
		$result = mysql_query($sql);
		
		$responses = array();
		while ($row = @mysql_fetch_row($result)) {
			$responses[] = array (
					'id'		=>	$row[0],
            		'user'		=>	$this->getUser($row[2]),
					'date'		=>	$row[3],
            		'response'	=>	$row[4]);
		}
		mysql_free_result($result);
		
		return $responses;
	}
	
	// 取得回覆
	public function getResponse($_responseId)
	{
		$sql = "SELECT * FROM responses WHERE id = '$_responseId'";
		$result = mysql_query($sql);
		$row = @mysql_fetch_row($result);
		
		mysql_free_result($result);
		
		$response = array (
				'id'		=>	$row[0],
				'messageId' =>	$row[1],
				'user'		=>	$this->getUser($row[2]),
				'date'		=>	$row[3],
				'response'	=>	$row[4]);
		
		return $response;
	}
	
	// 編輯留言
	public function editMessage($_messageId, $_message)
	{
		$sql = "UPDATE messages SET message = '$_message' WHERE id = '$_messageId'";
		$result = mysql_query($sql);
		if ($result) {
			mysql_free_result($result);
			return true;
		} else {
			mysql_free_result($result);
			return false;
		}
	}
	
	// 編輯回復
	public function editResponse($_responseId, $_response)
	{
		$sql = "UPDATE responses SET response = '$_response' WHERE id = '$_responseId'";
		$result = mysql_query($sql);
		if ($result) {
			mysql_free_result($result);
			return true;
		} else {
			mysql_free_result($result);
			return false;
		}
	}
	
	// 刪除留言
	public function deleteMessage($_messageId)
	{
		$sql = "DELETE FROM messages WHERE id = '$_messageId'";
		$result = mysql_query($sql);
		if ($result) {
			mysql_free_result($result);
			return $this->deleteResponseFromMessageId($_messageId);
		} else {
			mysql_free_result($result);
			return false;
		}
	}
	
	// 刪除回復
	public function deleteResponse($_responseId)
	{
		$sql = "DELETE FROM responses WHERE id = '$_responseId'";
		$result = mysql_query($sql);
		if ($result) {
			mysql_free_result($result);
			return true;
		} else {
			mysql_free_result($result);
			return false;
		}
	}
	
	// 刪除回復FromMessageId
	public function deleteResponseFromMessageId($_messageId)
	{
		$sql = "DELETE FROM responses WHERE messageId = '$_messageId'";
		$result = mysql_query($sql);
		if ($result) {
			mysql_free_result($result);
			return true;
		} else {
			mysql_free_result($result);
			return false;
		}
	}

    // 解構函式
    public function __destruct()
    {
		mysql_close(); 
    }

}