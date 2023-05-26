<?php

require "conn.php";
$drop=$_POST['drop'];
$query1 = "select * from logs where system_id='$drop'";


$CpuUtilizationLogs = mysqli_query($conn, $query1);
$cpu_util_rows = mysqli_num_rows($CpuUtilizationLogs);

$CpuLogTableBody = '';
$MemoryOverUsedTableBody = '';
$DiskStorageTableBody = '';

while ($row = mysqli_fetch_assoc($CpuUtilizationLogs)) {
    global $tableBody;
    $col1 = $row["cpu_log"];
    $col2 = $row["time"];

    $currRowData = "<tr class='table-secondary'><td class='table-secondary'>$col1</td><td class='table-secondary'>$col2</td></tr>";
    $CpuLogTableBody = $CpuLogTableBody . $currRowData;
}


$MemoryOverUsedLogs = mysqli_query($conn, $query1);
$memory_used_rows = mysqli_num_rows($MemoryOverUsedLogs);

while ($row = mysqli_fetch_assoc($MemoryOverUsedLogs)) {
    global $tableBody;
    
    $col1 = $row["ram_log"];
    $col2 = $row["time"];
    
    $currRowData = "<tr class='table-secondary'><td class='table-secondary'>$col1</td><td class='table-secondary'>$col2</td></tr>";
    $MemoryOverUsedTableBody = $MemoryOverUsedTableBody . $currRowData;
}

$DiskStorageFullLogs = mysqli_query($conn, $query1);
$disk_storage_rows = mysqli_num_rows($DiskStorageFullLogs);

while ($row = mysqli_fetch_assoc($DiskStorageFullLogs)) {
    global $tableBody;

    $col1 = $row["store_log"];
    $col2 = $row["time"];

    $currRowData = "<tr class='table-secondary'><td class='table-secondary'>$col1</td><td class='table-secondary'>$col2</td></tr>";
    $DiskStorageTableBody = $DiskStorageTableBody . $currRowData;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
       <link rel="stylesheet" href="Error_Logs.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
     
    
    <title>errorlogs - MonnitUI</title>
    <meta property="og:title" content="errorlogs - MonnitUI" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Lexend;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.1;
        color: var(--dl-color-grays-dark100);
        background-color: var(--dl-color-grays-white100);

      }
    </style>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
      data-tag="font"
    />
    <style>
      ::placeholder{
      color: #63667066;
      }
    </style>
    <style data-section-id="dropdown">
      [data-thq="thq-dropdown"]:hover > [data-thq="thq-dropdown-list"] {
          display: flex;
        }

        [data-thq="thq-dropdown"]:hover > div [data-thq="thq-dropdown-arrow"] {
          transform: rotate(90deg);
        }
    </style>
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div>
      <link href="./errorlogs.css" rel="stylesheet" />

      <div class="errorlogs-container">
        <header data-role="Header" class="errorlogs-header">
          <div class="errorlogs-container1">
            <img
              alt="logo"
              src="public/playground_assets/untitled%20%5B1170%20%C3%97%20560%20px%5D%20%5B1%5D-1500h.png"
              class="errorlogs-image"
            />
            <div class="errorlogs-nav">
              <nav
                class="navigation-links2-nav navigation-links2-root-class-name12"
              >
                  <span class="navigation-links2-text"><span><a href="home.html">Home</a></span></span>
              </nav>
            </div>
            <div
              data-thq="thq-dropdown"
              class="errorlogs-thq-dropdown list-item"
            >
              <div
                data-thq="thq-dropdown-toggle"
                class="errorlogs-dropdown-toggle"
              >
               <form  action="" method="post" >
                  <select name="drop"    onchange="this.form.submit()" >
                      <option><span class="dashboard-resource-text">
                  <span>Select System</span>
                  <br />
                </span></option>
            <?php
           session_start();           
    require "conn.php";
 $username=$_SESSION['username'];
 $query="SELECT * FROM user where email='$username'";
