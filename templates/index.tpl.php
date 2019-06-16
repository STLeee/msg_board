<?php include 'templates/function.tpl.php'; ?>
  
  <div id="content">
  
  <?php if ($this->userMessages): ?>
  
  <div class="userBlock">
    <div class="nameBlock1">
    </div>
    <div class="nameBlock2">
      <table width="100%">
        <tr>
          <td width="124">
            <div class="head"><img src="./head/<?php echo $this->userMessages['head']; ?>"></div>
          </td>
          <td width="220">
            <h2><?php echo $this->userMessages['username']; ?></h2>
          </td>
          <td>
            <p class="messageBlockFunctions">
            <?php if ($this->user['id'] != $this->userMessages['id']): ?>
              <?php if ($this->friendType == 0): ?>
              <a href="./index.php?act=addFriend&id=<?php echo $this->userMessages['id']; ?>">加為好友</a>
              <?php elseif ($this->friendType == 1): ?>
              等待確認中-<a href="./index.php?act=cancalAddFriend&id=<?php echo $this->userMessages['id']; ?>">取消</a>
              <?php elseif ($this->friendType == 2): ?>
              <a href="./index.php?act=confirmFriend&id=<?php echo $this->userMessages['id']; ?>">確認</a>／<a href="./index.php?act=refuseFriend&id=<?php echo $this->userMessages['id']; ?>">拒絕</a>
              <?php elseif ($this->friendType == 3): ?>
              <a href="./index.php?act=removeFriend&id=<?php echo $this->userMessages['id']; ?>">刪除好友</a>
              <?php endif; ?>
            <?php endif; ?>
            </p>
          </td>
        </tr>
      </table>
    </div>
    
    <table style="margin-top:10px; margin-left:50px; padding:4px">
      <tr>
        <td width="90px"><p>Birthday : </p></td>
        <td><p><?php echo $this->userMessages['birthday']; ?></p></td>
      </tr>
      
      <tr>
        <td><p>Telephone : </p></td>
        <td><p><?php echo $this->userMessages['telephone']; ?></p></td>
      </tr>
      
      <tr>
        <td><p>City : <p></td>
        <td><p><?php echo $this->userMessages['city']; ?></p></td>
      </tr>
    </table>
    
  </div>
  
  <?php endif; ?>
  
<?php if ($this->userMessages == NULL || $this->friendType == 3 || $this->userMessages['id'] == $this->user['id'] || $this->user['type'] == 1): ?>
  <form name="message" id="message" method="post" action="./index.php?act=addMessage">
<?php if ($this->userMessages): ?>
    <input type="hidden" name="userId1" value="<?php echo $this->userMessages['id']; ?>" />
<?php else: ?>
    <input type="hidden" name="userId1" value="<?php echo $this->user['id']; ?>" />
<?php endif; ?>
    <input type="hidden" name="account" value="<?php echo $this->userMessages['account']; ?>" />
    <p class="messageAddBlock">
    <textarea name="message" id="message" placeholder="你有事嗎，<?php echo $this->user['username']; ?>？" onfocus="this.style.height='75px'" style="height:18px; width:100%; padding:4px;"></textarea>
    </p>
    <p class="messageBlockFunctions">
    <input type="submit" value="送出" style="margin-right:10px; margin-top:4px;" />
    </p>
  </form>
<?php endif; ?>
  
<?php if ($this->messages): ?>
<?php foreach ($this->messages as $message): ?>
<script>
	function askForDeleteMessage<?php echo $message['id']; ?>() {
		if (confirm("確定要刪除?")) {
			document.forms["deleteMessage<?php echo $message['id']; ?>"].submit();
		}
	}
</script>
        <div class="messageBlock">
            <div class="userAndMessage" <?php if ($message['user2']['type'] == 1) echo 'style="background-color: #F44"'; ?>>
              <table width="100%">
                <tr>
                  <td width="52" style="vertical-align:top">
                    <img src="./head/<?php echo $message['user2']['head']; ?>" height="48" width="48">
                  </td>
                  <td style="vertical-align:text-top">
                    <table width="100%">
                      <tr>
                        <td>
                          <table width="100%">
                            <tr>
                              <td width="170px">
                                <h4 style="margin-top:-2px"><a href="./index.php?account=<?php echo $message['user2']['account']; ?>"><?php echo $message['user2']['username']; ?></a>
