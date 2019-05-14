<?php
	if(isset($_POST['employee'])){
		$output = array('error'=>false);

		include '../../config/connection.php';
    $timezone = 'Asia/Manila';
    date_default_timezone_set($timezone);

		$employee = $_POST['employee'];
		$status   = $_POST['status'];

		$sql = "SELECT * FROM Employees WHERE EmpId = '$employee'";
		$query = $con->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['EmpId'];

			$date_now = date('Y-m-d');

			if($status == 'in'){
				$sql = "SELECT * FROM EmployeeAttendance WHERE EmpId = '$id' AND Day = '$date_now' AND TimeIn IS NOT NULL";
				$query = $con->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'You have timed in for today';
				}
				else{
					$logstatus = 0;
					$sql = "INSERT INTO EmployeeAttendance (EmpId, Day,TimeIn) VALUES ('$id', '$date_now', NOW())";
					if($con->query($sql)){
						$output['message'] = 'Time in: '.$row['EmpName'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $con->error;
					}
				}
			}
			else{
				$sql = "SELECT *, EmployeeAttendance.EmpAtteId AS uid FROM EmployeeAttendance LEFT JOIN Employees ON Employees.EmpId=EmployeeAttendance.EmpId WHERE EmployeeAttendance.EmpId = '$id' AND Day = '$date_now'";
				$query = $con->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'Cannot Timeout. No time in.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['TimeOut'] != NULL){
						$output['error'] = true;
						$output['message'] = 'You have timed out for today';
					}
					else{
						$sql = "UPDATE EmployeeAttendance SET TimeOut = NOW() WHERE EmpAtteId = '".$row['uid']."'";
						if($con->query($sql)){
							$output['message'] = 'Time out: '.$row['EmpName'];

							$sql = "SELECT * FROM EmployeeAttendance WHERE EmpAtteId = '".$row['uid']."'";
							$query = $con->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['TimeIn'];
							$time_out = $urow['TimeOut'];

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE EmployeeAttendance SET hours = '$int' WHERE EmpAtteId = '".$row['uid']."'";
							$con->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $con->error;
						}
					}

				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Employee ID not found';
		}

	}

	echo json_encode($output);

?>
