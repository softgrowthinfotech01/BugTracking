  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand wow fadeIn" href="#">
            <!-- <img src="img/logo-inverse-166x57.png" width="166" height="57" alt=""> -->
            Bug Tracking Tool
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="dashboard">Dashboard <span class="border-b"></span>  <span class="sr-only">(current)</span></a>
              </li>
              <?php
              //check if employee id a tester then show add bugs menu
              if($row_employee_details[0]['employee_type']=="Tester")
              {
                  ?>
                <li class="nav-item">
                    <a class="nav-link" href="add_bug">Add Bugs <span class="border-b"></span>  </a>
                </li>
                  <?php
              }
              ?>
              <?php
              //check if employee id a tester then show add bugs menu
              if($row_employee_details[0]['employee_type']=="Developer")
              {
                  ?>
                <li class="nav-item">
                    <a class="nav-link" href="assigned_bugs">Assigned Bugs<span class="border-b"></span>  </a>
                </li>
                  <?php
              }
              ?>
              <?php
              
              ?>
              <!--<li class="nav-item">-->
              <!--  <a class="nav-link" href="emientry">Emi Details <span class="border-b"></span></a>-->
              <!--</li>-->
              <!--<li class="nav-item">-->
              <!--  <a class="nav-link" href="reports">Reports <span class="border-b"></span></a>-->
              <!--</li>-->
              <li class="nav-item">
                <a class="nav-link" href="logout">Logout <span class="border-b"></span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>