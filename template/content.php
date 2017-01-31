<div id="content">
  <div>
    <img src="images/image.jpg" id="imageImg"/>
  </div>

  <div id="form2">
    <form action="" method="post">
      <h1 style="color: white; padding-bottom: 20px;"> Sign Up </h1>
      <table>

        <tr>
          <td align="right" style="color: white;">Name:</td>
          <td>
            <input type="text" name="username" placeholder="Please enter your name" required="required"/>
          </td>
        </tr>

        <tr>
          <td align="right" style="color: white;">Email:</td>
          <td>
            <input type="email" name="e_mail" placeholder="Please enter your email address" required="required"/>
          </td>
        </tr>

        <tr>
          <td align="right" style="color: white;">Password</td>
          <td>
            <input type="password" name="password" placeholder="Please enter a password" required="required"/>
          </td>
        </tr>

        <tr>
          <td align="right" style="color: white;">Country:</td>
          <td>
            <select name="country">
              <option>Select a country</option>
              <option>United Kingdom</option>
            </select>
          </td>
        </tr>

        <tr>
          <td align="right" style="color: white;">Birthday:</td>
          <td>
            <input type="date" name="birthday"/>
          </td>
        </tr>

        <tr>
          <td colspan="6">
            <button name="signUp">Sign Up</button>
          </td>
        </tr>

      </table>
    </form>

  </div>
</div>
