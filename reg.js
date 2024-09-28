function checkpassword() {
    var nameU = document.getElementById("Uname").value;
    var mail = document.getElementById("myEmail").value;
    var pwrds = document.getElementById("pwrd").value;
    var nmbr = document.getElementById("Mnumber").value;

    checkme(nameU, "Uname");
    checkme(mail, "myEmail");
    checkme(pwrds, "pwrd");
    checkme(nmbr, "Mnumber");

    checkUsernameUnique(nameU);
    return true; 
}

function checkme(vari, idd) {
    if (vari == "" || vari == null) {
        document.getElementById(idd).style.borderColor = "red";
    } else {
        document.getElementById(idd).style.borderColor = "green";
    }
}

function checkUsernameUnique(username) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "configreg.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText == "unique") {
                document.getElementById("Uname").style.borderColor = "green";
                document.getElementById("btn").disabled = false;
            } else {
                document.getElementById("Uname").style.borderColor = "red";
                alert("Username already exists. Please choose another one.");
                document.getElementById("btn").disabled = true;
            }
        }
    };
    xhr.send("username=" + username);
}

function enableButton() {
    var checkBox = document.getElementById("cb");
    var text = document.getElementById("text");

    if (checkBox.checked) {
        text.style.display = "block";
        document.getElementById("btn").disabled = false;
    } else {
        text.style.display = "none";
        document.getElementById("btn").disabled = true;
    }
}
