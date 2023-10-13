<?php
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
                        <div class="label" id="process-label2"></div>
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

                            <div id="result" style="display: none;">
                                <div style="font-size: 20px;">Результат</div>
                                <img style="max-width: 500px; max-height: 250px;" src="/templates/default/assets/img/news-1.jpg">
                            </div>

                        </div>

                        <div class="info-inputs">
                            <input type="text" class="profile-name" id="profile_name" placeholder="Введите название...">
                            <textarea name="" cols="30" rows="10" id="profile_description" class="profile-desc" placeholder="Введите описание..."></textarea>
                        </div>


                        <div>
                            Выберите тип обработки
                        </div>
                        <label><input type="radio" id="radio1" name="e"> First</label>
                        <label><input type="radio" id="radio2" name="e"> Second</label>
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
                                        document.querySelector('#process-label2').textContent = 'Обработка завершена'

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
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/footer.php';
?>