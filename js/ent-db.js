function showMOC1(strRows) {

    if (strRows.length == 0) { 
        document.getElementById("tableRowCol").innerHTML = "";
        return;
    } else {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("tableRowCol").innerHTML = xmlhttp.responseText;
            }
        }
    }
    xmlhttp.open("GET","../admin/moc-data.php?rowCount="+strRows,true);
    xmlhttp.send();
}