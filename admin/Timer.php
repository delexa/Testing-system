<html>
<head>
<meta charset="utf-8">
 <link rel="stylesheet" type="text/css" href="../style2.css" />
 
<title>Администратор</title>

</head>

<body class="cbody">

	<div id="container">
	<div id="header">
<div align=left>
<?php
session_start();
if ($_SESSION['adminname'] == null) header('Location: ../index.php');
echo $_SESSION['adminname'] . ', добро пожаловать на свою личную страничку.';
?>
</div>
	<div align=right><a href="../common/exit.php" >Выйти</a></div>
	
	</div>
	<div id="sidebar1">
	<p><a href="MyPage.php">Моя страница</a></p>
	<p><a href="SeeAllQuestions.php">Просмотреть вопросы</a></p>
	<p><a href="SeeAllUsers.php">Просмотреть студентов</a></p>
	<p><a href="AdditionPage.php">Добавить вопросы</a></p>
	<p><a href="AddUser.php">Добавить студентов</a></p>
	<p><a href="DeleteQuestion.php">Удалить вопросы</a></p>
	<p><a href="Timer.php">Начать тестирование</a></p>
	<p><a href="Result.php">Просмотреть результат</a></p>
	</div>
	
	<div id="mainContent">
      <p><strong>Установить таймер</strong></p>
      <p>
	  <div id="container"></div>
	<?php
include '../common/my.php';

if (isset($_POST['submit'])) {
    $seconds = $_POST['seconds'];
    $number = $_POST['number'];
    
    $Myconnect = new ConnectToBD();
    $Myconnect->Connect("mysql4.000webhost.com", "a9646121_1", "1q1q1q", "a9646121_1");
    
    // $Myconnect->Connect("localhost", "root", "", "a9646121_1" );
    $query = mysql_query("SELECT * FROM questions WHERE id='$number'");
    $user_data = mysql_fetch_array($query);
    $answer = $user_data['r_answer'];
   
    if (empty($answer)) 
    	{
    		echo ("Вопрос не найден в БД!");
    		$Timer = new Timer();
   			 $Timer->ShowFormToStart();
    	}
    else {
        
        $Timer = new Timer();
        $Timer->Run($seconds, $number);
    }
} else {
    
    $Timer = new Timer();
    $Timer->ShowFormToStart();
}
?>
	  </p>
    </div>
 
  </div>
  
</body>

</html>