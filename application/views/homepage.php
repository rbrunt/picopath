
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
                         <?php
                            $this->load->view('link_form.php', $loggedin);
                         ?>
