
            <script type="text/javascript">
                function addLink() {
                    $.post("/links/addlink", {url: $("#url").val()}, function(name) {
                        if (name == 'false') {
                            $("#message").fadeIn();
                        } else {
                            $("#addlink").html("Your link has been added. Go to: <a href='/" + name + "'>http://picopath.com/" + name + "</a>");
                        }
                    });
                }
            </script>

			<div id="logo" class="section logo">
				<h1>
					<a href="#">
						<img src="/media/images/logo.png" width="297" height="47" alt="PicoPath" />
					</a>
				</h1>
			</div>

			<h2><span>About Us</span></h2>

			<div class="section about">
				<h3>It's Super Effective!</h3>
                <p>PicoPath is a link shortening service. To customise the name of your links you can <a href="/users/registerform/">create an account</a>.</p>
			</div>

			<hr />

			<h2><span>Add A Link</span></h2>

			<div id="addlink" class="section" style="margin-top: 40px; text-align: center;">
    			<div id="message" style="text-align: center; display: none;"><b style='color: red;'>Could not add this link.</b></div>
                URL:
                <input type="text" name="url" id="url" size="40">
                <button onclick="addLink(); return false;">Add Link</button>
			</div>
