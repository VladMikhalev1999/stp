function change_to_input_form(id, _hid) {
    let add = document.getElementById(id)
    add.style.visibility = "hidden";
    let hid = document.getElementById(_hid)
    hid.style.visibility = "visible";
}

function change_to_button(id, _hid, tid = null) {
    let add = document.getElementById(id)
    add.style.visibility = "hidden";
    let hid = document.getElementById(_hid)
    add.style.visibility = "visible";
    hid.style.visibility = "hidden";
    if (tid != null) document.getElementById(tid).value = "";
}

function append_request(id, tid = null) {
    if (tid != null) return "get_films.php?id=" + id + "&name=" + document.getElementById(tid).value;
    return document.location.href = "films.php?id=" + id; 
}

function rename(id, tid, sid) {
    let ind = document.getElementById(sid).selectedIndex;
    if (tid != null) return "get_films.php?id=" + id + "&name=" + document.getElementById(tid).value + "&fid=" + document.getElementById(sid).options[ind].value;
    return "get_films.php?id=" + id + "&fid=" + document.getElementById(sid).options[ind].value;
}

function ajax(id, tid = null, sid = null) {
    var objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function() {
    if(objXMLHttpRequest.readyState === 4) {
        if(objXMLHttpRequest.status === 200) {
            var table = document.getElementById("tbl_films");
            update_table(table, objXMLHttpRequest.responseText)
            update_lists(['sel', 'sel1'], objXMLHttpRequest.responseText)
        } else {
            alert('Error Code: ' +  objXMLHttpRequest.status);
            alert('Error Message: ' + objXMLHttpRequest.statusText);
        }
    }
    }
    if (sid == null) objXMLHttpRequest.open('GET', append_request(id, tid));
    else objXMLHttpRequest.open('GET', rename(id, tid, sid));
    objXMLHttpRequest.send();
}

function update_lists(lids, response) {
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

function update_table(table, response) {
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