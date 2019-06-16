<?php include 'templates/function.tpl.php'; ?>
  
<script>
function askForCancel()
{
	if (confirm("取消?")) {
		history.go(-1);
	}
}
</script>
  
  <div class="messageBlock">
<?php if ($this->message): ?>
    <form name="editMessage" id="editMessage" method="post" action="./index.php?act=doEditMessage&messageId=<?php echo $this->message['id']; ?>" >
      <textarea name="message" id="message" style="width:100%"><?php echo $this->message['message']; ?></textarea>
      <div class="messageBlockFunctions">
        <input type="submit" value="送出" />
        <input type="button" onclick="askForCancel()" value="取消" />
      </div>
    </form>
<?php elseif ($this->response): ?>
    <form name="editResponse" id="editResponse" method="post" action="./index.php?act=doEditResponse&responseId=<?php echo $this->response['id']; ?>" >
      <textarea name="response" id="response" style="width:100%"><?php echo $this->response['response']; ?></textarea>
      <div class="messageBlockFunctions">
        <input type="submit" value="送出" />
        <input type="button" onclick="askForCancel()" value="取消" />
      </div>
    </form>
<?php endif; ?>
  </div>