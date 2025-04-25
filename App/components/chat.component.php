<button class ="chatbot-toggler">
    <img src="<?=ROOT?>/images/icons/chat.svg" class="icon-btn" alt="">
    <img src="<?=ROOT?>/images/icons/close.svg" class="icon-btn" alt="">
</button>

<div class="chatbot">
    <header>
        <h2><?=$user?></h2>
    </header>
    <ul class ="chatbox">
        <?php foreach($chat as $message): ?>
            <li class="chat <?=$message['direction']?>">
                <p><?=$message['text']?></p>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="chat-input alitem-center">
        <textarea placeholder="Type a message..." required></textarea>
        <img id="send-btn" src="<?=ROOT?>/images/icons/send.svg" class="send-btn clickable" alt="">
    </div>
</div>
<div class="hidden" id="chatBackDrop"></div>