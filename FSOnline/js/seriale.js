var searchBtn = document.getElementById('buttonSearch');
var input = document.getElementById('inputSearch');
searchBtn.onclick = function(){
    var text = document.getElementById('inputSearch').value;
    window.location.href = "seriale.php?pagina=1&cauta="+text;
}
input.onkeypress = function(e){
    if (e.keyCode == 13) {
        var text = document.getElementById('inputSearch').value;
        window.location.href = "seriale.php?pagina=1&cauta="+text;
    }
}

function arataInfoSerial(id){
    doXmlRequest("GET", "componente/preluareInfoSerial.php?id="+id, function(response){
        var obj = JSON.parse(response);
        var header = document.createElement('h2');
        header.innerText = obj["nume"];
        var content = document.createElement('div');
        content.style.overflow = "hidden";
        var para = document.createElement('p');
        para.style.textIndent = '4ch';
        para.style.marginBottom = "5px";
        para.innerText = obj["descriere"];
        content.appendChild(para);
        var ul = document.createElement('ul');
        ul.style.display = "inline-block";
        ul.style.marginLeft = "25px";
        ul.style.width = "auto";
        var li = document.createElement('li');
        li.innerText = "Anul: " + obj["an"];
        ul.appendChild(li);li = document.createElement('li');
        li.innerText = "Gen: " + obj["gen"];
        ul.appendChild(li);li = document.createElement('li');
        content.appendChild(ul);
        ul = document.createElement('ul');
        ul.style.display = "inline-block";
        ul.style.marginLeft = "25px";
        ul.style.width = "auto";
        li.innerText = "Sezoane: " + obj["sezoane"];
        ul.appendChild(li);li = document.createElement('li');
        li.innerText = "Episoade: " + obj["episoade"];
        ul.appendChild(li);li = document.createElement('li');
        content.appendChild(ul);
        var foot = document.createElement('p');
        var adauga = document.createElement("button");
        adauga.innerText = "Adauga pe lista";
        adauga.className = "fs_button";
        adauga.style.left = "15px";
        adauga.style.width = "150px";
        adauga.onclick = function(){
            adaugaSerialPeLista(obj["id"]);
        }
        foot.appendChild(adauga);

        var inchide = document.createElement("button");
        inchide.innerText = "Inchide";
        inchide.className = "fs_button";
        inchide.style.width = "150px";
        foot.appendChild(inchide);
        inchide.onclick = function(){
            document.getElementById("modalElement").remove();
        }
        createModal(header, content, foot);
    });
}

function adaugaSerialPeLista(id){
    doXmlRequest("POST", "componente/adaugaSerial.php", function(resp){
        console.log(resp);
        if(resp == "ok_logat"){
            arataModalLogat();
        }
        else if(resp == "ok"){
            arataModalOk();
        }
        else{
            arataModalNotOk();
        }
    }, "id="+id);
}

function arataModalNotOk(){
    var head = document.createElement('h2');
    head.innerText = "Oopss...";

    var para = document.createElement('p');
    para.innerHTML = "Serialul se afla deja pe lista dumeavoastra.";

    var foot = document.createElement('p');
    var lista = document.createElement("button");
    lista.innerText = "Lista mea";
    lista.className = "fs_button";
    lista.style.left = "15px";
    lista.style.width = "150px";
    lista.onclick = function(){
        window.location.href = "listamea.php";
    }
    foot.appendChild(lista);

    var inchide = document.createElement("button");
    inchide.innerText = "Inchide";
    inchide.className = "fs_button";
    inchide.style.left = "15px";
    inchide.style.width = "150px";
    inchide.onclick = function(){
        document.getElementById("modalElement").remove();
    }
    foot.appendChild(inchide);
    createModal(head, para, foot);

}

function arataModalLogat(){
    var head = document.createElement('h2');
    head.innerText = "Serial adaugat!";

    var para = document.createElement('p');
    para.innerHTML = "Serialul a fost adaugat si este disponibil in sectiunea Lista Mea.";

    var foot = document.createElement('p');
    var lista = document.createElement("button");
    lista.innerText = "Lista mea";
    lista.className = "fs_button";
    lista.style.left = "15px";
    lista.style.width = "150px";
    lista.onclick = function(){
        window.location.href = "listamea.php";
    }
    foot.appendChild(lista);
    
    var inchide = document.createElement("button");
    inchide.innerText = "Inchide";
    inchide.className = "fs_button";
    inchide.style.left = "15px";
    inchide.style.width = "150px";
    inchide.onclick = function(){
        document.getElementById("modalElement").remove();
    }
    foot.appendChild(inchide);
    createModal(head, para, foot);

}

function arataModalOk(){
    var head = document.createElement('h2');
    head.innerText = "Serial adaugat!";

    var para = document.createElement('p');
    para.innerHTML = "Serialul a fost adaugat!<br>Pentru a avea acces la lista de seriale de pe orice device, va sfatuim sa va creati un cont.";

    var foot = document.createElement('p');
    var lista = document.createElement("button");
    lista.innerText = "Lista mea";
    lista.className = "fs_button";
    lista.style.left = "15px";
    lista.style.width = "150px";
    lista.onclick = function(){
        window.location.href = "listamea.php";
    }
    foot.appendChild(lista);

    var login = document.createElement("button");
    login.innerText = "Creeaza cont";
    login.className = "fs_button";
    login.style.width = "150px";
    login.onclick = function(){
        window.location.href = "login.php";
    }
    foot.appendChild(login);
    var inchide = document.createElement("button");
    inchide.innerText = "Inchide";
    inchide.className = "fs_button";
    inchide.style.left = "15px";
    inchide.style.width = "150px";
    inchide.onclick = function(){
        document.getElementById("modalElement").remove();
    }
    foot.appendChild(inchide);
    createModal(head, para, foot);

}