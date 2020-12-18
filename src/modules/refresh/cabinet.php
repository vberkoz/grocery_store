<?php

$login = "
<div class='row'>
    <div class='col-lg-4'></div>
    <div class='col-lg-4'>
        <div class='card'>
            <div class='card-body'>
                <h4 class='card-title'>$loginToCabinetCap</h4>
                <div style='height: 23px;'></div>
                <div class='form-group'>
                    <label for='email'>$cabinetEmailCap</label>
                    <input id='email' class='form-control' placeholder='name@gmail.com' type='email' onblur='validate(this)'>
                    <div class='invalid-feedback'>$invalidEmailCap</div>
                </div>
                <div class='form-group'>
                    <button type='button' class='btn btn-link float-right p-0'>$changePasswordCap</button>
                    <label for='secret'>$passwordCap</label>
                    <input id='secret' class='form-control' placeholder='******' type='password' onblur='validate(this)'>
                    <div class='invalid-feedback'>$invalidPasswordCap</div>
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary btn-block' onclick='login()'>
                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 515.556 515.556' height='1.2em' fill='currentColor' class='align-middle pb-1'>
                            <path d='m96.667 0v96.667h64.444v-32.223h257.778v386.667h-257.778v-32.222h-64.444v96.667h386.667v-515.556z'/>
                            <path d='m157.209 331.663 45.564 45.564 119.449-119.449-119.448-119.449-45.564 45.564 41.662 41.662h-166.65v64.445h166.65z'/>
                        </svg> $loginCap
                    </button>
                </div>
                <p class='text-center'>$firstTimeCap <a href='#'>$registerCap</a></p>
            </div>
        </div>
    </div>
    <div class='col-lg-4 mb-3'></div>
</div>
";

$register = "
<div class='row'>
    <div class='col-lg-3'></div>
    <div class='col-lg-6'>
        <div class='card'>
            <div class='card-body'>
                <header class='mb-4'>
                    <h4 class='card-title'>Зареєструвати користувача</h4>
                </header>
                <form action='#' method='post'>
                    <div class='form-group'>
                        <label>Ім'я користувача</label>
                        <input type='text' placeholder='Григорій' class='form-control is-invalid'>
                        <div class='invalid-feedback'>Ім'я має бути не менше 2-х символів</div>
                    </div>
                    <div class='form-group'>
                        <label>Електронна пошта</label>
                        <input type='email' placeholder='пр. name@gmail.com' class='form-control is-invalid'>
                        <div class='invalid-feedback'>Невірний формат електронної пошти</div>
                        <div class='invalid-feedback'>Така електронна пошта вже існує</div>
                        <small class='form-text text-muted'>Ми не передаємо особисту інформацію наших клієнтів іншим сторонам.</small>
                    </div>
                    <div class='form-row'>
                        <div class='form-group col-lg-6'>
                            <label>Створити пароль</label>
                            <input class='form-control is-invalid' type='password' placeholder='******'>
                            <div class='invalid-feedback'>Мінімум 6 символів</div>
                        </div>
                        <div class='form-group col-lg-6'>
                            <label>Повторити пароль</label>
                            <input class='form-control is-invalid' type='password' placeholder='******'>
                            <div class='invalid-feedback'>Паролі не співпадають</div>
                        </div>
                    </div>
                    <div class='form-group mt-3'>
                        <button type='submit' class='btn btn-primary btn-block' name='submit'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 30 512 450' height='1.2em' fill='currentColor' class='align-middle pb-1'>
                                <path d='m431.964 435.333c-.921-58.994-19.3-112.636-51.977-151.474-32.487-38.601-76.515-59.859-123.987-59.859s-91.5 21.258-123.987 59.859c-32.646 38.797-51.013 92.364-51.973 151.285 18.46 9.247 94.85 44.856 175.96 44.856 87.708 0 158.845-35.4 175.964-44.667z'/>
                                <circle cx='256' cy='120' r='88'/>
                            </svg>Зареєструватися
                        </button>
                    </div>
                </form>
                <p class='text-center'>Вже є акаунт? <a href='#'>Вхід</a></p>
            </div>
        </div>
    </div>
    <div class='col-lg-3 mb-3'></div>
</div>
";

return "
<main role='main' class='content container-fluid px-3' style='margin-top: 120px;'>
<div class='row'>
<div class='col-12 d-none' id='login'>$login</div>
<div class='col-12 d-none' id='register'>$register</div>

