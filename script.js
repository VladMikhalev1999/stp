function changeToInputForm(id, _hid) {
    let add = document.getElementById(id)
    add.style.visibility = "hidden";
    let hid = document.getElementById(_hid)
    hid.style.visibility = "visible";
}

function changeToButton(id, _hid, tid = null) {
    let add = document.getElementById(id)
    add.style.visibility = "hidden";
    let hid = document.getElementById(_hid)
    add.style.visibility = "visible";
    hid.style.visibility = "hidden";
    if (tid != null) document.getElementById(tid).value = "";
}

function appendRequest(id, tid = null, fn) {
    if (tid != null) return fn + "?id=" + id + "&name=" + document.getElementById(tid).value;
    return fn + "?id=" + id; 
}

function rename(id, tid, sid, fn) {
    let ind = document.getElementById(sid).selectedIndex;
    if (tid != null) return fn + "?id=" + id + "&name=" + document.getElementById(tid).value + "&fid=" + document.getElementById(sid).options[ind].value;
    return fn + "?id=" + id + "&fid=" + document.getElementById(sid).options[ind].value;
}

function ajax(id, tid = null, sid = null, fn = "get_films.php") {
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function() {
    if(objXMLHttpRequest.readyState === 4) {
        if(objXMLHttpRequest.status === 200) {
            var table = document.getElementById("tbl_films");
            updateTable(table, objXMLHttpRequest.responseText)
            updateLists(['sel', 'sel1'], objXMLHttpRequest.responseText)
        } else {
            alert('Error Code: ' +  objXMLHttpRequest.status);
            alert('Error Message: ' + objXMLHttpRequest.statusText);
        }
    }
    }
    if (sid == null) objXMLHttpRequest.open('GET', append_request(id, tid, fn));
    else objXMLHttpRequest.open('GET', rename(id, tid, sid, fn));
    objXMLHttpRequest.send();
}

function updateLists(lids, response) {
    let data = JSON.parse(response)
    for (let i = 0; i < lids.length; i++) {
        let lid = lids[i]
        let sel = document.getElementById(lid)
        while (sel.children.length != 0) {
            sel.removeChild(sel.firstChild)
        }
        for (let j = 0; j < data.length; j++) {
            let opt = document.createElement("option")
            opt.innerText = data[j]["ID"]
            sel.appendChild(opt)
        }
    }
}

function updateTable(table, response) {
    var x = document.createElement("tbody");
    table.replaceChild(x, table.children[0]);
    var body = table.children[0];
    var data = JSON.parse(response)
    var tr = document.createElement("tr");
    var td = document.createElement("th");
    td.innerText = "Номер"
    tr.appendChild(td)
    td = document.createElement("th");
    td.innerText = "Название"
    tr.appendChild(td)
    body.appendChild(tr);
    for (let i = 0; i < data.length; i++) {
        let el = data[i]
        tr = document.createElement("tr")
        td = document.createElement("td")
        td.innerText = el["ID"]
        tr.appendChild(td);
        td = document.createElement("td")
        td.innerText = el["NAME"]
        tr.appendChild(td)
        body.appendChild(tr)
    }
}