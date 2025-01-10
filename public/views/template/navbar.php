<header class="main-nav">
          <div class="sidebar-user text-center">
            <a class="setting-primary" href="javascript:void(0)"
              ><i data-feather="settings"></i></a
            ><img
              class="img-90 rounded-circle"
              src="<?= assets('assets/images/dashboard/1.png')?>"
              alt=""
            />
            <!-- <div class="badge-bottom">
              <span class="badge badge-primary">New</span>
            </div> -->
            <a href="#">
              <h6 class="mt-3 f-14 f-w-600"><?= $_SESSION['name'] ?></h6>
            </a>
            <p class="mb-0 font-roboto"><?= $_SESSION['position']?></p>
            <ul>
              <li>
                <span>2 year</span>
                <p>Experince</p>
              </li>
            </ul>
          </div>
          <nav>
            <div class="main-navbar">
              <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
              </div>
              <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                  <li class="back-btn">
                    <div class="mobile-back text-end">
                      <span>Back</span
                      ><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <!--  -->
                      <h6>PMS</h6>
                    </div>
                  </li>
                  <li class="dropdown">
                    <a class="nav-link menu-title link-nav <?= $active == "home" ? "active" : ""?>" href="<?=$this->basePath?>home"
                      ><i data-feather="home"></i><span>Dashboard</span></a
                    >
                  </li>
                  <li class="dropdown">
                    <a
                      class="nav-link menu-title link-nav <?= $active == "quarterly" ? "active" : ""?>"
                      href="<?=$this->basePath?>quarterlyPMS"
                      ><i data-feather="book"></i><span>Quarterly PMS</span></a
                    >
                  </li>
                 <?php
                  if($_SESSION['type'] == "2"){
                 ?>
                  <li class="dropdown">
                    <a class="nav-link menu-title <?= $active == "result" || ($active == "kpi" || $active == "evaluation" || $active == "result") ? "active" : ""?>" href="javascript:void(0)"
                      ><i data-feather="settings"></i><span>Management</span></a
                    >
                    <ul class="nav-submenu menu-content <?= $active == "kpi" || $active == "evaluation" || $active == "result" ? "d-block" : ""?>" >
                      <li><a href="<?=$this->basePath?>kpi" class="<?= $active == "kpi" ? "active" : ""?>">KPI</a></li>
                      <li><a href="<?=$this->basePath?>evaluation" class="<?= $active == "evaluation" ? "active" : ""?> ">Quarterly PMS Evaluation</a></li>
                      <!-- <li><a href="evaluate.html">Evaluate</a></li> -->

                      <li><a href="<?=$this->basePath?>result" class="<?= $active == "result" ? "active" : ""?> ">Results</a></li>
                    </ul>
                  </li>
                  <?php
                  }
                  if($_SESSION['type'] == "2"){
                  ?>
                  <li class="dropdown">
                    <a
                      class="nav-link menu-title link-nav <?= $active == "schedule" ? "active" : ""?>"
                      href="<?=$this->basePath?>schedule/assessment"
                      ><i data-feather="calendar"></i><span>Quarterly Schedule</span></a
                    >
                  </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
              </div>
            </div>
          </nav>
        </header>