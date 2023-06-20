<?php

session_start();
  include "../helpers/connections.php";
  include "../helpers/functions.php";
  $user_data = check_login($con);
  
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['nav']))
    {
      $_SESSION['doctor_id'] = "0";
      header("Location: patients.php");
    }
    for ($i = 1; $i <= 5; $i++) {
      if(isset($_POST['btn' . $i]))
      {
        $_SESSION['doctor_id'] = $i;
        header("Location: patients.php");
      }
    }
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <link href="../assets/style/main.css" rel="stylesheet" />
        <link rel="Website Icon" type="png" href="assets/images/logo.png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo+Play:wght@600&display=swap" rel="stylesheet">
        <script src="../assets/scripts/main.js"></script>
    </head>
    <body>
            <ul>
                <li>
                    <button class="navbar" onclick="document.location='main.php'">Home</button>
                </li>
                <li>
                  <form method = 'post'>
                    <button name='nav' class="navbar">Patients</button>
                    </form>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='about.php'">About</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='logout.php'">Log out</button>
                </li>
            </ul>
            <form method='post'>
            <div class = "container">
                <div class="card" onmouseover="notHidden(1)" onmouseout="hide(1)">
                  <div class="card-info">
                    <div id="cardAvtr1" class="card-avatar"></div>
                    <div id="cardTitle1" class="card-title">Andrei Popescu</div>
                    <div id="cardSubtitle1" class="card-subtitle">Internal Medic</div>
                    <div hidden id="descr1" class="description">
                    Dr. Andrei Popescu is a compassionate and highly skilled physician dedicated to providing exceptional medical care to her patients. With over 15 years of experience, Dr. Popescu is board-certified in internal medicine and has a deep understanding of the complexities of the human body.</div>
                  </div>
                  <ul class="card-social">
                    <li class="card-social__item">
                      <button hidden id="btn1" name='btn1' class="btnPacienti">
                      <img class="imgReports" src="../assets/images/fd_pacienti.png">
                      </button>
                    </li>
                  </ul>
                </div>
                <div class="card" onmouseover="notHidden(2)" onmouseout="hide(2)">
                    <div class="card-info">
                    <div id="cardAvtr2" class="card-avatar"></div>
                    <div id="cardTitle2" class="card-title">Mihai Ionescu</div>
                    <div id="cardSubtitle2" class="card-subtitle">Orthopedic Surgeon</div>
                    <div hidden id="descr2" class="description">
                    Dr. Mihai Ionescu is a highly experienced and dedicated physician known for his exceptional expertise in orthopedic surgery. With a career spanning over two decades, Dr. Ionescu has become a trusted name in his field, renowned for his surgical skills and compassionate patient care.</div>
                    </div>
                    <ul class="card-social">
                      <li class="card-social__item">
                        <button hidden id="btn2" name='btn2' class="btnPacienti">
                        <img class="imgReports" src="../assets/images/fd_pacienti.png">
                        </button>
                      </li>
                    </ul>
                  </div>
                <div class="card" onmouseover="notHidden(3)" onmouseout="hide(3)">
                  <div class="card-info">
                  <div id="cardAvtr3" class="card-avatar"></div>
                    <div id="cardTitle3" class="card-title">Andrei Mihaescu</div>
                    <div id="cardSubtitle3" class="card-subtitle">Cardiologist</div>
                    <div hidden id="descr3" class="description"> 
                    Dr. Andrei Mihaescu is a highly skilled and compassionate cardiologist dedicated to the diagnosis and treatment of cardiovascular diseases. With a strong background in cardiology, Dr. Mihaescu has established himself as a respected authority in the field.</div>
                  </div>
                  <ul class="card-social">
                    <li class="card-social__item">
                      <button hidden id="btn3" name='btn3' class="btnPacienti">
                      <img class="imgReports" src="../assets/images/fd_pacienti.png">
                      </button>
                    </li>
                  </ul>
                </div>
                <div class="card" onmouseover="notHidden(4)" onmouseout="hide(4)">
                  <div class="card-info">
                  <div id="cardAvtr4" class="card-avatar"></div>
                    <div id="cardTitle4" class="card-title">Elena Voda</div>
                    <div id="cardSubtitle4" class="card-subtitle">Children Medic</div>
                    <div hidden id="descr4" class="description">
                    Dr. Elena Voda is a highly compassionate and experienced pediatrician dedicated to providing comprehensive care to infants, children, and adolescents. With a genuine love for working with young patients, Dr. Voda creates a warm and welcoming environment where children feel comfortable.</div>
                  </div>
                  <ul class="card-social">
                    <li class="card-social__item">
                      <button hidden id="btn4" name='btn4' class="btnPacienti">
                      <img class="imgReports" src="../assets/images/fd_pacienti.png">
                      </button>
                    </li>
                  </ul>
                </div>
                <div class="card" onmouseover="notHidden(5)" onmouseout="hide(5)">
                  <div class="card-info">
                  <div id="cardAvtr5" class="card-avatar"></div>
                    <div id="cardTitle5" class="card-title">Elena Popescu</div>
                    <div id="cardSubtitle5" class="card-subtitle">Obstetrician-gynecologist </div>
                    <div hidden id="descr5" class="description"> 
                    Dr. Elena Popescu is a highly skilled and compassionate obstetrician-gynecologist committed to providing women's healthcare. With a focus on the unique needs of women throughout their reproductive years, Dr. Popescu offers personalized care in a comfortable environment.</div>
                  </div>
                      <button hidden id="btn5" name='btn5' class="btnPacienti">
                      <img class="imgReports" src="../assets/images/fd_pacienti.png">
                      </button>
                </div>
</div>
</form>
<footer class="footer">
  <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
    <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="white" />
    <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="#2C363E" />
  </svg>
</footer>
    </body>
</html>