<?php
putenv('PATH=../../ChamCode/MinGW64/bin');
// include '../../ChamCode/';
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
            $er = 'lỗi biên dịch';
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
:root {
  --primary-bg: #f2f2f2;
  --secondary-bg: #fff;
  --neutral-color: #333;
  --accent-color: #4CAF50;
  --input-border: 1px solid #ccc;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: sans-serif;
  color: var(--neutral-color);
  background-color: var(--primary-bg);
}

/* ===== Editor Styles ===== */

.editor-container {
  background-color: var(--secondary-bg);
  margin: 20px auto;
  border-radius: 5px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  font-size: 14px;
  width: 80%;
}

.editor-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 15px;
  background-color: var(--primary-bg);
  border-bottom: 1px solid #ccc;
  font-weight: bold;
  height: 50px;
}

.header-button {
  padding: 5px;
  border-radius: 3px;
  border: none;
  color: #fff;
  font-size: 14px;
  cursor: pointer;
}

.run-button {
  background-color: var(--accent-color);
}

.reset-button {
  background-color: #dcdcdc;
  margin-right: 10px;
}

.header-dropdown {
  position: relative;
}

.header-button-language {
  background-color: var(--primary-bg);
  border: var(--input-border);
  position: relative;
}

.header-dropdown-content {
  display: none;
  position: absolute;
  z-index: 1;
  right: 0;
  top: 110%;
  border: var(--input-border);
  border-top: none;
  background-color: var(--secondary-bg);
}

.header-dropdown-content a {
  display: block;
  padding: 10px;
  text-decoration: none;
  color: var(--neutral-color);
  border-bottom: var(--input-border);
}

.header-dropdown-content a:last-child {
  border-bottom: none;
}

.header-dropdown:hover .header-dropdown-content {
  display: block;
}

.button-selected {
  background-color: var(--accent-color);
}

.editor-subheader {
  background-color: var(--primary-bg);
  padding: 5px 15px;
  border-bottom: var(--input-border);
  height: 30px;
  display: flex;
  align-items: center;
}

.subheader-label {
  font-weight: bold;
  font-size: 14px;
}

.editor-body {
  display: flex;
  height: 400px;
  width: 100%;
  position: relative;
}

.editor-ide {
  display: flex;
  flex: 3;
}

.editor-code {
  height: 100%;
  width: 100%;
  position: relative;
}

#editor-textarea {
  width: 100%;
  height: 100%;
  border: none;
  outline: none;
  resize: none;
  font-family: monospace;
  font-size: 14px;
  padding: 10px;
  overflow: auto;
}

.editor-output {
  display: flex;
  flex-direction: column;
  height: 100%;
  width: 20%;
  border: var(--input-border);
  border-left: 0.5px gray solid;
}

.output-subheader {
  background-color: var(--primary-bg);
  padding: 5px 10px;
  border-bottom: var(--input-border);
  height: 30px;
  display: flex;
  align-items: center;
}

#error-container {
  padding: 10px;
  font-family: monospace;
}

.output-subheader .subheader-label {
  font-weight: bold;
  font-size: 14px;
}

.editor-error {
  display: flex;
  flex-direction: column;
  height: 100%;
  width: 25%;
  border: var(--input-border);
}

.error-subheader {
  background-color: var(--primary-bg);
  padding: 5px 10px;
  border-bottom: var(--input-border);
  height: 30px;
  display: flex;
  align-items: center;
}

#error-container {
  padding: 10px;
  font-family: monospace;
}

.error-subheader .subheader-label {
  font-weight: bold;
  font-size: 14px;
}

  </style>
</head>
<body>
  <form method="post">
<div class="editor-container">
  <div class="editor-header">
  <input type="submit" name="submit" value="Run Code">
    <button class="header-button reset-button" id="reset-button">Reset</button>
    <div class="header-dropdown">
      <button class="header-button-language button-selected" data-lang="cpp">C++</button>
      <div class="header-dropdown-content">
        <a class="lang-select" data-lang="cpp">C++</a>
        <a class="lang-select" data-lang="java">Java</a>
        <a class="lang-select" data-lang="python">Python</a>
      </div>
    </div>
  </div>
        <?php
        $code = null;
            if(isset($usercode)){
                $code = $usercode;
            }
        $returndiem = '0';
        $returner= null;
            if(isset($diem)){
              $returndiem = $diem . '/10';
            }
            if(isset($er)){
              $returner = $er;
            }           
        ?>
        <div class="editor-subheader"><span class="subheader-label">Enter your code:</span></div>
          <div class="editor-body">
            <div class="editor-ide">
              <div class="editor-code">
                <textarea name="usercode" id="editor-textarea" spellcheck="false"><?=$code?></textarea>
              </div>
              <div class="editor-output">
                <div class="output-subheader"><span class="subheader-label">Kết quả:</span></div>
                <div id="output-container"><?=$returndiem?></div>
              </div>
            </div>
            <div class="editor-error">
              <div class="error-subheader"><span class="subheader-label">Error:</span></div>
              <div id="error-container"><?=$returner?></div>
            </div>
          </div>
    <!-- <textarea name="usercode" style="width: 600px; height: 400px;"></textarea> -->
    <!-- <input type="submit" name="submit" value="Run Code"> -->
</form>

</div>
<script>
  const editorTextarea = document.getElementById('editor-textarea');
const runButton = document.getElementById('run-button');
const resetButton = document.getElementById('reset-button');
const outputContainer = document.getElementById('output-container');
const errorContainer = document.getElementById('error-container');
const languageButtons = document.querySelectorAll('.header-dropdown .lang-select');
const languageSelectedButton = document.querySelector('.header-dropdown .button-selected');
let selectedLanguage = languageSelectedButton.getAttribute('data-lang');

setEditorLanguage(selectedLanguage);

// runButton.addEventListener('click', () => {
//   resetEditor();
//   const code = editorTextarea.value;

//   // execute code here and set output
//   const output = 'Output goes here';
//   const error = '';

//   outputContainer.innerText = output;
//   errorContainer.innerText = error;
// });

// resetButton.addEventListener('click', () => {
//   resetEditor();
// });

// languageButtons.forEach(langButton => {
//   langButton.addEventListener('click', () => {
//     const lang = langButton.getAttribute('data-lang');
//     setEditorLanguage(lang);
//     selectedLanguage = lang;
//     languageSelectedButton.innerText = langButton.innerText;
//     languageSelectedButton.setAttribute('data-lang', lang);
//   });
// });

// function resetEditor() {
//   outputContainer.innerText = '';
//   errorContainer.innerText = '';
// }

function setEditorLanguage(lang) {
  let syntax = '';

  switch(lang) {
    case 'cpp':
      syntax = 'text/x-c++src';
      break;
    case 'java':
      syntax = 'text/x-java';
      break;
    case 'python':
      syntax = 'text/x-python';
      break;
    default:
      syntax = 'text/plain';
  }

  CodeMirror.fromTextArea(editorTextarea, {
    mode: syntax,
    lineNumbers: true,
    theme: 'idea'
  });
}

</script>
</body>
</html>