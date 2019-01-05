var btnLogin = document.getElementById('btnArataLogin');
var btnReg = document.getElementById('btnArataRegister');

btnLogin.onclick = function(){
    document.getElementById('formLogin').style.display='block';
    document.getElementById('formRegister').style.display='none';
    btnLogin.className = "fs_button_activ";
    btnReg.className = "fs_button";
}
btnReg.onclick = function(){
    document.getElementById('formLogin').style.display='none';
    document.getElementById('formRegister').style.display='block';
    btnReg.className = "fs_button_activ";
    btnLogin.className = "fs_button";
}