$result = mysqli_query($conn, $query);



    
                // use a while loop to fetch data
                // from the $result variable variable
                // and individually display as an option
                while ($systemid = mysqli_fetch_array(
                        $result,MYSQLI_ASSOC)):;
            ?>
                      
                <option >
                    <?php echo $systemid["system_id"];
                        // To show the system name to the user
                    ?>
                    
                </option>
            <?php
                endwhile;
                // While loop must be terminated
            ?>
        </select> 
                      </form>
              </div>
              
            </div>
          </div>
          <div class="errorlogs-btn-group">
            <button class="errorlogs-button button">
              <span class="errorlogs-text06">
                <span><a href="index.html">Logout</a></span>
                <br />
              </span>
            </button>
          </div>
          <div data-role="BurgerMenu" class="errorlogs-burger-menu">
            <svg viewBox="0 0 1024 1024" class="errorlogs-icon">
              <path
                d="M128 554.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 298.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667zM128 810.667h768c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-768c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"
              ></path>
            </svg>
          </div>
          <div data-role="MobileMenu" class="errorlogs-mobile-menu">
            <nav class="errorlogs-nav1">
              <div class="errorlogs-container2">
                <img
                  alt="image"
                  src="https://presentation-website-assets.teleporthq.io/logos/logo.png"
                  class="errorlogs-image2"
                />
                <div
                  data-role="CloseMobileMenu"
                  class="errorlogs-close-mobile-menu"
                >
                  <svg viewBox="0 0 1024 1024" class="errorlogs-icon02">
                    <path
                      d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
                    ></path>
                  </svg>
                </div>
              </div>
              <nav
                class="navigation-links2-nav navigation-links2-root-class-name14"
              >
                <span class="navigation-links2-text"><span>Home</span></span>
              </nav>
            </nav>
            <div>
              <svg
                viewBox="0 0 950.8571428571428 1024"
                class="errorlogs-icon04"
              >
                <path
                  d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"
                ></path></svg
              ><svg
                viewBox="0 0 877.7142857142857 1024"
                class="errorlogs-icon06"
              >
                <path
                  d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"
                ></path></svg
              ><svg
                viewBox="0 0 602.2582857142856 1024"
                class="errorlogs-icon08"
              >
                <path
                  d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"
                ></path>
              </svg>
            </div>
          </div>
        </header>
        <section class="section">
        <div id="LogTables">
        <div id="CpuUtilizationLogs">
            <div class="heading"> CPU Overutilization Logs </div>
            <table>
                <tr>
                    <th>CPU Utilization</th>
                    <th>Time</th>
                </tr>

                <?= $CpuLogTableBody ?>
            </table>
        </div>

        <div id="MemoryOverusedLogs">
            <div class="heading"> Memory Overused Logs</div>
            <table>
                <tr>
                    <th>Memory Used</th>
                    <th>Time</th>
                </tr>

                <?= $MemoryOverUsedTableBody ?>
            </table>
        </div>

        <div id="DiskStorageLogs">
            <div class="heading"> Disk Storage Full Logs</div>
            <table>
                <tr>
                    <th>Disk Storage</th>
                    <th>Time</th>
                </tr>

                <?= $DiskStorageTableBody ?>

            </table>
        </div>
    </div> 
