<?php
            include "../helpers/connections.php";
            include "../helpers/functions.php";
            session_start();
            $user_data = check_login($con);

            $doctor_id = $_SESSION['doctor_id'];
            if($doctor_id != 0)
            {
                $sql = "SELECT 
                    patients.name as patient_name, 
                    disease, 
                    COUNT(DISTINCT appointments.id) as appointments,
                    GROUP_CONCAT(
                        CONCAT(
                            DATE_FORMAT(appointments.appointment_date, '%Y-%m-%d %H:%i'), 
                            ': ', 
                            appointments.reason
                        ) 
                        ORDER BY appointments.appointment_date ASC
                        SEPARATOR '<br>'
                    ) as appointment_details
                FROM patients
                INNER JOIN doctors ON patients.id_doctors = doctors.id
                LEFT JOIN appointments ON appointments.patient_id = patients.id
                WHERE doctors.id = '$doctor_id'
                GROUP BY patients.id, disease, patients.name";
                
                $sqlD = "SELECT doctors.name, 
                        (select COUNT(*) from patients where id_doctors = doctors.id) as patients, 
                        (select COUNT(*) from appointments where doctor_id = doctors.id) as appointments 
                        FROM doctors
                        where doctors.id = '$doctor_id'
                        group by doctors.id limit 1";
            }

            $pQuery = null;
            $dQuery = null;

            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                if(isset($_POST['search']))
                {
                    if(isset($_POST['text']) && !empty(trim($_POST['text']))){
                        $search = trim($_POST['text']);

                        $sql = "SELECT 
                            patients.name as patient_name, 
                            disease, 
                            COUNT(DISTINCT appointments.id) as appointments,
                            GROUP_CONCAT(
                                CONCAT(
                                    DATE_FORMAT(appointments.appointment_date, '%Y-%m-%d %H:%i'), 
                                    ': ', 
                                    appointments.reason
                                ) 
                                ORDER BY appointments.appointment_date ASC
                                SEPARATOR '<br>'
                            ) as appointment_details
                            FROM patients
                            INNER JOIN doctors ON patients.id_doctors = doctors.id
                            LEFT JOIN appointments ON appointments.patient_id = patients.id
                            WHERE doctors.name LIKE ?
                            GROUP BY patients.id, disease, patients.name";

                        $sqlD = "SELECT doctors.name, 
                                (SELECT COUNT(*) FROM patients WHERE id_doctors = doctors.id) as patients, 
                                (SELECT COUNT(*) FROM appointments WHERE doctor_id = doctors.id) as appointments 
                                FROM doctors
                                WHERE doctors.name LIKE ?
                                GROUP BY doctors.id LIMIT 1";

                        $stmt = mysqli_prepare($con, $sql);
                        $search_param = "%$search%";
                        mysqli_stmt_bind_param($stmt, "s", $search_param);
                        mysqli_stmt_execute($stmt);
                        $pQuery = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $stmt = mysqli_prepare($con, $sqlD);
                        mysqli_stmt_bind_param($stmt, "s", $search_param);
                        mysqli_stmt_execute($stmt);
                        $dQuery = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                    } else {
                        echo "<dialog id='dialog'>
                            <form method='dialog'>
                            Please enter a doctor name to search!
                            <button id='btnClose'>Close</button>
                            </form>
                            </dialog>";
                    }
                }
                if(isset($_POST['add']))
                {
                    header("Location: addPatient.php");
                }
                if(isset($_POST['addAppointment'])) {
                    header("Location: addAppointment.php");
                    die;
                }
            }
            if(!isset($pQuery) && !empty($sql)){
                $pQuery = mysqli_query($con, $sql);
            }
            
            if(!isset($dQuery) && !empty($sqlD)){
                $dQuery = mysqli_query($con, $sqlD);
            }

            $con->close();
            ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Patients</title>
        <link href="../assets/style/main.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    </head>
    <body>
    <ul>
                <li>
                    <button class="navbar" onclick="document.location='main.php'">Home</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='patients.php'">Patients</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='about.php'">About</button>
                </li>
                <li>
                    <button class="navbar" onclick="document.location='signin.php'">Log out</button>
                </li>
            </ul>
            <form method='post'>
            <div class="container">
                <label class="search-label">
                    <input type="text" name="text" class="input" placeholder="Name of the medic...">
                    <kbd class="slash-icon">/</kbd>
                    <g>
                        <path d="M55.146 51.887 41.588 37.786A22.926 22.926 0 0 0 46.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 0 0 .083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z" fill="currentColor" data-original="#000000" class=""></path>
                    </g>
                    </svg>
                </label>
                <button name='search' id="search" class="tooltip">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
                    <path d="M 21 3 C 11.601563 3 4 10.601563 4 20 C 4 29.398438 11.601563 37 21 37 C 24.355469 37 27.460938 36.015625 30.09375 34.34375 L 42.375 46.625 L 46.625 42.375 L 34.5 30.28125 C 36.679688 27.421875 38 23.878906 38 20 C 38 10.601563 30.398438 3 21 3 Z M 21 7 C 28.199219 7 34 12.800781 34 20 C 34 27.199219 28.199219 33 21 33 C 13.800781 33 8 27.199219 8 20 C 8 12.800781 13.800781 7 21 7 Z"></path>
                </svg>
                    <span class="tooltiptext">Search</span>
                </button>
                </form>
            <button name='add' id="search" class="tooltip">
                <img src="../assets/images/fd_pacienti.png" width='25px'>
                <span class="tooltiptext">Add patient</span>
            </button>
            <button name='addAppointment' id="search" class="tooltip">
                    <img src="../assets/images/addAppointment.png" width='25px'>
                    <span class="tooltiptext">Add appointment</span>
                </button>
            </div>
            <div class='tables'>
            <?php
            if($pQuery != null){ ?>
                <table class='patients'>
                <th>Name</th>
                <th>Disease</th>
                <th>Number of Appointments</th>
                <th>Appointment Details</th>
               <?php while ($row = mysqli_fetch_array($pQuery)) {?>
                   <tr>
                   <td><?php echo $row['patient_name'];?></td>
                   <td><?php echo $row['disease'];?></td>
                   <td><?php echo $row['appointments'];?></td>
                   <td><?php echo $row['appointment_details'] ? $row['appointment_details'] : 'No appointments';?></td>
                   </tr>            
              <?php  } }?> </table>
            <?php
            if($dQuery != null){ ?>
                <table id='tbl' class='doctor'>
                <th>Doctor Name</th>
                <th>Number of Patients</th>
                <th>Total Appointments</th>
                <th>Chart</th>
               <?php while ($row = mysqli_fetch_array($dQuery)) {?>
                   <tr>
                   <td><?php echo $row['name'];?></td>
                   <td><?php echo $row['patients'];?></td>
                   <td><?php echo $row['appointments'];?></td>
                   <td></td>
                   </tr>
              <?php  } }?></table>
            </div>
    <script>
