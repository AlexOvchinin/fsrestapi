<!DOCTYPE html>
<html>
    <head>
        <title>fsrestapi client</title>
    </head>
    <body>
        <?php echo $this->tag->form(array('login/logout')); ?>
            <?php echo $this->tag->submitButton(array('Logout')); ?>
        <?php echo $this->tag->endform(); ?>
        <?php echo $this->tag->form(array($files / $deleteFile)); ?>
            <table>
                <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php $v6221263801iterator = $items; $v6221263801incr = 0; $v6221263801loop = new stdClass(); $v6221263801loop->self = &$v6221263801loop; $v6221263801loop->length = count($v6221263801iterator); $v6221263801loop->index = 1; $v6221263801loop->index0 = 1; $v6221263801loop->revindex = $v6221263801loop->length; $v6221263801loop->revindex0 = $v6221263801loop->length - 1; ?><?php foreach ($v6221263801iterator as $item) { ?><?php $v6221263801loop->first = ($v6221263801incr == 0); $v6221263801loop->index = $v6221263801incr + 1; $v6221263801loop->index0 = $v6221263801incr; $v6221263801loop->revindex = $v6221263801loop->length - $v6221263801incr; $v6221263801loop->revindex0 = $v6221263801loop->length - ($v6221263801incr + 1); $v6221263801loop->last = ($v6221263801incr == ($v6221263801loop->length - 1)); ?>
                    <tr>
                        <td><?php echo $v6221263801loop->index; ?></td>
                        <td><?php echo $item; ?></td>
                        <td> <?php echo $this->tag->submitButton(array('Login')); ?></td>
                    </tr>
                <?php $v6221263801incr++; } ?>
            </table>
        <?php echo $this->tag->endform(); ?>
        <?php if (isset($result)) { ?>
            <textarea rows = "5" cols = "50">
                <?php echo $result; ?>
            </textarea>
        <?php } ?>
    </body>
</html>