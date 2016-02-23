<?php echo $this->tag->form(array('login/start')); ?>
    <fieldset>
        <label for="username">Username</label>
        <div>
            <?php echo $this->tag->textField(array('username')); ?>
        </div>
        <label for="password">Password</label>
        <div>
            <?php echo $this->tag->passwordField(array('password')); ?>
        </div>
        <div>
            <?php echo $this->tag->submitButton(array('Login')); ?>
        </div>
    </fieldset>
<?php echo $this->tag->endform(); ?>