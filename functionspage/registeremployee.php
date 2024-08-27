<?php

function registerEmployee(){
  ?>
  <form action="managerpage.php" class="emoregistrationform" name="empregiter" method="post">
    <div class="infocontainer">
      <div class="nameholder">
          <div class=" values">
            <label for="fname">First Name</label><br>
            <input class="valu" type="text" required name="fname" class="name"><br>
            <span class="fname_error"></span>
          </div>
          <div class="values">
          <label for="lname">Last Name</label><br>
            <input class="valu" type="text" require name="lname" class="l_name"><br>
            <span class="lname_error"></span>
          </div>
      </div>
      <div class="phonedate">
          <div class=" values">
          <label for="phone">Phone Number</label><br>
              <input class="valu" type="text"  name="phone" class="phone_no"><br>
              <span class="pho_error"></span>
          </div>
          <div class=" values">
          <label for="birthdate">Date of Birth</label><br>
              <input class="valu" type="date"  name="birthdate" class="birthdate"><br>
              <span class="birtherror"></span>
          </div>
      </div>
      <div class="phonedate">
          <div class=" values">
              <label for="nation">Nationality</label><br>
              <input class="valu" type="text"  name="nationality" class="nationality"><br>
              <span class="nation_error"></span>
              </div>
          <div class=" values">
              <label for="region">Region</label><br>
              <input class="valu" type="text"  name="region" class="region"><br>
              <span class="region_error"></span>
            </div>
          </div>

          <div class="phonedate">
            <div class=" values">
              <label for="zone">Zone</label><br>
              <input class="valu" type="text"  name="zone" class="zone"><br>
              <span class="zone_error error"></span>
            </div>
            <div class=" values">
          <label for="woreda">Woreda</label><br>
              <input class="valu" type="text"  name="woreda" class="woreda"><br>
              <span class="wereda_error"></span>
        </div>
          </div>
          <div class="phonedate">
            <div class=" values">
          <label for="kebele">Kebele</label><br>
                <input class="valu"v type="text"  name="kebele" class="kebele"><br>
              <span class="kebele_error"></span>
        </div>
        <div class=" values">
          <label for="sex">Gender</label><br>
             <select name="gender" id="genderid">
              <option class="valu" value="female">Female</option>
              <option class="valu" value="male">Male</option>
             </select>
        </div>
          </div>
      <div class="phonedate">
        <div class=" values">
        <label for="email">Email</label><br>
              <input class="valu" type="email"  name="email" class="email"><br>
              <span class="email_error"></span>
        </div>
          <div class=" values">
                  <label for="role">Role</label><br>
                        <input class="valu" type="text"  name="role" class="role" require><br>
                        <span class="role_error"></span>
                  </div>
      </div>
      <div class="phonedate">
        <div class=" values">
        <label for="salary">Salary</label><br>
              <input class="valu" type="number"  name="salary" class="salary"><br>
              <span class="salary_error"></span>
        </div>
      </div>
      
      <div>
         <input type="submit" name="submit" value="Regiter" class="btnRegister">
    <input type="reset" name="clear" value="Clear" class="btnclear">
      </div>
    </div>
   
  </form>

  <?php    
}
?>