</section> 
        <footer class="errorlogs-footer">
          <img
            alt="logo"
            src="public/playground_assets/untitled%20%5B1170%20%C3%97%20560%20px%5D%20%5B1%5D-1500h.png"
            class="errorlogs-image3"
          />
          <span class="errorlogs-text09">
            © 2022 MONNIT, All Rights Reserved.
          </span>
          <div class="errorlogs-icon-group1">
            <svg viewBox="0 0 950.8571428571428 1024" class="errorlogs-icon10">
              <path
                d="M925.714 233.143c-25.143 36.571-56.571 69.143-92.571 95.429 0.571 8 0.571 16 0.571 24 0 244-185.714 525.143-525.143 525.143-104.571 0-201.714-30.286-283.429-82.857 14.857 1.714 29.143 2.286 44.571 2.286 86.286 0 165.714-29.143 229.143-78.857-81.143-1.714-149.143-54.857-172.571-128 11.429 1.714 22.857 2.857 34.857 2.857 16.571 0 33.143-2.286 48.571-6.286-84.571-17.143-148-91.429-148-181.143v-2.286c24.571 13.714 53.143 22.286 83.429 23.429-49.714-33.143-82.286-89.714-82.286-153.714 0-34.286 9.143-65.714 25.143-93.143 90.857 112 227.429 185.143 380.571 193.143-2.857-13.714-4.571-28-4.571-42.286 0-101.714 82.286-184.571 184.571-184.571 53.143 0 101.143 22.286 134.857 58.286 41.714-8 81.714-23.429 117.143-44.571-13.714 42.857-42.857 78.857-81.143 101.714 37.143-4 73.143-14.286 106.286-28.571z"
              ></path></svg
            ><svg viewBox="0 0 877.7142857142857 1024" class="errorlogs-icon12">
              <path
                d="M585.143 512c0-80.571-65.714-146.286-146.286-146.286s-146.286 65.714-146.286 146.286 65.714 146.286 146.286 146.286 146.286-65.714 146.286-146.286zM664 512c0 124.571-100.571 225.143-225.143 225.143s-225.143-100.571-225.143-225.143 100.571-225.143 225.143-225.143 225.143 100.571 225.143 225.143zM725.714 277.714c0 29.143-23.429 52.571-52.571 52.571s-52.571-23.429-52.571-52.571 23.429-52.571 52.571-52.571 52.571 23.429 52.571 52.571zM438.857 152c-64 0-201.143-5.143-258.857 17.714-20 8-34.857 17.714-50.286 33.143s-25.143 30.286-33.143 50.286c-22.857 57.714-17.714 194.857-17.714 258.857s-5.143 201.143 17.714 258.857c8 20 17.714 34.857 33.143 50.286s30.286 25.143 50.286 33.143c57.714 22.857 194.857 17.714 258.857 17.714s201.143 5.143 258.857-17.714c20-8 34.857-17.714 50.286-33.143s25.143-30.286 33.143-50.286c22.857-57.714 17.714-194.857 17.714-258.857s5.143-201.143-17.714-258.857c-8-20-17.714-34.857-33.143-50.286s-30.286-25.143-50.286-33.143c-57.714-22.857-194.857-17.714-258.857-17.714zM877.714 512c0 60.571 0.571 120.571-2.857 181.143-3.429 70.286-19.429 132.571-70.857 184s-113.714 67.429-184 70.857c-60.571 3.429-120.571 2.857-181.143 2.857s-120.571 0.571-181.143-2.857c-70.286-3.429-132.571-19.429-184-70.857s-67.429-113.714-70.857-184c-3.429-60.571-2.857-120.571-2.857-181.143s-0.571-120.571 2.857-181.143c3.429-70.286 19.429-132.571 70.857-184s113.714-67.429 184-70.857c60.571-3.429 120.571-2.857 181.143-2.857s120.571-0.571 181.143 2.857c70.286 3.429 132.571 19.429 184 70.857s67.429 113.714 70.857 184c3.429 60.571 2.857 120.571 2.857 181.143z"
              ></path></svg
            ><svg viewBox="0 0 602.2582857142856 1024" class="errorlogs-icon14">
              <path
                d="M548 6.857v150.857h-89.714c-70.286 0-83.429 33.714-83.429 82.286v108h167.429l-22.286 169.143h-145.143v433.714h-174.857v-433.714h-145.714v-169.143h145.714v-124.571c0-144.571 88.571-223.429 217.714-223.429 61.714 0 114.857 4.571 130.286 6.857z"
              ></path>
            </svg>
          </div>
        </footer>
      </div>
    </div>
    <script src="https://unpkg.com/@teleporthq/teleport-custom-scripts"></script>
    <script>
      window.onload = () => {
        const runAllScripts = () => {
          initializeAllSliders();
        };

        const listenForUrlChanges = () => {
          let url = location.href;
          document.body.addEventListener(
            "click",
            () => {
              requestAnimationFrame(() => {
                if (url !== location.href) {
                  runAllScripts();
                  url = location.href;
                }
              });
            },
            true
          );
        };

        const initializeAllSliders = () => {
          const allSliders = document.querySelectorAll('[data-type="slider"]');
          allSliders.forEach((carrousel) => {
            initializeSlider(carrousel);
          });
        };

        const initializeSlider = (carrousel) => {
          let currentSlide = 0;

          const slides = carrousel.querySelectorAll('[data-type="slide"]');
          const nextSlideBtns = carrousel.querySelectorAll(
            '[data-action="nextSlide"]'
          );
          const previousSlideBtns = carrousel.querySelectorAll(
            '[data-action="previousSlide"]'
          );

          const changeSlide = (slideIndex, action) => {
            currentSlide = slideIndex;

            switch (action) {
              case "next":
                slideIndex === slides.length - 1
                  ? (currentSlide = 0)
                  : currentSlide++;
                break;
              case "previous":
                slideIndex === 0
                  ? (currentSlide = slides.length - 1)
                  : currentSlide--;
            }

            carrousel.style.transform = `translateX(${-100 * currentSlide}%)`;
          };

          previousSlideBtns.forEach((btn) => {
            btn.addEventListener("click", () =>
              changeSlide(currentSlide, "previous")
            );
          });

          nextSlideBtns.forEach((btn) => {
            btn.addEventListener("click", () =>
              changeSlide(currentSlide, "next")
            );
          });
        };

        runAllScripts();
      };
    </script>
  </body>
</html>