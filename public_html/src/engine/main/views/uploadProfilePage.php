
<?php
$SITE_URL = "http://localhost:{$_ENV['SITE_PORT']}/";
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
?>



<section>
    <div class="container">
        <div class="section-title">
            Загрузка видео
        </div>
        <div class="toVidList">
            <a href="/"><ion-icon name="arrow-back-outline"></ion-icon> Назад</a>
        </div>
        <div class="upload-form">
            <div class="progressBars">
                <div class="progressBar">
                    <div class="itemBar">
                        <div class="label" id="load-label"></div>
                        <div class="label" id="load-label2"></div>
                    </div>
                    <ion-icon name="checkmark-circle-outline" id="load"></ion-icon>
                </div>
                <div class="progressBar" id="process-progressBar">
                    <div class="itemBar" id="process-itemBar">
                        <div class="label" id="process-label"></div>
                        <div class="label" style="top: 0px;" id="process-label2"></div>
                    </div>
                    <ion-icon name="checkmark-circle-outline" id="process"></ion-icon>
                </div>
            </div>
            <div class="thatOneForm">
                <div class="video-info" style="display: none">
                    <div class="video-frame">
                        <div class="frame-animation">
                            <ion-icon name="reload-outline"></ion-icon>
                        </div>
                    </div>
                </div>
