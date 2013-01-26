<h2><span>Add A Link</span></h2>

<div id="addlink" class="section" style="margin-top: 40px; text-align: center;">
<div id="message" style="text-align: center; display: none;"><b style='color: red;'>Could not add this link.</b></div>
    URL:
    <input type="text" name="url" id="url" size="40">
    <button onclick="addLink(); return false;">Add Link</button>
    <?php if($loggedin){ ?>
    <div>
        Custom Shortlink (optional): http://picopath.com/<input type='text' name='name' id='name' size='10' onkeyup="checkLink();">
        <div id='taken'></div>
    </div>
    <?php }?>
</div>