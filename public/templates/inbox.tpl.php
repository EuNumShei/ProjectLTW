<?php declare(strict_types = 1); ?>

<?php function drawContacts(array $contacted_users) { ?>
    <section class="contacts">
        <h1>Contacts</h1>
        <nav>
            <ul>
                <?php if (!empty($contacted_users)) { ?>
                    <?php foreach ($contacted_users as $contact) { ?>
                        <li><a href="inbox.php?receiver=<?= $contact->id; ?>"><?= $contact->username; ?></a></li>
                    <?php } ?>
                <?php } else { ?>
                    <li>No contacts found.</li>
                <?php } ?>
            </ul>
        </nav>
    </section>
<?php } ?>

<?php function drawChat(array $chat, User $sender, User $receiver) { ?>
    <section class="chat">
        <h2>Chat with <?= $receiver->username; ?></h2>
        <div class="chat-box">
            <?php foreach ($chat as $msg) { ?>
                <?php if ($msg['sender'] == $sender->id) { ?>
                    <div class="msg sent">
                        <span><?= $sender->username; ?></span>
                        <p><?= $msg['content']; ?></p>
                        <span><?= $msg['send_time']; ?></span>
                    </div>
                <?php } else { ?>
                    <div class="msg received">
                        <span><?= $receiver->username; ?></span>
                        <p><?= $msg['content']; ?></p>
                        <span><?= $msg['send_time']; ?></span>
                    </div>
                <?php } ?>
            <?php } ?>

            <section class="send-message">
                <form action="../actions/send-message.php" method="POST">
                    <input type="hidden" name="receiver" value="<?= $receiver->id ?>">
                    <textarea name="content" placeholder="Type your message here"></textarea>
                    <button type="submit">Send</button>
                </form>
            </section>
        </div>
    </section>
<?php } ?>