<h3>Log In</h3>
<form action='/users/login' method='post'>
    <table>
        <tr>
            <td>
                Email Address
            </td><td>
                <input type='text' name='email' id='email' value='<?php echo stripslashes($email); ?>'>
            </td>
        </tr><tr>
            <td>
                Password
            </td><td>
                <input type='password' name='password' id='password'>
            </td>
        </tr><tr>
            <td></td><td>
                <input type='submit' value='Log In'>
            </td>
        </tr>
    </table>
</form>