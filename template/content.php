<div id="content">
  <div>
    <img src="images/image.jpg" id="imageImg"/>
  </div>

  <div id="form2">
    <form action="" method="post">
      <h1 style="color: white; padding-bottom: 20px;"> Sign Up </h1>
      <table>

        <tr>
          <td align="right" style="color: white;">First name:</td>
          <td>
            <input type="text" name="firstName" placeholder="Please enter your first name" required="required"/>
          </td>
        </tr>

        <tr>
          <td align="right" style="color: white;">Surname:</td>
          <td>
            <input type="text" name="lastName" placeholder="Please enter your first surname" required="required"/>
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
          <td align="right" style="color: white;">Gender:</td>
          <td>
            <select name="gender">
              <option>Select a gender</option>
              <option>Male</option>
              <option>Female</option>
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
