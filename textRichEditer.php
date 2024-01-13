<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Rich Text Editor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #editor-container {
            /* max-width: 800px; */
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .toolbar {
            background-color: #f4f4f4;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .toolbar button {
            margin-right: 10px;
            padding: 8px 12px;
            font-size: 14px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
        }

        #editor {
            width: 100%;
            border: none;
            min-height: 200px;
            padding: 10px;
            font-size: 16px;
            outline: none;
        }

        .select-wrapper {
            position: relative;
            display: inline-block;
            margin-right: 10px;
        }

        .select-wrapper select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 150px;
            padding: 8px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
        }

        .select-wrapper::after {
            content: '\25BC';
            /* Unicode character for a down arrow */
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Style options */
        .select-wrapper select option {
            background-color: #fff;
            color: #333;
        }
    </style>
</head>

<body>

    <form action="./API/banner.php" method="post">
        <div id="editor-container">
            <div class="toolbar">
                <button type="button" onclick="boldText()"><i class="fas fa-bold"></i></button>
                <button type="button" onclick="italicText()"><i class="fas fa-italic"></i></button>
                <button type="button" onclick="underlineText()"><i class="fas fa-underline"></i></button>
                <button type="button" onclick="changeColor()"><i class="fas fa-paint-brush"></i></button>
                <button type="button" onclick="createLink()"><i class="fas fa-link"></i></button>
                <button type="button" onclick="insertNumberedList()"><i class="fas fa-list-ol"></i></button>
                <button type="button" onclick="insertBulletedList()"><i class="fas fa-list-ul"></i></button>
                <button type="button" onclick="undo()"><i class="fas fa-undo"></i></button>
                <button type="button" onclick="redo()"><i class="fas fa-redo"></i></button>
                <div class="select-wrapper">
                    <select onchange="changeFont(this.value)">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier New">Courier New</option>
                    </select>
                </div>
                <div class="select-wrapper">
                    <select onchange="changeHeading(this.value)">
                        <option value="h1">Heading 1</option>
                        <option value="h2">Heading 2</option>
                        <option value="h3">Heading 3</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="editorContent" id="editorContent" value="">

            <div id="editor" contenteditable="true" oninput="updateHiddenInput()">
                <!-- Default content or existing content goes here -->
                Start typing...
            </div>
         
        </div>
        <br>
        <button type="submit">Submit</button>
    </form>

    <script>
        function boldText() {
            document.execCommand('bold', false, null);
        }

        function italicText() {
            document.execCommand('italic', false, null);
        }

        function underlineText() {
            document.execCommand('underline', false, null);
        }

        function changeColor() {
            var color = prompt('Enter color:');
            document.execCommand('foreColor', false, color);
        }

        function createLink() {
            var url = prompt('Enter URL:');
            document.execCommand('createLink', false, url);
        }

        function insertNumberedList() {
            document.execCommand('insertOrderedList', false, null);
        }

        function insertBulletedList() {
            document.execCommand('insertUnorderedList', false, null);
        }

        function undo() {
            document.execCommand('undo', false, null);
        }

        function redo() {
            document.execCommand('redo', false, null);
        }

        function changeFont(font) {
            document.execCommand('fontName', false, font);
        }

        function changeHeading(heading) {
            document.execCommand('formatBlock', false, heading);
        }

        function updateHiddenInput() {
            var editorContent = document.getElementById('editor').innerHTML;
            document.getElementById('editorContent').value = editorContent;
        }

        document.getElementById('editor').addEventListener('input', function() {
            var content = this.innerHTML;
            // console.log(content);
        });
    </script>

</body>

</html>