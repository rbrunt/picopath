<?php
    if($register == TRUE){
?>
    <h4>Thanks for registering!</h4>
<?php
    }
?>
    <h3>Hi <?php echo html_escape($email);?></h3>
    <h4>Here's your links</h4>
    <?php
        foreach($links->result() as $link){
            echo $link->name;
        }
    ?>