<div class='d-none' id='account'>
    <div id='account_menu'>
        <button class='btn btn-primary'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 30 515 455' height='1.4em' fill='currentColor' class='align-middle pb-1 pr-2'>
                <path d='m290 32.222c-113.405 0-207.262 84.222-222.981 193.333h-67.019l96.667 96.667 96.667-96.667h-61.188c14.972-73.444 80.056-128.889 157.854-128.889 88.832 0 161.111 72.28 161.111 161.111s-72.279 161.112-161.111 161.112c-51.684 0-100.6-25.079-130.84-67.056l-52.298 37.635c42.323 58.78 110.78 93.866 183.138 93.866 124.373 0 225.556-101.198 225.556-225.556s-101.183-225.556-225.556-225.556z'></path>
                <path d='m257.778 161.111v131.029l96.195 57.711 33.166-55.256-64.917-38.956v-94.527z'></path>
            </svg>".($lang == 'ua' ? 'Мої замовлення' : 'My orders')."
        </button>
        <button class='btn btn-light'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512.001 512.001' height='1.5em' fill='currentColor' class='align-middle pb-1 pr-2'>
                <path d='M504.008,223.961c-4.121-2.587-36.412-21.931-49.246-27.802l-15.903-38.392c4.725-12.695,13.752-48.308,15.164-54.482    c1.307-5.724-0.418-11.718-4.57-15.87l-24.868-24.867c-4.151-4.152-10.147-5.878-15.87-4.57    c-4.682,1.071-41.226,10.23-54.482,15.164L315.84,57.239c-5.618-12.28-24.386-43.807-27.802-49.246    c-3.121-4.973-8.581-7.992-14.453-7.992h-35.17c-5.872,0-11.332,3.019-14.454,7.992c-2.587,4.121-21.931,36.412-27.802,49.246    l-38.392,15.903c-12.695-4.725-48.308-13.752-54.482-15.164c-5.724-1.307-11.718,0.419-15.87,4.57L62.547,87.416    c-4.152,4.152-5.878,10.146-4.57,15.87c1.071,4.682,10.23,41.226,15.164,54.482L57.238,196.16    c-12.28,5.618-43.807,24.386-49.246,27.802C3.019,227.083,0,232.543,0,238.415v35.17c0,5.872,3.019,11.332,7.992,14.454    c4.121,2.587,36.412,21.931,49.246,27.802l15.903,38.392c-4.725,12.695-13.752,48.308-15.164,54.482    c-1.307,5.724,0.418,11.718,4.57,15.87l24.868,24.868c4.152,4.152,10.148,5.879,15.87,4.57    c4.682-1.071,41.226-10.23,54.482-15.164l38.392,15.903c5.618,12.28,24.386,43.807,27.802,49.246    c3.122,4.973,8.582,7.992,14.454,7.992h35.17c5.872,0,11.332-3.019,14.454-7.992c2.587-4.121,21.931-36.412,27.802-49.246    l38.392-15.903c12.695,4.725,48.308,13.752,54.482,15.164c5.726,1.31,11.719-0.418,15.87-4.57l24.868-24.868    c4.152-4.152,5.878-10.146,4.57-15.87c-1.071-4.682-10.23-41.226-15.164-54.482l15.903-38.392    c12.28-5.618,43.807-24.386,49.246-27.802c4.973-3.122,7.992-8.582,7.992-14.454v-35.17    C512,232.543,508.981,227.083,504.008,223.961z M256,367.605c-61.539,0-111.605-50.066-111.605-111.605    S194.461,144.396,256,144.396s111.605,50.066,111.605,111.605S317.539,367.605,256,367.605z'></path>
            </svg>".($lang == 'ua' ? 'Налаштування' : 'Settings')."
        </button>
        <button class='btn btn-outline-secondary' onclick='logout()'>
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 515 515' height='1.4em' fill='currentColor' class='align-middle pb-1 pr-2'>
                <path d='m225.556 0h64.444v257.778h-64.444z'></path>
                <path d='m322.222 73.944v68.602c56.798 24.932 96.667 81.559 96.667 147.454 0 88.832-72.28 161.111-161.111 161.111s-161.111-72.279-161.111-161.111c0-65.896 39.869-122.523 96.667-147.454v-68.602c-93.051 27.813-161.112 114.097-161.112 216.056 0 124.358 101.182 225.556 225.556 225.556s225.556-101.198 225.556-225.556c0-101.959-68.061-188.243-161.112-216.056z'></path>
            </svg>".($lang == 'ua' ? 'Вихід' : 'Logout')."
        </button>
    </div>
    <div id='order_list'></div>
</div>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js'></script>
<script src='https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js'></script>
<script src='$assets/js/main.js'></script>
<script src='$assets/js/categories.js'></script>
<script src='$assets/js/search.js'></script>
<script src='$assets/js/cabinet.js'></script>
<script src='$assets/js/validation.js'></script>
<script src='$assets/js/card.js'></script>
";
