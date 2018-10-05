<?php
	//print_r($_POST);
	$id=$_POST['answer'];
	
	//Cap nhat so luot vote
	$sql="update `nn_answer` set `vote`=`vote`+1 where `id`=$id";
	mysqli_query($link,$sql);
	
	//Hien thi ket qua
	//Lay cau hoi active
	
	$sql='select `id`,`content` from `nn_question` where `active`=1';
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	$question=$r['content'];
	
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
		  <?php
				//Lay cac lua chon cua hoi tren
				$sql='select `id`,`content`,`vote` from `nn_answer` where `question_id`='.$r['id'];
				$rs=mysqli_query($link,$sql);
				while($r=mysqli_fetch_assoc($rs))
				{
			?>
				  ['<?php echo $r['content'] ?>',<?php echo $r['vote'] ?>],
			<?php
				}
			?>
        ]);

        var options = {
          title: '<?php echo $question ?>',
		  is3D:true,
		  legend:{position:'bottom',textStyle:{ color: 'red',  fontSize:20,}},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <div id="piechart" style="width: 700px; height: 500px;"></div>