<!--                <form class="form" id="uploadForm" method="POST" enctype="multipart/form-data">-->
                    <div class="video-inputs">
                        <div class="select-vid">
                            <input type="file" id="inpFile1" class="inpFile" name="inpFile" hidden>
                            <label for="inpFile1" id="inpFile">Выберите файл</label>
                            <div class="vid-name"></div>

                            <div id="preresult" style="display: none;">
                                <div style="font-size: 20px;">Исходное фото</div>
                                <img id="photo" style="max-width: 500px; max-height: 250px;" src="/templates/default/assets/img/news-1.jpg">
                            </div>

                            <div id="result" style="display: none;">
                                <div style="font-size: 20px;">Результат</div>
                                <img id="photo_res" style="max-width: 500px; max-height: 250px;" src="/templates/default/assets/img/news-1.jpg">
                            </div>

                        </div>

                        <div class="info-inputs">
                            <input type="text" class="profile-name" id="profile_name" placeholder="Введите название...">
                            <textarea name="" cols="30" rows="10" id="profile_description" class="profile-desc" placeholder="Введите описание..."></textarea>
                        </div>


                        <div class="video-checkbox">
                            <style>
                                .box {
                                    width: 300px;
                                    height: 30px;
                                    border: 1px solid #999;
                                    font-size: 18px;
                                    color: #1c87c9;
                                    background-color: #eee;
                                    border-radius: 5px;
                                    box-shadow: 4px 4px #ccc;
                                }
                            </style>
                            <br>
                            <br>
                            <div>Оформленный блок выбора:</div>
                            <select id="style" class="box">
                                <option>LoRa (0mib) Type of Vector Art</option>
                                <option>Colors [Tabi Style LoRA]</option>
                                <option>LACollageStyle</option>
                                <option>BouquetLatin|花束设计</option>
                                <option>Alena Style</option>
                                <option>Openjourney Lora</option>
                            </select>
                        </div>



                        <div>
                            <br>
                            <br>
                            <br>
                            <div>
                                Выберите тип обработки
                            </div>
                            <label><input type="radio" id="radio1" name="e"> By Face Pose</label>
                            <label><input type="radio" id="radio2" name="e"> By Body Pose</label>
                            <label><input type="radio" id="radio3" name="e"> Inpaint</label>
                            <style>
                                input[type=radio] {
                                    --s: 1em;     /* control the size */
                                    --c: #009688; /* the active color */

                                    height: var(--s);
                                    aspect-ratio: 1;
                                    border: calc(var(--s)/8) solid #939393;
                                    padding: calc(var(--s)/8);
                                    background:
                                            radial-gradient(farthest-side,var(--c) 94%,#0000)
                                            50%/0 0 no-repeat content-box;
                                    border-radius: 50%;
                                    outline-offset: calc(var(--s)/10);
                                    -webkit-appearance: none;
                                    -moz-appearance: none;
                                    appearance: none;
                                    cursor: pointer;
                                    font-size: inherit;
                                    transition: .3s;
                                }
                                input[type=radio]:checked {
                                    border-color: var(--c);
                                    background-size: 100% 100%;
                                }

                                input[type=radio]:disabled {
                                    background:
                                            linear-gradient(#939393 0 0)
                                            50%/100% 20% no-repeat content-box;
                                    opacity: .5;
                                    cursor: not-allowed;
                                }

                                @media print {
                                    input[type=radio] {
                                        -webkit-appearance: auto;
                                        -moz-appearance: auto;
                                        appearance: auto;
                                        background: none;
                                    }
                                }

                                label {
                                    display:inline-flex;
                                    align-items:center;
                                    gap:10px;
                                    margin:5px 0;
                                    cursor: pointer;
                                }
                            </style>
                        </div>


                    </div>










                <div id="paint_block" style="display: none" class="paint_title">
                    <div class="instruments_for_paint">
                        <div class="main_btn_paint">
<!--                            <button onclick="Clear()" class="common_back_href">Очистить</button>-->
<!--                            <button onclick="undo_last()" class="common_back_href">Назад</button>-->
                        </div>
                        <div class="main_color_choice">
                            <input type="color" id="color">
                        </div>
                        <div>
                            <div class="switch-btn" onclick="change_color(this)" style="background:white"></div>
                            <div class="switch-btn" onclick="change_color(this)" style="background:black"></div>
                        </div>
                        <div class="choice_bold">
                            <input type="range" min="1" max="100" value="3" oninput="stroke_width = this.value">
                        </div>
                        <div class="shape_selection">
                            <button onclick="d_1()" class="common_back_href">Линиия</button>
                            <button onclick="d_2()" class="common_back_href">Овал</button>
                            <button onclick="d_3()" class="common_back_href">Квадрат</button>
                        </div>
                    </div>


                    <div class="image_for_designer">
                        <canvas id="c1_new" width="1000" height="500"></canvas>
                    </div>
                    <img hidden id="img"/>

                </div>
                <script>
                    let canvas = document.getElementById("c1_new");

                    //canvas.style.backgroundImage = "url('/files/profile/hyperpc-wallpaper-4K.jpg')";
                    canvas.style.backgroundSize = "1000px 500px";


                    let context = canvas.getContext("2d");

                    let img = new Image();
                    var height = 180;
                    var width = 180;
                    img.onload = function() {
                        // context.save();
                        //context.rect(0, 0, 1000, 500);//Здесь первый 0=X
                        // context.clip();
                        //context.drawImage(img,0, 0,1000,500);//Первый 0=X
                        // context.restore();

                        context.fill();
                        context.strokeStyle = 'rgba(0, 0, 0, 0)';
                    };





                    var d = new Date();


                    //img.src = '/files/profile/Снимок экрана 2023-10-14 134432.png';



                    let stroke_color = 'black';
                    let stroke_width = "3";
                    let is_drawing = false;
                    let fig;


                    document.getElementById('color').oninput = function (){
                        stroke_color = this.value;
                    }

                    function change_color(element) {
                        stroke_color = element.style.background;
                    }

                    function change_width(element) {
                        stroke_width = element.innerHTML
                    }






                    function Clear() {
                        context.fillStyle = "white";
                        context.clearRect(0, 0, canvas.width, canvas.height);
                        img.src = canvas.toDataURL();
                        context.fillRect(0, 0, canvas.width, canvas.height);


                        restore_array = [];
                        start_index = -1;
                    }



                    let restore_array = [];
                    let start_index = -1;
                    function undo_last(){
                        if(start_index <= 0){
                            //img.src = '/files/profile/Снимок экрана 2023-10-14 134432.png';
                        }else{
                            start_index -= 1;
                            restore_array.pop();
                            context.putImageData(restore_array[start_index], 0, 0);
                            console.log(restore_array);
                        }
                    }






                    var f1 = 0;
                    var f2 = 0;
                    var f3 = 0;

                    function d_1(){

                        fig = 0;

                        if(f1 == 1){
                            return;
                        }
                        f1 = 1;



                        console.log(fig);

                        canvas.addEventListener("touchstart", start, false);
                        canvas.addEventListener("touchmove", draw, false);
                        canvas.addEventListener("touchend", stop, false);
                        canvas.addEventListener("mousedown", start, false);
                        canvas.addEventListener("mousemove", draw, false);
                        canvas.addEventListener("mouseup", stop, false);
                        canvas.addEventListener("mouseout", stop, false);


                        function getX(event) {
                            if (event.pageX == undefined) {return event.targetTouches[0].pageX - canvas.offsetLeft}
                            else {return event.pageX - canvas.offsetLeft}
                        }
                        function getY(event) {
                            if (event.pageY == undefined) {return event.targetTouches[0].pageY - canvas.offsetTop}
                            else {return event.pageY - canvas.offsetTop}
                        }
                        // обычная рисовалка
                        function start(event) {
                            if(fig == 0) {
                                is_drawing = true;
                                context.beginPath();
                                context.moveTo(getX(event), getY(event));
                                event.preventDefault();
                            }
                        }
                        function draw(event) {
                            if (is_drawing && fig == 0) {
                                context.lineTo(getX(event), getY(event));
                                context.strokeStyle = stroke_color;
                                context.lineWidth = stroke_width;
                                context.lineCap = "round";
                                context.lineJoin = "round";
                                context.stroke();
                            }
                            event.preventDefault();
                        }
                        function stop(event) {
                            if (is_drawing) {
                                context.stroke();
                                context.closePath();
                                is_drawing = false;
                            }
                            event.preventDefault();

                            if(event.type != 'mouseout' && event.type != 'touchend' && fig == 0){
                                restore_array.push(context.getImageData(0, 0, canvas.width, canvas.height));
                                start_index += 1;
                                console.log(restore_array);
                            }

                            img.src = canvas.toDataURL();
                        }
                    }













                    function d_2(){

                        fig = 1;

                        if(f2 == 1){
                            return;
                        }
                        f2 = 1;



                        console.log(fig);
                        canvas.addEventListener("mousedown", startDrawing, false);
                        canvas.addEventListener("mousemove", draw_2, false);
                        canvas.addEventListener("mouseup", stopDrawing, false);

                        canvas.addEventListener("touchstart", startDrawing, false);
                        canvas.addEventListener("touchmove", draw_2, false);
                        canvas.addEventListener("touchend", stopDrawing, false);
                        canvas.addEventListener("mouseout", stopDrawing, false);



                        isDrawing = false;
                        function getX(e) {
                            if (e.pageX == undefined) {return e.targetTouches[0].pageX - canvas.offsetLeft}
                            else {return e.pageX - canvas.offsetLeft}
                        }
                        function getY(e) {
                            if (e.pageY == undefined) {return e.targetTouches[0].pageY - canvas.offsetTop}
                            else {return e.pageY - canvas.offsetTop}
                        }
                        function current_coords(e){
                            x2 = getX(e);
                            y2 = getY(e);
                        }

                        function startDrawing(e) {
                            if(e.which == 1 || e.which == 0){
                                isDrawing = true;


                                context.beginPath();
                                context.moveTo(getX(e), getY(e));
                                e.preventDefault();


                            }
                            x = getX(e);
                            y = getY(e);
                        }


                        function stopDrawing(e) {
                            img.src = canvas.toDataURL();
                            isDrawing = false;

                            if(e.type != 'mouseout' && e.type != 'touchend' && fig == 1){
                                restore_array.push(context.getImageData(0, 0, canvas.width, canvas.height));
                                start_index += 1;
                                console.log(restore_array);
                            }
                        }

                        function draw_2(e) {
                            if(isDrawing == true && fig == 1){
                                context.clearRect(0,0,canvas.width, canvas.height);
                                context.drawImage(img, 0, 0);
                                current_coords(e);
                                draw_ellipce();
                                context.strokeStyle = stroke_color;
                                context.lineWidth = stroke_width;
                                context.stroke();
                            }
                            e.preventDefault();
                        }
                        function current_center_radius(){
                            if(x2 > x || x2 == x){
                                R_x = (x2 - x) / 2;
                                centerX = R_x + x;
                            }
                            if(x2 < x){
                                R_x = (x - x2) / 2;
                                centerX = x - R_x;
                            }

                            if(y2 > y || y2 == y){
                                R_y = (y2 - y) / 2;
                                centerY = R_y + y;
                            }
                            if(y2 < y){
                                R_y = (y - y2) / 2;
                                centerY = y - R_y;
                            }
                        }

                        function draw_ellipce() {
                            current_center_radius();
                            context.save();

                            if(R_x > R_y || R_x == R_y) {
                                R = R_x;
                                scale_y = R_y / R_x;
                                scale_x = 1;
                                if(scale_y != 0){
                                    centerY = centerY / scale_y;
                                }
                                context.scale(1, scale_y);
                            }
                            if(R_x < R_y) {
                                R = R_y;
                                scale_x = R_x / R_y;
                                scale_y = 1;
                                if(scale_x != 0){
                                    centerX = centerX / scale_x;
                                }
                                context.scale(scale_x, 1);
                            }


                            context.beginPath();
                            context.translate(centerX, centerY);
                            if(scale_y != 0 && scale_x != 0){
                                context.arc(0,0, R, 0, 2*Math.PI);
                            }
                            context.restore();
                            context.stroke();

                        }


                    }







                    function d_3(){

                        fig = 2;

                        if(f3 == 1){
                            return;
                        }
                        f3 = 1;


                        console.log(fig);
                        canvas.addEventListener("mousedown", startDrawing, false);
                        canvas.addEventListener("mousemove", draw_3, false);
                        canvas.addEventListener("mouseup", stopDrawing, false);
                        canvas.addEventListener("touchstart", startDrawing, false);
                        canvas.addEventListener("touchmove", draw_3, false);
                        canvas.addEventListener("touchend", stopDrawing, false);
                        canvas.addEventListener("mouseout", stopDrawing, false);



                        function current_width_height(){
                            rect_width = Math.abs(x2 - x);
                            rect_height = Math.abs(y2 - y);
                        }
                        function drawRect() {
                            current_width_height();
                            context.beginPath();
                            if (x2 < x) x_start = x2;
                            if (y2 < y) y_start = y2;
                            if (x2 > x) x_start = x;
                            if (y2 > y) y_start = y;
                            if (x2 == x) x_start = x;
                            if (y2 == y) y_start = y;
                            context.rect(x_start, y_start, rect_width, rect_height);
                            context.stroke();
                        }
                        isDrawing = false;
                        function getX(e) {
                            if (e.pageX == undefined) {return e.targetTouches[0].pageX - canvas.offsetLeft}
                            else {return e.pageX - canvas.offsetLeft}
                        }
                        function getY(e) {
                            if (e.pageY == undefined) {return e.targetTouches[0].pageY - canvas.offsetTop}
                            else {return e.pageY - canvas.offsetTop}
                        }
                        function current_coords(e){
                            x2 = getX(e);
                            y2 = getY(e);
                        }

                        function startDrawing(e) {
                            if(e.which == 1 || e.which == 0){
                                isDrawing = true;
                            }
                            x = getX(e);
                            y = getY(e);
                        }
                        function stopDrawing(e) {
                            img.src = canvas.toDataURL();
                            isDrawing = false;

                            if(e.type != 'mouseout' && e.type != 'touchend' && fig == 2){
                                restore_array.push(context.getImageData(0, 0, canvas.width, canvas.height));
                                start_index += 1;
                                console.log(fig, restore_array);
                            }
                        }
                        function draw_3(e) {
                            if(isDrawing == true && fig == 2){
                                context.clearRect(0,0,canvas.width, canvas.height);
                                context.drawImage(img, 0, 0);
                                context.strokeStyle = stroke_color;
                                context.lineWidth = stroke_width;
                                current_coords(e);
                                drawRect();
                            }
                        }
                    }
                </script>

                    <button type="submit" id="upload_profile_btn" style="
                            width: 100%;
                            max-width: 150px;
                            margin-top: 15px;
                            align-self: flex-end;
                        ">
                        Загрузить
                    </button>
<!--                </form>-->


            </div>
        </div>
    </div>
</section>
<script>

    const uploadForm = document.querySelector('#uploadForm')
    const inpFile = document.querySelector('.inpFile')
    let elem = document.querySelector('.itemBar')
    const rootDiv = document.querySelector('.container')

    let subbtn = document.getElementById('upload_profile_btn')

    function ext(name) {
        var m = name.match(/\.([^.]+)$/)
        return m && m[1]
    }

    inpFile.onchange = (i) => {
        console.log(1);
        if(inpFile.files.length) {
            let fileName = inpFile.files[0].name
            console.log(fileName)
            var splittedFileName = ext(fileName)
            document.querySelector('.vid-name').style.display = 'inline-table'
            document.querySelector('.vid-name').textContent = fileName
            document.querySelector('.vid-name').style.border = '1px dashed black'
            document.querySelector('.vid-name').style.width = '10%'
            document.querySelector('.vid-name').style.color = 'black'
        }
        if (splittedFileName == 'png' || splittedFileName == 'jpg' || splittedFileName == 'jpeg') {

            document.getElementById('upload_profile_btn').removeAttribute('disabled');
            document.getElementById('upload_profile_btn').style.background = '#FF645F';

            document.getElementById('paint_block').style.display = 'block';
            let canvas = document.getElementById("c1_new");
            //canvas.style.backgroundImage = "url('/files/profile/hyperpc-wallpaper-4K.jpg')";
            canvas.style.backgroundImage = "url('" + URL.createObjectURL(document.querySelector('[name=inpFile]').files[0]) + "')";

            let GlobalWidth = 0;
            let GlobalHeight = 0;
            const imgss = new Image();
            imgss.onload = function() {
                GlobalWidth = this.width;
                GlobalHeight = this.height;
            }
            imgss.src = URL.createObjectURL(document.querySelector('[name=inpFile]').files[0]);

            subbtn.onclick = (e) => {
                    e.preventDefault();
                    const files = document.querySelector('[name=inpFile]').files[0]
                    const formData = new FormData()
                    formData.append('file', files)

                    console.log(inpFile.files)
                    console.log(inpFile.files[0])
                    console.log(files)


                    formData.append('name', document.getElementById('profile_name').value)
                    formData.append('description', document.getElementById('profile_description').value)
                    formData.append('style', document.getElementById('style').value)

                    canvas.width = GlobalWidth;
                    canvas.height = GlobalHeight;
                    //render the image
                    console.log(img)
                    context.drawImage(img, 0, 0, GlobalWidth, GlobalHeight);
                    var img_s = canvas.toDataURL('image.png').replace('data:image/png;base64,', '');
                    formData.append('draw_photo', img_s)

                    canvas.width = 1000;
                    canvas.height = 500;
                    //render the image
                    context.drawImage(img, 0, 0, 1000, 500);


                if (document.getElementById('radio1').checked == true) {
                        formData.append('type', 1)
                    } else if (document.getElementById('radio2').checked == true) {
                        formData.append('type', 2)
                    } else if (document.getElementById('radio3').checked == true) {
                        formData.append('type', 3)
                    }

                    console.log(formData)

                    const xhr = new XMLHttpRequest()

                    xhr.open('POST', '/uploadProfile')
                    xhr.upload.addEventListener('progress', e => {
                        const percent = e.lengthComputable ? (e.loaded / e.total) * 100 : 0;
                        elem.style.width = percent.toFixed(2) + '%'
                        document.querySelector('#load-label').textContent = percent.toFixed(2) + '%'
                    })

                    xhr.onload = () => {

                        document.querySelector('#load-label2').textContent = 'Загрузка завершена'
                        document.querySelector('.label').style.color = '#52C78F'
                        document.querySelector('.profile-name').setAttribute('disabled', true)
                        document.querySelector('.profile-desc').setAttribute('disabled', true)
                        document.getElementById('style').setAttribute('disabled', true)
                        document.querySelector('[for="inpFile1"]').style.display = 'none'
                        document.querySelector('.vid-name').style.display = 'none'
                        document.querySelector('[type="submit"]').style.display = 'none'
                        document.querySelector('#load').style.color = '#52C78F'
                        document.querySelector('#process-itemBar').style.width = '100%'
                        document.querySelector('#process').style.color = '#52C78F'
                        document.querySelector('#process-label').style.color = '#52C78F'
                        document.querySelector('#process-label').textContent = 'Обработка...'


                        let JSONobj = JSON.parse(xhr.response)
                        console.log(JSONobj.status)
                        console.log(JSONobj)

                        document.getElementById('preresult').style.display = 'block';
                        document.getElementById('photo').setAttribute('src', `/files/profile/${JSONobj.photo}`)

                        if (JSONobj.status == 'success') {
                            var xhr2 = new XMLHttpRequest()
                            var formdata2 = new FormData()
                            formdata2.append('id', JSONobj.id)
                            var proccess = setInterval(() => {
                                xhr2.open('POST', '/checkProfile')
                                xhr2.send(formdata2)
                                xhr2.onload = () => {
                                    let JSONobj2 = JSON.parse(xhr2.response)
                                    if (JSONobj2.is_processed == 1) {
                                        clearInterval(proccess)
                                        document.querySelector('#process-label').style.display = 'none';
                                        document.querySelector('#process-label2').textContent = 'Обработка завершена';
                                        document.querySelector('#process-label2').style.color = '#52C78F';

                                        document.getElementById('photo_res').setAttribute('src', `/files/profile/photo/${JSONobj2.photo_res}`)
                                        document.getElementById('result').style.display = 'block';
                                    }
                                }
                            }, 2000)
                        }

                        let responseObj = xhr.response;
                        console.log(responseObj); // Привет, мир!
                    }
                    // let JSONobj = JSON.parse(xhr.response)
                    // if(JSONobj.name){}
                    xhr.send(formData)

            }
        } else {
            document.querySelector('.vid-name').style.display = 'inline-table'
            document.querySelector('.vid-name').style.border = 'none'
            document.querySelector('.vid-name').style.width = '100%'
            document.querySelector('.vid-name').style.color = 'red'
            document.querySelector('.vid-name').textContent = 'Загрузите Фото, файлы другого формата будут очищаться.'
            document.getElementById('upload_profile_btn').setAttribute('disabled', true);
            document.getElementById('upload_profile_btn').style.background = 'gray';
            if (i.value) {
                try {
                    i.value = '';
                } catch (err) {
                }
                if (i.value) {
                    var form = document.createElement('form'),
                        parentNode = i.parentNode, ref = i.nextSibling;
                    form.appendChild(i);
                    form.reset();
                    parentNode.insertBefore(i, ref);
                }
            }
        }
}


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/footer.php';
?>