<?php if ($message['user1']['id'] != $message['user2']['id']): ?>
                                >>
                                <a href="./index.php?account=<?php echo $message['user1']['account']; ?>"><?php echo $message['user1']['username']; ?></a></h4>
<?php endif; ?>
                              </td>
                              <td style="text-align:right">
                                <div style="font-size:10px; color:#666">
                                  <form name="deleteMessage" id="deleteMessage<?php echo $message['id']; ?>" method="post" action="index.php?act=deleteMessage">
                                    <?php echo $message['date']; ?>
<?php if ($this->user['type'] == 1 || $this->user['id'] == $this->userMessages['id']): ?>
                                    <input type="hidden" name="messageId" value="<?php echo $message['id']; ?>" />
                                    <input type="hidden" name="account" value="<?php echo $this->userMessages['account']; ?>" />
                                    &nbsp;<input type="button" onclick="document.location.href='./index.php?act=editMessage&messageId=<?php echo $message['id']; ?>'" value="編輯" style="background-color:inherit; border-style:inherit" />
                                    &nbsp;<input type="button" onclick="askForDeleteMessage<?php echo $message['id']; ?>()" value="X" style="background-color:inherit; border-style:inherit" />
<?php endif; ?>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="message"><?php echo nl2br(htmlentities($message['message'])); ?></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
            
            
<?php if ($message['responses']): ?>
<?php foreach ($message['responses'] as $response): ?>
<script type="text/javascript">
	function askForDeleteResponse<?php echo $response['id']; ?>() {
		if (confirm("確定要刪除?")) {
			document.forms["deleteResponse<?php echo $response['id']; ?>"].submit();
		}
	}
</script>
            <div class="userAndResponse">
              <table width="100%">
                <tr>
                  <td width="36" style="vertical-align:top">
                    <img src="./head/<?php echo $response['user']['head']; ?>" height="32" width="32">
                  </td>
                  <td style="vertical-align:text-top">
                    <table width="100%">
                      <tr>
                        <td>
                          <table width="100%">
                            <tr>
                              <td width="120px">
                                <h5 style="margin-top:-6px;"><a <?php if ($response['user']['type'] == 1) echo 'style="color: #F00"'; ?> href="./index.php?account=<?php echo $response['user']['account']; ?>"><?php echo $response['user']['username']; ?></a></h6>
                              </td>
                              <td style="text-align:right">
                                <div style="font-size:10px; color:#666">
                                  <form name="deleteResponse" id="deleteResponse<?php echo $response['id']; ?>" method="post" action="index.php?act=deleteResponse">
                                    <?php echo $response['date']; ?>
<?php if ($this->user['type'] == 1 || $this->user['id'] == $this->userMessages['id']): ?>
                                    <input type="hidden" name="responseId" value="<?php echo $response['id']; ?>" />
                                    <input type="hidden" name="account" value="<?php echo $this->userMessages['account']; ?>" />
<?php if ($this->user['type'] == 1): ?>
                                    &nbsp;<input type="button" onclick="document.location.href='./index.php?act=editResponse&responseId=<?php echo $response['id']; ?>'" value="編輯" style="background-color:inherit; border-style:inherit" />
<?php endif; ?>
                                    &nbsp;<input type="button" onclick="askForDeleteResponse<?php echo $response['id']; ?>()" value="X" style="background-color:inherit; border-style:inherit" />
<?php endif; ?>
                                  </form>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="response"><?php echo nl2br(htmlentities($response['response'])); ?></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
<?php endforeach; ?>
<?php endif; ?>

            
<!--?php if ($this->userMessages == NULL || $this->friendType == 3 || $this->userMessages['id'] == $this->user['id'] || $this->user['type'] == 1): ?-->
  <form name="message" id="message" method="post" action="./index.php?act=addResponse">
    <input type="hidden" name="messageId" value="<?php echo $message['id']; ?>" />
    <input type="hidden" name="account" value="<?php echo $this->userMessages['account']; ?>" />
    <div class="responseAddBlock"><textarea name="response" id="response" placeholder="留言..." style="height:18px; width:100%; padding:2px;"></textarea></div>
    <div class="messageBlockFunctions"><input type="submit" value="送出" style="margin-top:4px;" /></div>
  </form>
<!--?php endif; ?-->
            
        </div>
<?php endforeach; ?>
<?php endif; ?>
  
  </div>