var table = document.getElementById("tbl");
var tableArr = [];
var tableLab = [];
for ( var i = 1; i < table.rows.length; i++ ) {
    tableArr.push([
     table.rows[i].cells[1].innerHTML,
     table.rows[i].cells[2].innerHTML
    ]);
tableLab.push(table.rows[i].cells[0].innerHTML)
var canvas = document.createElement("canvas");
canvas.setAttribute("id", "myChart"+i);
table.rows[i].cells[3].appendChild(canvas);
}
console.log(tableArr);

tableArr.forEach(function(e,i){
  var chartID = "myChart"+ (i+1)
  var ctx = document.getElementById(chartID).getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Appointments", "Patients"],
        datasets: [{
            label: tableLab[i],
            data: e,
            backgroundColor: [
                '#2A363F',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                '#2A363F',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
                labels: {
                    fontColor: "black",
                }
            },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    min: 0,
                    max: 7,
                    fontColor: "black"
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                    min: 0,
                    max: 7,
                    fontColor: "black"
                },
                
            }]
        }
    }
});
})

    </script> 
  <footer class="footer">
  <svg viewBox="0 -20 700 110" width="100%" height="110" preserveAspectRatio="none">
    <path transform="translate(0, -20)" d="M0,10 c80,-22 240,0 350,18 c90,17 260,7.5 350,-20 v50 h-700" fill="white" />
    <path d="M0,10 c80,-18 230,-12 350,7 c80,13 260,17 350,-5 v100 h-700z" fill="#2C363E" />
  </svg>
</footer>
    </body>
</html>