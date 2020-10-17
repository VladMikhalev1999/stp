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
    if (tid != null) document.location.href = "films.php?id=" + id + "&name=" + document.getElementById(tid).value;
    else document.location.href = "films.php?id=" + id; 
}

function rename(id, tid, sid) {
    let ind = document.getElementById(sid).selectedIndex;
    if (tid != null) document.location.href = "films.php?id=" + id + "&name=" + document.getElementById(tid).value + "&fid=" + document.getElementById(sid).options[ind].value;
    else document.location.href = "films.php?id=" + id + "&fid=" + document.getElementById(sid).options[ind].value;
}