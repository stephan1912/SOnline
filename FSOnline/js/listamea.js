function arataModalSerial(id, nume, divBox){
        var h = document.createElement('header');
        h.style.width = "100%";
        h.style.textAlign = "center";
        var header = document.createElement('h2');
        header.innerText = nume;
        header.style.marginLeft = "auto";
        header.style.marginRight = "auto";
        header.style.display = "inline-block";
        h.appendChild(header);
        var foot = document.createElement('p');
        var adauga = document.createElement("button");
        adauga.innerText = "Arata episoade";
        adauga.className = "fs_button";
        adauga.style.left = "15px";
        adauga.style.width = "175px";
        adauga.onclick = function(){
            window.location.href = "listamea.php?serial="+id;
        }
        foot.appendChild(adauga);
        var hh = document.createElement('footer');
        hh.style.width = "100%";
        hh.style.textAlign = "center";
        hh.appendChild(foot);
        var inchide = document.createElement("button");
        inchide.innerText = "Elimina de pe lista";
        inchide.className = "fs_button";
        inchide.style.width = "175px";
        foot.appendChild(inchide);
        inchide.onclick = function(){
            doXmlRequest("DELETE", "componente/eliminaSerial.php?id="+id, function(response){
                console.log(response);
                if(response == 'good'){
                    divBox.remove();
                    arataModalSucces();
                }
                else{
                    arataModalEsec();
                }
            });
        }
        createModal(h, document.createElement('section'), hh);
}

function arataModalSucces(){
    var head = document.createElement('h2');
    head.innerText = "Serial eliminat!";

    var para = document.createElement('p');
    para.innerHTML = "Serialul a fost eliminat de pe lista dumneavoastra. Puteti sa il readaugati accesand sectiunea 'Seriale'.";

    var foot = document.createElement('p');
    var lista = document.createElement("button");
    lista.innerText = "Sectiunea 'Seriale'";
    lista.className = "fs_button";
    lista.style.left = "15px";
    lista.style.width = "175px";
    lista.onclick = function(){
        window.location.href = "seriale.php";
    }
    foot.appendChild(lista);

    var inchide = document.createElement("button");
    inchide.innerText = "Inchide";
    inchide.className = "fs_button";
    inchide.style.left = "15px";
    inchide.style.width = "175px";
    inchide.onclick = function(){
        document.getElementById("modalElement").remove();
    }
    foot.appendChild(inchide);
    createModal(head, para, foot);
}

function arataModalEsec(){
    var head = document.createElement('h2');
    head.innerText = "Oopss...";

    var para = document.createElement('p');
    para.innerHTML = "Ceva nu a functionat, va rugam sa reincercati.";

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

function checkBoxClick(id, cb){
    if (cb.checked == true){
        doXmlRequest("PUT", "componente/modificaEpisodVizionat.php?vizionat=1&id="+id, function(response){
            if(response != "good"){
                alert("A aparut o eroare!Va rugam sa reincercati.");
            }
        });
    } else {
        doXmlRequest("PUT", "componente/modificaEpisodVizionat.php?vizionat=0&id="+id, function(response){
            if(response != "good"){
                alert("A aparut o eroare!Va rugam sa reincercati.");
            }
        });
    }
}

function collapseLiSezon(sez, btn){
    if(btn.hasAttribute('collapse') == false){
        if(document.getElementById('tabelSezon_'+sez).style.display == "none"){
            btn.setAttribute('collapse', 0);
        }
        else{
            btn.setAttribute('collapse', 1);
        }
    }
    if(btn.getAttribute('collapse') == 1){
        document.getElementById('tabelSezon_'+sez).style.display = "none";
        btn.setAttribute('collapse', 0);
        btn.innerHTML = "+";
    }
    else{
        document.getElementById('tabelSezon_'+sez).style.display = "table";
        btn.setAttribute('collapse', 1);
        btn.innerHTML = "-";
    }
}