<?php
putenv('PATH=../ChamCode/MinGW64/bin');
// include './';
// Kiểm tra xem nút "submit" đã được nhấn hay chưa
if(isset($_POST['submit'])) {
    $diem=0;
    for($i=0; $i<10; $i++){
        // Lấy mã nguồn từ biểu mẫu
        $usercode = $_POST['usercode'];
        // Save user code to temporary file
        $filename = 'test';
        $file = fopen($filename . ".cpp", 'w');
        fwrite($file, $usercode);
        fclose($file);
        // Compile user code using g++
        $check = exec("g++ $filename.cpp -o $filename.exe");
        if(!file_exists("{$filename}.exe")){
            echo 'lỗi biên dịch';
            break;
        }
        // Run compiled code and display output
        $output = exec("{$filename}.exe < ./input/input$i.txt");
        // hiển thị output của chương trình C
        $out= file_get_contents("./input/output$i.txt");
        if($output == $out){
            $diem++;
        }
        // Clean up temporary files
        unlink("{$filename}.exe");
    }
    // echo $diem;
}
?>

<!-- HTML code to display a form for the user to input code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <?php
        $code = null;
            if(isset($usercode)){
                $code = $usercode;
            }
        ?>
    <textarea name="usercode" style="width: 600px; height: 400px;"><?=$code?></textarea>
    <input type="submit" name="submit" value="Run Code">
</form>
<?php
    if(isset($diem)){
        echo 'diem cua ban la ' . $diem;
    }
?>
</body>
</html>
